<?php

use App\Livewire\CreateItem;
use App\Livewire\CreateOrder;
use App\Livewire\CreateUser;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/item/create', CreateItem::class)->name('item.create');
Route::get('/user/create', CreateUser::class)->name('user.create');
Route::get('/user/{user:id}/order/create', CreateOrder::class)->name('order.create');
