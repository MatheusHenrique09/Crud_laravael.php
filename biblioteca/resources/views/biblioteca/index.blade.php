@extends('layouts.app')

@section('title', 'Listagem Livros')

@section('content')
<div class="container mt-5">
    <img src="{{ asset('img/10a37154-27fa-41a1-bffd-bf108541f67f.webp') }}" alt="livros" class="img-fluid mb-4" style="width: 100%; max-height: 300px; object-fit: cover;">

    <div class="row mb-3">
        <div class="col-sm-10">
            <h1>Listagem de Livros</h1>
        </div>
        <div class="col-sm-2 text-end">
            <a href="{{ route('bibliotecas-create') }}" class="btn btn-success">Novo Livro</a>
        </div>
    </div>

    <div class="box-search mb-3 d-flex justify-content-center">
        <input type="search" class="form-control w-25 me-2" placeholder="Pesquisar" id="pesquisar" onkeyup="filterTable()">
        <button class="btn btn-primary" onclick="filterTable()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
            </svg>
        </button>
    </div>

    <!-- Mensagens de Sucesso e Erro -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Tabela de Listagem de Livros -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Categoria</th>
                <th scope="col">Ano de Publicação</th>
                <th scope="col">Preço</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody id="livrosTabela">
            @foreach ($bibliotecas as $livro)
                <tr>
                    <th scope="row">{{ $livro->id }}</th>
                    <td>{{ $livro->nome }}</td>
                    <td>{{ $livro->categoria }}</td>
                    <td>{{ $livro->ano_publicacao }}</td>
                    <td>R$ {{ number_format($livro->valor, 2, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('bibliotecas-edit', ['id' => $livro->id]) }}" class="btn btn-primary btn-sm" aria-label="Editar livro">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                            </svg>
                            Editar
                        </a>
                        <form action="{{ route('bibliotecas-destroy', ['id' => $livro->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Você realmente deseja excluir este livro?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" aria-label="Excluir livro">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                </svg>
                                Excluir
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function filterTable() {
        let input = document.getElementById('pesquisar').value.toLowerCase();
        let table = document.getElementById('livrosTabela');
        let rows = table.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            let cells = rows[i].getElementsByTagName('td');
            let found = false;

            for (let j = 0; j < cells.length; j++) {
                if (cells[j]) {
                    if (cells[j].innerText.toLowerCase().indexOf(input) > -1) {
                        found = true;
                        break;
                    }
                }
            }
            rows[i].style.display = found ? "" : "none";
        }
    }
</script>

@endsection
