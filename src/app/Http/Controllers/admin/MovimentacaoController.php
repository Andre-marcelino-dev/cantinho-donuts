<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MateriaPrima;
use App\Models\MovimentacaoEstoque;


class MovimentacaoController extends Controller
{
    public function index(Request $request)
    {
        $filtroMateria = (int) $request->query('materia') ?: null;
        $filtroTipo = in_array($request->query('tipo'), ['ENTRADA', 'SAIDA'], true) ? $request->query('tipo') : null;

        $movimentacoes = MovimentacaoEstoque::with('materiaPrima')
            ->when($filtroMateria, fn ($q) => $q->where('id_materia_prima', $filtroMateria))
            ->when($filtroTipo, fn ($q) => $q->where('tipo_controle', $filtroTipo))
            ->orderByDesc('data_controle')
            ->orderByDesc('id_controle')
            ->limit(200)
            ->get();

        $materias = MateriaPrima::orderBy('nome_materia_prima')->get();

        return view('admin.movimentacao.index', compact('movimentacoes', 'materias', 'filtroMateria', 'filtroTipo'));
    }

    public function store(Request $request)
    {
        // Aceita quantidade com vírgula (ex.: 2,5)
        $request->merge(['qtde_controle' => str_replace(',', '.', (string) $request->qtde_controle)]);

        $dados = $request->validate([
            'id_materia_prima' => 'required|integer|exists:tbl_materia_prima,id_materia_prima',
            'tipo_controle'    => 'required|in:ENTRADA,SAIDA',
            'qtde_controle'    => 'required|numeric|gt:0|max:9999999',
            'obs_controle'     => 'nullable|string|max:500',
        ], [
            'id_materia_prima.required' => 'Escolha a matéria-prima.',
            'tipo_controle.required'    => 'Escolha se é entrada ou saída.',
            'qtde_controle.required'    => 'Informe a quantidade.',
            'qtde_controle.numeric'     => 'A quantidade precisa ser um número, ex.: 2,5.',
            'qtde_controle.gt'          => 'A quantidade precisa ser maior que zero.',
        ]);

        $mov = MovimentacaoEstoque::registrar(
            (int) $dados['id_materia_prima'],
            $dados['tipo_controle'],
            (float) $dados['qtde_controle'],
            isset($dados['obs_controle']) ? trim($dados['obs_controle']) : null
        );

        $materia = $mov->materiaPrima()->first();
        $tipo = $dados['tipo_controle'] === 'ENTRADA' ? 'Entrada' : 'Saída';

        return redirect()->back()->with('sucesso', sprintf(
            '%s registrada. %s agora tem %s %s.',
            $tipo,
            $materia->nome_materia_prima,
            rtrim(rtrim(number_format((float) $materia->qtde_atual_materia_prima, 3, ',', '.'), '0'), ','),
            $materia->unid_med_materia_prima
        ));
    }
}
