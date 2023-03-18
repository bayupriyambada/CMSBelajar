<?php

use App\Http\Livewire\Pages\App\Dashboard;
use App\Http\Livewire\Pages\LoginComponent;
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

Route::group(['middleware' => 'guest'], function () {
    Route::get('/authentication/login', LoginComponent::class)->name('login');
});


Route::group(['middleware' => 'auth'], function () {
    // halaman dasbor
    Route::get('/', Dashboard::class)->name('dashboard');
});
