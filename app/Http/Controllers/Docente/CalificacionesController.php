<?php

namespace App\Http\Controllers\Docente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Calificacion;
use App\Models\Oferta;
use App\Models\Malla;
use App\Models\Matricula;
use App\Models\Personal;
use App\Models\Alumno;
use App\Models\Periodo;
use App\Models\Seccion;
use App\Models\Curso;
use App\Models\Asignatura;
use App\Models\ProyEscolar;
use App\Models\Comportamiento;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class CalificacionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra las asignaturas asignadas al docente que inicia sesion con sus credenciales.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function asignaturas($id){          
        $materias = Malla::whereHas('personal', function($q) use($id) {
            $q->where('pers_id', $id);
        })->get();
        return view('docente.calificacion.asignaturas', compact('materias'));
    }
    
    /**
     * Muestra la tabla de calificaciones de una asignatura seleccionada de un curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function ingresocalificacion($mal_id)
    {       
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        return view('docente.calificacion.asignaturas.ingresocalificacion', compact('malla','calificaciones'));
    }

    /**
     * Guarda las calificaciones ingresadas de una asignatura seleccionada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function save(Request $request)
    {
        try {
            $cal_id = $request->cal_id;
            $calificaciones = $request->get('calificaciones');
            $validator = Validator::make($request->get('calificaciones'), [
            'mal_id.*' => 'nullable|max:10',
            'mat_id.*' => 'nullable|max:10',      
            'cal_deberP1Q1.*' => 'numeric|between:0,10.00',  
            'cal_actindP1Q1.*' => 'numeric|between:0,10.00',
            'cal_actgruP1Q1.*' => 'numeric|between:0,10.00',
            'cal_lecP1Q1.*' => 'numeric|between:0,10.00',  
            'cal_pruP1Q1.*' => 'numeric|between:0,10.00',
            'cal_promP1Q1.*' => 'numeric|between:0,10.00',
            'cal_deberP2Q1.*' => 'numeric|between:0,10.00',  
            'cal_actindP2Q1.*' => 'numeric|between:0,10.00',
            'cal_actgruP2Q1.*' => 'numeric|between:0,10.00',
            'cal_lecP2Q1.*' => 'numeric|between:0,10.00',  
            'cal_pruP2Q1.*' => 'numeric|between:0,10.00',
            'cal_promP2Q1.*' => 'numeric|between:0,10.00',
            'cal_promParQ1.*' => 'numeric|between:0,10.00',  
            'cal_promQ1_80.*' => 'numeric|between:0,10.00',
            'cal_examQ1_10.*' => 'numeric|between:0,10.00',
            'cal_examQ1_20.*' => 'numeric|between:0,10.00',  
            'cal_promTotalQ1.*' => 'numeric|between:0,10.00',
            'cal_escalaQ1.*' => 'max:4',
            'cal_deberP1Q2.*' => 'numeric|between:0,10.00',  
            'cal_actindP1Q2.*' => 'numeric|between:0,10.00',
            'cal_actgruP1Q2.*' => 'numeric|between:0,10.00',
            'cal_lecP1Q2.*' => 'numeric|between:0,10.00',  
            'cal_pruP1Q2.*' => 'numeric|between:0,10.00',
            'cal_promP1Q2.*' => 'numeric|between:0,10.00',
            'cal_deberP2Q2.*' => 'numeric|between:0,10.00',  
            'cal_actindP2Q2.*' => 'numeric|between:0,10.00',
            'cal_actgruP2Q2.*' => 'numeric|between:0,10.00',
            'cal_lecP2Q2.*' => 'numeric|between:0,10.00',  
            'cal_pruP2Q2.*' => 'numeric|between:0,10.00',
            'cal_promP2Q2.*' => 'numeric|between:0,10.00',
            'cal_promParQ2.*' => 'numeric|between:0,10.00',  
            'cal_promQ2_80.*' => 'numeric|between:0,10.00',
            'cal_examQ2_10.*' => 'numeric|between:0,10.00',
            'cal_examQ2_20.*' => 'numeric|between:0,10.00',  
            'cal_promTotalQ2.*' => 'numeric|between:0,10.00',
            'cal_escalaQ2.*' => 'max:4',
            'cal_promAnual.*' => 'numeric|between:0,10.00',
            'cal_escalaAnual.*' => 'max:4',    
            'cal_estatus.*' => 'max:10',
            'cal_examMejora.*' => 'numeric|between:0,10.00',  
            'cal_examSupletorio.*' => 'numeric|between:0,10.00',
            'cal_examRemedial.*' => 'numeric|between:0,10.00',
            'cal_examGracia.*' => 'numeric|between:0,10.00'  
            ],                        
            [
                'cal_deberP1Q1.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',  
                'cal_actindP1Q1.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',
                'cal_actgruP1Q1.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',
                'cal_lecP1Q1.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',  
                'cal_pruP1Q1.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',
                'cal_promP1Q1.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',
                'cal_deberP2Q1.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',  
                'cal_actindP2Q1.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',
                'cal_actgruP2Q1.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',
                'cal_lecP2Q1.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',  
                'cal_pruP2Q1.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',
                'cal_promP2Q1.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',
                'cal_promParQ1.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',  
                'cal_promQ1_80.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',
                'cal_examQ1_10.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',
                'cal_examQ1_20.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',  
                'cal_promTotalQ1.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',
                'cal_escalaQ1.*' => 'Solo se admite 4 caracteres',
                'cal_deberP1Q2.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',  
                'cal_actindP1Q2.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',
                'cal_actgruP1Q2.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',
                'cal_lecP1Q2.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',  
                'cal_pruP1Q2.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',
                'cal_promP1Q2.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',
                'cal_deberP2Q2.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',  
                'cal_actindP2Q2.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',
                'cal_actgruP2Q2.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',
                'cal_lecP2Q2.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',  
                'cal_pruP2Q2.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',
                'cal_promP2Q2.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',
                'cal_promParQ2.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',  
                'cal_promQ2_80.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',
                'cal_examQ2_10.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',
                'cal_examQ2_20.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',  
                'cal_promTotalQ2.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',
                'cal_escalaQ2.*' => 'Solo se admite 4 caracteres',
                'cal_promAnual.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',
                'cal_escalaAnual.*' => 'Solo se admite 4 caracteres',
                'cal_examMejora.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',  
                'cal_examSupletorio.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',
                'cal_examRemedial.*' => 'Solo se admiten valores desde 0.00 hasta 10.00',
                'cal_examGracia.*' => 'Solo se admiten valores desde 0.00 hasta 10.00'      
            ]);

            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }
        
            foreach ($calificaciones as $cal_id => $calificacion) {
                DB::table('calificacion')
                    ->where('cal_id', $cal_id)
                    ->update([
                        'mal_id' => $calificacion['mal_id'],  
                        'mat_id' => $calificacion['mat_id'],                                    
                        'cal_deberP1Q1' => $calificacion['cal_deberP1Q1'],
                        'cal_actindP1Q1' => $calificacion['cal_actindP1Q1'],    
                        'cal_actgruP1Q1' => $calificacion['cal_actgruP1Q1'],
                        'cal_lecP1Q1' => $calificacion['cal_lecP1Q1'],
                        'cal_pruP1Q1' => $calificacion['cal_pruP1Q1'],
                        'cal_promP1Q1' => $calificacion['cal_promP1Q1'],
                        'cal_deberP2Q1' => $calificacion['cal_deberP2Q1'],
                        'cal_actindP2Q1' => $calificacion['cal_actindP2Q1'],
                        'cal_actgruP2Q1' => $calificacion['cal_actgruP2Q1'],
                        'cal_lecP2Q1' => $calificacion['cal_lecP2Q1'],
                        'cal_pruP2Q1' => $calificacion['cal_pruP2Q1'], 
                        'cal_promP2Q1' => $calificacion['cal_promP2Q1'],     
                        'cal_promParQ1' => $calificacion['cal_promParQ1'], 
                        'cal_promQ1_80' => $calificacion['cal_promQ1_80'],  
                        'cal_examQ1_10' => $calificacion['cal_examQ1_10'], 
                        'cal_examQ1_20' => $calificacion['cal_examQ1_20'],
                        'cal_promTotalQ1' => $calificacion['cal_promTotalQ1'],
                        'cal_escalaQ1' => $calificacion['cal_escalaQ1'], 
                        'cal_deberP1Q2' => $calificacion['cal_deberP1Q2'],
                        'cal_actindP1Q2' => $calificacion['cal_actindP1Q2'],    
                        'cal_actgruP1Q2' => $calificacion['cal_actgruP1Q2'], 
                        'cal_lecP1Q2' => $calificacion['cal_lecP1Q2'], 
                        'cal_pruP1Q2' => $calificacion['cal_pruP1Q2'],  
                        'cal_promP1Q2' => $calificacion['cal_promP1Q2'],    
                        'cal_deberP2Q2' => $calificacion['cal_deberP2Q2'],
                        'cal_actindP2Q2' => $calificacion['cal_actindP2Q2'], 
                        'cal_actgruP2Q2' => $calificacion['cal_actgruP2Q2'],  
                        'cal_lecP2Q2' => $calificacion['cal_lecP2Q2'],    
                        'cal_pruP2Q2' => $calificacion['cal_pruP2Q2'], 
                        'cal_promP2Q2' => $calificacion['cal_promP2Q2'],
                        'cal_promParQ2' => $calificacion['cal_promParQ2'],
                        'cal_promQ2_80' => $calificacion['cal_promQ2_80'],
                        'cal_examQ2_10' => $calificacion['cal_examQ2_10'],  
                        'cal_examQ2_20' => $calificacion['cal_examQ2_20'],   
                        'cal_promTotalQ2' => $calificacion['cal_promTotalQ2'],
                        'cal_escalaQ2' => $calificacion['cal_escalaQ2'],
                        'cal_promAnual' => $calificacion['cal_promAnual'],
                        'cal_escalaAnual' => $calificacion['cal_escalaAnual'],
                        'cal_estatus' => $calificacion['cal_estatus'],
                        'cal_examMejora' => $calificacion['cal_examMejora'],     
                        'cal_examSupletorio' => $calificacion['cal_examSupletorio'],
                        'cal_examRemedial' => $calificacion['cal_examRemedial'],
                        'cal_examGracia' => $calificacion['cal_examGracia']
                ]);
            }

            if($calificaciones){
                $notificacion=array(
                    'message' => 'Las calificaciones de esta materia han sido registradas',
                    'alert-type' => 'success'
                );
                return back()->with($notificacion);
            }

        } catch(\Exception $e) {
            $notificacion=array(
                'message' => 'Calificaciones no registradas. No puede ingresar letras solo puede ingresar números.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        } 
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones de la materia seleccionada de un curso determinado del primer parcial (Q1).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarCalifPromP1Q1($mal_id)
    {       
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        return view('docente.calificacion.asignaturas.consultar-calificacion-prom-p1q1', compact('malla','calificaciones'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones de la materia seleccionada de un curso determinado del segundo parcial (Q1).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarCalifPromP2Q1($mal_id)
    {       
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        return view('docente.calificacion.asignaturas.consultar-calificacion-prom-p2q1', compact('malla','calificaciones'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones de la materia seleccionada de un curso determinado del primer quimestre.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarCalifPromQ1($mal_id)
    {       
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        return view('docente.calificacion.asignaturas.consultar-calificacion-prom-q1', compact('malla','calificaciones'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones de la materia seleccionada de un curso determinado del primer parcial (Q2).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarCalifPromP1Q2($mal_id)
    {       
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        return view('docente.calificacion.asignaturas.consultar-calificacion-prom-p1q2', compact('malla','calificaciones'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones de la materia seleccionada de un curso determinado del segundo parcial (Q2).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarCalifPromP2Q2($mal_id)
    {       
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        return view('docente.calificacion.asignaturas.consultar-calificacion-prom-p2q2', compact('malla','calificaciones'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones de la materia seleccionada de un curso determinado del segundo quimestre.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarCalifPromQ2($mal_id)
    {       
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        return view('docente.calificacion.asignaturas.consultar-calificacion-prom-q2', compact('malla','calificaciones'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones de la materia seleccionada de un curso determinado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarCalifPromAnual($mal_id)
    {       
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        return view('docente.calificacion.asignaturas.consultar-calificacion-prom-anual', compact('malla','calificaciones'));
    }

    /**
     * Muestra los cursos que el docente dirige o dirigio como tutor de curso del periodo actual o anteriores.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function cursos($id){          
        $cursos = Oferta::whereHas('personal', function($q) use($id) {
            $q->where('pers_id', $id);
        })->get();
        return view('docente.calificacion.cursos', compact('cursos'));
    }

    /**
     * Muestra los cursos que el docente dirige como tutor de curso actual.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function cursoActual($id){          
        $cursos = Oferta::whereHas('personal', function($q) use($id) {
            $q->where('pers_id', $id);
        })->get();
        return view('docente.calificacion.curso-actual', compact('cursos'));
    }

    /**
     * Muestra las asignaturas del curso seleccionado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function seleccionarAsignatura($ofer_id)
    {       
        $oferta = Oferta::query()->findOrFail($ofer_id);
        $mallas = Malla::whereHas('asignatura', function($q) use($ofer_id) {
            $q->where('ofer_id', $ofer_id);
        })->get();

        return view('docente.calificacion.cursos.materias', compact('mallas','oferta'));
    }

    /**
     * Muestra las asignaturas del curso actual.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function seleccionarAsignaturaCursActual($ofer_id)
    {       
        $oferta = Oferta::query()->findOrFail($ofer_id);
        $mallas = Malla::whereHas('asignatura', function($q) use($ofer_id) {
            $q->where('ofer_id', $ofer_id);
        })->get();

        return view('docente.calificacion.curso-actual.materias', compact('mallas','oferta'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones de la materia seleccionada de un curso determinado del primer parcial (Q1) para consulta por parte del tutor de curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarCalPromP1Q1($mal_id)
    {       
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        return view('docente.calificacion.cursos.materias.consultar-calificacion-prom-p1q1', compact('malla','calificaciones'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones de la materia seleccionada de un curso determinado del segundo parcial (Q1) para consulta por parte del tutor de curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarCalPromP2Q1($mal_id)
    {       
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        return view('docente.calificacion.cursos.materias.consultar-calificacion-prom-p2q1', compact('malla','calificaciones'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones de la materia seleccionada de un curso determinado del primer quimestre para consulta por parte del tutor de curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarCalPromQ1($mal_id)
    {       
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        return view('docente.calificacion.cursos.materias.consultar-calificacion-prom-q1', compact('malla','calificaciones'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones de la materia seleccionada de un curso determinado del primer parcial (Q2) para consulta por parte del tutor de curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarCalPromP1Q2($mal_id)
    {       
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        return view('docente.calificacion.cursos.materias.consultar-calificacion-prom-p1q2', compact('malla','calificaciones'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones de la materia seleccionada de un curso determinado del segundo parcial (Q2) para consulta por parte del tutor de curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarCalPromP2Q2($mal_id)
    {       
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        return view('docente.calificacion.cursos.materias.consultar-calificacion-prom-p2q2', compact('malla','calificaciones'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones de la materia seleccionada de un curso determinado del segundo quimestre para consulta por parte del tutor de curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarCalPromQ2($mal_id)
    {       
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        return view('docente.calificacion.cursos.materias.consultar-calificacion-prom-q2', compact('malla','calificaciones'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones de la materia seleccionada de un curso determinado para consulta por parte del tutor de curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarCalPromAnual($mal_id)
    {       
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        return view('docente.calificacion.cursos.materias.consultar-calificacion-prom-anual', compact('malla','calificaciones'));
    }    

    /**
     * Muestra los alumnos y sus correspondientes calificaciones de la materia seleccionada de un curso determinado del primer parcial (Q1) para consulta por parte del tutor de curso actual.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarCalPromP1Q1CurActual($mal_id)
    {       
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        return view('docente.calificacion.curso-actual.materias.consultar-calificacion-prom-p1q1', compact('malla','calificaciones'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones de la materia seleccionada de un curso determinado del segundo parcial (Q1) para consulta por parte del tutor de curso actual.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarCalPromP2Q1CurActual($mal_id)
    {       
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        return view('docente.calificacion.curso-actual.materias.consultar-calificacion-prom-p2q1', compact('malla','calificaciones'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones de la materia seleccionada de un curso determinado del primer quimestre para consulta por parte del tutor de curso actual.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarCalPromQ1CurActual($mal_id)
    {       
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        return view('docente.calificacion.curso-actual.materias.consultar-calificacion-prom-q1', compact('malla','calificaciones'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones de la materia seleccionada de un curso determinado del primer parcial (Q2) para consulta por parte del tutor de curso actual.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarCalPromP1Q2CurActual($mal_id)
    {       
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        return view('docente.calificacion.curso-actual.materias.consultar-calificacion-prom-p1q2', compact('malla','calificaciones'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones de la materia seleccionada de un curso determinado del segundo parcial (Q2) para consulta por parte del tutor de curso actual.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarCalPromP2Q2CurActual($mal_id)
    {       
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        return view('docente.calificacion.curso-actual.materias.consultar-calificacion-prom-p2q2', compact('malla','calificaciones'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones de la materia seleccionada de un curso determinado del segundo quimestre para consulta por parte del tutor de curso actual.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarCalPromQ2CurActual($mal_id)
    {       
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        return view('docente.calificacion.curso-actual.materias.consultar-calificacion-prom-q2', compact('malla','calificaciones'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones de la materia seleccionada de un curso determinado para consulta por parte del tutor de curso actual.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarCalPromAnualCurActual($mal_id)
    {       
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        return view('docente.calificacion.curso-actual.materias.consultar-calificacion-prom-anual', compact('malla','calificaciones'));
    }    


    /**
     * Genera el reporte en PDF de las calificaciones de la materia seleccionada de un curso determinado del primer parcial (Q1).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFPromP1Q1(Request $request)
    {    
        $mal_id = $request->mal_id;   
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();
        
        $pdf = Pdf::loadView('docente.calificacion.asignaturas.reporte-pdf.pdfP1Q1', compact('malla','calificaciones'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_docente' => $request->input('nom_ape_docente')
        ]);
        return $pdf->download('reporte_calificaciones_P1Q1.pdf');
    }

    /**
     * Genera el reporte en PDF de las calificaciones de la materia seleccionada de un curso determinado del segundo parcial (Q1).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFPromP2Q1(Request $request)
    {    
        $mal_id = $request->mal_id;   
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        $pdf = Pdf::loadView('docente.calificacion.asignaturas.reporte-pdf.pdfP2Q1', compact('malla','calificaciones'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_docente' => $request->input('nom_ape_docente')
        ]);
        return $pdf->download('reporte_calificaciones_P2Q1.pdf');
    }

    /**
     * Genera el reporte en PDF de las calificaciones de la materia seleccionada de un curso determinado del Primer Quimestre.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFPromQ1(Request $request)
    {    
        $mal_id = $request->mal_id;   
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        $pdf = Pdf::loadView('docente.calificacion.asignaturas.reporte-pdf.pdfQ1', compact('malla','calificaciones'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_docente' => $request->input('nom_ape_docente')
        ]);
        return $pdf->download('reporte_calificaciones_Q1.pdf');
    }

    /**
     * Genera el reporte en PDF de las calificaciones de la materia seleccionada de un curso determinado del primer parcial (Q2).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFPromP1Q2(Request $request)
    {    
        $mal_id = $request->mal_id;   
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        $pdf = Pdf::loadView('docente.calificacion.asignaturas.reporte-pdf.pdfP1Q2', compact('malla','calificaciones'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_docente' => $request->input('nom_ape_docente')
        ]);
        return $pdf->download('reporte_calificaciones_P1Q2.pdf');
    }

    /**
     * Genera el reporte en PDF de las calificaciones de la materia seleccionada de un curso determinado del segundo parcial (Q2).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFPromP2Q2(Request $request)
    {    
        $mal_id = $request->mal_id;   
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        $pdf = Pdf::loadView('docente.calificacion.asignaturas.reporte-pdf.pdfP2Q2', compact('malla','calificaciones'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_docente' => $request->input('nom_ape_docente')
        ]);
        return $pdf->download('reporte_calificaciones_P2Q2.pdf');
    }

    /**
     * Genera el reporte en PDF de las calificaciones de la materia seleccionada de un curso determinado del Segundo Quimestre.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFPromQ2(Request $request)
    {    
        $mal_id = $request->mal_id;   
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        $pdf = Pdf::loadView('docente.calificacion.asignaturas.reporte-pdf.pdfQ2', compact('malla','calificaciones'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_docente' => $request->input('nom_ape_docente')
        ]);
        return $pdf->download('reporte_calificaciones_Q2.pdf');
    }

    /**
     * Genera el reporte en PDF de las calificaciones de la materia seleccionada de un curso determinado del Promedio Anual.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFPromAnual(Request $request)
    {    
        $mal_id = $request->mal_id;   
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        $pdf = Pdf::loadView('docente.calificacion.asignaturas.reporte-pdf.pdfAnual', compact('malla','calificaciones'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_docente' => $request->input('nom_ape_docente')
        ]);
        return $pdf->download('reporte_calificaciones_Anual.pdf');
    }

    /**
     * Genera el reporte en PDF de las calificaciones de la materia seleccionada de un curso determinado del Promedio Anual junto con las calificaciones de los examenes de recuperación.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFCalifAnual(Request $request)
    {    
        $mal_id = $request->mal_id;   
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        $pdf = Pdf::loadView('docente.calificacion.asignaturas.reporte-pdf.pdfCuadroAnual', compact('malla','calificaciones'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_docente' => $request->input('nom_ape_docente'),
            'abreviatura_rector' => $request->input('abreviatura_rector'),
            'nom_ape_rector' => $request->input('nom_ape_rector'),
        ]);
        return $pdf->download('reporte_calificaciones_cuadro_Anual.pdf');
    }

    /**
     * Genera el reporte en PDF de las calificaciones de la materia seleccionada de un curso determinado del primer parcial (Q1) - Tutor de Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFPromCalifP1Q1(Request $request)
    {    
        $mal_id = $request->mal_id;   
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();
        
        $pdf = Pdf::loadView('docente.calificacion.cursos.materias.reporte-pdf.pdfP1Q1', compact('malla','calificaciones'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_docente' => $request->input('nom_ape_docente')
        ]);
        return $pdf->download('reporte_calificaciones_P1Q1.pdf');
    }

    /**
     * Genera el reporte en PDF de las calificaciones de la materia seleccionada de un curso determinado del segundo parcial (Q1) - Tutor de Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFPromCalifP2Q1(Request $request)
    {    
        $mal_id = $request->mal_id;   
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        $pdf = Pdf::loadView('docente.calificacion.cursos.materias.reporte-pdf.pdfP2Q1', compact('malla','calificaciones'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_docente' => $request->input('nom_ape_docente')
        ]);
        return $pdf->download('reporte_calificaciones_P2Q1.pdf');
    }

    /**
     * Genera el reporte en PDF de las calificaciones de la materia seleccionada de un curso determinado del Primer Quimestre - Tutor de Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFPromCalifQ1(Request $request)
    {    
        $mal_id = $request->mal_id;   
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        $pdf = Pdf::loadView('docente.calificacion.cursos.materias.reporte-pdf.pdfQ1', compact('malla','calificaciones'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_docente' => $request->input('nom_ape_docente')
        ]);
        return $pdf->download('reporte_calificaciones_Q1.pdf');
    }

    /**
     * Genera el reporte en PDF de las calificaciones de la materia seleccionada de un curso determinado del primer parcial (Q2) - Tutor de Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFPromCalifP1Q2(Request $request)
    {    
        $mal_id = $request->mal_id;   
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        $pdf = Pdf::loadView('docente.calificacion.cursos.materias.reporte-pdf.pdfP1Q2', compact('malla','calificaciones'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_docente' => $request->input('nom_ape_docente')
        ]);
        return $pdf->download('reporte_calificaciones_P1Q2.pdf');
    }

    /**
     * Genera el reporte en PDF de las calificaciones de la materia seleccionada de un curso determinado del segundo parcial (Q2) - Tutor de Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFPromCalifP2Q2(Request $request)
    {    
        $mal_id = $request->mal_id;   
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        $pdf = Pdf::loadView('docente.calificacion.cursos.materias.reporte-pdf.pdfP2Q2', compact('malla','calificaciones'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_docente' => $request->input('nom_ape_docente')
        ]);
        return $pdf->download('reporte_calificaciones_P2Q2.pdf');
    }

    /**
     * Genera el reporte en PDF de las calificaciones de la materia seleccionada de un curso determinado del Segundo Quimestre - Tutor de Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFPromCalifQ2(Request $request)
    {    
        $mal_id = $request->mal_id;   
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        $pdf = Pdf::loadView('docente.calificacion.cursos.materias.reporte-pdf.pdfQ2', compact('malla','calificaciones'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_docente' => $request->input('nom_ape_docente')
        ]);
        return $pdf->download('reporte_calificaciones_Q2.pdf');
    }

    /**
     * Genera el reporte en PDF de las calificaciones de la materia seleccionada de un curso determinado del Promedio Anual - Tutor de Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFPromCalifAnual(Request $request)
    {    
        $mal_id = $request->mal_id;   
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        $pdf = Pdf::loadView('docente.calificacion.cursos.materias.reporte-pdf.pdfAnual', compact('malla','calificaciones'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_docente' => $request->input('nom_ape_docente')
        ]);
        return $pdf->download('reporte_calificaciones_Anual.pdf');
    }

    /**
     * Genera el reporte en PDF de las calificaciones de la materia seleccionada de un curso determinado del Promedio Anual junto con las calificaciones de los examenes de recuperación - Tutor de Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFCalifPromAnual(Request $request)
    {    
        $mal_id = $request->mal_id;   
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        $pdf = Pdf::loadView('docente.calificacion.cursos.materias.reporte-pdf.pdfCuadroAnual', compact('malla','calificaciones'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_docente' => $request->input('nom_ape_docente'),
            'abreviatura_rector' => $request->input('abreviatura_rector'),
            'nom_ape_rector' => $request->input('nom_ape_rector'),
        ]);
        return $pdf->download('reporte_calificaciones_cuadro_Anual.pdf');
    }

    /**
     * Genera el reporte en PDF de las calificaciones de la materia seleccionada del curso actual del primer parcial (Q1) - Tutor de Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFPromCalifP1Q1CurActual(Request $request)
    {    
        $mal_id = $request->mal_id;   
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();
        
        $pdf = Pdf::loadView('docente.calificacion.curso-actual.materias.reporte-pdf.pdfP1Q1', compact('malla','calificaciones'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_docente' => $request->input('nom_ape_docente')
        ]);
        return $pdf->download('reporte_calificaciones_P1Q1.pdf');
    }

    /**
     * Genera el reporte en PDF de las calificaciones de la materia seleccionada de un curso actual del segundo parcial (Q1) - Tutor de Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFPromCalifP2Q1CurActual(Request $request)
    {    
        $mal_id = $request->mal_id;   
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        $pdf = Pdf::loadView('docente.calificacion.curso-actual.materias.reporte-pdf.pdfP2Q1', compact('malla','calificaciones'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_docente' => $request->input('nom_ape_docente')
        ]);
        return $pdf->download('reporte_calificaciones_P2Q1.pdf');
    }

    /**
     * Genera el reporte en PDF de las calificaciones de la materia seleccionada de un curso actual del Primer Quimestre - Tutor de Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFPromCalifQ1CurActual(Request $request)
    {    
        $mal_id = $request->mal_id;   
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        $pdf = Pdf::loadView('docente.calificacion.curso-actual.materias.reporte-pdf.pdfQ1', compact('malla','calificaciones'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_docente' => $request->input('nom_ape_docente')
        ]);
        return $pdf->download('reporte_calificaciones_Q1.pdf');
    }

    /**
     * Genera el reporte en PDF de las calificaciones de la materia seleccionada de un curso actual del primer parcial (Q2) - Tutor de Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFPromCalifP1Q2CurActual(Request $request)
    {    
        $mal_id = $request->mal_id;   
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        $pdf = Pdf::loadView('docente.calificacion.curso-actual.materias.reporte-pdf.pdfP1Q2', compact('malla','calificaciones'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_docente' => $request->input('nom_ape_docente')
        ]);
        return $pdf->download('reporte_calificaciones_P1Q2.pdf');
    }

    /**
     * Genera el reporte en PDF de las calificaciones de la materia seleccionada de un curso actual del segundo parcial (Q2) - Tutor de Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFPromCalifP2Q2CurActual(Request $request)
    {    
        $mal_id = $request->mal_id;   
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        $pdf = Pdf::loadView('docente.calificacion.curso-actual.materias.reporte-pdf.pdfP2Q2', compact('malla','calificaciones'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_docente' => $request->input('nom_ape_docente')
        ]);
        return $pdf->download('reporte_calificaciones_P2Q2.pdf');
    }

    /**
     * Genera el reporte en PDF de las calificaciones de la materia seleccionada de un curso actual del Segundo Quimestre - Tutor de Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFPromCalifQ2CurActual(Request $request)
    {    
        $mal_id = $request->mal_id;   
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        $pdf = Pdf::loadView('docente.calificacion.curso-actual.materias.reporte-pdf.pdfQ2', compact('malla','calificaciones'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_docente' => $request->input('nom_ape_docente')
        ]);
        return $pdf->download('reporte_calificaciones_Q2.pdf');
    }

    /**
     * Genera el reporte en PDF de las calificaciones de la materia seleccionada de un curso actual del Promedio Anual - Tutor de Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFPromCalifAnualCurActual(Request $request)
    {    
        $mal_id = $request->mal_id;   
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        $pdf = Pdf::loadView('docente.calificacion.curso-actual.materias.reporte-pdf.pdfAnual', compact('malla','calificaciones'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_docente' => $request->input('nom_ape_docente')
        ]);
        return $pdf->download('reporte_calificaciones_Anual.pdf');
    }

    /**
     * Genera el reporte en PDF de las calificaciones de la materia seleccionada de un curso actual determinado del Promedio Anual junto con las calificaciones de los examenes de recuperación - Tutor de Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFCalifPromAnualCurActual(Request $request)
    {    
        $mal_id = $request->mal_id;   
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        $pdf = Pdf::loadView('docente.calificacion.curso-actual.materias.reporte-pdf.pdfCuadroAnual', compact('malla','calificaciones'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_docente' => $request->input('nom_ape_docente'),
            'abreviatura_rector' => $request->input('abreviatura_rector'),
            'nom_ape_rector' => $request->input('nom_ape_rector'),
        ]);
        return $pdf->download('reporte_calificaciones_cuadro_Anual.pdf');
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

        return view('docente.calificacion.cursos.listado', compact('ofertas','alumnos'));
    }

    /**
     * Muestra las calificaciones de las materias correspondientes de un curso seleccionado para consulta de un alumno escogido (Q1).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function verCalificacionQ1($mat_id)
    {       
        $matricula = Matricula::query()->findOrFail($mat_id);
        $calificaciones = Calificacion::whereHas('matricula', function($q) use($mat_id) {
            $q->where('mat_id', $mat_id);
        })->get();

        $comportamientos = Comportamiento::whereHas('matricula', function($q) use($mat_id) {
            $q->where('mat_id', $mat_id);
        })->get();

        $proyescolares = ProyEscolar::whereHas('matricula', function($q) use($mat_id) {
            $q->where('mat_id', $mat_id);
        })->get();

        return view('docente.calificacion.cursos.listado.ver-calificacion-q1', compact('matricula','calificaciones','comportamientos','proyescolares'));
    }   

    /**
     * Muestra las calificaciones de las materias correspondientes de un curso seleccionado para consulta de un alumno escogido (Q2).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function verCalificacionQ2($mat_id)
    {       
        $matricula = Matricula::query()->findOrFail($mat_id);
        $calificaciones = Calificacion::whereHas('matricula', function($q) use($mat_id) {
            $q->where('mat_id', $mat_id);
        })->get();

        $comportamientos = Comportamiento::whereHas('matricula', function($q) use($mat_id) {
            $q->where('mat_id', $mat_id);
        })->get();

        $proyescolares = ProyEscolar::whereHas('matricula', function($q) use($mat_id) {
            $q->where('mat_id', $mat_id);
        })->get();

        return view('docente.calificacion.cursos.listado.ver-calificacion-q2', compact('matricula','calificaciones','comportamientos','proyescolares'));
    }   

    /**
     * Muestra las calificaciones de las materias correspondientes de un curso seleccionado para consulta de un alumno escogido (Promedio Anual).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function verCalificacionAnual($mat_id)
    {       
        $matricula = Matricula::query()->findOrFail($mat_id);
        $calificaciones = Calificacion::whereHas('matricula', function($q) use($mat_id) {
            $q->where('mat_id', $mat_id);
        })->get();

        $comportamientos = Comportamiento::whereHas('matricula', function($q) use($mat_id) {
            $q->where('mat_id', $mat_id);
        })->get();

        $proyescolares = ProyEscolar::whereHas('matricula', function($q) use($mat_id) {
            $q->where('mat_id', $mat_id);
        })->get();

        return view('docente.calificacion.cursos.listado.ver-calificacion-anual', compact('matricula','calificaciones','comportamientos','proyescolares'));
    }   

    /**
     * Genera el certificado del primer quimestre en PDF de las calificaciones de un alumno seleccionado de un curso determinado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFPromQ1Certificado(Request $request, $mat_id)
    {       
        $matricula = Matricula::query()->findOrFail($mat_id);
        
        $calificaciones = Calificacion::whereHas('matricula', function($q) use($mat_id) {
            $q->where('mat_id', $mat_id);
        })->get();

        $comportamientos = Comportamiento::whereHas('matricula', function($q) use($mat_id) {
            $q->where('mat_id', $mat_id);
        })->get();

        $proyescolares = ProyEscolar::whereHas('matricula', function($q) use($mat_id) {
            $q->where('mat_id', $mat_id);
        })->get();


        $pdf = Pdf::loadView('docente.calificacion.cursos.listado.ver-calificacion-q1.certificados-pdf.pdfCertCalificacionQ1', compact('matricula','calificaciones','comportamientos','proyescolares'), [
            'periodo' => $request->input('periodo'),
            'curso_seccion' => $request->input('curso_seccion'),
            'suma_q1' => $request->input('suma_q1'),
            'promedio_q1' => $request->input('promedio_q1'),
            'escala_prom_q1' => $request->input('escala_prom_q1'),
            'recomendaciones' => $request->input('recomendaciones'),
            'fecha_emision' => $request->input('fecha_emision'),
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor' => $request->input('nom_ape_tutor'),
            'abreviatura_rector' => $request->input('abreviatura_rector'),
            'nom_ape_rector' => $request->input('nom_ape_rector'),
        ]);
        return $pdf->download('certificado_calificaciones_Q1.pdf');
    }

    /**
     * Genera el certificado del segundo quimestre en PDF de las calificaciones de un alumno seleccionado de un curso determinado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFPromQ2Certificado(Request $request, $mat_id)
    {       
        $matricula = Matricula::query()->findOrFail($mat_id);
        
        $calificaciones = Calificacion::whereHas('matricula', function($q) use($mat_id) {
            $q->where('mat_id', $mat_id);
        })->get();

        $comportamientos = Comportamiento::whereHas('matricula', function($q) use($mat_id) {
            $q->where('mat_id', $mat_id);
        })->get();

        $proyescolares = ProyEscolar::whereHas('matricula', function($q) use($mat_id) {
            $q->where('mat_id', $mat_id);
        })->get();

        $pdf = Pdf::loadView('docente.calificacion.cursos.listado.ver-calificacion-q2.certificados-pdf.pdfCertCalificacionQ2', compact('matricula','calificaciones','comportamientos','proyescolares'), [
            'periodo' => $request->input('periodo'),
            'curso_seccion' => $request->input('curso_seccion'),
            'suma_q2' => $request->input('suma_q2'),
            'promedio_q2' => $request->input('promedio_q2'),
            'escala_prom_q2' => $request->input('escala_prom_q2'),
            'recomendaciones' => $request->input('recomendaciones'),
            'fecha_emision' => $request->input('fecha_emision'),
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor' => $request->input('nom_ape_tutor'),
            'abreviatura_rector' => $request->input('abreviatura_rector'),
            'nom_ape_rector' => $request->input('nom_ape_rector'),
        ]);
        return $pdf->download('certificado_calificaciones_Q2.pdf');
    }

    /**
     * Genera el certificado anual en PDF de las calificaciones de un alumno seleccionado de un curso determinado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function generarPDFPromAnualCertificado(Request $request, $mat_id)
    {       
        $matricula = Matricula::query()->findOrFail($mat_id);
        
        $calificaciones = Calificacion::whereHas('matricula', function($q) use($mat_id) {
            $q->where('mat_id', $mat_id);
        })->get();

        $comportamientos = Comportamiento::whereHas('matricula', function($q) use($mat_id) {
            $q->where('mat_id', $mat_id);
        })->get();

        $pdf = Pdf::loadView('docente.calificacion.cursos.listado.ver-calificacion-anual.certificados-pdf.pdfCertCalifAnual', compact('matricula','calificaciones','comportamientos'), [
            'periodo' => $request->input('periodo'),
            'curso' => $request->input('curso'),
            'promedio_anual' => $request->input('promedio_anual'),
            'escala_prom_anual' => $request->input('escala_prom_anual'),
            'observacion' => $request->input('observacion'),
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor' => $request->input('nom_ape_tutor'),
            'abreviatura_rector' => $request->input('abreviatura_rector'),
            'nom_ape_rector' => $request->input('nom_ape_rector'),
        ]);
        return $pdf->download('certificado_calificaciones_Anual.pdf');
    }
}
