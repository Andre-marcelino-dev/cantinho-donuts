@extends('layout.admin')

@section('title', 'Mensagens de contato | Confeitaria Dashboard')
@section('pg-titulo', 'Mensagens de contato')
@section('link-topo', 'Mensagens de contato')

@section('content')

    @php
        // Cor do badge de cada status
        $corStatus = [
            'ENVIADO'    => 'warning',
            'LIDO'       => 'info',
            'RESPONDIDO' => 'success',
        ];
        // Só números, com 55 na frente, para o link do WhatsApp
        $linkWhatsapp = function ($telefone) {
            $numeros = preg_replace('/\D/', '', $telefone);
            if (strlen($numeros) <= 11) $numeros = '55' . $numeros;
            return 'https://wa.me/' . $numeros;
        };
    @endphp

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Mensagens enviadas pelo site</h3>
                        <div class="card-tools">
                            {{-- Filtro por status --}}
                            <form method="GET" action="{{ route('admin.contato') }}">
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="">Todas</option>
                                    @foreach ($statusContato as $valor => $rotulo)
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
                                    <th>Data</th>
                                    <th>Nome</th>
                                    <th>Assunto</th>
                                    <th>Mensagem</th>
                                    <th>Status</th>
                                    <th style="width: 260px">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($mensagens as $linha)
                                    <tr class="align-middle">
                                        <td>{{ \Carbon\Carbon::parse($linha->criado_em_contato)->format('d/m/Y H:i') }}</td>
                                        <td>{{ $linha->nome_contato }}</td>
                                        <td>{{ $linha->assunto_contato }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($linha->mensagem_contato, 60) }}</td>
                                        <td>
                                            <span class="badge text-bg-{{ $corStatus[$linha->status_contato] ?? 'secondary' }}">
                                                {{ $statusContato[$linha->status_contato] ?? $linha->status_contato }}
                                            </span>
                                        </td>
                                        <td>
                                            {{-- Trocar o status --}}
                                            <form action="{{ route('admin.contato.status', $linha->id_contato) }}"
                                                method="POST" class="d-inline-flex gap-1">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status_contato" class="form-select form-select-sm">
                                                    @foreach ($statusContato as $valor => $rotulo)
                                                        <option value="{{ $valor }}" {{ $linha->status_contato === $valor ? 'selected' : '' }}>
                                                            {{ $rotulo }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-sm btn-primary" title="Salvar status">
                                                    <i class="bi bi-check-lg"></i>
                                                </button>
                                            </form>

                                            {{-- Ler a mensagem completa --}}
                                            <button type="button" class="btn btn-sm btn-secondary" title="Ler mensagem"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalContato{{ $linha->id_contato }}">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Nenhuma mensagem encontrada</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAIS DE LEITURA (fora da tabela) --}}
    @foreach ($mensagens as $linha)
        <div class="modal fade" id="modalContato{{ $linha->id_contato }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $linha->assunto_contato }} — {{ $linha->nome_contato }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-1">
                            @php $enviadaEm = \Carbon\Carbon::parse($linha->criado_em_contato); @endphp
                            Enviada em {{ $enviadaEm->format('d/m/Y') }} às {{ $enviadaEm->format('H:i') }}
                        </p>
                        <p class="mb-3">
                            E-mail: {{ $linha->email_contato }}<br>
                            Telefone: {{ $linha->telefone_contato }}
                        </p>

                        <h6>Mensagem</h6>
                        <p style="white-space: pre-line">{{ $linha->mensagem_contato }}</p>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-success" target="_blank" rel="noopener"
                            href="{{ $linkWhatsapp($linha->telefone_contato) }}">
                            <i class="bi bi-whatsapp"></i> Responder no WhatsApp
                        </a>
                        <a class="btn btn-primary"
                            href="mailto:{{ $linha->email_contato }}?subject={{ rawurlencode('Re: ' . $linha->assunto_contato) }}">
                            <i class="bi bi-envelope"></i> Responder por e-mail
                        </a>
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
