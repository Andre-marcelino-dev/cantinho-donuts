<?php

namespace App\Providers;

use App\Models\Categoria;
use App\Models\Contato;
use App\Models\Depoimento;
use App\Models\MateriaPrima;
use App\Models\Venda;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
// use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $categorias = Categoria::orderBy('nome_categoria')->get();
            $view->with('lista', $categorias);
            $view->with('categorias', $categorias);
            $view->with('filtroCategoria', $categorias);
        });

        // Dados da loja (config/services.php) com o telefone já formatado: (11) 98816-1211
        View::composer('*', function ($view) {
            $loja = config('services.loja');
            $numero = preg_replace('/^55/', '', preg_replace('/\D/', '', $loja['whatsapp']));
            $loja['telefone'] = strlen($numero) === 11
                ? sprintf('(%s) %s-%s', substr($numero, 0, 2), substr($numero, 2, 5), substr($numero, 7))
                : $numero;
            $loja['mapa'] = "{$loja['endereco']}, {$loja['cep']}, {$loja['cidade']}";
            $view->with('loja', $loja);
        });

        // Mensagens e notificações do topo do painel (só roda no cabeçalho do admin)
        View::composer('admin.partials.app-header', function ($view) {
            $mensagensNovas = Contato::where('status_contato', 'ENVIADO');

            $notificacoes = collect([
                [
                    'icone' => 'bi-receipt',
                    'texto' => 'pedido(s) em preparo',
                    'total' => Venda::where('status_venda', 'EM ANDAMENTO')->count(),
                    'link'  => route('admin.pedido', ['status' => 'EM ANDAMENTO']),
                ],
                [
                    'icone' => 'bi-star-fill',
                    'texto' => 'depoimento(s) para aprovar',
                    'total' => Depoimento::where('status_depoimento', 'PENDENTE')->count(),
                    'link'  => route('admin.depoimento', ['status' => 'PENDENTE']),
                ],
                [
                    'icone' => 'bi-box-seam',
                    'texto' => 'matéria(s)-prima(s) sem estoque',
                    'total' => MateriaPrima::where('qtde_atual_materia_prima', '<=', 0)->count(),
                    'link'  => route('admin.materia'),
                ],
            ])->where('total', '>', 0)->values();

            $view->with([
                'totalMensagensNovas' => (clone $mensagensNovas)->count(),
                'ultimasMensagens'    => $mensagensNovas->orderByDesc('criado_em_contato')->limit(5)->get(),
                'notificacoes'        => $notificacoes,
                'totalNotificacoes'   => $notificacoes->sum('total'),
            ]);
        });

        // Depoimentos aprovados no painel, para a seção de depoimentos da Home e da página Sobre
        View::composer('partials.depoimentos', function ($view) {
            $view->with('depoimentosSite', Depoimento::with('cliente')
                ->where('status_depoimento', 'APROVADO')
                ->whereHas('cliente')
                ->orderByDesc('criado_em_depoimento')
                ->limit(10)
                ->get());
        });
    }
}
