<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CadastraVendaController;

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



// MENU

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('dashboard.home');
    })->name('home');
    Route::get('/home', [AuthController::class, 'home']);
    Route::get('/cadastrarvendas', function () {
        return view('dashboard.cadastrarvendas');
    })->name('cadastrarvendas');
    Route::get('/listagemdevendas', function () {
        return view('dashboard.listagemdevendas');
    })->name('listagemdevendas');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/cadastravenda', [CadastraVendaController::class, 'index'])->name('cadastravenda.index');
    Route::post('/cadastravenda', [CadastraVendaController::class, 'store'])->name('cadastravenda.store');
    Route::get('/cadastravenda/create', [CadastraVendaController::class, 'create'])->name('cadastravenda.create');
    Route::get('/cadastravenda/{venda}', [CadastraVendaController::class, 'show'])->name('cadastravenda.show');
    Route::get('/cadastravenda/{venda}/edit', [CadastraVendaController::class, 'edit'])->name('cadastravenda.edit');
    Route::put('/cadastravenda/{venda}', [CadastraVendaController::class, 'update'])->name('cadastravenda.update');
    Route::delete('/cadastravenda/{venda}', [CadastraVendaController::class, 'destroy'])->name('cadastravenda.destroy');
});
