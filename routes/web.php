<?php

use App\Http\Livewire\Pages\App\Dashboard;
use App\Http\Livewire\Pages\App\Operator\{Siswa, TenagaPendidik};
use App\Http\Livewire\Pages\App\Teacher\Materi;
use App\Http\Livewire\Pages\App\Teacher\Section;
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
    Route::get('/tenaga-pendidik', TenagaPendidik::class)->name('tendik');
    Route::get('/kesiswaan', Siswa::class)->name('kesiswaan');
    Route::get('/materi', Materi::class)->name('materi');
    Route::get('/materi/{slug}/section', Section::class)->name('section');
});
