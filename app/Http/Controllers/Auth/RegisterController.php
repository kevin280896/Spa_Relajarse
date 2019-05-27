<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Session;

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

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    //Funcion que redirige despues de que se registre el usuario
    protected function redirectPath()
    {
        //Alerta para el usuario de que ya se ha registrado
        Session::flash('success', 'Usuario registrado');
        //Alerta para que el usuario confirme el correo sino no podra acceder a la plataforma
        Session::flash('info', 'Por favor confirma tu correo para acceder a la plataforma');
        //URL a donde se va a redirigir
        return '/login';
    }

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
        //Mensajes que se mostraran dependiendo el error y el campo
        $messages = [
            'name.required' => 'El :attribute es obligatorio.',
            'name.string' => 'El :attribute debe ser una cadena de texto',
            'email.required' => 'El :attribute es obligatorio',
            'email.email' => 'El :attribute debe de ser un correo electronico',
            'email.max' => 'El :attribute no debe de pasar de 255 caracteres',
            'password.required' => 'La :attribute es obligatoria.',
            'password.min' => 'La :attribute debe ser de minimo de 4 digitos.',
            'tipo.required' => 'El :attribute es obligatorio.',
        ];
        //Validador que indica que tipo de dato es cada campo del formulario
        //Validator::make($datos, reglas, mensajes);
        //Los mensajes no es obligatorio ponerlo ya que laravel cuenta con mensajes por default
        //Si se ponen los mensajes es porque quieres ser mas especifico
        //$datos= Formulario que se manda de la vista
        //reglas= Reglas de cada campo del formulario, si es requerido, si es string o entero, etc..
        //mensajes= Mensaje que se mostraran si entra en algun error
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'tipo' => 'required',
        ], $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //Creamos iun codigo de cconfirmacion random
        $data['confirmation_code'] = str_random(15);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'Tipo' => $data['tipo'],
            'confirmation_code' => $data['confirmation_code'],
        ]);

        //Enviar email para que confirme el correo
        Mail::send('emails.confirmation_code', $data, function ($message) use($data) {
            $message->to($data['email'], $data['name'])->subject('Por favor confirma tu correo');
        });

        return $user;
    }

    public function verify($code)
    {
        //Obtenemos el usuario con el codigo de verificacion que se mando al correo
        $user = User::where('confirmation_code', $code)->first();

        //Si no existe el usuario se retorna al login
        if (!$user)
            return redirect('/login')->with('error', 'El código de verificación es inválido.');

        //Activamos la bandera de que confirmo el correo
        $user->confirmed = true;
        //Borramos el codigo de verificacion
        $user->confirmation_code = null;
        $user->save();
        //Redireccionamos al login con la alerta de que se confirmo el correo
        return redirect('/login')->with('success', 'Has confirmado correctamente tu correo.');
    }
}
