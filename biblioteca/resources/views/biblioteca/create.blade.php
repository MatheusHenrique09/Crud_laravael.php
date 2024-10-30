@extends('layouts.app')

@section('title', 'Cadastro de Livros')

@section('content')

<div class="container mt-5">
    <div class="row mb-3">
        <div class="col-sm-10">
            <h1>Criar um novo cadastro de livro:</h1>
        </div>
        <div class="col-sm-2 text-end">
            <a href="{{ route('bibliotecas-index') }}" class="btn btn-success">Página inicial</a>
        </div>
    </div>
    <hr>
    <form action="{{ route('bibliotecas-store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" name="nome" placeholder="Digite o nome do livro..." required>
        </div>

        <div class="form-group">
            <label for="categoria">Categoria:</label>
            <input type="text" class="form-control" name="categoria" placeholder="Digite a categoria do livro..." required>
        </div>

        <div class="form-group">
            <label for="ano_publicacao">Ano de Publicação:</label>
            <input type="number" class="form-control" name="ano_publicacao" placeholder="Digite o ano da publicação..." required>
        </div>

        <div class="form-group">
            <label for="valor">Preço:</label>
            <input type="text" class="form-control" name="valor" placeholder="Digite o preço do livro..." required>
        </div>

        <div class="form-group mt-3">
            <input type="submit" class="btn btn-primary" value="Cadastrar Livro">
        </div>
    </form>
</div>

@endsection
