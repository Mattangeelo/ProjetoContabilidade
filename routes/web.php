<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AtividadesController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\login;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inicial');
});


Route::get('/login',[LoginController::class,'login'])->name('login');
Route::post('/loginSubmit',[LoginController::class,'loginSubmit'])->name('loginSubmit');


Route::middleware(login::class)->group(function (){
    Route::get('/admin',[AdminController::class , 'index'])->name('admin');
    Route::get('/CadastrarCliente',[ClienteController::class , 'index'])->name('CadastrarCliente');
    Route::post('/cadastrarSubmit',[ClienteController::class,'cadastrarSubmit'])->name('cadastrarSubmit');

    Route::get('/showCliente/{cnpj}',[ClienteController::class,'show'])->name('showCliente');
    Route::post('/editarCliente/{cnpj}',[ClienteController::class,'editarCliente'])->name('editarCliente');

    Route::get('/cadastrarAtividade',[AtividadesController::class,'cadastrarAtividade'])->name('cadastrarAtividade');
    Route::post('/cadastrarAtividadeSubmit',[AtividadesController::class,'cadastrarAtividadeSubmit'])->name('cadastrarAtividadeSubmit');
    Route::get('/showAtividade/{id}',[AtividadesController::class,'showAtividade'])->name('showAtividade');
    Route::post('/editarAtividade/{id}',[AtividadesController::class,'editarAtividade'])->name('editarAtividade');

    Route::get('/relatorio',[AdminController::class,'relatorio'])->name('relatorio');

    Route::get('/logout',[LoginController::class,'logout'])->name('logout');
});
