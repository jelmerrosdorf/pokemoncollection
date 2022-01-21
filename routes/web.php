<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PokemonController;
use App\Http\Controllers\UserController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('pokemons', PokemonController::class);
});

Route::post('/update-status', [PokemonController::class, 'updateStatus']);

Route::get('/profile', [UserController::class,'index']);

Route::put('/profile/{username}',[UserController::class,'profileUpdate']);

Route::post('/pokemon/caught',[PokemonController::class, 'caught'])->name('caught');
Route::post('/pokemon/lost',[PokemonController::class, 'lost'])->name('lost');


