<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Receita;


// Receitas do livro da Home
class ReceitaController extends Controller
{
    public function index()
    {
        $receitas = Receita::orderByRaw("status_receita = 'ATIVO' DESC")
            ->orderBy('ordem_receita')
            ->orderBy('id_receita')
            ->get();

        return view('admin.receita.index', compact('receitas'));
    }

    public function create()
    {
        $receita = new Receita([
            'cor_receita'    => 'rose',
            'status_receita' => 'ATIVO',
            'ordem_receita'  => (int) Receita::max('ordem_receita') + 1,
        ]);

        return view('admin.receita.form', compact('receita'));
    }

    public function store(Request $request)
    {
        Receita::create($this->validar($request));

        return redirect()->route('admin.receita')->with('sucesso', 'Receita cadastrada! Ela já aparece no livro da Home.');
    }

    public function edit($id)
    {
        $receita = Receita::findOrFail($id);

        return view('admin.receita.form', compact('receita'));
    }

    public function update(Request $request, $id)
    {
        Receita::findOrFail($id)->update($this->validar($request));

        return redirect()->route('admin.receita')->with('sucesso', 'Receita atualizada!');
    }

    public function alterarStatus($id)
    {
        $receita = Receita::findOrFail($id);
        $receita->status_receita = $receita->status_receita === 'ATIVO' ? 'INATIVO' : 'ATIVO';
        $receita->save();

        return redirect()->back()->with('sucesso', 'Status atualizado!');
    }

    public function destroy($id)
    {
        Receita::findOrFail($id)->delete();

        return redirect()->route('admin.receita')->with('sucesso', 'Receita excluída.');
    }

    private function validar(Request $request): array
    {
        $dados = $request->validate([
            'titulo_receita'       => 'required|string|max:60',
            'destaque_receita'     => 'nullable|string|max:60',
            'intro_receita'        => 'nullable|string|max:400',
            'tempo_receita'        => 'nullable|string|max:30',
            'rendimento_receita'   => 'nullable|string|max:30',
            'nivel_receita'        => 'nullable|string|max:20',
            'cor_receita'          => 'required|in:' . implode(',', array_keys(Receita::CORES)),
            'ingredientes_receita' => 'required|string|max:3000',
            'preparo_receita'      => 'required|string|max:5000',
            'dica_receita'         => 'nullable|string|max:300',
            'ordem_receita'        => 'required|integer|min:0',
            'status_receita'       => 'required|in:ATIVO,INATIVO',
        ], [
            'titulo_receita.required'       => 'Informe o nome da receita.',
            'ingredientes_receita.required' => 'Informe os ingredientes (um por linha).',
            'preparo_receita.required'      => 'Informe o modo de preparo (um passo por linha).',
            'intro_receita.max'             => 'A apresentação pode ter no máximo 400 caracteres (o livro tem pouco espaço).',
            'dica_receita.max'              => 'A dica pode ter no máximo 300 caracteres.',
        ]);

        // Uma linha por item, sem linhas vazias
        foreach (['ingredientes_receita', 'preparo_receita'] as $campo) {
            $dados[$campo] = implode("\n", Receita::linhas($dados[$campo]));
        }

        return $dados;
    }
}
