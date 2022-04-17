<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\MainController;

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


Route::get('/', function () {
    return redirect('/auth/login'); //suunan sisselogimise lehele
});


Route::post('/auth/save', [MainController::class, 'save'])->name('auth.save');
Route::post('/auth/checking', [MainController::class, 'checking'])->name('auth.checking');
Route::get('/auth/logout', [MainController::class, 'logout'])->name('auth.logout');

Route::group(['middleware'=>['AuthCheck']], function(){ //laen just tehtud middleware mooduli ning panen siia sisse koik Route, mille vaateid  peab kaitsma
    Route::resource('links',LinksController::class);
    Route::get('/all',[LinksController::class,'all'])->name('links.all');
    Route::get('/auth/login', [MainController::class, 'login'])->name('auth.login');
    Route::get('/auth/register', [MainController::class, 'register'])->name('auth.register');
});