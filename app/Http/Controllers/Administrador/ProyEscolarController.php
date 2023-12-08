<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\TutorProyecto;
use App\Models\Matricula;
use App\Models\Oferta;
use App\Models\ProyEscolar;
use Barryvdh\DomPDF\Facade\Pdf;

class ProyEscolarController extends Controller
{
    /**
     * Muestra la lista de cursos disponibles.
     *
     * @return \Illuminate\Http\Response
    */

    public function index()
    {
        $ofertas = Oferta::query()->paginate(10);
        return view('administrador.proyectoescolar.index', ['ofertas' => $ofertas]); 
    }

    /**
     * Muestra la tabla de alumnos y el tutor de curso de proyectos escolares.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function asignar(Request $request, $ofer_id)
    {       
        $oferta = Oferta::query()->findOrFail($ofer_id);
        $estudiantes = Oferta::query()->findOrFail($ofer_id)->matriculas;
        $tutoresproyectos = Oferta::query()->findOrFail($ofer_id)->tutorproyectos;
                
        return view('administrador.proyectoescolar.asignar', compact('oferta','estudiantes','tutoresproyectos'));
    }

    /**
     * Guarda la asignaciones realizadas de estudiantes de un curso a lista de calificaciones del proyecto escolar.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */

    public function store(Request $request)
    {
        $request->validate([
            'tutproy_id' => 'required',
            'mat_id' => 'required',
            'proy_estado' => 'required'  		
        ]);  
             
        $data=$request->all();
           
        if(count($request->mat_id) > 0){
            foreach($request->mat_id as $item=>$v){
                $data=array(
                    'tutproy_id'=>$request->tutproy_id[$item],
                    'mat_id'=>$request->mat_id[$item],
                    'proy_estado' => $request->proy_estado[$item]
                );           
            }
        }  

        $asignar = ProyEscolar::query()->firstOrCreate($data);

        if($asignar){
            $notificacion=array(
                'message' => 'Los estudiantes de ese curso han sido registrados en la lista de calificaciones del proyecto escolar.',
                'alert-type' => 'success'
            );
            return redirect('administrador/proyectoescolar/index')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Se registro los estudiantes nuevos a la lista de calificaciones del proyecto escolar de este curso.',
                'alert-type' => 'error'
            );
            return redirect('administrador/proyectoescolar/index')->with($notificacion);
        }             
    }

    /**
     * Muestra la tabla del tutor de proyecto registrado del curso seleccionado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function seleccionlista($ofer_id)
    {       
        $oferta = Oferta::query()->findOrFail($ofer_id);
        $tutorproyectos = TutorProyecto::whereHas('oferta', function($q) use($ofer_id) {
            $q->where('ofer_id', $ofer_id);
        })->get();

        return view('administrador.proyectoescolar.seleccionlista', compact('tutorproyectos','oferta'));
    }

    /**
     * Muestra la tabla de control de asignaciones del curso seleccionado de la lista de calificaciones del proyecto escolar.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function controlasignacion($tutproy_id)
    {       
        $tutorproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        return view('administrador.proyectoescolar.seleccionlista.controlasignacion', compact('tutorproyecto','proyescolares'));
    }

    /**
     * Muestra la forma para editar asignacion de un alumno asignado a la lista de calificaciones de proyectos escolares. 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function edit($proy_id)
    {
        return view('administrador.proyectoescolar.seleccionlista.controlasignacion.edit', [
            'proyescolar' => ProyEscolar::query()->findOrFail($proy_id),            
            'tutorproyectos' => TutorProyecto::query()->get(),  
            'matriculas' => Matricula::query()->get()       
        ]);    
    }

    /**
     * Muestra la forma para reemplazar asignacion de un alumno asignado a la lista de calificaciones del comportamiento. 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function reemplazar($proy_id)
    {
        return view('administrador.proyectoescolar.seleccionlista.controlasignacion.reemplazar', [
            'proyescolar' => ProyEscolar::query()->findOrFail($proy_id),            
            'tutorproyectos' => TutorProyecto::query()->get(),  
            'matriculas' => Matricula::query()->get()       
        ]);    
    }

    /**
     * Actualiza la asignación de un estudiante de la lista de calificaciones del proyecto escolar.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function update(Request $request)
    {
        $proy_id = $request->proy_id;
        
        $request->validate([                 
            'tutproy_id' => 'required',
            'mat_id' => 'required',
            'proy_estado' => 'required' 
        ]);   

        $form_data = array(                   
            'tutproy_id' => $request->tutproy_id,
            'mat_id'  => $request->mat_id,
            'proy_estado'  => $request->proy_estado
        );   

        $actualizar = ProyEscolar::query()->whereKey($proy_id)->update($form_data);
  
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
     * Muestra los alumnos y sus correspondientes calificaciones del proyecto escolar de un curso determinado del primer quimestre.
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

        return view('administrador.proyectoescolar.seleccionlista.consultar-calificacion-proyecto-escolar-prom-q1', compact('tutorproyecto','proyescolares'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones del proyecto escolar de un curso determinado del segundo quimestre.
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

        return view('administrador.proyectoescolar.seleccionlista.consultar-calificacion-proyecto-escolar-prom-q2', compact('tutorproyecto','proyescolares'));
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

        return view('administrador.proyectoescolar.seleccionlista.consultar-calificacion-proyecto-escolar-prom', compact('tutorproyecto','proyescolares'));
    }

    /**
     * Eliminación de la asignación de un alumno de la lista de calificaciones de tutor de proyectos escolares.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function destroy(Request $request)
    {
        $proyescolar = ProyEscolar::findOrFail($request->proy_id);
        $proyescolar->delete();

        if($proyescolar){
            $notificacion=array(
                'message' => 'El estudiante seleccionado ha sido eliminado de la lista de calificaciones del proyecto escolar de este curso.',
                'alert-type' => 'success'
            );
            return back()->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'El estudiante seleccionado no ha sido eliminado de la lista de calificaciones del proyecto escolar de este curso.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }  
    }

    /**
     * Muestra la lista de cursos disponibles registrados para ver las calificaciones de proyectos escolares de cada curso. 
     *
     * @return \Illuminate\Http\Response
    */

    public function cursos()
    {
        $tutorproyectos = TutorProyecto::all();
        return view('administrador.proyectoescolar.cursos', ['tutorproyectos' => $tutorproyectos]);   
    }

    
    /**
     * Muestra los alumnos y sus correspondientes calificaciones del proyecto escolar de un curso determinado del primer quimestre para el rol de administrador.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consulPromProyEscQ1($tutproy_id)
    {       
        $tutorproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        return view('administrador.proyectoescolar.cursos.consultar-calificacion-proyecto-escolar-prom-q1', compact('tutorproyecto','proyescolares'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones del proyecto escolar de un curso determinado del segundo quimestre para el rol de administrador.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consulPromProyEscQ2($tutproy_id)
    {       
        $tutorproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        return view('administrador.proyectoescolar.cursos.consultar-calificacion-proyecto-escolar-prom-q2', compact('tutorproyecto','proyescolares'));
    }

    /**
     * Muestra los alumnos y sus correspondientes calificaciones del proyecto escolar de un curso determinado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function consulPromProyEsc($tutproy_id)
    {       
        $tutorproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $proyescolares = ProyEscolar::whereHas('tutorproyecto', function($q) use($tutproy_id) {
            $q->where('tutproy_id', $tutproy_id);
        })->get();

        return view('administrador.proyectoescolar.cursos.consultar-calificacion-proyecto-escolar-prom', compact('tutorproyecto','proyescolares'));
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

        $pdf = Pdf::loadView('administrador.proyectoescolar.cursos.reporte-pdf.pdfProyEscolarP1Q1', compact('tutorproyecto','proyescolares'), [
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

        $pdf = Pdf::loadView('administrador.proyectoescolar.cursos.reporte-pdf.pdfProyEscolarP2Q1', compact('tutorproyecto','proyescolares'), [
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

        $pdf = Pdf::loadView('administrador.proyectoescolar.cursos.reporte-pdf.pdfProyEscolarQ1', compact('tutorproyecto','proyescolares'), [
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

        $pdf = Pdf::loadView('administrador.proyectoescolar.cursos.reporte-pdf.pdfProyEscolarP1Q2', compact('tutorproyecto','proyescolares'), [
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

        $pdf = Pdf::loadView('administrador.proyectoescolar.cursos.reporte-pdf.pdfProyEscolarP2Q2', compact('tutorproyecto','proyescolares'), [
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

        $pdf = Pdf::loadView('administrador.proyectoescolar.cursos.reporte-pdf.pdfProyEscolarQ2', compact('tutorproyecto','proyescolares'), [
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

        $pdf = Pdf::loadView('administrador.proyectoescolar.cursos.reporte-pdf.pdfProyEscolarAnual', compact('tutorproyecto','proyescolares'), [
            'abreviatura' => $request->input('abreviatura'),
            'nom_ape_tutor_proy' => $request->input('nom_ape_tutor_proy'),
            'abreviatura_rector' => $request->input('abreviatura_rector'),
            'nom_ape_rector' => $request->input('nom_ape_rector')
        ]);
        return $pdf->download('reporte_calificacion_proy_escolar_Anual.pdf');
    }

    /**
     * Busca el curso (Asignacion a la lista de calificaciones de proyectos escolares).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function search(Request $request) 
    {
        return view('administrador.proyectoescolar.index', [
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
