<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Fornecedor;
use App\Models\MateriaPrima;
use App\Models\MovimentacaoEstoque;


class MateriaPrimaController extends Controller
{
    public function index()
    {
        $materias = MateriaPrima::with('fornecedor')
            ->withCount('movimentacoes')
            ->orderBy('nome_materia_prima')
            ->get();
        $fornecedores = Fornecedor::where('status_fornecedor', 'ATIVO')->orderBy('nome_fornecedor')->get();
        $unidades = MateriaPrima::UNIDADES;

        return view('admin.materia.index', compact('materias', 'fornecedores', 'unidades'));
    }

    public function store(Request $request)
    {
        $request->merge(['qtde_inicial' => str_replace(',', '.', (string) $request->qtde_inicial)]);
        $dados = $request->validate($this->regras() + [
            'qtde_inicial' => 'nullable|numeric|min:0|max:9999999',
        ], $this->mensagens());

        DB::transaction(function () use ($dados) {
            $materia = MateriaPrima::create([
                'id_fornecedor'            => $dados['id_fornecedor'],
                'nome_materia_prima'       => trim($dados['nome_materia_prima']),
                'unid_med_materia_prima'   => $dados['unid_med_materia_prima'],
                'qtde_atual_materia_prima' => 0,
            ]);

            // O estoque inicial entra como uma movimentação, para o histórico explicar a quantidade
            if ((float) ($dados['qtde_inicial'] ?? 0) > 0) {
                MovimentacaoEstoque::registrar($materia->id_materia_prima, 'ENTRADA', (float) $dados['qtde_inicial'], 'Estoque inicial');
            }
        });

        return redirect()->route('admin.materia')->with('sucesso', 'Matéria-prima cadastrada com sucesso!');
    }

    // A quantidade não é editada aqui: só muda pelas movimentações
    public function update(Request $request, $id)
    {
        $materia = MateriaPrima::findOrFail($id);
        $dados = $request->validate($this->regras(), $this->mensagens());

        $materia->update([
            'id_fornecedor'          => $dados['id_fornecedor'],
            'nome_materia_prima'     => trim($dados['nome_materia_prima']),
            'unid_med_materia_prima' => $dados['unid_med_materia_prima'],
        ]);

        return redirect()->route('admin.materia')->with('sucesso', 'Matéria-prima atualizada com sucesso!');
    }

    // Só exclui se nunca teve movimentação (o histórico aponta para ela)
    public function destroy($id)
    {
        $materia = MateriaPrima::withCount('movimentacoes')->findOrFail($id);

        if ($materia->movimentacoes_count > 0) {
            return redirect()->back()->withErrors(['materia' => "{$materia->nome_materia_prima} já tem movimentações e não pode ser excluída."]);
        }

        $materia->delete();

        return redirect()->route('admin.materia')->with('sucesso', 'Matéria-prima excluída.');
    }

    private function regras(): array
    {
        return [
            'nome_materia_prima'     => 'required|string|max:30',
            'id_fornecedor'          => 'required|integer|exists:tbl_fornecedores,id_fornecedor',
            'unid_med_materia_prima' => 'required|in:' . implode(',', array_keys(MateriaPrima::UNIDADES)),
        ];
    }

    private function mensagens(): array
    {
        return [
            'nome_materia_prima.required' => 'Informe o nome da matéria-prima.',
            'nome_materia_prima.max'      => 'O nome pode ter no máximo 30 caracteres.',
            'id_fornecedor.required'      => 'Escolha o fornecedor.',
            'unid_med_materia_prima.in'   => 'Escolha uma unidade da lista.',
            'qtde_inicial.numeric'        => 'O estoque inicial precisa ser um número, ex.: 12,5.',
            'qtde_inicial.min'            => 'O estoque inicial não pode ser negativo.',
        ];
    }
}
