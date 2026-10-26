@extends('layout.admin')

@section('title', 'Kits | Confeitaria Dashboard')
@section('pg-titulo', 'Kits')
@section('link-topo', 'Kits')

@section('content')

    @php
        $formatarValor = fn ($valor) => 'R$ ' . number_format((float) $valor, 2, ',', '.');
        // Foto do kit ou, se não tiver, a do primeiro produto
        $fotoDoKit = fn ($kit) => asset('donuts/images/' . ($kit->foto_kit ?: ($kit->ProdutosKit->first()?->produto?->foto_produto ?? '')));
        $corDestaque = ['MAIS VENDIDO' => 'danger', 'PROMOCAO' => 'warning', 'NOVIDADE' => 'success'];
    @endphp

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Kits da Home do site</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                                data-bs-target="#modalNovoKit">
                                <i class="bi bi-plus-circle"></i>
                                Novo Kit
                            </button>
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
                                    <th style="width: 110px">Foto</th>
                                    <th>Kit</th>
                                    <th>Produtos</th>
                                    <th>Preço</th>
                                    <th>Etiqueta</th>
                                    <th style="width: 150px">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kits as $linha)
                                    <tr class="align-middle">
                                        <td>
                                            <img src="{{ $fotoDoKit($linha) }}" alt="{{ $linha->nome_kit }}"
                                                style="width: 90px; height: 64px; object-fit: cover; border-radius: 6px; background: #eee;">
                                        </td>
                                        <td>
                                            <strong>{{ $linha->nome_kit }}</strong><br>
                                            <small class="text-secondary">{{ \Illuminate\Support\Str::limit($linha->descricao_kit, 60) }}</small>
                                        </td>
                                        <td>
                                            @foreach ($linha->ProdutosKit as $item)
                                                <div>{{ $item->produto->nome_produto ?? 'Produto removido' }}</div>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if ($linha->preco_promocional_kit)
                                                <del class="text-secondary">{{ $formatarValor($linha->preco_kit) }}</del><br>
                                                <strong>{{ $formatarValor($linha->preco_promocional_kit) }}</strong>
                                            @else
                                                {{ $formatarValor($linha->preco_kit) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($corDestaque[$linha->destaque_kit]))
                                                <span class="badge text-bg-{{ $corDestaque[$linha->destaque_kit] }}">
                                                    {{ $destaques[$linha->destaque_kit] }}
                                                </span>
                                            @else
                                                <span class="text-secondary">—</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- Editar --}}
                                            <button type="button" class="btn btn-warning" title="Editar"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalEditarKit{{ $linha->id_kit }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>

                                            {{-- Excluir --}}
                                            <form action="{{ route('admin.kit.destroy', $linha->id_kit) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Excluir o kit {{ addslashes($linha->nome_kit) }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" title="Excluir">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Nenhum kit cadastrado</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL NOVO KIT --}}
    <div class="modal fade" id="modalNovoKit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Novo Kit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.kit.store') }}" enctype="multipart/form-data">
                        @csrf
                        @include('admin.kit.campos', ['kit' => null])
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar Kit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAIS EDITAR — um por kit --}}
    @foreach ($kits as $linha)
        <div class="modal fade" id="modalEditarKit{{ $linha->id_kit }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Kit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('admin.kit.update', $linha->id_kit) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <img src="{{ $fotoDoKit($linha) }}" alt="{{ $linha->nome_kit }}"
                                class="mb-3" style="width: 100%; max-height: 180px; object-fit: cover; border-radius: 6px; background: #eee;">
                            @include('admin.kit.campos', ['kit' => $linha])
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Salvar Kit</button>
                            </div>
                        </form>
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
        }, 6000);
    </script>

@endsection
