<?php

namespace App\Http\Controllers\Rector;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\TutorProyecto;
use App\Models\Matricula;
use App\Models\Oferta;
use App\Models\ProyEscolar;
use Barryvdh\DomPDF\Facade\Pdf;

class ProyEscController extends Controller
{
    
    /**
     * Muestra la lista de cursos disponibles registrados para ver las calificaciones de proyectos escolares de cada curso. 
     *
     * @return \Illuminate\Http\Response
    */

    public function cursos()
    {
        $tutorproyectos = TutorProyecto::all();
        return view('rector.proyectoescolar.cursos', ['tutorproyectos' => $tutorproyectos]);   
    }

    
    /**
     * Muestra los alumnos y sus correspondientes calificaciones del proyecto escolar de un curso determinado del primer quimestre para el rol de rector.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarPromProyEscQ1($tutproy_id)
    {       
        $tutorproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        return view('rector.proyectoescolar.cursos.consultar-calificacion-proyecto-escolar-prom-q1', compact('tutorproyecto','proyescolares'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones del proyecto escolar de un curso determinado del segundo quimestre para el rol de rector.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarPromProyEscQ2($tutproy_id)
    {       
        $tutorproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        return view('rector.proyectoescolar.cursos.consultar-calificacion-proyecto-escolar-prom-q2', compact('tutorproyecto','proyescolares'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones del proyecto escolar de un curso determinado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarPromProyEsc($tutproy_id)
    {       
        $tutorproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        return view('rector.proyectoescolar.cursos.consultar-calificacion-proyecto-escolar-prom', compact('tutorproyecto','proyescolares'));
    }

    /**
     * Genera el reporte en PDF de las calificaciones del proyecto escolar de un curso determinado del promedio del primer parcial (Q1).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFProyEscPromP1Q1(Request $request)
    {    
        $tutproy_id = $request->tutproy_id;   
        $tutorproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        $pdf = Pdf::loadView('rector.proyectoescolar.cursos.reporte-pdf.pdfProyEscolarP1Q1', compact('tutorproyecto','proyescolares'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor_proy' => $request->input('nom_ape_tutor_proy')
        ]);
        return $pdf->download('reporte_calificacion_proy_escolar_P1Q1.pdf');
    }    

    /**
     * Genera el reporte en PDF de las calificaciones del proyecto escolar de un curso determinado del promedio del segundo parcial (Q1).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFProyEscPromP2Q1(Request $request)
    {    
        $tutproy_id = $request->tutproy_id;   
        $tutorproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        $pdf = Pdf::loadView('rector.proyectoescolar.cursos.reporte-pdf.pdfProyEscolarP2Q1', compact('tutorproyecto','proyescolares'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor_proy' => $request->input('nom_ape_tutor_proy')
        ]);
        return $pdf->download('reporte_calificacion_proy_escolar_P2Q1.pdf');
    }   
    
    /**
     * Genera el reporte en PDF de las calificaciones del proyecto escolar de un curso determinado del promedio del primer quimestre.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFProyEscPromQ1(Request $request)
    {    
        $tutproy_id = $request->tutproy_id;   
        $tutorproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        $pdf = Pdf::loadView('rector.proyectoescolar.cursos.reporte-pdf.pdfProyEscolarQ1', compact('tutorproyecto','proyescolares'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor_proy' => $request->input('nom_ape_tutor_proy')
        ]);
        return $pdf->download('reporte_calificacion_proy_escolar_Q1.pdf');
    }
    
    /**
     * Genera el reporte en PDF de las calificaciones del proyecto escolar de un curso determinado del promedio del primer parcial (Q2).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFProyEscPromP1Q2(Request $request)
    {    
        $tutproy_id = $request->tutproy_id;   
        $tutorproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        $pdf = Pdf::loadView('rector.proyectoescolar.cursos.reporte-pdf.pdfProyEscolarP1Q2', compact('tutorproyecto','proyescolares'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor_proy' => $request->input('nom_ape_tutor_proy')
        ]);
        return $pdf->download('reporte_calificacion_proy_escolar_P1Q2.pdf');
    }    

    /**
     * Genera el reporte en PDF de las calificaciones del proyecto escolar de un curso determinado del promedio del segundo parcial (Q2).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFProyEscPromP2Q2(Request $request)
    {    
        $tutproy_id = $request->tutproy_id;   
        $tutorproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        $pdf = Pdf::loadView('rector.proyectoescolar.cursos.reporte-pdf.pdfProyEscolarP2Q2', compact('tutorproyecto','proyescolares'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor_proy' => $request->input('nom_ape_tutor_proy')
        ]);
        return $pdf->download('reporte_calificacion_proy_escolar_P2Q2.pdf');
    }    
        
    /**
     * Genera el reporte en PDF de las calificaciones del proyecto escolar de un curso determinado del promedio del segundo quimestre.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFProyEscPromQ2(Request $request)
    {    
        $tutproy_id = $request->tutproy_id;   
        $tutorproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        $pdf = Pdf::loadView('rector.proyectoescolar.cursos.reporte-pdf.pdfProyEscolarQ2', compact('tutorproyecto','proyescolares'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor_proy' => $request->input('nom_ape_tutor_proy')
        ]);
        return $pdf->download('reporte_calificacion_proy_escolar_Q2.pdf');
    }

    /**
     * Genera el reporte en PDF de las calificaciones del proyecto escolar de un curso determinado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFProyEscPromAnual(Request $request)
    {    
        $tutproy_id = $request->tutproy_id;   
        $tutorproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        $pdf = Pdf::loadView('rector.proyectoescolar.cursos.reporte-pdf.pdfProyEscolarAnual', compact('tutorproyecto','proyescolares'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor_proy' => $request->input('nom_ape_tutor_proy'),
            'abreviatura_rector' => $request->input('abreviatura_rector'),
            'nom_ape_rector' => $request->input('nom_ape_rector')
        ]);
        return $pdf->download('reporte_calificacion_proy_escolar_Anual.pdf');
    }
}
