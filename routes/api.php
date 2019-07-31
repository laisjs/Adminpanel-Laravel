<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Padrão de endpoints:
// cinco rotas para cada tabela

// get/usuarios [retorna todos os usuários]
// get/usuarios/{{id}}  
// post/usuarios [cadastrar um usuario]
// delete/usuario/{{id}} [deletar usuário específico]
// put/usuarios/{{id}} [atualizar as informações de usuário específico]


// Pega a lista de todos os usuarios
Route::get('/usuarios', "api\UsuariosController@pegarTodos");
// Pega a lista de todos um unico usuario
Route::get('/usuarios/{id}', "api\UsuariosController@pegarUm");
// Cadastra um usuario
Route::post('/usuarios', "api\UsuariosController@criarUm");
// Deleta um usuario específico
Route::delete('/usuarios/{id}', "api\UsuariosController@deletarUm");
// Atualiza um usuario específico
Route::put('/usuarios/{id}', "api\UsuariosController@alterarUm");