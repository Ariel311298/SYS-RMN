<?php

namespace App\Http\Controllers\Secretario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Oferta;
use App\Models\Matricula;
use App\Models\Comportamiento;
use Barryvdh\DomPDF\Facade\Pdf;

class ListComporController extends Controller
{
    /**
     * Muestra la lista de cursos disponibles.
     *
     * @return \Illuminate\Http\Response
    */

    public function index()
    {
        $ofertas = Oferta::query()->paginate(10);
        return view('secretario.comportamiento.index', ['ofertas' => $ofertas]); 
    }

    /**
     * Muestra la tabla de alumnos y el tutor de curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function asignar(Request $request, $ofer_id)
    {       
        $estudiantes = Oferta::query()->findOrFail($ofer_id)->matriculas;
        $ofertas = Oferta::query()->findOrFail($ofer_id);
                
        return view('secretario.comportamiento.asignar', compact('estudiantes','ofertas'));
    }

    /**
     * Guarda la asignaciones realizadas de estudiantes de un curso a lista de calificaciones del comportamiento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */

    public function store(Request $request)
    {
        $request->validate([
            'ofer_id' => 'required',
            'mat_id' => 'required',
            'cond_estado' => 'required'  		
        ]);  
             
        $data=$request->all();
           
        if(count($request->mat_id) > 0){
            foreach($request->mat_id as $item=>$v){
                $data=array(
                    'ofer_id'=>$request->ofer_id[$item],
                    'mat_id'=>$request->mat_id[$item],
                    'cond_estado' => $request->cond_estado[$item]
                );
            }
        }  

        $asignar = Comportamiento::query()->firstOrCreate($data);

        if($asignar){
            $notificacion=array(
                'message' => 'Los estudiantes de ese curso han sido registrados en la lista de calificaciones del comportamiento.',
                'alert-type' => 'success'
            );
            return redirect('secretario/comportamiento/index')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Se registro los estudiantes nuevos a la lista de calificaciones del comportamiento de este curso.',
                'alert-type' => 'error'
            );
            return redirect('secretario/comportamiento/index')->with($notificacion);
        }             
    }

    /**
     * Muestra la tabla de control de asignaciones del curso seleccionado de la lista de calificaciones del comportamiento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function controlasignacion($ofer_id)
    {       
        $oferta = Oferta::query()->findOrFail($ofer_id);
        $comportamientos = Comportamiento::whereHas('oferta', function($q) use($ofer_id) {
            $q->where('ofer_id', $ofer_id);
        })->get();

        return view('secretario.comportamiento.controlasignacion', compact('oferta','comportamientos'));
    }

    /**
     * Muestra la forma para editar asignacion de un alumno asignado a la lista de calificaciones de comportamiento. 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function edit($cond_id)
    {
        return view('secretario.comportamiento.controlasignacion.edit', [
            'comportamiento' => Comportamiento::query()->findOrFail($cond_id),            
            'ofertas' => Oferta::query()->get(),  
            'matriculas' => Matricula::query()->get()       
        ]);    
    }

    /**
     * Muestra la forma para reemplazar asignacion de un alumno asignado a la lista de calificaciones del comportamiento. 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function reemplazar($cond_id)
    {
        return view('secretario.comportamiento.controlasignacion.reemplazar', [
            'comportamiento' => Comportamiento::query()->findOrFail($cond_id),  
            'ofertas' => Oferta::query()->get(),
            'matriculas' => Matricula::query()->get()       
        ]);    
    }

    /**
     * Actualiza la asignación de un estudiante de la lista de calificaciones del comportamiento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function update(Request $request)
    {
        $cond_id = $request->cond_id;
        
        $request->validate([                 
            'ofer_id' => 'required',
            'mat_id' => 'required',
            'cond_estado' => 'required'      
        ]);   

        $form_data = array(                   
            'ofer_id' => $request->ofer_id,
            'mat_id' => $request->mat_id,
            'cond_estado' => $request->cond_estado
        );   

        $actualizar = Comportamiento::query()->whereKey($cond_id)->update($form_data);

        if($actualizar){
            $notificacion=array(
                'message' => 'Asignación Actualizada. Los datos de esta asignación correspondiente a este estudiante han sido actualizados.',
                'alert-type' => 'success'
            );
            return back()->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Asignación no actualizada. Los datos de esta asignación correspondiente a este estudiante no han sido actualizados.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }    
    }

    /**
     * Eliminación de la asignación de un alumno de la lista de calificaciones de comportamiento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function destroy(Request $request)
    {
        $comportamiento = Comportamiento::findOrFail($request->cond_id);
        $comportamiento->delete();
        if($comportamiento){
            $notificacion=array(
                'message' => 'El estudiante seleccionado ha sido eliminado de la lista de calificaciones del comportamiento de este curso.',
                'alert-type' => 'success'
            );
            return back()->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'El estudiante seleccionado no ha sido eliminado de la lista de calificaciones del comportamiento de este curso.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }  
    }

    /**
     * Muestra la lista de cursos disponibles para consultar o generar reportes de calificaciones del comportamiento.
     *
     * @return \Illuminate\Http\Response
    */

    public function cursos()
    {
        $ofertas = Oferta::query()->paginate(10);
        return view('secretario.comportamiento.cursos', ['ofertas' => $ofertas]); 
    }

     /**
     * Muestra los alumnos y sus correspondientes calificaciones del comportamiento de un curso determinado del primer quimestre para el rol de secretario.
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

        return view('secretario.comportamiento.cursos.consultar-comportamiento-prom-q1', compact('oferta','comportamientos'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones del comportamiento de un curso determinado del segundo quimestre para el rol de secretario.
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

        return view('secretario.comportamiento.cursos.consultar-comportamiento-prom-q2', compact('oferta','comportamientos'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones del comportamiento de un curso para el rol de secretario.
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

        return view('secretario.comportamiento.cursos.consultar-comportamiento-prom-anual', compact('oferta','comportamientos'));
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

        $pdf = Pdf::loadView('secretario.comportamiento.cursos.reporte-pdf.pdfCompQ1', compact('oferta','comportamientos'), [
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

        $pdf = Pdf::loadView('secretario.comportamiento.cursos.reporte-pdf.pdfCompQ2', compact('oferta','comportamientos'), [
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

        $pdf = Pdf::loadView('secretario.comportamiento.cursos.reporte-pdf.pdfCompAnual', compact('oferta','comportamientos'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor_curso' => $request->input('nom_ape_tutor_curso'),
            'abreviatura_rector' => $request->input('abreviatura_rector'),
            'nom_ape_rector' => $request->input('nom_ape_rector')
        ]);
        return $pdf->download('reporte_promedio_comportamientos_Anual.pdf');
    }

    /**
     * Busca el curso (Asignacion a la lista de comportamiento).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function search(Request $request) 
    {
        return view('secretario.comportamiento.index', [
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
     * Busca el curso (Consulta de calificaciones de comportamiento).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function searchcurso(Request $request) 
    {
        return view('secretario.comportamiento.cursos', [
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
