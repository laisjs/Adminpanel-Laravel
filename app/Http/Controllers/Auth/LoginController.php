<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }


    //quando o usuário clicar no facebook ele vai mandar pra uma url que vamos configurar que vai ter uma palavra
    // facebook. 
    public function redirectToProvider($provider)
    {
        //eu quero que redirecione para a página do facebook. 
        return Socialite::driver($provider)->redirect();
    }


//eu vou pegar os links que setou, chave e começar a conectar com a api do facebook pra pegar as informações,
// que ta vindo do usuário do facebook.
// quando eu executar a função, eu vou falar olha facebook me da a informação do usuário
//2.

    public function handleProviderCallback($provider)
    {
        //vai pegar os dados que vieram do facebook e vai recuperar o usuário pra gente
        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user, $provider);
        //pra gente logar o usuário
        Auth::login($authUser, true);
        return redirect($this->redirectTo);
    }

    //eu vou receber o user, as informações do meu usuário dentro desse obejto $user, 
    // além disso vou receber o $variável
    // objetivo da função é procurar o usuário no banco de dados e se não existir retorna aquela função
    public function findOrCreateUser($user, $provider)
    {
//eu vou verificar se o o id do provider existe, se existir vai retornar no usuário autenticado
//1.
// dd($user);
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
// se o email já existir 
        $authUser = User::where('email', $user->email)->first();
        if ($authUser) {
            return $authUser;
        }
// se nenhuma das informações for true eu crio um usuário
        $authUser = new User;

        $authUser->name = $user->name;
        $authUser->email = $user->email;
        $authUser->provider = $provider;
        $authUser->provider_id = $user->id;
        $authUser->img = $user->avatar;
        $authUser->nivel_user = 1;
        $authUser->save();
        return $authUser;
    }



}

