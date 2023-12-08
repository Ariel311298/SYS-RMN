<?php

namespace App\Http\Controllers\Docente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Oferta;
use App\Models\Matricula;
use App\Models\Comportamiento;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Personal;
use App\Models\Alumno;
use App\Models\Periodo;
use App\Models\Seccion;
use App\Models\Curso;
use Barryvdh\DomPDF\Facade\Pdf;

class ComportamientosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra los cursos asignados como tutor de curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function cursos($id){          
        $cursos = Oferta::whereHas('personal', function($q) use($id) {
            $q->where('pers_id', $id);
        })->get();
        return view('docente.comportamiento.cursos', compact('cursos'));
    }
        
    /**
     * Muestra la tabla de calificaciones del comportamiento de un curso seleccionado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function ingresoComportamiento($ofer_id)
    {       
        $oferta = Oferta::query()->findOrFail($ofer_id);
        $comportamientos = Comportamiento::whereHas('oferta', function($q) use($ofer_id) {
            $q->where('ofer_id', $ofer_id);
        })->get();

        return view('docente.comportamiento.cursos.ingreso-comportamiento', compact('oferta','comportamientos'));
    }

    public function save(Request $request)
    {
        try{
            $cond_id = $request->cond_id;
            $comportamientos = $request->get('comportamientos');

            $request->validate([
                'ofer_id' => 'nullable',    
                'mat_id' => 'nullable',    
                'cond_notaQ1' => 'regex:/^[A-D]+$/u',
                'cond_escalaQ1' => 'max:255',
                'cond_notaQ2' => 'regex:/^[A-D]+$/u',
                'cond_escalaQ2' => 'max:255',        
                'cond_notaAnual' => 'regex:/^[A-D]+$/u',
                'cond_escalaAnual' => 'max:255'        
            ]); 
            foreach ($comportamientos as $cond_id => $comportamiento) {
                DB::table('comportamiento')
                ->where('cond_id', $cond_id)
                ->update([
                    'ofer_id' => $comportamiento['ofer_id'], 
                    'mat_id' => $comportamiento['mat_id'],                   
                    'cond_notaQ1' => $comportamiento['cond_notaQ1'],
                    'cond_escalaQ1' => $comportamiento['cond_escalaQ1'],
                    'cond_notaQ2' => $comportamiento['cond_notaQ2'],    
                    'cond_escalaQ2' => $comportamiento['cond_escalaQ2'],
                    'cond_notaAnual' => $comportamiento['cond_notaAnual'],
                    'cond_escalaAnual' => $comportamiento['cond_escalaAnual'] 
                ]);
            }

            if($comportamientos){
                $notificacion=array(
                    'message' => 'Las calificaciones del comportamiento de este curso han sido registradas',
                    'alert-type' => 'success'
                );
                return back()->with($notificacion);
            }

        } catch(\Exception $e) {
            $notificacion=array(
                'message' => 'Calificaciones del comportamiento no registradas. No puede ingresar números y no puede ingresar la calificacion pasando del rango: A hasta D.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        } 
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones del comportamiento de un curso determinado del primer quimestre para el rol de docente.
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

        return view('docente.comportamiento.cursos.consultar-comportamiento-prom-q1', compact('oferta','comportamientos'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones del comportamiento de un curso determinado del segundo quimestre para el rol de docente.
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

        return view('docente.comportamiento.cursos.consultar-comportamiento-prom-q2', compact('oferta','comportamientos'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones del comportamiento de un curso para el rol de docente.
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

        return view('docente.comportamiento.cursos.consultar-comportamiento-prom-anual', compact('oferta','comportamientos'));
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

        $pdf = Pdf::loadView('docente.comportamiento.cursos.reporte-pdf.pdfCompQ1', compact('oferta','comportamientos'), [
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

        $pdf = Pdf::loadView('docente.comportamiento.cursos.reporte-pdf.pdfCompQ2', compact('oferta','comportamientos'), [
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

        $pdf = Pdf::loadView('docente.comportamiento.cursos.reporte-pdf.pdfCompAnual', compact('oferta','comportamientos'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor_curso' => $request->input('nom_ape_tutor_curso'),
            'abreviatura_rector' => $request->input('abreviatura_rector'),
            'nom_ape_rector' => $request->input('nom_ape_rector')
        ]);
        return $pdf->download('reporte_promedio_comportamientos_Anual.pdf');
    }
}
