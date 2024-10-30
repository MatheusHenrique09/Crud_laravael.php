<?php

use App\Http\Controllers\BibliotecaController;
use Illuminate\Support\Facades\Route;

Route::prefix('biblioteca')->group(function(){
    Route::get('/', [BibliotecaController::class, 'index'])->name('bibliotecas-index');
    Route::get('/create', [BibliotecaController::class, 'create'])->name('bibliotecas-create');
    Route::post('/', [BibliotecaController::class, 'store'])->name('bibliotecas-store');
    Route::get('/{id}/edit', [BibliotecaController::class, 'edit'])->where('id','[0-9]+')->name('bibliotecas-edit');
    Route::put('/{id}', [BibliotecaController::class, 'update'])->where('id', '[0-9]+')->name('bibliotecas-update');
    Route::delete('/{id}', [BibliotecaController::class, 'destroy'])->where('id', '[0-9]+')->name('bibliotecas-destroy');
});


Route::fallback(function(){
    return response('Erro 404 - Página não encontrada', 404);
});

