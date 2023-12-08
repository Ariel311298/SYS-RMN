<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Curso;
use App\Models\Asignatura;
use App\Models\Area;

class AsignaturaController extends Controller
{
    /**
     * Muestra la lista de las asignaturas registradas.
     *
     * @return \Illuminate\Http\Response
    */
    
    public function index()
    {
        $asignaturas = Asignatura::sortable()->paginate(10);
        return view('administrador.asignatura.index', ['asignaturas' => $asignaturas]); 
    }

    /**
     * Muestra el formulario para crear asignaturas.
     *
     * @return \Illuminate\Http\Response
    */

    public function create()
    {
        $cursos = Curso::all();
        $areas = Area::all();
        return view('administrador.asignatura.create', compact('cursos', 'areas'));
    }

    /**
     * Guarda la asignatura creada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'area_id' => 'required',
            'cur_id' => 'required',
            'asig_nom' => 'required|max:150|min:5|regex:/^[\pL\s\-]+$/u',      
            'asig_estado' => 'required'    
        ]);    

        $form_data = array(           
            'area_id' => $request->area_id,
            'cur_id'  => $request->cur_id,   
            'asig_nom' =>  $request->asig_nom,
            'asig_estado' => $request->asig_estado
        );   

        $insertar = Asignatura::create($form_data);

        if($insertar){
            $notificacion=array(
                'message' => 'Asignatura Registrada',
                'alert-type' => 'success'
            );
            return redirect('administrador/asignatura/index')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Asignatura no Registrada. Verifique que este correctamente ingresado los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }         
    }

    /**
     * Muestra la forma para editar la asignatura seleccionada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function edit($asig_id)
    {
        return view('administrador.asignatura.edit', [
            'asignatura' => Asignatura::query()->findOrFail($asig_id),            
            'curso' => Curso::query()->get(),
            'area' => Area::query()->get()    
        ]); 
    }

    /**
     * Actualiza la asignatura seleccionada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function update(Request $request)
    {
        $asig_id = $request->asig_id;
        
        $request->validate([                 
            'area_id' => 'required',
            'cur_id' => 'required',
            'asig_nom' => 'required|max:150|min:5|regex:/^[\pL\s\-]+$/u',
            'asig_estado' => 'required'   
        ]);   

        $form_data = array(                   
            'area_id' => $request->area_id,
            'cur_id'  => $request->cur_id,   
            'asig_nom' =>  $request->asig_nom,
            'asig_estado' => $request->asig_estado
        );   

        $actualizar = Asignatura::query()->whereKey($asig_id)->update($form_data);

        if($actualizar){
            $notificacion=array(
                'message' => 'Asignatura Actualizada',
                'alert-type' => 'success'
            );
            return redirect('administrador/asignatura/index')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Asignatura no Actualizada. Verifique que este correctamente ingresado los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }   
    }

    /**
     * Elmina una asignatura seleccionada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function destroy(Request $request)
    {
        $asignatura = Asignatura::findOrFail($request->asig_id);
        $asignatura->delete();

        if($asignatura){
            $notificacion=array(
                'message' => 'Asignatura Eliminada',
                'alert-type' => 'success'
            );
            return back()->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Asignatura no Eliminada',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }   
    }

    /**
     * Busca la asignatura.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function search(Request $request) 
    {
        return view('administrador.asignatura.index', [
            'asignaturas' => Asignatura::join('area', 'asignatura.area_id', '=', 'area.area_id')
                ->join('curso', 'asignatura.cur_id', '=', 'curso.cur_id')    
                ->where('area.area_nombre', 'like', '%' . $request->buscar . '%')
                ->orWhere('curso.cur_nombre', 'like', '%' . $request->buscar  . '%')
                ->orWhere('curso.cur_paralelo', 'like', '%' . $request->buscar  . '%')
                ->orWhere(DB::raw("CONCAT(curso.cur_nombre, ' ', curso.cur_paralelo)"), 'LIKE', "%" . $request->buscar . "%")
                ->orWhere('asignatura.asig_nom', 'like', '%' . $request->buscar  . '%')
                ->orWhere('asignatura.asig_estado', 'like', '%' . $request->buscar  . '%')
                ->select('*')
                ->paginate(10),
        ]);
    }
}
