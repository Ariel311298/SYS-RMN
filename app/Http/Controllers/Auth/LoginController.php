<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/dashboard';

    protected function redirectTo(){
      if ( Auth()->user()->rol_id == '1' && Auth()->user()->usu_estado == '1') 
      {
        return redirect()->route('administrador.dashboard');
      }
      else if ( Auth()->user()->rol_id == '2' && Auth()->user()->usu_estado == '1') 
      {
        return redirect()->route('secretario.dashboard');
      }
      else if ( Auth()->user()->rol_id == '3' && Auth()->user()->usu_estado == '1') 
      {
        return redirect()->route('docente.dashboard');
      }
      else if ( Auth()->user()->rol_id == '4' && Auth()->user()->usu_estado == '1') 
      {
        return redirect()->route('rector.dashboard');
      }
      else if ( Auth()->user()->rol_id == '5' && Auth()->user()->usu_estado == '1') 
      {
        return redirect()->route('alumno.dashboard');
      }
      else
      {
        return redirect()->route('dashboard')->with('error','Acceso Denegado. Por favor contactese con el Administrador.');;
      }
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

    use AuthenticatesUsers {
        logout as performLogout;
    }

    public function logout(Request $request)
    {
        $this->performLogout($request);
        return redirect()->route('login');
    }

    /*
    public function name(){
      $loginValue = request('name');
      $this->name = filter_var($loginValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
      request()->merge([$this->name => $loginValue]);
      return property_exists($this, 'name') ? $this->name : 'email';
    }
    */

    public function login(Request $request)
    {   
        $input = $request->all();
     
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
     
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (auth()->user()->rol_id == '1' && auth()->user()->usu_estado == '1') 
            {
              return redirect()->route('administrador.dashboard');
            }
            else if (auth()->user()->rol_id == '2' && auth()->user()->usu_estado == '1') 
            {
              return redirect()->route('secretario.dashboard');
            }
            else if (auth()->user()->rol_id == '3' && auth()->user()->usu_estado == '1') 
            {
              return redirect()->route('docente.dashboard');
            }
            else if (auth()->user()->rol_id == '4' && auth()->user()->usu_estado == '1') 
            {
              return redirect()->route('rector.dashboard');
            }
            else if (auth()->user()->rol_id == '5' && auth()->user()->usu_estado == '1') 
            {
              return redirect()->route('alumno.dashboard');
            }
            else
            {
              return redirect()->route('dashboard')->with('error','Acceso Denegado. Por favor contactese con el Administrador.');;
            }
        }
        else
        {
            return redirect()
            ->route('login')
            ->with('error','El email o contraseña es incorrecto.');
        }
    }
    
}
