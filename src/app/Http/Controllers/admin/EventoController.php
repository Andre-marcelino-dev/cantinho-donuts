<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index()
    {
        $listaEvento = Evento::orderBy('data_evento')->orderBy('ordem_evento')->get();
        
        return view('admin.evento.index', compact('listaEvento'));
    }
    
    public function store(Request $request)
    {
        
        $request->validate([
            'titulo_evento'      => 'required|string|max:30',
            'nome_evento'        => 'required|string|max:120',
            'descricao_evento'   => 'nullable|string|max:160',
            'data_evento'        => 'required|date',
            'horario_evento'     => 'required|string|max:30',
            'endereco_evento'    => 'required|string|max:160',
            'tags_evento'        => 'nullable|string|max:255',
            'link_local_evento'  => 'nullable|string|max:255',
            'ordem_evento'       => 'required|integer',
            'status_evento'      => 'required|string',
            'foto_evento'        => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $caminhoFoto = null;
        if ($request->hasFile('foto_evento')) {
            $arquivo = $request->file('foto_evento');
            $nomeFoto = uniqid('evento_') . '.' . $arquivo->getClientOriginalExtension();
            $arquivo->move(public_path('davilla/images/evento'), $nomeFoto);
            $caminhoFoto = 'evento/' . $nomeFoto;
        }

        try {
            Evento::create([
                'titulo_evento'      => $request->titulo_evento,
                'nome_evento'        => $request->nome_evento,
                'descricao_evento'   => $request->descricao_evento,
                'data_evento'        => $request->data_evento,
                'horario_evento'     => $request->horario_evento,
                'endereco_evento'    => $request->endereco_evento,
                'tags_evento'        => $request->tags_evento,
                'link_local_evento'  => $request->link_local_evento,
                'ordem_evento'       => $request->ordem_evento,
                'status_evento'      => $request->status_evento,
                'foto_evento'        => $caminhoFoto,
            ]);
            return redirect()->back()->with('sucesso', 'Evento cadastrado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('erro', 'Erro ao cadastrar evento. Tente novamente.');
        }
    }

    public function update(Request $request, $id)
    {
        $evento = Evento::findOrFail($id);



        if ($request->hasFile('foto_evento')) {
            if ($evento->foto_evento && file_exists(public_path('davilla/images/' . $evento->foto_evento))) {
                unlink(public_path('davilla/images/' . $evento->foto_evento));
            }

            $arquivo = $request->file('foto_evento');
            $nomeFoto = uniqid('evento_') . '.' . $arquivo->getClientOriginalExtension();
            $arquivo->move(public_path('davilla/images/evento'), $nomeFoto);
            $evento->foto_evento = 'evento/' . $nomeFoto;
        }

         $urlEvento = $request->link_local_evento;
 
       
        if (!empty($urlEvento) && str_contains($urlEvento, '<iframe')) {
            preg_match('/src="([^"]+)"/', $urlEvento, $matches);
 
            if (isset($matches[1])) {
                $urlEvento = $matches[1];
            }
        }     
        
        $evento->titulo_evento = $request->titulo_evento;
        $evento->nome_evento = $request->nome_evento;
        $evento->descricao_evento = $request->descricao_evento;
        $evento->data_evento = $request->data_evento;
        $evento->horario_evento = $request->horario_evento;
        $evento->endereco_evento = $request->endereco_evento;
        $evento->tags_evento = $request->tags_evento;
        $evento->link_local_evento = $urlEvento;
        $evento->ordem_evento = $request->ordem_evento;
        $evento->status_evento = $request->status_evento;
 

        $evento->save();
        //dd($evento);



        return redirect()->back()->with('sucesso', 'Evento atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $evento = Evento::findOrFail($id);

        try {
            if ($evento->foto_evento && file_exists(public_path('davilla/images/' . $evento->foto_evento))) {
                unlink(public_path('davilla/images/' . $evento->foto_evento));
            }

            $evento->delete();

            return redirect()->back()->with('sucesso', 'Evento excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('erro', 'Não foi possível excluir o evento devido a um erro inesperado.');
        }
    }

    public function alterarStatus($id)
    {
        $evento = Evento::findOrFail($id);

        $evento->status_evento = ($evento->status_evento === 'ATIVO') ? 'INATIVO' : 'ATIVO';
        $evento->save();

        return redirect()->back()->with('sucesso', 'Status do evento atualizado com sucesso!');
    }
}
