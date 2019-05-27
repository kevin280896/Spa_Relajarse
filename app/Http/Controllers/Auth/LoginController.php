<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Session;

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

    public function login(Request $request)
    {
        $this->validateLogin($request);
        //Consulta para obtener si se ha confirmado el correo
        $confirmoCorreo = DB::table('users')->where('email', '=', $request->get('email'))->where('confirmed', '=', '1')->first();
        //Validar si existe el usuario
        $existeUser = User::where('email', $request->get('email'))->first();

        if($confirmoCorreo != null) {

            // If the class is using the ThrottlesLogins trait, we can automatically throttle
            // the login attempts for this application. We'll key this by the username and
            // the IP address of the client making these requests into this application.
            if ($this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);

                return $this->sendLockoutResponse($request);
            }

            if ($this->attemptLogin($request)) {
                return $this->sendLoginResponse($request);
            }

            // If the login attempt was unsuccessful we will increment the number of attempts
            // to login and redirect the user back to the login form. Of course, when this
            // user surpasses their maximum number of attempts they will get locked out.
            $this->incrementLoginAttempts($request);

            return $this->sendFailedLoginResponse($request);
        } else {
            if($existeUser == null){
                //Validacion de si no existe el usuario muestre la alerta de que no existe el email
                return back()->with('error', 'El correo no esta en nuestros registros.');
            } else {
                //Si existe el usuario y no confirmo el correo muestre la alerta de que no podra iniciar sesion
                //hasta que confirme el correo
                return back()->with('error', 'Por favor, confirma tu correo para iniciar sesión');
            }
        }
    }

    public function redirectPath()
    {
        //Redirigimos a la ruta home para que cargue los cursos y muestre la notificacion de bienvenido
        Session::flash('success', 'Bienvenido a Spa-Relajarse.');
        return url('/');
    }

    public function logout()
    {
        //Comando para borrar la sesion guardada (logout)
        $this->guard()->logout();

        return redirect('/');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
