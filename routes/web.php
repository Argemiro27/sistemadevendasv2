<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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
    Route::get('/vendas', [VendaController::class, 'index'])->name('vendas.index');
    Route::get('/vendas/create', [VendaController::class, 'create'])->name('vendas.create');
    Route::post('/vendas', [VendaController::class, 'store'])->name('vendas.store');
    Route::get('/vendas/{id}', [VendaController::class, 'show'])->name('vendas.show');
    Route::get('/vendas/{id}/edit', [VendaController::class, 'edit'])->name('vendas.edit');
    Route::put('/vendas/{id}', [VendaController::class, 'update'])->name('vendas.update');
    Route::delete('/vendas/{id}', [VendaController::class, 'destroy'])->name('vendas.destroy');
});
