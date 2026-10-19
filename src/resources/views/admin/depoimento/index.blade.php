@extends('layout.admin')

@section('title', 'Depoimentos | Confeitaria Dashboard')
@section('pg-titulo', 'Depoimentos')
@section('link-topo', 'Depoimentos')

@section('content')

    @php
        // Cor do badge de cada status
        $corStatus = [
            'PENDENTE' => 'warning',
            'APROVADO' => 'success',
            'RECUSADO' => 'secondary',
        ];
        $estrelas = fn ($nota) => str_repeat('★', (int) $nota) . str_repeat('☆', 5 - (int) $nota);
    @endphp

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Depoimentos enviados pelo app
                            @if ($pendentes > 0)
                                <span class="badge text-bg-warning ms-1">{{ $pendentes }} em análise</span>
                            @endif
                        </h3>
                        <div class="card-tools">
                            {{-- Filtro por status --}}
                            <form method="GET" action="{{ route('admin.depoimento') }}">
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="">Todos</option>
                                    @foreach ($statusDepoimento as $valor => $rotulo)
                                        <option value="{{ $valor }}" {{ $filtro === $valor ? 'selected' : '' }}>
                                            {{ $rotulo }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>

                    <div class="card-body pb-0">
                        <p class="text-muted mb-2">
                            O cliente envia pelo app, em <strong>Configurações → Depoimentos</strong>.
                            Todo depoimento chega <strong>Em análise</strong>; marque como <strong>Publicado</strong>
                            para aprovar ou <strong>Não publicado</strong> para recusar.
                        </p>
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
                                    <th>Data</th>
                                    <th>Cliente</th>
                                    <th>Nota</th>
                                    <th>Depoimento</th>
                                    <th>Status</th>
                                    <th style="width: 300px">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($depoimentos as $linha)
                                    <tr class="align-middle">
                                        <td>{{ \Carbon\Carbon::parse($linha->criado_em_depoimento)->format('d/m/Y H:i') }}</td>
                                        <td>{{ $linha->cliente->nome_cliente ?? '-' }}</td>
                                        <td class="text-nowrap" style="color: #ff9800">{{ $estrelas($linha->nota_depoimento) }}</td>
                                        <td style="white-space: pre-line">{{ $linha->texto_depoimento }}</td>
                                        <td>
                                            <span class="badge text-bg-{{ $corStatus[$linha->status_depoimento] ?? 'secondary' }}">
                                                {{ $statusDepoimento[$linha->status_depoimento] ?? $linha->status_depoimento }}
                                            </span>
                                        </td>
                                        <td>
                                            {{-- Trocar o status --}}
                                            <form action="{{ route('admin.depoimento.status', $linha->id_depoimento) }}"
                                                method="POST" class="d-inline-flex gap-1">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status_depoimento" class="form-select form-select-sm">
                                                    @foreach ($statusDepoimento as $valor => $rotulo)
                                                        <option value="{{ $valor }}" {{ $linha->status_depoimento === $valor ? 'selected' : '' }}>
                                                            {{ $rotulo }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-sm btn-primary" title="Salvar status">
                                                    <i class="bi bi-check-lg"></i>
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.depoimento.destroy', $linha->id_depoimento) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Excluir este depoimento?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Excluir">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Nenhum depoimento encontrado</td>
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
