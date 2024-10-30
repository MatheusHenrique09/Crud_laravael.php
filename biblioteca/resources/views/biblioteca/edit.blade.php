@extends('layouts.app')

@section('title', 'Editar Livros')

@section('content')

<div class="container mt-5">
    <div class="row mb-3">
        <div class="col-sm-10">
            <h1>Editar cadastro de livro:</h1>
        </div>
        <div class="col-sm-2 text-end">
            <a href="{{ route('bibliotecas-index') }}" class="btn btn-success">Página inicial</a>
        </div>
    </div>
    <hr>
    <form action="{{ route('bibliotecas-update', ['id' => $bibliotecas->id]) }}" method="POST" id="form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" name="nome" value="{{ $bibliotecas->nome }}" placeholder="Digite o nome do livro..." required>
        </div>

        <div class="form-group">
            <label for="categoria">Categoria:</label>
            <input type="text" class="form-control" name="categoria" value="{{ $bibliotecas->categoria }}" placeholder="Digite a categoria do livro..." required>
        </div>

        <div class="form-group">
            <label for="ano_publicacao">Ano de Publicação:</label>
            <input type="number" class="form-control" name="ano_publicacao" value="{{ $bibliotecas->ano_publicacao }}" placeholder="Digite o ano da publicação..." required>
        </div>

        <div class="form-group">
            <label for="valor">Preço:</label>
            <input type="text" class="form-control" name="valor" id="valor" value="{{ number_format($bibliotecas->valor, 2, ',', '.') }}" placeholder="Digite o preço do livro..." required>
        </div>

        <div class="form-group mt-3">
            <input type="submit" class="btn btn-success" value="Atualizar">
        </div>
    </form>
</div>

<script>
    document.getElementById('form').addEventListener('submit', function() {
        var valorInput = document.getElementById('valor');
        // Substitui a vírgula por ponto antes de enviar o formulário
        valorInput.value = valorInput.value.replace(',', '.');
    });
</script>

@endsection
