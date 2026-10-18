<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contato;


class ContatoController extends Controller
{
    // status_contato tem no máximo 10 caracteres
    const STATUS = [
        'ENVIADO'    => 'Nova',
        'LIDO'       => 'Lida',
        'RESPONDIDO' => 'Respondida',
    ];

    public function index(Request $request)
    {
        $filtro = $request->query('status');
        if (!is_string($filtro) || !isset(self::STATUS[$filtro])) {
            $filtro = null;
        }

        $mensagens = Contato::when($filtro, function ($query) use ($filtro) {
                $query->where('status_contato', $filtro);
            })
            ->orderByDesc('criado_em_contato')
            ->orderByDesc('id_contato')
            ->get();

        $statusContato = self::STATUS;

        return view('admin.contato.index', compact('mensagens', 'statusContato', 'filtro'));
    }

    public function alterarStatus(Request $request, $id)
    {
        $request->validate([
            'status_contato' => 'required|in:' . implode(',', array_keys(self::STATUS)),
        ]);

        $mensagem = Contato::findOrFail($id);
        $mensagem->status_contato = $request->status_contato;
        $mensagem->save();

        return redirect()->back()
            ->with('sucesso', "Mensagem de {$mensagem->nome_contato} marcada como " . self::STATUS[$mensagem->status_contato] . '.');
    }
}
