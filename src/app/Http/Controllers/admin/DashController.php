<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contato;
use App\Models\Venda;
use Illuminate\Support\Facades\DB;

class DashController extends Controller
{
    public function index()
    {
        // As datas dos pedidos são gravadas no horário de Brasília
        $agora = now('America/Sao_Paulo');

        // Pedidos que contam como venda (cancelados ficam de fora)
        $vendasValidas = fn () => Venda::where('status_venda', '!=', 'CANCELADA');

        $resumo = [
            'pedidosHoje'    => Venda::whereDate('data_venda', $agora->toDateString())->count(),
            'emPreparo'      => Venda::where('status_venda', 'EM ANDAMENTO')->count(),
            'faturamentoMes' => (float) $vendasValidas()
                ->whereYear('data_venda', $agora->year)
                ->whereMonth('data_venda', $agora->month)
                ->sum('valor_venda'),
            'mensagensNovas' => Contato::where('status_contato', 'ENVIADO')->count(),
        ];

        // Faturamento e quantidade de pedidos dos últimos 6 meses (inclui meses sem venda)
        $inicio = $agora->copy()->startOfMonth()->subMonths(5);
        $porMes = $vendasValidas()
            ->where('data_venda', '>=', $inicio->format('Y-m-d H:i:s'))
            ->select(
                DB::raw("DATE_FORMAT(data_venda, '%Y-%m') as mes"),
                DB::raw('SUM(valor_venda) as total'),
                DB::raw('COUNT(*) as pedidos')
            )
            ->groupBy('mes')
            ->get()
            ->keyBy('mes');

        $nomesMeses = ['jan', 'fev', 'mar', 'abr', 'mai', 'jun', 'jul', 'ago', 'set', 'out', 'nov', 'dez'];
        $grafico = ['meses' => [], 'faturamento' => [], 'pedidos' => []];
        for ($i = 0; $i < 6; $i++) {
            $mes = $inicio->copy()->addMonths($i);
            $chave = $mes->format('Y-m');
            $grafico['meses'][] = $nomesMeses[$mes->month - 1] . '/' . $mes->format('y');
            $grafico['faturamento'][] = round((float) ($porMes[$chave]->total ?? 0), 2);
            $grafico['pedidos'][] = (int) ($porMes[$chave]->pedidos ?? 0);
        }

        $ultimosPedidos = Venda::with('cliente')
            ->orderByDesc('data_venda')
            ->orderByDesc('id_venda')
            ->limit(5)
            ->get();

        $statusPedido = PedidoController::STATUS;

        return view('admin/dash/dashboard', compact('resumo', 'grafico', 'ultimosPedidos', 'statusPedido'));
    }
}
