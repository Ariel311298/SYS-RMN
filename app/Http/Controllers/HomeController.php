<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('isadmin',['only'=>['index']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    
    public function index()
    {
        return view('dashboard');
    }
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    /*
    public function administradorHome()
    {
        return view('administrador.dashboard');
    }
    */
    public function secretarioHome()
    {
        return view('dashboard');
    }

    public function docenteHome()
    {
        return view('dashboard');
    }

    public function rectorHome()
    {
        return view('dashboard');
    }

    public function alumnoHome()
    {
        return view('dashboard');
    }

    public function userHome()
    {
        return view('dashboard');
    }

    public function perform()
    {
        Session::flush();
        
        Auth::logout();

        return redirect('login');
    }
}
