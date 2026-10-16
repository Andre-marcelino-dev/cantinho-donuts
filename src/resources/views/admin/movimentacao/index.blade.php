@extends('layout.admin')

@section('title', 'Movimentações de estoque | Confeitaria Dashboard')
@section('pg-titulo', 'Movimentações de estoque')
@section('link-topo', 'Movimentações de estoque')

@section('content')

    @php
        $qtd = fn ($valor) => rtrim(rtrim(number_format((float) $valor, 3, ',', '.'), '0'), ',');
        $materiaFiltrada = $filtroMateria ? $materias->firstWhere('id_materia_prima', $filtroMateria) : null;
    @endphp

    <div class="app-content">
        <div class="container-fluid">

            {{-- MENSAGENS DE FEEDBACK --}}
            @if (session('sucesso'))
                <div id="alerta-sucesso" class="alert alert-success alert-dismissible fade show" role="alert">
                    ✅ {{ session('sucesso') }}
                </div>
            @endif

            @if ($errors->any())
                <div id="alerta-erro" class="alert alert-danger alert-dismissible fade show" role="alert">
                    ❌ {{ $errors->first() }}
                </div>
            @endif

            {{-- Registrar entrada / saída --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Registrar entrada ou saída</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.movimentacao.store') }}" class="row g-3 align-items-end">
                        @csrf
                        <div class="col-md-4">
                            <label class="form-label">Matéria-prima</label>
                            <select class="form-select" name="id_materia_prima" required>
                                <option value="">Selecione</option>
                                @foreach ($materias as $materia)
                                    <option value="{{ $materia->id_materia_prima }}"
                                        {{ (int) old('id_materia_prima', $filtroMateria) === $materia->id_materia_prima ? 'selected' : '' }}>
                                        {{ $materia->nome_materia_prima }} (tem {{ $qtd($materia->qtde_atual_materia_prima) }} {{ $materia->unid_med_materia_prima }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Tipo</label>
                            <select class="form-select" name="tipo_controle" required>
                                <option value="ENTRADA" {{ old('tipo_controle') === 'ENTRADA' ? 'selected' : '' }}>Entrada (compra)</option>
                                <option value="SAIDA" {{ old('tipo_controle') === 'SAIDA' ? 'selected' : '' }}>Saída (uso)</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Quantidade</label>
                            <input type="text" inputmode="decimal" class="form-control" name="qtde_controle" required
                                placeholder="Ex.: 2,5" value="{{ old('qtde_controle') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Observação (opcional)</label>
                            <input type="text" class="form-control" name="obs_controle" maxlength="500"
                                placeholder="Ex.: compra semanal" value="{{ old('obs_controle') }}">
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary w-100" title="Registrar">
                                <i class="bi bi-check-lg"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Histórico --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Histórico
                        @if ($materiaFiltrada)
                            — {{ $materiaFiltrada->nome_materia_prima }}
                            (estoque atual: {{ $qtd($materiaFiltrada->qtde_atual_materia_prima) }} {{ $materiaFiltrada->unid_med_materia_prima }})
                        @endif
                    </h3>
                    <div class="card-tools">
                        <form method="GET" action="{{ route('admin.movimentacao') }}" class="d-flex gap-2">
                            <select name="materia" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="">Todas as matérias-primas</option>
                                @foreach ($materias as $materia)
                                    <option value="{{ $materia->id_materia_prima }}" {{ $filtroMateria === $materia->id_materia_prima ? 'selected' : '' }}>
                                        {{ $materia->nome_materia_prima }}
                                    </option>
                                @endforeach
                            </select>
                            <select name="tipo" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="">Entradas e saídas</option>
                                <option value="ENTRADA" {{ $filtroTipo === 'ENTRADA' ? 'selected' : '' }}>Só entradas</option>
                                <option value="SAIDA" {{ $filtroTipo === 'SAIDA' ? 'selected' : '' }}>Só saídas</option>
                            </select>
                        </form>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Matéria-prima</th>
                                <th>Tipo</th>
                                <th>Quantidade</th>
                                <th>Observação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($movimentacoes as $mov)
                                <tr class="align-middle">
                                    <td>{{ \Carbon\Carbon::parse($mov->data_controle)->format('d/m/Y H:i') }}</td>
                                    <td>{{ $mov->materiaPrima->nome_materia_prima ?? '-' }}</td>
                                    <td>
                                        @if ($mov->tipo_controle === 'ENTRADA')
                                            <span class="badge text-bg-success"><i class="bi bi-arrow-down"></i> Entrada</span>
                                        @else
                                            <span class="badge text-bg-warning"><i class="bi bi-arrow-up"></i> Saída</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $mov->tipo_controle === 'ENTRADA' ? '+' : '−' }}{{ $qtd($mov->qtde_controle) }}
                                        {{ $mov->materiaPrima->unid_med_materia_prima ?? '' }}
                                    </td>
                                    <td>{{ $mov->obs_controle ?: '—' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Nenhuma movimentação encontrada</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        setTimeout(function() {
            let alertaSucesso = document.getElementById('alerta-sucesso');
            if (alertaSucesso) alertaSucesso.style.display = 'none';
        }, 5000);
        setTimeout(function() {
            let alertaErro = document.getElementById('alerta-erro');
            if (alertaErro) alertaErro.style.display = 'none';
        }, 8000);
    </script>

@endsection
