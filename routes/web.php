<?php

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

Route::get('/index',function(){
    return view('painel.index');
})->middleware('checkadmin');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// auth/{provider} - provider está como parâmetro, pq quando ele digitar facebook vai executar o redirect provider
Route::get('/auth/{provider}', 'Auth\LoginController@redirectToProvider');
//executa um callback pra pdoer enviar as informações. 
Route::get('/auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');