<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', "PokemonController@pokemons");

Route::get('/getPagePokemons', "PokemonController@getPagePokemons");

Route::get('/getPokemonByName', "PokemonController@getPokemonByName");

// Route::get('/controler', "PruebaController@test");

// Route::resource('/controler2', PruebaTestController::class);