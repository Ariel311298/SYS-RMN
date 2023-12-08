<?php

namespace App\Http\Controllers\Docente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\TutorProyecto;
use App\Models\Matricula;
use App\Models\Oferta;
use App\Models\ProyEscolar;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ProyEscolarCalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra los cursos asigados a un docente para ingreso de registro de calificacioes de proyecto escolar.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function cursos($id){          
        $cursos = TutorProyecto::whereHas('personal', function($q) use($id) {
            $q->where('pers_id', $id);
        })->get();
        return view('docente.proyescolar.cursos', compact('cursos'));
    }

    /**
     * Muestra la tabla de calificaciones del proyecto escolar de un curso seleccionado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function ingresoCalificacionProyecto($tutproy_id)
    {       
        $tutproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        return view('docente.proyescolar.cursos.ingreso-calificacion-proyecto', compact('tutproyecto','proyescolares'));
    }

    /**
     * Guarda las calificaciones del proyecto escolar ingresados de un curso seleccionado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function save(Request $request)
    {
        try{
            $proy_id = $request->proy_id;
            $proyescolares = $request->get('proyescolares');

            $request->validate([
                'tutproy_id' => 'nullable',    
                'mat_id' => 'nullable',    
                'proy_prom_parcialP1Q1' => 'regex:/^[A-D]+$/u',
                'proy_prom_parcialP2Q1' => 'regex:/^[A-D]+$/u',
                'proy_promTotalQ1' => 'regex:/^[A-D]+$/u',
                'proy_prom_parcialP1Q2' => 'regex:/^[A-D]+$/u',
                'proy_prom_parcialP2Q2' => 'regex:/^[A-D]+$/u',
                'proy_promTotalQ2' => 'regex:/^[A-D]+$/u'     
            ]); 
            foreach ($proyescolares as $proy_id => $proyescolar) {
                DB::table('proy_escolar')
                ->where('proy_id', $proy_id)
                ->update([
                    'tutproy_id' => $proyescolar['tutproy_id'], 
                    'mat_id' => $proyescolar['mat_id'],                   
                    'proy_prom_parcialP1Q1' => $proyescolar['proy_prom_parcialP1Q1'],
                    'proy_prom_parcialP2Q1' => $proyescolar['proy_prom_parcialP2Q1'],
                    'proy_promTotalQ1' => $proyescolar['proy_promTotalQ1'],    
                    'proy_prom_parcialP1Q2' => $proyescolar['proy_prom_parcialP1Q2'],
                    'proy_prom_parcialP2Q2' => $proyescolar['proy_prom_parcialP2Q2'],
                    'proy_promTotalQ2' => $proyescolar['proy_promTotalQ2'] 
                ]);
            }

            $notificacion=array(
                'message' => 'Las calificaciones del proyecto escolar de este curso han sido registradas',
                'alert-type' => 'success'
            );
            return back()->with($notificacion);

        } catch(\Exception $e) {
            $notificacion=array(
                'message' => 'Calificaciones del proyecto escolar no registradas. No puede ingresar números y no puede ingresar la calificacion pasando del rango: EX hasta R.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        } 

        /*
        if($proyescolares){
            $notificacion=array(
                'message' => 'Las calificaciones del proyecto escolar de este curso han sido registradas',
                'alert-type' => 'success'
            );
            return back()->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Calificaciones del proyecto escolar no registradas. Verifique que este correctamente ingresado las calificaciones.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        } 
        */ 
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones del proyecto escolar de un curso determinado del primer quimestre para el rol de docente.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarPromProyEscQ1($tutproy_id)
    {       
        $tutproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        return view('docente.proyescolar.cursos.consultar-calificacion-proyecto-escolar-prom-q1', compact('tutproyecto','proyescolares'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones del proyecto escolar de un curso determinado del segundo quimestre para el rol de docente.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    
    public function consultarPromProyEscQ2($tutproy_id)
    {       
        $tutproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        return view('docente.proyescolar.cursos.consultar-calificacion-proyecto-escolar-prom-q2', compact('tutproyecto','proyescolares'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones del proyecto escolar de un curso determinado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarPromProyEsc($tutproy_id)
    {       
        $tutproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        return view('docente.proyescolar.cursos.consultar-calificacion-proyecto-escolar-prom', compact('tutproyecto','proyescolares'));
    }

    /**
     * Muestra los cursos que el docente dirige o dirigio como tutor de curso del periodo actual o anteriores.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function aulas($id){          
        $cursos = Oferta::whereHas('personal', function($q) use($id) {
            $q->where('pers_id', $id);
        })->get();
        return view('docente.proyescolar.aulas', compact('cursos'));
    }

    /**
     * Muestra los cursos que el docente dirige como tutor de curso del periodo actual.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function cursoActual($id){          
        $cursos = Oferta::whereHas('personal', function($q) use($id) {
            $q->where('pers_id', $id);
        })->get();
        return view('docente.proyescolar.curso-actual', compact('cursos'));
    }

    /**
     * Muestra una lista de tutores de proyectos escolares registrados en el curso seleccionado.S
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function seleccionLista($ofer_id)
    {       
        $oferta = Oferta::query()->findOrFail($ofer_id);
        $tutorproyectos = TutorProyecto::whereHas('oferta', function($q) use($ofer_id) {
            $q->where('ofer_id', $ofer_id);
        })->get();

        return view('docente.proyescolar.aulas.curso-proyecto', compact('tutorproyectos','oferta'));
    }

    /**
     * Muestra una lista de tutores de proyectos escolares registrados en el curso actual.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function seleccionListaCurActual($ofer_id)
    {       
        $oferta = Oferta::query()->findOrFail($ofer_id);
        $tutorproyectos = TutorProyecto::whereHas('oferta', function($q) use($ofer_id) {
            $q->where('ofer_id', $ofer_id);
        })->get();

        return view('docente.proyescolar.curso-actual.curso-proyecto', compact('tutorproyectos','oferta'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones del proyecto escolar de un curso determinado del primer quimestre para consulta por parte del tutor de curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consulPromProyEscQ1($tutproy_id)
    {       
        $tutproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        return view('docente.proyescolar.aulas.curso-proyecto.consultar-calificacion-proyecto-escolar-prom-q1', compact('tutproyecto','proyescolares'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones del proyecto escolar de un curso determinado del segundo quimestre para consulta por parte del tutor de curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    
    public function consulPromProyEscQ2($tutproy_id)
    {       
        $tutproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        return view('docente.proyescolar.aulas.curso-proyecto.consultar-calificacion-proyecto-escolar-prom-q2', compact('tutproyecto','proyescolares'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones del proyecto escolar de un curso determinado para consulta por parte del tutor de curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consulPromProyEsc($tutproy_id)
    {       
        $tutproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        return view('docente.proyescolar.aulas.curso-proyecto.consultar-calificacion-proyecto-escolar-prom', compact('tutproyecto','proyescolares'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones del proyecto escolar del curso actual del primer quimestre para consulta por parte del tutor de curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consulPromProyEscQ1CurActual($tutproy_id)
    {       
        $tutproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        return view('docente.proyescolar.curso-actual.curso-proyecto.consultar-calificacion-proyecto-escolar-prom-q1', compact('tutproyecto','proyescolares'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones del proyecto escolar de un curso actual del segundo quimestre para consulta por parte del tutor de curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    
    public function consulPromProyEscQ2CurActual($tutproy_id)
    {       
        $tutproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        return view('docente.proyescolar.curso-actual.curso-proyecto.consultar-calificacion-proyecto-escolar-prom-q2', compact('tutproyecto','proyescolares'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones del proyecto escolar de un curso actual para consulta por parte del tutor de curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consulPromProyEscCurActual($tutproy_id)
    {       
        $tutproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        return view('docente.proyescolar.curso-actual.curso-proyecto.consultar-calificacion-proyecto-escolar-prom', compact('tutproyecto','proyescolares'));
    }

    /**
     * Genera el reporte en PDF de las calificaciones del proyecto escolar de un curso determinado del promedio del primer parcial (Q1) - Tutor de Curso. 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFProyEscolarPromP1Q1(Request $request)
    {    
        $tutproy_id = $request->tutproy_id;   
        $tutorproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        $pdf = Pdf::loadView('docente.proyescolar.aulas.curso-proyecto.reporte-pdf.pdfProyEscolarP1Q1', compact('tutorproyecto','proyescolares'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor_proy' => $request->input('nom_ape_tutor_proy')
        ]);
        return $pdf->download('reporte_calificacion_proy_escolar_P1Q1.pdf');
    }    

    /**
     * Genera el reporte en PDF de las calificaciones del proyecto escolar de un curso determinado del promedio del segundo parcial (Q1) - Tutor de Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFProyEscolarPromP2Q1(Request $request)
    {    
        $tutproy_id = $request->tutproy_id;   
        $tutorproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        $pdf = Pdf::loadView('docente.proyescolar.aulas.curso-proyecto.reporte-pdf.pdfProyEscolarP2Q1', compact('tutorproyecto','proyescolares'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor_proy' => $request->input('nom_ape_tutor_proy')
        ]);
        return $pdf->download('reporte_calificacion_proy_escolar_P2Q1.pdf');
    }   
    
     /**
     * Genera el reporte en PDF de las calificaciones del proyecto escolar de un curso determinado del promedio del primer quimestre - Tutor de Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFProyEscolarPromQ1(Request $request)
    {    
        $tutproy_id = $request->tutproy_id;   
        $tutorproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        $pdf = Pdf::loadView('docente.proyescolar.aulas.curso-proyecto.reporte-pdf.pdfProyEscolarQ1', compact('tutorproyecto','proyescolares'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor_proy' => $request->input('nom_ape_tutor_proy')
        ]);
        return $pdf->download('reporte_calificacion_proy_escolar_Q1.pdf');
    }
    
    /**
     * Genera el reporte en PDF de las calificaciones del proyecto escolar de un curso determinado del promedio del primer parcial (Q2) - Tutor de Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFProyEscolarPromP1Q2(Request $request)
    {    
        $tutproy_id = $request->tutproy_id;   
        $tutorproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        $pdf = Pdf::loadView('docente.proyescolar.aulas.curso-proyecto.reporte-pdf.pdfProyEscolarP1Q2', compact('tutorproyecto','proyescolares'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor_proy' => $request->input('nom_ape_tutor_proy')
        ]);
        return $pdf->download('reporte_calificacion_proy_escolar_P1Q2.pdf');
    }    

    /**
     * Genera el reporte en PDF de las calificaciones del proyecto escolar de un curso determinado del promedio del segundo parcial (Q2) - Tutor de Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFProyEscolarPromP2Q2(Request $request)
    {    
        $tutproy_id = $request->tutproy_id;   
        $tutorproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        $pdf = Pdf::loadView('docente.proyescolar.aulas.curso-proyecto.reporte-pdf.pdfProyEscolarP2Q2', compact('tutorproyecto','proyescolares'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor_proy' => $request->input('nom_ape_tutor_proy')
        ]);
        return $pdf->download('reporte_calificacion_proy_escolar_P2Q2.pdf');
    }    
        
    /**
     * Genera el reporte en PDF de las calificaciones del proyecto escolar de un curso determinado del promedio del segundo quimestre - Tutor de Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFProyEscolarPromQ2(Request $request)
    {    
        $tutproy_id = $request->tutproy_id;   
        $tutorproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        $pdf = Pdf::loadView('docente.proyescolar.aulas.curso-proyecto.reporte-pdf.pdfProyEscolarQ2', compact('tutorproyecto','proyescolares'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor_proy' => $request->input('nom_ape_tutor_proy')
        ]);
        return $pdf->download('reporte_calificacion_proy_escolar_Q2.pdf');
    }

    /**
     * Genera el reporte en PDF de las calificaciones del proyecto escolar de un curso determinado - Tutor de Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFProyEscolarPromAnual(Request $request)
    {    
        $tutproy_id = $request->tutproy_id;   
        $tutorproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        $pdf = Pdf::loadView('docente.proyescolar.aulas.curso-proyecto.reporte-pdf.pdfProyEscolarAnual', compact('tutorproyecto','proyescolares'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor_proy' => $request->input('nom_ape_tutor_proy'),
            'abreviatura_rector' => $request->input('abreviatura_rector'),
            'nom_ape_rector' => $request->input('nom_ape_rector')
        ]);
        return $pdf->download('reporte_calificacion_proy_escolar_Anual.pdf');
    }

    /**
     * Genera el reporte en PDF de las calificaciones del proyecto escolar de un curso actual del promedio del primer parcial (Q1) - Tutor de Curso. 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFProyEscolarPromP1Q1CurActual(Request $request)
    {    
        $tutproy_id = $request->tutproy_id;   
        $tutorproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        $pdf = Pdf::loadView('docente.proyescolar.curso-actual.curso-proyecto.reporte-pdf.pdfProyEscolarP1Q1', compact('tutorproyecto','proyescolares'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor_proy' => $request->input('nom_ape_tutor_proy')
        ]);
        return $pdf->download('reporte_calificacion_proy_escolar_P1Q1.pdf');
    }    

    /**
     * Genera el reporte en PDF de las calificaciones del proyecto escolar de un curso actual del promedio del segundo parcial (Q1) - Tutor de Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFProyEscolarPromP2Q1CurActual(Request $request)
    {    
        $tutproy_id = $request->tutproy_id;   
        $tutorproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        $pdf = Pdf::loadView('docente.proyescolar.curso-actual.curso-proyecto.reporte-pdf.pdfProyEscolarP2Q1', compact('tutorproyecto','proyescolares'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor_proy' => $request->input('nom_ape_tutor_proy')
        ]);
        return $pdf->download('reporte_calificacion_proy_escolar_P2Q1.pdf');
    }   
    
    /**
     * Genera el reporte en PDF de las calificaciones del proyecto escolar de un curso actual del promedio del primer quimestre - Tutor de Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFProyEscolarPromQ1CurActual(Request $request)
    {    
        $tutproy_id = $request->tutproy_id;   
        $tutorproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        $pdf = Pdf::loadView('docente.proyescolar.curso-actual.curso-proyecto.reporte-pdf.pdfProyEscolarQ1', compact('tutorproyecto','proyescolares'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor_proy' => $request->input('nom_ape_tutor_proy')
        ]);
        return $pdf->download('reporte_calificacion_proy_escolar_Q1.pdf');
    }
    
    /**
     * Genera el reporte en PDF de las calificaciones del proyecto escolar de un curso actual del promedio del primer parcial (Q2) - Tutor de Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFProyEscolarPromP1Q2CurActual(Request $request)
    {    
        $tutproy_id = $request->tutproy_id;   
        $tutorproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        $pdf = Pdf::loadView('docente.proyescolar.curso-actual.curso-proyecto.reporte-pdf.pdfProyEscolarP1Q2', compact('tutorproyecto','proyescolares'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor_proy' => $request->input('nom_ape_tutor_proy')
        ]);
        return $pdf->download('reporte_calificacion_proy_escolar_P1Q2.pdf');
    }    

    /**
     * Genera el reporte en PDF de las calificaciones del proyecto escolar de un curso actual del promedio del segundo parcial (Q2) - Tutor de Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFProyEscolarPromP2Q2CurActual(Request $request)
    {    
        $tutproy_id = $request->tutproy_id;   
        $tutorproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        $pdf = Pdf::loadView('docente.proyescolar.curso-actual.curso-proyecto.reporte-pdf.pdfProyEscolarP2Q2', compact('tutorproyecto','proyescolares'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor_proy' => $request->input('nom_ape_tutor_proy')
        ]);
        return $pdf->download('reporte_calificacion_proy_escolar_P2Q2.pdf');
    }    
        
    /**
     * Genera el reporte en PDF de las calificaciones del proyecto escolar de un curso actual del promedio del segundo quimestre - Tutor de Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFProyEscolarPromQ2CurActual(Request $request)
    {    
        $tutproy_id = $request->tutproy_id;   
        $tutorproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        $pdf = Pdf::loadView('docente.proyescolar.curso-actual.curso-proyecto.reporte-pdf.pdfProyEscolarQ2', compact('tutorproyecto','proyescolares'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor_proy' => $request->input('nom_ape_tutor_proy')
        ]);
        return $pdf->download('reporte_calificacion_proy_escolar_Q2.pdf');
    }

    /**
     * Genera el reporte en PDF de las calificaciones del proyecto escolar de un curso actual - Tutor de Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFProyEscolarPromAnualCurActual(Request $request)
    {    
        $tutproy_id = $request->tutproy_id;   
        $tutorproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        $pdf = Pdf::loadView('docente.proyescolar.curso-actual.curso-proyecto.reporte-pdf.pdfProyEscolarAnual', compact('tutorproyecto','proyescolares'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor_proy' => $request->input('nom_ape_tutor_proy'),
            'abreviatura_rector' => $request->input('abreviatura_rector'),
            'nom_ape_rector' => $request->input('nom_ape_rector')
        ]);
        return $pdf->download('reporte_calificacion_proy_escolar_Anual.pdf');
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

        $pdf = Pdf::loadView('docente.proyescolar.cursos.reporte-pdf.pdfProyEscolarP1Q1', compact('tutorproyecto','proyescolares'), [
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

        $pdf = Pdf::loadView('docente.proyescolar.cursos.reporte-pdf.pdfProyEscolarP2Q1', compact('tutorproyecto','proyescolares'), [
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

        $pdf = Pdf::loadView('docente.proyescolar.cursos.reporte-pdf.pdfProyEscolarQ1', compact('tutorproyecto','proyescolares'), [
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

        $pdf = Pdf::loadView('docente.proyescolar.cursos.reporte-pdf.pdfProyEscolarP1Q2', compact('tutorproyecto','proyescolares'), [
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

        $pdf = Pdf::loadView('docente.proyescolar.cursos.reporte-pdf.pdfProyEscolarP2Q2', compact('tutorproyecto','proyescolares'), [
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

        $pdf = Pdf::loadView('docente.proyescolar.cursos.reporte-pdf.pdfProyEscolarQ2', compact('tutorproyecto','proyescolares'), [
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

        $pdf = Pdf::loadView('docente.proyescolar.cursos.reporte-pdf.pdfProyEscolarAnual', compact('tutorproyecto','proyescolares'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor_proy' => $request->input('nom_ape_tutor_proy'),
            'abreviatura_rector' => $request->input('abreviatura_rector'),
            'nom_ape_rector' => $request->input('nom_ape_rector')
        ]);
        return $pdf->download('reporte_calificacion_proy_escolar_Anual.pdf');
    }
}
