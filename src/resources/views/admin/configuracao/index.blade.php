@extends('layout.admin')

@section('title', 'Configurações da loja | Confeitaria Dashboard')
@section('pg-titulo', 'Configurações da loja')
@section('link-topo', 'Configurações da loja')

@section('content')

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Entrega</h3>
                        </div>

                        {{-- MENSAGENS DE FEEDBACK --}}
                        @if (session('sucesso'))
                            <div id="alerta-sucesso" class="alert alert-success alert-dismissible fade show mx-3 mt-3" role="alert">
                                ✅ {{ session('sucesso') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger mx-3 mt-3" role="alert">
                                ❌ {{ $errors->first() }}
                            </div>
                        @endif

                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.configuracao.update') }}">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label">Taxa de entrega (R$)</label>
                                    <input type="text" inputmode="decimal" class="form-control" name="taxa_entrega" required
                                        value="{{ old('taxa_entrega', number_format($taxaEntrega, 2, ',', '')) }}">
                                    <div class="form-text">
                                        Cobrada nos pedidos com entrega (retirada não paga). Use 0 para entrega grátis.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Previsão de entrega</label>
                                    <input type="text" class="form-control" name="previsao_entrega" maxlength="30" required
                                        placeholder="Ex.: 45 - 60 min"
                                        value="{{ old('previsao_entrega', $previsaoEntrega) }}">
                                    <div class="form-text">
                                        Aparece no app na Sacola, no Pagamento e nos pedidos.
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-lg"></i> Salvar configurações
                                </button>
                            </form>
                        </div>
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
