@extends('layout.admin')

@section('title', 'Novidades e promoções | Confeitaria Dashboard')
@section('pg-titulo', 'Novidades e promoções')
@section('link-topo', 'Novidades e promoções')

@section('content')

    @php
        // Só números, com 55 na frente, para o link do WhatsApp
        $linkWhatsapp = function ($telefone) {
            $numeros = preg_replace('/\D/', '', (string) $telefone);
            if (strlen($numeros) <= 11) $numeros = '55' . $numeros;
            return 'https://wa.me/' . $numeros;
        };
    @endphp

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Clientes que aceitaram receber novidades
                            <span class="badge text-bg-primary ms-1">{{ $clientes->count() }}</span>
                        </h3>
                        <div class="card-tools d-flex gap-2">
                            @if ($clientes->isNotEmpty())
                                <button type="button" class="btn btn-sm btn-secondary" id="btn-copiar-emails">
                                    <i class="bi bi-clipboard"></i> Copiar e-mails
                                </button>
                                <a href="{{ route('admin.novidades.exportar') }}" class="btn btn-sm btn-success">
                                    <i class="bi bi-file-earmark-spreadsheet"></i> Baixar planilha
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="card-body pb-0">
                        <p class="text-muted mb-2">
                            O cliente escolhe no app, em <strong>Editar perfil → Receber novidades e promoções</strong>.
                            Aqui aparecem só os clientes ativos que marcaram essa opção.
                            Para mandar um e-mail para todos, use <strong>Copiar e-mails</strong> e cole no campo
                            <strong>Cco</strong> (cópia oculta), assim um cliente não vê o e-mail do outro.
                        </p>
                        <div id="aviso-copiado" class="alert alert-success py-2" style="display: none">
                            ✅ E-mails copiados. Cole no campo Cco do seu e-mail.
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Telefone</th>
                                    <th>Cliente desde</th>
                                    <th style="width: 120px">Contato</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($clientes as $linha)
                                    <tr class="align-middle">
                                        <td>{{ $linha->nome_cliente }}</td>
                                        <td>{{ $linha->email_cliente }}</td>
                                        <td>{{ $linha->telefone_cliente }}</td>
                                        <td>{{ $linha->criado_em_cliente ? $linha->criado_em_cliente->format('d/m/Y') : '-' }}</td>
                                        <td>
                                            @if ($linha->telefone_cliente)
                                                <a class="btn btn-sm btn-success" target="_blank" rel="noopener"
                                                    title="Chamar no WhatsApp"
                                                    href="{{ $linkWhatsapp($linha->telefone_cliente) }}">
                                                    <i class="bi bi-whatsapp"></i>
                                                </a>
                                            @endif
                                            @if ($linha->email_cliente)
                                                <a class="btn btn-sm btn-primary" title="Mandar e-mail"
                                                    href="mailto:{{ $linha->email_cliente }}">
                                                    <i class="bi bi-envelope"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            Nenhum cliente marcou "Receber novidades e promoções" ainda
                                        </td>
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
        // Copia todos os e-mails separados por vírgula
        const botaoCopiar = document.getElementById('btn-copiar-emails');
        if (botaoCopiar) {
            botaoCopiar.addEventListener('click', function() {
                const emails = @json($emails);
                const aviso = document.getElementById('aviso-copiado');
                const mostrarAviso = function() {
                    aviso.style.display = 'block';
                    setTimeout(function() { aviso.style.display = 'none'; }, 3000);
                };
                if (navigator.clipboard) {
                    navigator.clipboard.writeText(emails).then(mostrarAviso, function() {
                        window.prompt('Copie os e-mails:', emails);
                    });
                } else {
                    window.prompt('Copie os e-mails:', emails);
                }
            });
        }
    </script>

@endsection
