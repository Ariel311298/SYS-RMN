<?php

namespace App\Http\Controllers\Alumno;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Alumno;
use App\Models\Oferta;
use App\Models\Matricula;
use App\Models\Comportamiento;

class ComporAlumController extends Controller
{
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
        return view('alumno.comportamiento.cursos', compact('cursos'));
    }
    
    /**
     * Muestra los alumnos y sus correspondientes calificaciones del comportamiento de un curso para el rol de alumno.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarCalifComportamiento($mat_id)
    {       
        $matricula = Matricula::query()->findOrFail($mat_id);
        $comportamientos = Comportamiento::whereHas('matricula', function($q) use($mat_id) {
            $q->where('mat_id', $mat_id);
        })->get();

        return view('alumno.comportamiento.cursos.consultar-calificaciones-comportamiento', compact('matricula','comportamientos'));
    }
}
