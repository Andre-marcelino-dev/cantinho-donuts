<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Venda;


class PedidoController extends Controller
{
    // Status que o app entende (status_venda tem no máximo 12 caracteres)
    const STATUS = [
        'EM ANDAMENTO' => 'Em preparo',
        'SAIU ENTREGA' => 'Saiu para entrega',
        'FINALIZADA'   => 'Finalizada',
        'CANCELADA'    => 'Cancelada',
    ];

    public function index(Request $request)
    {
        $filtro = $request->query('status');
        if (!is_string($filtro) || !isset(self::STATUS[$filtro])) {
            $filtro = null;
        }

        $pedidos = Venda::with(['cliente', 'endereco', 'cupom', 'itens.produto'])
            ->when($filtro, function ($query) use ($filtro) {
                $query->where('status_venda', $filtro);
            })
            ->orderByDesc('data_venda')
            ->orderByDesc('id_venda')
            ->get();

        $statusPedido = self::STATUS;

        return view('admin.pedido.index', compact('pedidos', 'statusPedido', 'filtro'));
    }

    public function alterarStatus(Request $request, $id)
    {
        $request->validate([
            'status_venda' => 'required|in:' . implode(',', array_keys(self::STATUS)),
        ]);

        $pedido = Venda::findOrFail($id);
        $pedido->status_venda = $request->status_venda;

        // Guarda quando o pedido foi entregue (horário de Brasília)
        if ($request->status_venda === 'FINALIZADA' && !$pedido->data_entrega_venda) {
            $pedido->data_entrega_venda = now('America/Sao_Paulo')->format('Y-m-d H:i:s');
        }

        $pedido->save();

        return redirect()->back()
            ->with('sucesso', "Pedido #{$pedido->id_venda} agora está: " . self::STATUS[$pedido->status_venda]);
    }
}
