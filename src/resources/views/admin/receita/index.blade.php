@extends('layout.admin')

@section('title', 'Livro de receitas | Confeitaria Dashboard')
@section('pg-titulo', 'Livro de receitas')
@section('link-topo', 'Livro de receitas')

@section('content')

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Receitas do livro da Home</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.conteudo.edit', 'home') }}#sec-receitas" class="btn btn-outline-secondary mb-2">
                                <i class="bi bi-type"></i> Textos da seção
                            </a>
                            <a href="{{ route('admin.receita.create') }}" class="btn btn-primary mb-2">
                                <i class="bi bi-plus-circle"></i> Nova receita
                            </a>
                        </div>
                    </div>

                    {{-- MENSAGENS DE FEEDBACK --}}
                    @if (session('sucesso'))
                        <div id="alerta-sucesso" class="alert alert-success alert-dismissible fade show mx-3 mt-3" role="alert">
                            ✅ {{ session('sucesso') }}
                        </div>
                    @endif

                    <p class="text-secondary mx-3 mt-3 mb-2">
                        Só as receitas <strong>ativas</strong> aparecem no livro, na ordem do campo "Ordem" (menor primeiro).
                        A cada dia o livro abre sozinho em uma receita diferente ("Receita do dia").
                        Sem nenhuma receita ativa, a seção some da Home.
                    </p>

                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Receita</th>
                                    <th>Tempo</th>
                                    <th>Rende</th>
                                    <th>Cor</th>
                                    <th style="width: 80px">Ordem</th>
                                    <th>Status</th>
                                    <th style="width: 200px">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($receitas as $linha)
                                    @php $cor = \App\Models\Receita::CORES[$linha->cor_receita] ?? \App\Models\Receita::CORES['rose']; @endphp
                                    <tr class="align-middle">
                                        <td>
                                            <strong>{{ $linha->titulo_receita }}</strong>
                                            @if ($linha->destaque_receita)
                                                <em class="text-secondary">{{ $linha->destaque_receita }}</em>
                                            @endif
                                            <div class="small text-secondary">
                                                {{ count(\App\Models\Receita::linhas($linha->ingredientes_receita)) }} ingredientes ·
                                                {{ count(\App\Models\Receita::linhas($linha->preparo_receita)) }} passos
                                            </div>
                                        </td>
                                        <td>{{ $linha->tempo_receita }}</td>
                                        <td>{{ $linha->rendimento_receita }}</td>
                                        <td>
                                            <span class="d-inline-block rounded-circle align-middle me-1" style="width:14px;height:14px;background:{{ $cor[1] }}"></span>
                                            {{ $cor[0] }}
                                        </td>
                                        <td>{{ $linha->ordem_receita }}</td>
                                        <td>
                                            @if ($linha->status_receita === 'ATIVO')
                                                <span class="badge text-bg-success">Ativo</span>
                                            @else
                                                <span class="badge text-bg-danger">Inativo</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- Ativar/Desativar --}}
                                            <form action="{{ route('admin.receita.status', $linha->id_receita) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                @if ($linha->status_receita === 'ATIVO')
                                                    <button type="submit" class="btn btn-secondary" title="Desativar">
                                                        <i class="bi bi-toggle-on"></i>
                                                    </button>
                                                @else
                                                    <button type="submit" class="btn btn-success" title="Ativar">
                                                        <i class="bi bi-toggle-off"></i>
                                                    </button>
                                                @endif
                                            </form>

                                            {{-- Editar --}}
                                            <a href="{{ route('admin.receita.edit', $linha->id_receita) }}" class="btn btn-warning" title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            {{-- Excluir --}}
                                            <form action="{{ route('admin.receita.destroy', $linha->id_receita) }}" method="POST" class="d-inline"
                                                onsubmit="return confirm('Excluir a receita {{ addslashes($linha->titulo_receita) }}?');">
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
                                        <td colspan="7" class="text-center">Nenhuma receita cadastrada</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        setTimeout(function() {
            let alertaSucesso = document.getElementById('alerta-sucesso');
            if (alertaSucesso) alertaSucesso.style.display = 'none';
        }, 4000);
    </script>

@endsection
