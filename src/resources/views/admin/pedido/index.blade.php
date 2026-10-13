@extends('layout.admin')

@section('title', 'Pedidos | Confeitaria Dashboard')
@section('pg-titulo', 'Pedidos')
@section('link-topo', 'Pedidos')

@section('content')

    @php
        // Cor do badge de cada status
        $corStatus = [
            'EM ANDAMENTO' => 'warning',
            'SAIU ENTREGA' => 'info',
            'FINALIZADA'   => 'success',
            'CANCELADA'    => 'danger',
        ];
        $formatarValor = fn ($valor) => 'R$ ' . number_format($valor, 2, ',', '.');
    @endphp

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pedidos do app e do site</h3>
                        <div class="card-tools">
                            {{-- Filtro por status --}}
                            <form method="GET" action="{{ route('admin.pedido') }}" class="d-flex gap-2">
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="">Todos os status</option>
                                    @foreach ($statusPedido as $valor => $rotulo)
                                        <option value="{{ $valor }}" {{ $filtro === $valor ? 'selected' : '' }}>
                                            {{ $rotulo }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>

                    {{-- MENSAGENS DE FEEDBACK --}}
                    @if (session('sucesso'))
                        <div id="alerta-sucesso" class="alert alert-success alert-dismissible fade show mx-3 mt-3" role="alert">
                            ✅ {{ session('sucesso') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div id="alerta-erro" class="alert alert-danger alert-dismissible fade show mx-3 mt-3" role="alert">
                            ❌ {{ $errors->first() }}
                        </div>
                    @endif

                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 70px">Pedido</th>
                                    <th>Data</th>
                                    <th>Cliente</th>
                                    <th>Itens</th>
                                    <th>Total</th>
                                    <th>Pagamento</th>
                                    <th>Entrega</th>
                                    <th>Status</th>
                                    <th style="width: 260px">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pedidos as $linha)
                                    <tr class="align-middle">
                                        <td><strong>#{{ $linha->id_venda }}</strong></td>
                                        <td>{{ \Carbon\Carbon::parse($linha->data_venda)->format('d/m/Y H:i') }}</td>
                                        <td>{{ $linha->cliente->nome_cliente ?? 'Cliente removido' }}</td>
                                        <td>
                                            @foreach ($linha->itens as $item)
                                                <div>{{ (int) $item->qtde_item }}x {{ $item->produto->nome_produto ?? 'Produto removido' }}</div>
                                            @endforeach
                                        </td>
                                        <td>{{ $formatarValor($linha->valor_venda) }}</td>
                                        <td>{{ $linha->forma_pagamento_venda ?? '-' }}</td>
                                        <td>{{ $linha->entrega_venda === 'SIM' ? 'Entrega' : 'Retirada' }}</td>
                                        <td>
                                            <span class="badge text-bg-{{ $corStatus[$linha->status_venda] ?? 'secondary' }}">
                                                {{ $statusPedido[$linha->status_venda] ?? $linha->status_venda }}
                                            </span>
                                        </td>
                                        <td>
                                            {{-- Trocar o status --}}
                                            <form action="{{ route('admin.pedido.status', $linha->id_venda) }}"
                                                method="POST" class="d-inline-flex gap-1">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status_venda" class="form-select form-select-sm">
                                                    @foreach ($statusPedido as $valor => $rotulo)
                                                        <option value="{{ $valor }}" {{ $linha->status_venda === $valor ? 'selected' : '' }}>
                                                            {{ $rotulo }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-sm btn-primary" title="Salvar status">
                                                    <i class="bi bi-check-lg"></i>
                                                </button>
                                            </form>

                                            {{-- Ver detalhes --}}
                                            <button type="button" class="btn btn-sm btn-secondary" title="Ver detalhes"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalPedido{{ $linha->id_venda }}">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Nenhum pedido encontrado</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAIS DE DETALHES (fora da tabela: o modal tem uma tabela de itens dentro) --}}
    @foreach ($pedidos as $linha)
        {{-- MODAL DETALHES — um por pedido --}}
        <div class="modal fade" id="modalPedido{{ $linha->id_venda }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pedido #{{ $linha->id_venda }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @php $cliente = $linha->cliente; @endphp

                        <h6>Cliente</h6>
                        <p class="mb-3">
                            {{ $cliente->nome_cliente ?? '-' }}<br>
                            Telefone: {{ $cliente->telefone_cliente ?? '-' }}<br>
                            E-mail: {{ $cliente->email_cliente ?? '-' }}
                        </p>

                        @if ($linha->entrega_venda === 'SIM' && $cliente)
                            <h6>Endereço de entrega</h6>
                            <p class="mb-3">
                                {{ $cliente->endereco_cliente }}, {{ $cliente->numero_cliente }}
                                {{ $cliente->complemento_cliente ? '- ' . $cliente->complemento_cliente : '' }}<br>
                                {{ $cliente->bairro_cliente }} - {{ $cliente->cidade_cliente }}/{{ $cliente->uf_cliente }}
                                - CEP {{ $cliente->cep_cliente }}
                            </p>
                        @else
                            <p class="mb-3"><strong>Retirada na loja</strong></p>
                        @endif

                        <h6>Itens</h6>
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Qtde</th>
                                    <th>Unitário</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($linha->itens as $item)
                                    <tr>
                                        <td>{{ $item->produto->nome_produto ?? 'Produto removido' }}</td>
                                        <td>{{ (int) $item->qtde_item }}</td>
                                        <td>{{ $formatarValor($item->valor_unit_item) }}</td>
                                        <td>{{ $formatarValor($item->valor_unit_item * $item->qtde_item) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <p class="mb-1">Pagamento: <strong>{{ $linha->forma_pagamento_venda ?? '-' }}</strong></p>
                        @if ($linha->valor_desconto_venda > 0)
                            <p class="mb-1">Desconto: {{ $formatarValor($linha->valor_desconto_venda) }}</p>
                        @endif
                        <p class="mb-3">Total: <strong>{{ $formatarValor($linha->valor_venda) }}</strong></p>

                        <h6>Observação</h6>
                        <p class="mb-0">{{ $linha->observacao_venda ?: 'Nenhuma observação.' }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        // ALERTA SUCESSO
        setTimeout(function() {
            let alertaSucesso = document.getElementById('alerta-sucesso');
            if (alertaSucesso) alertaSucesso.style.display = 'none';
        }, 3000);

        // ALERTA ERRO
        setTimeout(function() {
            let alertaErro = document.getElementById('alerta-erro');
            if (alertaErro) alertaErro.style.display = 'none';
        }, 3000);
    </script>

@endsection
