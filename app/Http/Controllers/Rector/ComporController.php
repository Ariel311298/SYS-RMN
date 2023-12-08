<?php

namespace App\Http\Controllers\Rector;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Oferta;
use App\Models\Matricula;
use App\Models\Comportamiento;
use Barryvdh\DomPDF\Facade\Pdf;

class ComporController extends Controller
{
    /**
     * Muestra la lista de cursos disponibles para consultar o generar reportes de calificaciones del comportamiento.
     *
     * @return \Illuminate\Http\Response
    */

    public function cursos()
    {
        $ofertas = Oferta::query()->paginate(5);
        return view('rector.comportamiento.cursos', ['ofertas' => $ofertas]); 
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones del comportamiento de un curso determinado del primer quimestre para el rol del rector.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarPromCompQ1($ofer_id)
    {       
        $oferta = Oferta::query()->findOrFail($ofer_id);
        $comportamientos = Comportamiento::whereHas('oferta', function($q) use($ofer_id) {
            $q->where('ofer_id', $ofer_id);
        })->get();

        return view('rector.comportamiento.cursos.consultar-comportamiento-prom-q1', compact('oferta','comportamientos'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones del comportamiento de un curso determinado del segundo quimestre para el rol de rector.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarPromCompQ2($ofer_id)
    {       
        $oferta = Oferta::query()->findOrFail($ofer_id);
        $comportamientos = Comportamiento::whereHas('oferta', function($q) use($ofer_id) {
            $q->where('ofer_id', $ofer_id);
        })->get();

        return view('rector.comportamiento.cursos.consultar-comportamiento-prom-q2', compact('oferta','comportamientos'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones del comportamiento de un curso para el rol de rector.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarPromCompAnual($ofer_id)
    {       
        $oferta = Oferta::query()->findOrFail($ofer_id);
        $comportamientos = Comportamiento::whereHas('oferta', function($q) use($ofer_id) {
            $q->where('ofer_id', $ofer_id);
        })->get();

        return view('rector.comportamiento.cursos.consultar-comportamiento-prom-anual', compact('oferta','comportamientos'));
    }

    /**
     * Genera el reporte en PDF de las calificaciones del comportamiento de un curso determinado del promedio del primer quimestre.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFCompPromQ1(Request $request)
    {    
        $ofer_id = $request->ofer_id;   
        $oferta = Oferta::query()->findOrFail($ofer_id);
        $comportamientos = Comportamiento::whereHas('oferta', function($q) use($ofer_id) {
            $q->where('ofer_id', $ofer_id);
        })->get();

        $pdf = Pdf::loadView('rector.comportamiento.cursos.reporte-pdf.pdfCompQ1', compact('oferta','comportamientos'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor_curso' => $request->input('nom_ape_tutor_curso')
        ]);
        return $pdf->download('reporte_comportamientos_Q1.pdf');
    }

    /**
     * Genera el reporte en PDF de las calificaciones del comportamiento de un curso determinado del promedio del segundo quimestre.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFCompPromQ2(Request $request)
    {    
        $ofer_id = $request->ofer_id;   
        $oferta = Oferta::query()->findOrFail($ofer_id);
        $comportamientos = Comportamiento::whereHas('oferta', function($q) use($ofer_id) {
            $q->where('ofer_id', $ofer_id);
        })->get();

        $pdf = Pdf::loadView('rector.comportamiento.cursos.reporte-pdf.pdfCompQ2', compact('oferta','comportamientos'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor_curso' => $request->input('nom_ape_tutor_curso')
        ]);
        return $pdf->download('reporte_comportamientos_Q2.pdf');
    }

    /**
     * Genera el reporte en PDF de las calificaciones del comportamiento de un curso determinado del promedio anual.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFCompPromAnual(Request $request)
    {    
        $ofer_id = $request->ofer_id;   
        $oferta = Oferta::query()->findOrFail($ofer_id);
        $comportamientos = Comportamiento::whereHas('oferta', function($q) use($ofer_id) {
            $q->where('ofer_id', $ofer_id);
        })->get();

        $pdf = Pdf::loadView('rector.comportamiento.cursos.reporte-pdf.pdfCompAnual', compact('oferta','comportamientos'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor_curso' => $request->input('nom_ape_tutor_curso'),
            'abreviatura_rector' => $request->input('abreviatura_rector'),
            'nom_ape_rector' => $request->input('nom_ape_rector')
        ]);
        return $pdf->download('reporte_promedio_comportamientos_Anual.pdf');
    }

    /**
     * Busca el curso (Seleccionar Curso).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function search(Request $request) 
    {
        return view('rector.comportamiento.cursos', [
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
