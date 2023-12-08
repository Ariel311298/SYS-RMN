<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Models\User;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo(){
        if ( Auth()->user()->rol_id == '1') 
        {
          return route('administrador.dashboard');
        }
        else if ( Auth()->user()->rol_id == '2') 
        {
          return route('secretario.dashboard');
        }
        else if ( Auth()->user()->rol_id == '3') 
        {
          return route('docente.dashboard');
        }
        else if ( Auth()->user()->rol_id == '4') 
        {
          return route('rector.dashboard');
        }
        else if ( Auth()->user()->rol_id == '5') 
        {
          return route('alumno.dashboard');
        }
        else
        {
          return redirect()->route('dashboard')->with('error','Acceso Denegado. Por favor contactese con el Administrador.');;
        }
    }
}
