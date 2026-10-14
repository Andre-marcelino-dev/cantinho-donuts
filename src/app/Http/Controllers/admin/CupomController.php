<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Cupom;
use App\Models\Venda;


class CupomController extends Controller
{
    public function index()
    {
        $cupons = Cupom::orderByRaw("status_cupom = 'ATIVO' DESC")
            ->orderByDesc('data_fim_cupom')
            ->get();

        // Quantas vezes cada cupom já foi usado em pedidos
        $usos = Venda::whereNotNull('id_cupom')
            ->selectRaw('id_cupom, COUNT(*) as total')
            ->groupBy('id_cupom')
            ->pluck('total', 'id_cupom');

        $hoje = now('America/Sao_Paulo')->toDateString();

        return view('admin.cupom.index', compact('cupons', 'usos', 'hoje'));
    }

    public function store(Request $request)
    {
        $request->merge(['codigo_cupom' => strtoupper(trim((string) $request->codigo_cupom))]);
        $dados = $request->validate($this->regras(), $this->mensagens());

        Cupom::create($dados);

        return redirect()->route('admin.cupom')->with('sucesso', "Cupom {$dados['codigo_cupom']} criado com sucesso!");
    }

    public function update(Request $request, $id)
    {
        $cupom = Cupom::findOrFail($id);

        $request->merge(['codigo_cupom' => strtoupper(trim((string) $request->codigo_cupom))]);
        $dados = $request->validate($this->regras($cupom->id_cupom), $this->mensagens());

        $cupom->update($dados);

        return redirect()->route('admin.cupom')->with('sucesso', "Cupom {$dados['codigo_cupom']} atualizado com sucesso!");
    }

    public function alterarStatus($id)
    {
        $cupom = Cupom::findOrFail($id);
        $cupom->status_cupom = $cupom->status_cupom === 'ATIVO' ? 'INATIVO' : 'ATIVO';
        $cupom->save();

        return redirect()->back()->with('sucesso', 'Status atualizado!');
    }

    public function destroy($id)
    {
        $cupom = Cupom::findOrFail($id);

        // Pedidos antigos apontam para o cupom: nesse caso só dá para desativar
        if (Venda::where('id_cupom', $cupom->id_cupom)->exists()) {
            return redirect()->back()->withErrors(['cupom' => "O cupom {$cupom->codigo_cupom} já foi usado em pedidos. Desative-o em vez de excluir."]);
        }

        $cupom->delete();

        return redirect()->route('admin.cupom')->with('sucesso', 'Cupom excluído.');
    }

    private function regras($idIgnorado = null): array
    {
        return [
            // Só letras e números, sem espaço (ex.: THEGUSTA10)
            'codigo_cupom'         => ['required', 'string', 'max:20', 'alpha_num', Rule::unique('tbl_cupons', 'codigo_cupom')->ignore($idIgnorado, 'id_cupom')],
            'valor_desconto_cupom' => 'required|numeric|min:1|max:100',
            'data_inicio_cupom'    => 'required|date',
            'data_fim_cupom'       => 'required|date|after_or_equal:data_inicio_cupom',
            'status_cupom'         => 'required|in:ATIVO,INATIVO',
        ];
    }

    private function mensagens(): array
    {
        return [
            'codigo_cupom.required'         => 'Informe o código do cupom.',
            'codigo_cupom.alpha_num'        => 'O código pode ter só letras e números, sem espaços.',
            'codigo_cupom.unique'           => 'Já existe um cupom com esse código.',
            'codigo_cupom.max'              => 'O código pode ter no máximo 20 caracteres.',
            'valor_desconto_cupom.required' => 'Informe a porcentagem de desconto.',
            'valor_desconto_cupom.min'      => 'O desconto deve ser de pelo menos 1%.',
            'valor_desconto_cupom.max'      => 'O desconto pode ser de no máximo 100%.',
            'data_fim_cupom.after_or_equal' => 'A data final deve ser igual ou depois da data inicial.',
        ];
    }
}
