<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Area;

class AreaController extends Controller
{
    /**
     * Muestra las areas registradas.
     *
     * @return \Illuminate\Http\Response
    */

    public function index()
    {
        $area = Area::sortable()->paginate(10);
        return view('administrador.area.index', ['area' => $area]);
    }

    /**
     * Muestra el formulario para crear areas.
     *
     * @return \Illuminate\Http\Response
    */

    public function create()
    {
        return view('administrador.area.create');
    }

    /**
     * Crea el area de conocimiento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */

    public function store(Request $request)
    {
        $request->validate([
            'area_nombre' => 'required|unique:area|max:100|min:5|regex:/^[\pL\s\-]+$/u',      
            'area_estado' => 'required'     
        ]);    

        $form_data = array(           
            'area_nombre' => $request->area_nombre, 
            'area_estado' => $request->area_estado  
        );   

        $insertar = Area::create($form_data);

        if($insertar){
            $notificacion=array(
                'message' => 'Area Registrada',
                'alert-type' => 'success'
            );
            return redirect('administrador/area/index')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Area no Registrada. Verifique que este correctamente ingresado los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }       
    }

    /**
     * Muestra la forma para editar el area seleccionada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function edit($area_id)
    {
        $area = Area::query()->findOrFail($area_id);
        return view('administrador.area.edit', compact('area'));
    }

    /**
     * Actualiza los datos del area seleccionada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function update(Request $request)
    {
        $area_id = $request->area_id;
        
        $request->validate([                 
            'area_nombre' => 'required|max:100|min:5|regex:/^[\pL\s\-]+$/u',
            'area_estado' => 'required'     
        ]);   

        $form_data = array(                   
            'area_nombre' => $request->area_nombre,
            'area_estado' => $request->area_estado 
        );   

        $actualizar = Area::query()->whereKey($area_id)->update($form_data);

        if($actualizar){
            $notificacion=array(
                'message' => 'Area Actualizada',
                'alert-type' => 'success'
            );
            return redirect('administrador/area/index')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Area no Actualizada. Verifique que este correctamente ingresado los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }
    }

    /**
     * Borrar los datos de la area seleccionada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function destroy(Request $request)
    {
        $area = Area::findOrFail($request->area_id);
        $area->delete();

        if($area){
            $notificacion=array(
                'message' => 'Area Eliminada',
                'alert-type' => 'success'
            );
            return back()->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Area no Eliminada',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }       
    }

    /**
     * Busca el area.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function search(Request $request) 
    {
        return view('administrador.area.index', [
            'area' => Area::query()
                ->where('area_nombre', 'like', '%' . $request->buscar . '%')
                ->orWhere('area_estado', 'like', '%' . $request->buscar  . '%')
                ->select('*')
                ->paginate(10),
        ]);
    }
}
