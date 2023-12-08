<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocenteController extends Controller
{
    /**
     * Accede al dashboard del rol de Docente
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth');
     }

     public function docenteDashboard()
     {
         return view('docente.dashboard');
     }
}
