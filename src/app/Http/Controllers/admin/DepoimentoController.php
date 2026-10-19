<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Depoimento;
use Illuminate\Http\Request;

class DepoimentoController extends Controller
{
    public function index(Request $request)
    {
        $filtro = $request->query('status');
        if (!is_string($filtro) || !isset(Depoimento::STATUS[$filtro])) {
            $filtro = null;
        }

        $depoimentos = Depoimento::with('cliente')
            ->when($filtro, fn ($query) => $query->where('status_depoimento', $filtro))
            ->orderByDesc('criado_em_depoimento')
            ->orderByDesc('id_depoimento')
            ->get();

        $statusDepoimento = Depoimento::STATUS;
        $pendentes = Depoimento::where('status_depoimento', 'PENDENTE')->count();

        return view('admin.depoimento.index', compact('depoimentos', 'statusDepoimento', 'filtro', 'pendentes'));
    }

    public function alterarStatus(Request $request, $id)
    {
        $request->validate([
            'status_depoimento' => 'required|in:' . implode(',', array_keys(Depoimento::STATUS)),
        ]);

        $depoimento = Depoimento::with('cliente')->findOrFail($id);
        $depoimento->status_depoimento = $request->status_depoimento;
        $depoimento->save();

        $nome = $depoimento->cliente->nome_cliente ?? 'cliente';
        return redirect()->back()
            ->with('sucesso', "Depoimento de {$nome}: " . Depoimento::STATUS[$depoimento->status_depoimento] . '.');
    }

    public function destroy($id)
    {
        Depoimento::findOrFail($id)->delete();

        return redirect()->back()->with('sucesso', 'Depoimento excluído.');
    }
}
