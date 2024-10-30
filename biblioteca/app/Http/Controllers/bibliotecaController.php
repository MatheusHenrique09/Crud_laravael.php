<?php

namespace App\Http\Controllers;

use App\Models\biblioteca;
use Illuminate\Http\Request;

class BibliotecaController extends Controller
{
    public function index()
    {
        $bibliotecas = biblioteca::all();
        return view('biblioteca.index', ['bibliotecas' => $bibliotecas]);
    }

    public function create()
    {
        return view('biblioteca.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:55',
            'categoria' => 'required|string|max:55',
            'ano_publicacao' => 'required|integer',
            'valor' => 'required|numeric',
        ]);

        biblioteca::create($request->all());
        return redirect()->route('bibliotecas-index')->with('success', 'Livro adicionado com sucesso!');
    }

    public function edit($id)
    {
        $bibliotecas = biblioteca::where('id', $id)->first();
        if ($bibliotecas) {
            return view('biblioteca.edit', ['bibliotecas' => $bibliotecas]);
        } else {
            return redirect()->route('bibliotecas-index');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:55',
            'categoria' => 'required|string|max:55',
            'ano_publicacao' => 'required|integer',
            'valor' => 'required|numeric',
        ]);

        $biblioteca = biblioteca::findOrFail($id);
        $biblioteca->update($request->all());

        return redirect()->route('bibliotecas-index')->with('success', 'Livro atualizado com sucesso!');
    }
    public function destroy($id)
{
    // Verifica se o livro existe antes de tentar excluir
    $biblioteca = biblioteca::find($id);
    if ($biblioteca) {
        $biblioteca->delete(); // Exclui o livro
        return redirect()->route('bibliotecas-index')->with('success', 'Livro excluído com sucesso!');
    } else {
        return redirect()->route('bibliotecas-index')->with('error', 'Livro não encontrado.'); // Mensagem de erro se não encontrado
    }
}

}
