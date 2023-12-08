<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Curso;
use App\Models\Oferta;
use App\Models\Personal;
use App\Models\Malla;
use App\Models\Asignatura;

class MallaController extends Controller
{
    /**
     * Muestra la lista de cursos disponibles.
     *
     * @return \Illuminate\Http\Response
    */

    public function index()
    {
        $ofertas = Oferta::query()->paginate(10);
        return view('administrador.malla.index', ['ofertas' => $ofertas]);
    }

    /**
     * Muestra la forma para crear la asignacion.
     *
     * @return \Illuminate\Http\Response
    */

    public function create()
    {
        $ofertas = Oferta::all();
        $asignaturas = Asignatura::all();
        $personales = Personal::all();
        return view('administrador.malla.create', compact('ofertas', 'asignaturas', 'personales'));
    }
    
    /**
     * Guarda la asignación realizada a un docente a su asignatura correspondida.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */

    public function store(Request $request)
    {
        $request->validate([
            'ofer_id' => 'required',
            'asig_id' => 'required',
            'pers_id' => 'required',      
            'mal_estado' => 'required'    
        ]);    

        $form_data = array(           
            'ofer_id' => $request->ofer_id,
            'asig_id'  => $request->asig_id,   
            'pers_id' =>  $request->pers_id,
            'mal_estado' => $request->mal_estado
        );   

        $insertar = Malla::create($form_data);

        if($insertar){
            $notificacion=array(
                'message' => 'Asignación Registrada.',
                'alert-type' => 'success'
            );
            return redirect('administrador/malla/index')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Asignacion no registrada. Verifique que este correctamente seleccionado los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }    
    }

    /**
     * Sirve para encontrar el dato que busca por el numero de cedula o solo los nombres o solo los apellidos de un docente para crear una asignacion a un docente 
     * que se encarga de dirigir la materia asignada.
     *
     * @return \Illuminate\Http\Response
    */

    public function searchcedula(Request $request)
    {
        $ofertas = Oferta::all();
        $asignaturas = Asignatura::all();
        $docentes = Personal::where('pers_ncedula', $request->input('pers_ncedula'))->orWhere('pers_nombres', 'like', '%' . $request->input('pers_ncedula'). '%')->orWhere('pers_apellidos', 'like', '%' . $request->input('pers_ncedula') . '%')->get();

        if (empty($docentes)) {
            $notificacion=array(
                'message' => 'Docente no encontrado. Intente de nuevo con otro dato.',
                'alert-type' => 'error'
            );        
            return back()->with($notificacion);
        } 

        return view('administrador.malla.asignar', compact('ofertas','asignaturas','docentes'));
    }

    /**
     * Muestra el formulario para asignar una asignatura a un docente por medio de la busqueda del numero de cedula o por nombres o por apellidos del docente.
     *
     * @return \Illuminate\Http\Response
    */

    public function asignar()
    {
        $ofertas = Oferta::all();
        $asignaturas = Asignatura::all();       
        $docentes = Personal::all();
        return view('administrador.malla.asignar', compact('ofertas', 'asignaturas','docentes'));
    }

