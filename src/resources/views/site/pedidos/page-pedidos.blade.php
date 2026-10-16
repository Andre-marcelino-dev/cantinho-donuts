<!--Page Title-->

   @php
        $bannerPedidos = asset('davilla/pedidios/bannerpedidos.png')
    @endphp
    <section class="page-title" style="background-image:url('{{ $bannerPedidos}}');">
        <div class="auto-container">
            <h1>Faça seu pedido</h1>
            <ul class="page-breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Pedidos</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->
