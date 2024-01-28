<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Calificacion;
use App\Models\Oferta;
use App\Models\Malla;
use App\Models\Matricula;
use App\Models\Alumno;
use App\Models\ProyEscolar;
use App\Models\Comportamiento;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReporteP1Q1DataExport;
use App\Exports\ReporteP2Q1DataExport;
use App\Exports\ReporteQ1DataExport;
use App\Exports\ReporteP1Q2DataExport;
use App\Exports\ReporteP2Q2DataExport;
use App\Exports\ReporteQ2DataExport;
use App\Exports\ReportePromAnualDataExport;

class CalificacionController extends Controller
{
    /**
     * Muestra la lista de cursos disponibles.
     *
     * @return \Illuminate\Http\Response
    */

    public function index()
    {
        $ofertas = Oferta::query()->paginate(10);
        return view('administrador.calificacion.index', ['ofertas' => $ofertas]);        
    }

    /**
     * Muestra la lista de cursos disponibles para consultar calificaciones.
     *
     * @return \Illuminate\Http\Response
    */

    public function cursos()
    {
        $ofertas = Oferta::query()->paginate(10);
        return view('administrador.calificacion.cursos', ['ofertas' => $ofertas]);        
    }

    /**
     * Muestra la tabla de alumnos y las asignaturas.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function asignar(Request $request, $ofer_id)
    {       
        $oferta = Oferta::query()->findOrFail($ofer_id);        
        $estudiantes = Oferta::query()->findOrFail($ofer_id)->matriculas;
        $materias = Oferta::query()->findOrFail($ofer_id)->mallas;
                
        return view('administrador.calificacion.asignar', compact('oferta','estudiantes','materias'));
    }

    /**
     * Guarda la asignaciones realizadas de estudiantes de un curso a lista de calificaciones de la materia asignada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    
    public function store(Request $request)
    {
        $request->validate([
            'mal_id' => 'required',
            'mat_id' => 'required',
            'cal_estado' => 'required'  		
        ]);  
             
        $data=$request->all();
           
        if(count($request->mat_id) > 0){
            foreach($request->mat_id as $item=>$v){
                $data=array(
                    'mal_id'=>$request->mal_id[$item],
                    'mat_id'=>$request->mat_id[$item],
                    'cal_estado' => $request->cal_estado[$item]
                );
            }
        }  

        $insertar = Calificacion::query()->firstOrCreate($data);

        if($insertar){
            $notificacion=array(
                'message' => 'Los estudiantes de este curso han sido registrado correctamente en la lista de calificaciones de esta asignatura.',
                'alert-type' => 'success'
            );
            return redirect('administrador/calificacion/index')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Se registro los estudiantes nuevos a la lista de calificaciones de esta asignatura.',
                'alert-type' => 'error'
            );
            return redirect('administrador/calificacion/index')->with($notificacion);
        }         
    }

    /**
     * Muestra la tabla de asignaturas registradas del curso seleccionado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function asignaturas($ofer_id)
    {       
        $oferta = Oferta::query()->findOrFail($ofer_id);
        $mallas = Malla::whereHas('asignatura', function($q) use($ofer_id) {
            $q->where('ofer_id', $ofer_id);
        })->get();

        return view('administrador.calificacion.asignaturas', compact('mallas','oferta'));
    }

    /**
     * Muestra la tabla de control de asignaciones de la materia seleccionada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function controlasignacion($mal_id)
    {       
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        return view('administrador.calificacion.asignaturas.controlasignacion', compact('malla','calificaciones'));
    }

    /**
     * Muestra la forma para editar asignacion de un alumno asignado a una asignatura. 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function edit($cal_id)
    {
        return view('administrador.calificacion.asignaturas.controlasignacion.edit', [
            'calificacion' => Calificacion::query()->findOrFail($cal_id),           
            'mallas' => Malla::query()->get(),  
            'matriculas' => Matricula::query()->get()       
        ]);    
    }

    /**
     * Muestra la forma para reemplazar asignacion de un alumno asignado a una asignatura. 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function reemplazar($cal_id)
    {
        return view('administrador.calificacion.asignaturas.controlasignacion.reemplazar', [
            'calificacion' => Calificacion::query()->findOrFail($cal_id),           
            'mallas' => Malla::query()->get(),  
            'matriculas' => Matricula::query()->get()       
        ]);    
    }

    /**
     * Actualizar las asignaciones realizadas a un estudiante en una asignatura de un curso correspondiente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function update(Request $request)
    {
        $cal_id = $request->cal_id;
        
        $request->validate([                 
            'mal_id' => 'required',
            'mat_id' => 'required',   
            'cal_estado' => 'required'  
        ]);   

        $form_data = array(                   
            'mal_id' => $request->mal_id,
            'mat_id' => $request->mat_id,
            'cal_estado' => $request->cal_estado
        );   

        $editar = Calificacion::query()->whereKey($cal_id)->update($form_data);

        if($editar){
            $notificacion=array(
                'message' => 'El alumno seleccionado ha sido cambiado de asignatura exitosamente.',
                'alert-type' => 'success'
            );
            return back()->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'No se pudo cambiar la asignatura a este estudiante.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }     
    }

    /**
     * Eliminación de la asignación de un alumno de la materia asignada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function destroy(Request $request)
    {
        $calificacion = Calificacion::findOrFail($request->cal_id);
        $calificacion->delete();

        if($calificacion){
            $notificacion=array(
                'message' => 'El estudiante seleccionado ha sido eliminado de la lista de calificaciones de esta asignatura.',
                'alert-type' => 'success'
            );
            return back()->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'El estudiante seleccionado no ha sido eliminado de la lista de calificaciones de esta asignatura.',
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

    public function consultarPromP1Q1($mal_id)
    {       
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        return view('administrador.calificacion.asignaturas.consultar-calificacion-prom-p1q1', compact('malla','calificaciones'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones de la materia seleccionada de un curso determinado del segundo parcial (Q1).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarPromP2Q1($mal_id)
    {       
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        return view('administrador.calificacion.asignaturas.consultar-calificacion-prom-p2q1', compact('malla','calificaciones'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones de la materia seleccionada de un curso determinado del primer quimestre.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarPromQ1($mal_id)
    {       
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        return view('administrador.calificacion.asignaturas.consultar-calificacion-prom-q1', compact('malla','calificaciones'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones de la materia seleccionada de un curso determinado del primer parcial (Q2).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarPromP1Q2($mal_id)
    {       
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        return view('administrador.calificacion.asignaturas.consultar-calificacion-prom-p1q2', compact('malla','calificaciones'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones de la materia seleccionada de un curso determinado del segundo parcial (Q2).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarPromP2Q2($mal_id)
    {       
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        return view('administrador.calificacion.asignaturas.consultar-calificacion-prom-p2q2', compact('malla','calificaciones'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones de la materia seleccionada de un curso determinado del segundo quimestre.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarPromQ2($mal_id)
    {       
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        return view('administrador.calificacion.asignaturas.consultar-calificacion-prom-q2', compact('malla','calificaciones'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones de la materia seleccionada de un curso determinado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consultarPromAnual($mal_id)
    {       
        $malla = Malla::query()->findOrFail($mal_id);
        $calificaciones = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();

        return view('administrador.calificacion.asignaturas.consultar-calificacion-prom-anual', compact('malla','calificaciones'));
    }

    /**
     * Muestra la tabla de asignaturas registradas del curso seleccionado.
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

        return view('administrador.calificacion.cursos.materias', compact('mallas','oferta'));
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

        return view('administrador.calificacion.cursos.materias.consultar-calificacion-prom-p1q1', compact('malla','calificaciones'));
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

        return view('administrador.calificacion.cursos.materias.consultar-calificacion-prom-p2q1', compact('malla','calificaciones'));
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

        return view('administrador.calificacion.cursos.materias.consultar-calificacion-prom-q1', compact('malla','calificaciones'));
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

        return view('administrador.calificacion.cursos.materias.consultar-calificacion-prom-p1q2', compact('malla','calificaciones'));
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

        return view('administrador.calificacion.cursos.materias.consultar-calificacion-prom-p2q2', compact('malla','calificaciones'));
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

        return view('administrador.calificacion.cursos.materias.consultar-calificacion-prom-q2', compact('malla','calificaciones'));
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

        return view('administrador.calificacion.cursos.materias.consultar-calificacion-prom-anual', compact('malla','calificaciones'));
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
        
        $pdf = Pdf::loadView('administrador.calificacion.cursos.materias.reporte-pdf.pdfP1Q1', compact('malla','calificaciones'), [
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

        $pdf = Pdf::loadView('administrador.calificacion.cursos.materias.reporte-pdf.pdfP2Q1', compact('malla','calificaciones'), [
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

        $pdf = Pdf::loadView('administrador.calificacion.cursos.materias.reporte-pdf.pdfQ1', compact('malla','calificaciones'), [
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

        $pdf = Pdf::loadView('administrador.calificacion.cursos.materias.reporte-pdf.pdfP1Q2', compact('malla','calificaciones'), [
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

        $pdf = Pdf::loadView('administrador.calificacion.cursos.materias.reporte-pdf.pdfP2Q2', compact('malla','calificaciones'), [
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

        $pdf = Pdf::loadView('administrador.calificacion.cursos.materias.reporte-pdf.pdfQ2', compact('malla','calificaciones'), [
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

        $pdf = Pdf::loadView('administrador.calificacion.cursos.materias.reporte-pdf.pdfAnual', compact('malla','calificaciones'), [
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

        $pdf = Pdf::loadView('administrador.calificacion.cursos.materias.reporte-pdf.pdfCuadroAnual', compact('malla','calificaciones'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_docente' => $request->input('nom_ape_docente'),
            'abreviatura_rector' => $request->input('abreviatura_rector'),
            'nom_ape_rector' => $request->input('nom_ape_rector'),
        ]);
        return $pdf->download('reporte_calificaciones_cuadro_Anual.pdf');
    }

    /**
     * Genera el reporte en Excel de las calificaciones de la materia seleccionada de un curso determinado del primer parcial (Q1).
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function exportReportCalifP1Q1Excel(Request $request){
        $mal_id = $request->mal_id;           
        $malla_p1q1 = Malla::query()->findOrFail($mal_id);
        $calificaciones_p1q1 = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();
        return Excel::download(new ReporteP1Q1DataExport($calificaciones_p1q1, $malla_p1q1), "reporte_calificaciones_P1Q1.xlsx");
    }   

    /**
     * Genera el reporte en Excel de las calificaciones de la materia seleccionada de un curso determinado del segundo parcial (Q1).
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function exportReportCalifP2Q1Excel(Request $request){
        $mal_id = $request->mal_id;           
        $malla_p2q1 = Malla::query()->findOrFail($mal_id);
        $calificaciones_p2q1 = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();
        return Excel::download(new ReporteP2Q1DataExport($calificaciones_p2q1, $malla_p2q1), "reporte_calificaciones_P2Q1.xlsx");
    }   

    /**
     * Genera el reporte en Excel de las calificaciones de la materia seleccionada de un curso determinado del primer quimestre (Q1).
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function exportReportCalifQ1Excel(Request $request){
        $mal_id = $request->mal_id;           
        $malla_q1 = Malla::query()->findOrFail($mal_id);
        $calificaciones_q1 = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();
        return Excel::download(new ReporteQ1DataExport($calificaciones_q1, $malla_q1), "reporte_calificaciones_Q1.xlsx");
    }   

    /**
     * Genera el reporte en Excel de las calificaciones de la materia seleccionada de un curso determinado del primer parcial (Q2).
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function exportReportCalifP1Q2Excel(Request $request){
        $mal_id = $request->mal_id;           
        $malla_p1q2 = Malla::query()->findOrFail($mal_id);
        $calificaciones_p1q2 = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();
        return Excel::download(new ReporteP1Q2DataExport($calificaciones_p1q2, $malla_p1q2), "reporte_calificaciones_P1Q2.xlsx");
    }   

    /**
     * Genera el reporte en Excel de las calificaciones de la materia seleccionada de un curso determinado del segundo parcial (Q2).
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function exportReportCalifP2Q2Excel(Request $request){
        $mal_id = $request->mal_id;           
        $malla_p2q2 = Malla::query()->findOrFail($mal_id);
        $calificaciones_p2q2 = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();
        return Excel::download(new ReporteP2Q2DataExport($calificaciones_p2q2, $malla_p2q2), "reporte_calificaciones_P2Q2.xlsx");
    }   

    /**
     * Genera el reporte en Excel de las calificaciones de la materia seleccionada de un curso determinado del segundo quimestre (Q2).
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function exportReportCalifQ2Excel(Request $request){
        $mal_id = $request->mal_id;           
        $malla_q2 = Malla::query()->findOrFail($mal_id);
        $calificaciones_q2 = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();
        return Excel::download(new ReporteQ2DataExport($calificaciones_q2, $malla_q2), "reporte_calificaciones_Q2.xlsx");
    }   

    /**
     * Genera el reporte en Excel de las calificaciones de la materia seleccionada de un curso determinado del promedio anual.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function exportReportCalifAnualExcel(Request $request){
        $mal_id = $request->mal_id;           
        $malla_anual = Malla::query()->findOrFail($mal_id);
        $c_anual = Calificacion::whereHas('malla', function($q) use($mal_id) {
            $q->where('mal_id', $mal_id);
        })->get();
        return Excel::download(new ReportePromAnualDataExport($c_anual, $malla_anual), "rep_calif_prom_final.xlsx");
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

        return view('administrador.calificacion.cursos.listado', compact('ofertas','alumnos'));
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

        return view('administrador.calificacion.cursos.listado.ver-calificacion-q1', compact('matricula','calificaciones','comportamientos','proyescolares'));
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

        return view('administrador.calificacion.cursos.listado.ver-calificacion-q2', compact('matricula','calificaciones','comportamientos','proyescolares'));
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

        return view('administrador.calificacion.cursos.listado.ver-calificacion-anual', compact('matricula','calificaciones','comportamientos','proyescolares'));
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

        $pdf = Pdf::loadView('administrador.calificacion.cursos.listado.ver-calificacion-q1.certificados-pdf.pdfCertCalificacionQ1', compact('matricula','calificaciones','comportamientos','proyescolares'), [
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

        $pdf = Pdf::loadView('administrador.calificacion.cursos.listado.ver-calificacion-q2.certificados-pdf.pdfCertCalificacionQ2', compact('matricula','calificaciones','comportamientos','proyescolares'), [
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

        $pdf = Pdf::loadView('administrador.calificacion.cursos.listado.ver-calificacion-anual.certificados-pdf.pdfCertCalifAnual', compact('matricula','calificaciones','comportamientos'), [
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
     
    /**
     * Busca el curso (Asignacion a la lista de calificaciones).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function search(Request $request) 
    {
        return view('administrador.calificacion.index', [
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

    /**
     * Busca el curso (Consulta de calificaciones).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function searchcurso(Request $request) 
    {
        return view('administrador.calificacion.cursos', [
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