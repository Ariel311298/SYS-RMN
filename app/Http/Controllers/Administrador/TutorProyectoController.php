<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Personal;
use App\Models\Oferta;
use App\Models\TutorProyecto;

class TutorProyectoController extends Controller
{
    /**
     * Muestra la lista de tutores de proyectos escolares almacenadas en cada curso. 
     *
     * @return \Illuminate\Http\Response
    */

    public function index()
    {
        $tutorproyectos = TutorProyecto::all();
        return view('administrador.tutorproyecto.index', ['tutorproyectos' => $tutorproyectos]);   
    }

    /**
     * Muestra la forma para asignar un tutor de proyectos escolares a un curso.
     *
     * @return \Illuminate\Http\Response
    */

    public function create()
    {
        $ofertas = Oferta::all();
        $personales = Personal::all();
        return view('administrador.tutorproyecto.create', compact('ofertas', 'personales'));
    }

    /**
     * Sirve para encontrar el dato que busca por el numero de cedula 
     * o solo los nombres o solo los apellidos de un docente 
     * para crear una asignacion a un docente 
     * que se encarga de dirigir un curso como tutor de proyecto escolar.
     *
     * @return \Illuminate\Http\Response
    */

    public function searchcedula(Request $request)
    {
        $ofertas = Oferta::all();
        $docentes = Personal::where('pers_ncedula', $request->input('pers_ncedula'))->orWhere('pers_nombres', 'like', '%' . $request->input('pers_ncedula'). '%')->orWhere('pers_apellidos', 'like', '%' . $request->input('pers_ncedula') . '%')->get();

        if (empty($docentes)) {
            $notificacion=array(
                'message' => 'Docente no encontrado. Intente de nuevo con otro dato.',
                'alert-type' => 'error'
            );        
            return back()->with($notificacion);
        } 

        return view('administrador.tutorproyecto.asignar', compact('ofertas','docentes'));
    }

    /**
     * Muestra el formulario para asignar como tutor de proyectos escolares de un curso a un docente por medio de la busqueda del numero de cedula o por nombres o por apellidos del docente.
     *
     * @return \Illuminate\Http\Response
    */

    public function asignar()
    {
        $ofertas = Oferta::all();
        $docentes = Personal::all();
        return view('administrador.tutorproyecto.asignar', compact('ofertas','docentes'));
    }

    /**
     * Guarda la asignación realizada a un docente como tutor de proyectos escolares a un curso correspondiente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */

    public function store(Request $request)
    {
        $request->validate([
            'pers_id' => 'required',      
            'ofer_id' => 'required',
            'tutproy_estado' => 'required'    
        ]);    

        $form_data = array(        
            'pers_id' =>  $request->pers_id,   
            'ofer_id' => $request->ofer_id,
            'tutproy_estado' => $request->tutproy_estado
        );   

        $insertar = TutorProyecto::create($form_data);

        if($insertar){
            $notificacion=array(
                'message' => 'Tutor de Proyectos Escolares Registrado.',
                'alert-type' => 'success'
            );
            return redirect('administrador/tutorproyecto/index')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Tutor de Proyectos Escolares no registrado. Verifique que este correctamente seleccionado los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        } 
    }

    /**
     * Muestra los datos especficos del tutor de curso de proyectos escolares seleccionado.
     *
     * @param  int  $tutproy_id
     * @return \Illuminate\Http\Response
    */

    public function show($tutproy_id)
    {
        $tutorproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        return view('administrador.tutorproyecto.show', compact('tutorproyecto')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function edit($tutproy_id)
    {
        return view('administrador.tutorproyecto.edit', [
            'tutorproyecto' => TutorProyecto::query()->findOrFail($tutproy_id),        
            'personales' => Personal::query()->get(),
            'ofertas' => Oferta::query()->get()             
        ]);  
    }

    /**
     * Sirve para encontrar el dato que busca por el numero de cedula o solo los nombres o solo los apellidos de un docente 
     * para editar una asignacion del docente seleccionado como tutor de proyecto escolar de un curso correspondiente.
     *
     *
     * @return \Illuminate\Http\Response
    */

    public function searchdocente(Request $request)
    {    
        $tutproy_id = $request->tutproy_id;
        $tutorproyecto = TutorProyecto::query()->findOrFail($tutproy_id);
        $ofertas = Oferta::all();
        $docentes = Personal::where('pers_ncedula', $request->input('pers_ncedula'))->orWhere('pers_nombres', 'like', '%' . $request->input('pers_ncedula'). '%')->orWhere('pers_apellidos', 'like', '%' . $request->input('pers_ncedula') . '%')->get();
    
        if (empty($docentes)) {
            $notificacion=array(
                'message' => 'Docente no encontrado. Intente de nuevo con otro dato.',
                'alert-type' => 'error'
            );        
            return back()->with($notificacion);
        } 

        return view('administrador.tutorproyecto.editform', compact('tutorproyecto','ofertas','docentes'));
    }

    /**
     * Muestra el formulario para editar una asignacion a un docente encargado como tutor de proyecto escolar de un curso 
     * por medio de la busqueda del numero de cedula o por nombres o por apellidos del docente.
     *
     * @return \Illuminate\Http\Response
    */

    public function editform($tutproy_id)
    {
        return view('administrador.tutorproyecto.editform', [
            'tutorproyecto' => TutorProyecto::query()->findOrFail($tutproy_id),
            'ofertas' => Oferta::all(),
            'docentes' => Personal::all()             
        ]); 
    }

    /**
     * Actualiza la asignación seleccionada de un docente encargado de ser un tutor de proyectos escolares de un curso correspondiente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  tutproy_id
     * @return \Illuminate\Http\Response
    */

    public function update(Request $request)
    {
        $tutproy_id = $request->tutproy_id;
        
        $request->validate([
            'pers_id' => 'required',      
            'ofer_id' => 'required',
            'tutproy_estado' => 'required'     
        ]);
                  
        $form_data = array(
            'pers_id' =>  $request->pers_id,   
            'ofer_id' => $request->ofer_id,
            'tutproy_estado' => $request->tutproy_estado
        );
                    
        $actualizar = TutorProyecto::query()->whereKey($tutproy_id)->update($form_data);

        if($actualizar){
            $notificacion=array(
                'message' => 'Datos Actualizados. Los datos de este tutor de proyecto escolar han sido actualizados correctamente.',
                'alert-type' => 'success'
            );
            return redirect('administrador/tutorproyecto/index')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Datos no Actualizados. Verifique que este correctamente seleccionado los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }
    }

    /**
     * Eliminación de la asignación asignada a un tutor de proyectos escolares de un curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function destroy(Request $request)
    {
        $tutorproyecto = TutorProyecto::findOrFail($request->tutproy_id);
        $tutorproyecto->delete();

        if($tutorproyecto){
            $notificacion=array(
                'message' => 'Tutor de Proyectos Escolares Eliminado',
                'alert-type' => 'success'
            );
            return back()->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Tutor de Proyectos Escolares no Eliminada',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }   
    }
}
