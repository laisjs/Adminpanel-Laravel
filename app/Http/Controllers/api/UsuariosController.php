<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
//biblioteca pra criptografar a senha la no new user
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    public function pegarTodos (Request $request){
        $todosUsuarios= User::all();
        // response() é um método global do larável
        // devolve uma resposta com o código 200 e retorna um usuário
        return response()->json($todosUsuarios, 200);
}

    public function pegarUm (Request $request, $id){
        $usuario= User::find($id);
        return response()->json($usuario, 200);
}
    
    public function criarUm (Request $request){
        //aqui ta criando um usuário
        $usuario= new User();
        //agora precisa setar nesse usuário que está vazio, as informações recebidos pelo formulario
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make ($request->password);
        // usuario = 1 é que não é administrador
        $usuario->nivel_user = 1;
        $usuario->img = null;
        ///pra salvar o usuário
        $usuario->save();

        return response()->json(['usuario'=> true]);
}

    public function deletarUm (Request $request, $id){
        $usuario= User::find($id);
        $resultado= $usuario->delete();
        //o true pode ser substituido por "Usuárpio deletado com sucesso"
        return response()->json(['usuario'=> 'usuario']);

}

    public function alterarUm (Request $request, $id){
        
         $usuario= User::find($id);
   
         $usuario->name = $request->name;
         $usuario->email = $request->email;
         $usuario->password = Hash::make ($request->password);
         $usuario->nivel_user = 1;
         $usuario->img = null;
        
         $usuario->save();
 
         return response()->json(['usuario'=> true]);
}
}

