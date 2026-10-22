@extends('layout.admin')

@php $editando = $receita->exists; @endphp

@section('title', ($editando ? 'Editar receita' : 'Nova receita') . ' | Confeitaria Dashboard')
@section('pg-titulo', $editando ? 'Editar receita' : 'Nova receita')
@section('link-topo', 'Livro de receitas')

@section('content')

    <div class="app-content">
        <div class="container-fluid">
            <a href="{{ route('admin.receita') }}" class="btn btn-outline-secondary btn-sm mb-3"><i class="bi bi-arrow-left"></i> Voltar para as receitas</a>

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">❌ {{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ $editando ? route('admin.receita.update', $receita->id_receita) : route('admin.receita.store') }}">
                @csrf
                @if ($editando) @method('PUT') @endif

                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-header"><h3 class="card-title">Página da esquerda</h3></div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <label class="form-label">Nome da receita *</label>
                                        <input type="text" class="form-control" name="titulo_receita" maxlength="60" required
                                            placeholder="Ex.: Brigadeiro" value="{{ old('titulo_receita', $receita->titulo_receita) }}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Complemento em destaque</label>
                                        <input type="text" class="form-control" name="destaque_receita" maxlength="60"
                                            placeholder="Ex.: tradicional" value="{{ old('destaque_receita', $receita->destaque_receita) }}">
                                        <div class="form-text">Aparece em itálico depois do nome.</div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Apresentação</label>
                                        <textarea class="form-control" name="intro_receita" rows="3" maxlength="400"
                                            placeholder="Uma ou duas frases sobre a receita">{{ old('intro_receita', $receita->intro_receita) }}</textarea>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label">Tempo</label>
                                        <input type="text" class="form-control" name="tempo_receita" maxlength="30"
                                            placeholder="Ex.: 30 min" value="{{ old('tempo_receita', $receita->tempo_receita) }}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label">Rende</label>
                                        <input type="text" class="form-control" name="rendimento_receita" maxlength="30"
                                            placeholder="Ex.: 25 unidades" value="{{ old('rendimento_receita', $receita->rendimento_receita) }}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label">Nível</label>
                                        <input type="text" class="form-control" name="nivel_receita" maxlength="20" list="niveis"
                                            placeholder="Ex.: Fácil" value="{{ old('nivel_receita', $receita->nivel_receita) }}">
                                        <datalist id="niveis"><option value="Fácil"><option value="Médio"><option value="Difícil"></datalist>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Dica da confeiteira</label>
                                        <textarea class="form-control" name="dica_receita" rows="2" maxlength="300"
                                            placeholder="Opcional">{{ old('dica_receita', $receita->dica_receita) }}</textarea>
                                    </div>
                                    <div class="col-sm-5">
                                        <label class="form-label">Cor da página</label>
                                        <select class="form-select" name="cor_receita">
                                            @foreach (\App\Models\Receita::CORES as $valor => $cor)
                                                <option value="{{ $valor }}" {{ old('cor_receita', $receita->cor_receita) === $valor ? 'selected' : '' }}>{{ $cor[0] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="form-label">Ordem</label>
                                        <input type="number" class="form-control" name="ordem_receita" min="0" required
                                            value="{{ old('ordem_receita', $receita->ordem_receita) }}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label">Status</label>
                                        <select class="form-select" name="status_receita">
                                            <option value="ATIVO" {{ old('status_receita', $receita->status_receita) === 'ATIVO' ? 'selected' : '' }}>Ativo</option>
                                            <option value="INATIVO" {{ old('status_receita', $receita->status_receita) === 'INATIVO' ? 'selected' : '' }}>Inativo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-header"><h3 class="card-title">Página da direita</h3></div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Ingredientes * <small class="text-secondary">(um por linha)</small></label>
                                    <textarea class="form-control" name="ingredientes_receita" rows="9" required
                                        placeholder="1 lata de leite condensado&#10;1 colher (sopa) de manteiga&#10;# Cobertura&#10;...">{{ old('ingredientes_receita', $receita->ingredientes_receita) }}</textarea>
                                    <div class="form-text">Uma linha começando com <code>#</code> vira um subtítulo, ex.: <code># Cobertura</code>.</div>
                                </div>
                                <div>
                                    <label class="form-label">Modo de preparo * <small class="text-secondary">(um passo por linha)</small></label>
                                    <textarea class="form-control" name="preparo_receita" rows="9" required
                                        placeholder="Em uma panela, junte...&#10;Cozinhe em fogo baixo...">{{ old('preparo_receita', $receita->preparo_receita) }}</textarea>
                                    <div class="form-text">Os passos são numerados sozinhos no livro.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> {{ $editando ? 'Salvar alterações' : 'Cadastrar receita' }}</button>
                    <a href="{{ route('admin.receita') }}" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

@endsection
