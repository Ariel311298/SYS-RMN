<?php

namespace App\Http\Controllers\Alumno;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Alumno;
use App\Models\TutorProyecto;
use App\Models\Matricula;
use App\Models\Oferta;
use App\Models\ProyEscolar;

class ProyEscAlumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra los cursos del alumno asignado al curso asignado o anteriores cursos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function cursos($id){          
        $cursos = Matricula::whereHas('alumno', function($q) use($id) {
            $q->where('alum_id', $id);
        })->get();
        return view('alumno.proyecto-escolar.cursos', compact('cursos'));
    }

    /**
     *  Muestra el alumno y sus correspondientes calificaciones del proyecto escolar de un curso para el rol de alumno.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarCalifProyEscolar($mat_id)
    {       
        $matricula = Matricula::query()->findOrFail($mat_id);
        $proyescolares = ProyEscolar::whereHas('matricula', function($q) use($mat_id) {
            $q->where('mat_id', $mat_id);
        })->get();

        return view('alumno.proyecto-escolar.cursos.consultar-calificaciones-proyecto-escolar', compact('matricula','proyescolares'));
    }
}