    /**
     * Muestra la tabla de asignaciones de asignaturas registradas de un curso seleccionado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function asignacion($ofer_id)
    {       
        $oferta = Oferta::query()->findOrFail($ofer_id);
        $mallas = Malla::whereHas('personal', function($q) use($ofer_id) {
            $q->where('ofer_id', $ofer_id);
        })->get();

        return view('administrador.malla.asignacion', compact('mallas','oferta'));
    }

    /**
     * Muestra la forma para editar la asignación.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function edit($mal_id)
    {
        return view('administrador.malla.edit', [
            'malla' => Malla::query()->findOrFail($mal_id),        
            'asignaturas' => Asignatura::query()->get(),
            'personales' => Personal::query()->get(),
            'ofertas' => Oferta::query()->get()             
        ]);  
    }

    /**
     * Actualiza la asignación seleccionada de un docente asignado a su propia asignatura.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function update(Request $request)
    {
        $mal_id = $request->mal_id;
        
        $request->validate([
            'ofer_id' => 'required',
            'asig_id' => 'required',
            'pers_id' => 'required',      
            'mal_estado' => 'required'        
        ]);
                  
        $form_data = array(
            'ofer_id' => $request->ofer_id,
            'asig_id'  => $request->asig_id,   
            'pers_id' =>  $request->pers_id,
            'mal_estado' => $request->mal_estado
        );
                    
        $actualizar = Malla::query()->whereKey($mal_id)->update($form_data);
        
        if($actualizar){
            $notificacion=array(
                'message' => 'Asignación Actualizado. Los datos de esta asignación han sido actualizados correctamente.',
                'alert-type' => 'success'
            );
            return back()->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Asignación no Actualizada. Verifique que este correctamente seleccionado los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }
    }

    /**
     * Actualiza la asignación seleccionada de un docente asignado a su propia asignatura por medio de la busqueda por el numero de cedula o por nombres o por apellidos del docente buscado.
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function updateform(Request $request)
    {
        $mal_id = $request->mal_id;
        
        $request->validate([
            'ofer_id' => 'required',
            'asig_id' => 'required',
            'pers_id' => 'required',      
            'mal_estado' => 'required'          
        ]);
                  
        $form_data = array(
            'ofer_id' => $request->ofer_id,
            'asig_id'  => $request->asig_id,   
            'pers_id' =>  $request->pers_id,
            'mal_estado' => $request->mal_estado
        );
                    
        $actualizar = Malla::query()->whereKey($mal_id)->update($form_data);

        if($actualizar){
            $notificacion=array(
                'message' => 'Asignación Actualizado. Los datos de esta asignación han sido actualizados correctamente.',
                'alert-type' => 'success'
            );
            return redirect('administrador/malla/index')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Asignación no Actualizada. Verifique que este correctamente seleccionado los datos.',
                'alert-type' => 'error'
            );
            return redirect('administrador/malla/index')->with($notificacion);
        }
    }

    /**
     * Sirve para encontrar el dato que busca por el numero de cedula o solo los nombres o solo los apellidos de un docente 
     * para editar una asignacion asignada al mismo.
     *
     *
     * @return \Illuminate\Http\Response
    */

    public function searchdocente(Request $request)
    {
        $mal_id = $request->mal_id;
        $malla = Malla::query()->findOrFail($mal_id);
        $ofertas = Oferta::all();
        $asignaturas = Asignatura::all();
        $docentes = Personal::where('pers_ncedula', $request->input('pers_ncedula'))->orWhere('pers_nombres', 'like', '%' . $request->input('pers_ncedula'). '%')->orWhere('pers_apellidos', 'like', '%' . $request->input('pers_ncedula') . '%')->get();
    
        if (empty($docentes)) {
            $notificacion=array(
                'message' => 'Docente no encontrado. Intente de nuevo con otro dato.',
                'alert-type' => 'error'
            );        
            return back()->with($notificacion);
        } 

        return view('administrador.malla.editform', compact('malla','asignaturas','ofertas','docentes'));
    }

    /**
     * Muestra el formulario para editar una asignacion a un docente asignado a una materia por medio de la busqueda del numero de cedula o por nombres o por apellidos del docente.
     *
     * @return \Illuminate\Http\Response
    */

    public function editform($mal_id)
    {
        return view('administrador.malla.editform', [
            'malla' => Malla::query()->findOrFail($mal_id),
            'ofertas' => Oferta::all(),
            'asignaturas' => Asignatura::all(),
            'docentes' => Personal::all()                  
        ]); 
    }

    /**
     * Eliminación de la asignación asignada a un docente seleccionado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function destroy(Request $request)
    {
        $malla = Malla::findOrFail($request->mal_id);
        $malla->delete();

        if($malla){
            $notificacion=array(
                'message' => 'Asignación Eliminada',
                'alert-type' => 'success'
            );
            return back()->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Asignacion no Eliminada',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }      
    }
    
    /**
     * Busca la asignaturas asignadas a los docentes.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function search(Request $request) 
    {
        return view('administrador.malla.index', [
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
