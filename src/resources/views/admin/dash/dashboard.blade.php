@extends('layout.admin')

@section('title', 'Dashboard | Confeitaria Dashboard')
@section('pg-titulo', 'Dashboard')
@section('link-topo', 'Dashboard')

@section('content')

@php
    $formatarValor = fn ($valor) => 'R$ ' . number_format($valor, 2, ',', '.');
    $corStatus = [
        'EM ANDAMENTO' => 'warning',
        'SAIU ENTREGA' => 'info',
        'FINALIZADA'   => 'success',
        'CANCELADA'    => 'danger',
    ];
@endphp

<!--begin::App Content-->
<div class="app-content">
    <div class="container-fluid">

        {{-- Cartões de resumo --}}
        <div class="row">
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="small-box text-bg-primary">
                    <div class="inner">
                        <h3>{{ $resumo['pedidosHoje'] }}</h3>
                        <p>Pedidos hoje</p>
                    </div>
                    <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"></path>
                    </svg>
                    <a href="{{ route('admin.pedido') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                        Ver pedidos <i class="bi bi-link-45deg"></i>
                    </a>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 col-12">
                <div class="small-box text-bg-warning">
                    <div class="inner">
                        <h3>{{ $resumo['emPreparo'] }}</h3>
                        <p>Pedidos em preparo</p>
                    </div>
                    <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z"></path>
                    </svg>
                    <a href="{{ route('admin.pedido', ['status' => 'EM ANDAMENTO']) }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                        Ver em preparo <i class="bi bi-link-45deg"></i>
                    </a>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 col-12">
                <div class="small-box text-bg-success">
                    <div class="inner">
                        <h3>{{ $formatarValor($resumo['faturamentoMes']) }}</h3>
                        <p>Faturamento do mês</p>
                    </div>
                    <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z"></path>
                    </svg>
                    <a href="{{ route('admin.pedido') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                        Sem os cancelados <i class="bi bi-link-45deg"></i>
                    </a>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 col-12">
                <div class="small-box text-bg-danger">
                    <div class="inner">
                        <h3>{{ $resumo['mensagensNovas'] }}</h3>
                        <p>Mensagens novas</p>
                    </div>
                    <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z"></path>
                        <path d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z"></path>
                    </svg>
                    <a href="{{ route('admin.contato', ['status' => 'ENVIADO']) }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                        Ler mensagens <i class="bi bi-link-45deg"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            {{-- Gráfico de vendas --}}
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Vendas dos últimos 6 meses</h3>
                    </div>
                    <div class="card-body">
                        <div id="grafico-vendas"></div>
                    </div>
                </div>
            </div>

            {{-- Últimos pedidos --}}
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Últimos pedidos</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.pedido') }}" class="btn btn-sm btn-outline-primary">Ver todos</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Pedido</th>
                                    <th>Cliente</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($ultimosPedidos as $pedido)
                                    <tr class="align-middle">
                                        <td>
                                            <strong>#{{ $pedido->id_venda }}</strong><br>
                                            <small class="text-secondary">{{ \Carbon\Carbon::parse($pedido->data_venda)->format('d/m H:i') }}</small>
                                        </td>
                                        <td>{{ $pedido->cliente->nome_cliente ?? '-' }}</td>
                                        <td>{{ $formatarValor($pedido->valor_venda) }}</td>
                                        <td>
                                            <span class="badge text-bg-{{ $corStatus[$pedido->status_venda] ?? 'secondary' }}">
                                                {{ $statusPedido[$pedido->status_venda] ?? $pedido->status_venda }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Nenhum pedido ainda</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!--end::App Content-->

<script>
    // O ApexCharts é carregado no fim da página (admin.partials.script),
    // então o gráfico só é montado depois que a página termina de carregar.
    document.addEventListener('DOMContentLoaded', function () {
        const dados = @json($grafico);

        new ApexCharts(document.querySelector('#grafico-vendas'), {
            series: [
                { name: 'Faturamento', type: 'area', data: dados.faturamento },
                { name: 'Pedidos', type: 'line', data: dados.pedidos },
            ],
            chart: { height: 300, type: 'line', toolbar: { show: false } },
            colors: ['#20c997', '#0d6efd'],
            stroke: { curve: 'smooth', width: [2, 3] },
            fill: { opacity: [0.35, 1] },
            dataLabels: { enabled: false },
            xaxis: { categories: dados.meses },
            yaxis: [
                {
                    title: { text: 'Faturamento (R$)' },
                    labels: { formatter: (valor) => 'R$ ' + valor.toLocaleString('pt-BR', { maximumFractionDigits: 0 }) },
                },
                {
                    opposite: true,
                    title: { text: 'Pedidos' },
                    labels: { formatter: (valor) => Math.round(valor) },
                },
            ],
            tooltip: {
                y: {
                    formatter: (valor, { seriesIndex }) => seriesIndex === 0
                        ? valor.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })
                        : valor + ' pedido(s)',
                },
            },
            legend: { position: 'top' },
            // No celular o gráfico fica mais baixo e sem os títulos dos eixos,
            // para sobrar espaço para as linhas do gráfico.
            responsive: [{
                breakpoint: 576,
                options: {
                    chart: { height: 240 },
                    yaxis: [
                        {
                            title: { text: undefined },
                            labels: { formatter: (valor) => valor >= 1000 ? 'R$ ' + (valor / 1000).toLocaleString('pt-BR', { maximumFractionDigits: 1 }) + 'k' : 'R$ ' + Math.round(valor) },
                        },
                        { opposite: true, title: { text: undefined }, labels: { formatter: (valor) => Math.round(valor) } },
                    ],
                },
            }],
        }).render();
    });
</script>

@endsection
