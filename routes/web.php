<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\VendasController;

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

    //Home
    Route::get('/home', function () {
        return view('dashboard.home');
    })->name('home');

    //Cadastrar produtos
    Route::get('/cadastrarproduto', function () {
        return view('dashboard.cadastrarproduto');
    })->name('cadastrarproduto');

    Route::post('/produtos', [ProdutosController::class, 'store'])->name('produtos.store');

    //Cadastrar cliente

    Route::get('/cadastrarcliente', function () {
        return view('dashboard.cadastrarcliente');
    })->name('cadastrarcliente');

    Route::post('/clientes', [ClientesController::class, 'store'])->name('clientes.store');

    //Cadastrar vendas

    Route::get('/cadastrarvenda', function () {
        return view('dashboard.cadastrarvenda');
    })->name('cadastrarvenda');
    Route::match(['get', 'post'], '/vendas', [VendasController::class, 'store'])->name('vendas.store');

    //Buscar produtos e clientes
    Route::get('/clientes/buscar', [ClientesController::class, 'buscar'])->name('clientes.buscar');
    Route::get('/produtos/buscar', [ProdutosController::class, 'buscar'])->name('produtos.buscar');

    //Editar & atualizar
    Route::get('/editarvenda', function () {
        return view('dashboard.editarvenda');
    })->name('editarvenda');

    Route::get('/vendas/{id}/editar', [VendasController::class, 'edit'])->name('vendas.editar');
    Route::get('/vendas/{venda}/edit', [VendasController::class, 'edit'])->name('vendas.edit');
    Route::put('/vendas/{venda}', [VendasController::class, 'update'])->name('vendas.update');

    //Remover vendas
    Route::delete('/vendas/{id}', [VendasController::class, 'destroy'])->name('vendas.destroy');

    //Listagem

    Route::get('/listadevendas', function () {
        return view('dashboard.listadevendas');
    })->name('listadevendas');

    Route::get('/listadevendas', [VendasController::class, 'index'])->name('vendas.index');


});

