<?php

namespace App\Http\Controllers\Rector;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Oferta;
use App\Models\Alumno;
use App\Models\Matricula;
use App\Models\PadreApoderado;
use Barryvdh\DomPDF\Facade\Pdf;

class AlumnosController extends Controller
{
    /**
     * Muestra la lista de cursos disponibles para ver las matriculas almacenadas en cada curso. 
     *
     * @return \Illuminate\Http\Response
    */

    public function index()
    {
        $ofertas = Oferta::query()->paginate(5);
        return view('rector.matricula.index', ['ofertas' => $ofertas]);
    }

    /**
     * Muestra la tabla de alumnos matriculados de un curso seleccionado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    
    public function listado($ofer_id)
    {       
        $ofertas = Oferta::query()->findOrFail($ofer_id);
        $alumnos = Oferta::with('matriculas')->findOrFail($ofer_id);

        return view('rector.matricula.listado', compact('ofertas','alumnos'));
    }

    /**
     * Muestra una lista de padres/madres/representantes del estudiante seleccionado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    
    public function listaDatosPadresRepresentante($alum_id)
    {       
        $alumno = Alumno::query()->findOrFail($alum_id);
        $datos = Alumno::with('padresapoderados')->findOrFail($alum_id);
        return view('rector.matricula.listado.lista_datos_padres', compact('alumno', 'datos'));
    }

    /**
     * Generar Lista de Curso seleccionado en PDF
     *
     * @return \Illuminate\Http\Response
    */

    public function generarListaCursoPDF($ofer_id)
    {
        $oferta = Oferta::query()->findOrFail($ofer_id);
        $alumnos = Oferta::query()->findOrFail($ofer_id)->matriculas;
     
        $pdf = PDF::loadView('rector.matricula.lista_formato.pdfListaCurso', compact('oferta','alumnos'));
        return $pdf->download('lista_curso_alumno.pdf');
    }
    
    /**
     * Busca el curso (Seleccionar Curso).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function search(Request $request) 
    {
        return view('rector.matricula.index', [
            'ofertas' => Oferta::join('periodo', 'oferta.per_id', '=', 'periodo.per_id')
                ->join('curso', 'oferta.cur_id', '=', 'curso.cur_id')
                ->join('personal', 'oferta.pers_id', '=', 'personal.pers_id')    
                ->where('periodo.per_nombre', 'like', '%' . $request->buscar . '%')
                ->orWhere('curso.cur_nombre', 'like', '%' . $request->buscar  . '%')
                ->orWhere('curso.cur_paralelo', 'like', '%' . $request->buscar  . '%')
                ->orWhere(DB::raw("CONCAT(curso.cur_nombre, ' ', curso.cur_paralelo)"), 'LIKE', "%" . $request->buscar . "%")
                ->orWhere('personal.pers_nombres', 'like', '%' . $request->buscar  . '%')
                ->orWhere('personal.pers_apellidos', 'like', '%' . $request->buscar  . '%')
                ->orWhere(DB::raw("CONCAT(personal.pers_nombres, ' ', personal.pers_apellidos)"), 'LIKE', "%" . $request->buscar . "%")
                ->orWhere('oferta.ofer_estado', 'like', '%' . $request->buscar  . '%')
                ->select('*')
                ->paginate(10),
        ]);
    }
}
