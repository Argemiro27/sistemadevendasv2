<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rotas GET

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');


// Rotas POST


Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



// Rotas autenticadas

Route::middleware(['auth'])->group(function () {

    Route::get('/home', function () {
        return view('dashboard.home');
    })->name('home');

    Route::get('/cadastrarclientes', function () {
        return view('dashboard.cadastrarclientes');
    })->name('cadastrarclientes');

    Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');

    Route::get('/cadastrarprodutos', function () {
        return view('dashboard.cadastrarprodutos');
    })->name('cadastrarprodutos');

    Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store');

    Route::get('/listagemdevendas', [VendaController::class, 'index'])->name('vendas.index');

    Route::get('/cadastrarvendas', [VendaController::class, 'create'])->name('vendas.create');

    Route::post('/vendas', [VendaController::class, 'store'])->name('vendas.store');

    Route::get('/vendas/{id}/edit', [VendaController::class, 'edit'])->name('vendas.edit');

    Route::put('/vendas/{id}', [VendaController::class, 'update'])->name('vendas.update');

    Route::delete('/vendas/{id}', [VendaController::class, 'destroy'])->name('vendas.destroy');


});

