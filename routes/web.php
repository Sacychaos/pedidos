<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\SizeController;
use Illuminate\Support\Facades\Route;

//--------> Rotas Login/Logout <--------//
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



//--------> Rotas CRUD Usuários <--------//
//Route::get('/users',[UserController::class, 'index'])->name('users.index');
//Route::get('/users/create',[UserController::class, 'create'])->name('users.create');
//Route::post('/users',[UserController::class, 'store'])->name('users.store');
//Route::get('/users/{user}',[UserController::class, 'show'])->name('users.show');
//Route::get('/users/{user}/edit',[UserController::class, 'edit'])->name('users.edit');
//Route::put('/users/{user}',[UserController::class, 'update'])->name('users.update');
//Route::delete('/users/{user}',[UserController::class, 'destroy'])->name('users.destroy');
Route::resource('users', UserController::class);


//--------> Rotas CRUD ADMINISTRAÇÂO <--------//
Route::get('/admin', function () {
    return view('/admin/admin');
});


//--------> Rotas SETORES <--------//
Route::resource('sectors', SectorController::class);

//--------> Rotas TAMANHOS <--------//
Route::resource('sizes', SizeController::class);

//--------> Rotas RESTAURANTES <--------//
Route::resource('restaurants', RestaurantController::class);

//--------> Rotas PAGAMENTOS <--------//
Route::resource('payments', PaymentController::class);

//--------> Rotas CATEGORIAS <--------//
Route::resource('categories', CategoryController::class);

//--------> Rotas OPÇÕES CARDÁPIO GERAL <--------//
Route::resource('options', OptionController::class);

//--------> Rotas OPÇÕES CADASTRO CARDÁPIO DO DIA <--------//
Route::resource('menus', MenuController::class);

//--------> Rotas CARDÁPIO DO DIA DA PÁGINA DO USUÁRIO <--------//
Route::resource('orders', OrderController::class);
//--------> Rotas CARDÁPIO DO DIA DA PÁGINA DO ADM<--------//
Route::get('ordersadm', [OrderController::class, 'admindex'])->name('pedidoadm');


Route::resource('pedidos', PedidoController::class)->only([
    'index',
]);
Route::delete('/pedidos/{pedido}', [PedidoController::class, 'destroy'])->name('pedidos.destroy');







//--------> MEUS PEDIDO USUÁRIO<--------//
Route::get('/meuspedidos', [PedidoController::class, 'meuspedidos'])->name('meuspedidos');
//--------> MEUS PEDIDO ADM<--------//
Route::get('/meuspedidosadm', [PedidoController::class, 'meuspedidosadm'])->name('meuspedidosadm');










//--------> Rotas TESTES <--------//
