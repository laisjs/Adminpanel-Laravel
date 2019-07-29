<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Auth\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        //aqui vamos pegar as informações que vem do formulário
// $img = $request->file('avatar');
// tudo que o larável vai salvar ele salva na pasta storage e dentro da storage vai salvar dentro do App
//store: ele vai gerar um nome aleatório para o arquivo e cvai criar a pasta 'img '. Ela também devolve o caminho
// onde está a imagem e salva na variável que eu criei caminho ou path

// $caminho = $request->file('avatar')->store('img');
//pegando o nome original do arquivo
$nomeOriginal = $data['avatar']->getClientOriginalName();
//montando a url necessária para acessar o arquivo corretamente
$caminhoimg = 'storage/img/'. $nomeOriginal;
//Salvando apenas a imagem
$save = $data['avatar']->storeAs('public/img', $nomeOriginal);



        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'nivel_user' => $data['nivel-user'],            
            'img'=> $caminhoimg
        ]);
    }
    // o larável não enxerga a pasta storage então preciso falar que ele vai ter acesso ao storage
            //então precisa rodar um comando no termninal php artisan storage:link (ESSE COMANDO SÓ FAZ UMA VEZ NO PROJETO)
}
