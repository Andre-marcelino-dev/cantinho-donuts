@extends('layout.site')

@section('content')



    @include('site.cardapio.pagetitle')
    @include('site.cardapio.portifolio')
   
   

@push('plugins')
<script src="{{ asset('donuts/js/mixitup.js') }}"></script>
@endpush


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filtroInicial = "{{ $categoriaAtiva }}";
 
        if (filtroInicial !== 'all') {
            const botao = document.querySelector(`[data-filter="${filtroInicial}"]`);
 
            if (botao) {
                botao.click();
            }
        }
    });
</script>

@endsection
