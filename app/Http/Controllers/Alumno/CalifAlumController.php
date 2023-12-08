<?php

namespace App\Http\Controllers\Alumno;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Calificacion;
use App\Models\Oferta;
use App\Models\Malla;
use App\Models\Matricula;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Alumno;

class CalifAlumController extends Controller
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
        return view('alumno.calificacion.cursos', compact('cursos'));
    }

    /**
     * Muestra las calificaciones de las materias correspondientes de un curso seleccionado para consulta por parte del alumno.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarCalificacion($mat_id)
    {       
        $matricula = Matricula::query()->findOrFail($mat_id);
        $calificaciones = Calificacion::whereHas('matricula', function($q) use($mat_id) {
            $q->where('mat_id', $mat_id);
        })->get();

        return view('alumno.calificacion.cursos.consultar-calificaciones', compact('matricula','calificaciones'));
    }   
}
