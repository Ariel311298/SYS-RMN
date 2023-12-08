<?php

namespace App\Http\Controllers\Administrador;

use App\Models\Periodo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PeriodoController extends Controller
{
    /**
     * Muestra los periodos registrados. 
     *
     * @return \Illuminate\Http\Response
    */

    public function index()
    {
        $periodo = Periodo::sortable()->paginate(10);
        return view('administrador.periodo.index', ['periodo' => $periodo]);
    }

    /**
     * Muestra el formulario para crear periodos.
     *
     * @return \Illuminate\Http\Response
    */
    
     public function create()
    {
        return view('administrador.periodo.create');
    }

    /**
     *  Crea el periodo. 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */

    public function store(Request $request)
    {
        $request->validate([
            'per_nombre' => 'required|max:25|min:5|regex:/^\d{4}\ - \d{4}$/',      
            'per_fec_inicio' => 'required|after:today', 
            'per_fec_fin' => 'required|after:today',
            'per_estado' => 'required'      
        ]);    

        $form_data = array(           
            'per_nombre' => $request->per_nombre,
            'per_fec_inicio'  => $request->per_fec_inicio,   
            'per_fec_fin' =>  $request->per_fec_fin, 
            'per_estado' => $request->per_estado  
        );   

        $insertar = Periodo::create($form_data);

        if($insertar){
            $notificacion=array(
                'message' => 'Periodo Registrado',
                'alert-type' => 'success'
            );
            return redirect('administrador/periodo/index')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Periodo no Registrado. Verifique que este correctamente ingresado los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }       
    }

    /**
     * Muestra la forma para editar el periodo seleccionado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    
    public function edit($per_id)
    {
        $periodo = Periodo::query()->findOrFail($per_id);
        return view('administrador.periodo.edit', compact('periodo')); 
    }

    /**
     * Actualiza los datos del periodo seleccionado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function update(Request $request)
    {
        $per_id = $request->per_id;
        
        $request->validate([                 
            'per_nombre' => 'required|max:25|min:5|regex:/^\d{4}\ - \d{4}$/',      
            'per_fec_inicio' => 'required|after:today', 
            'per_fec_fin' => 'required|after:today',
            'per_estado' => 'required' 
        ]);   

        $form_data = array(                   
            'per_nombre' => $request->per_nombre,
            'per_fec_inicio'  => $request->per_fec_inicio,   
            'per_fec_fin' =>  $request->per_fec_fin, 
            'per_estado' => $request->per_estado
        );   

        $actualizar = Periodo::query()->whereKey($per_id)->update($form_data);

        if($actualizar){
            $notificacion=array(
                'message' => 'Periodo Actualizado',
                'alert-type' => 'success'
            );
            return redirect('administrador/periodo/index')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Periodo no Actualizado. Verifique que este correctamente ingresado los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }
    }

    /**
     * Borrar los datos del periodo seleccionado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function destroy(Request $request)
    {
        $periodo = Periodo::findOrFail($request->per_id);
        $periodo->delete();

        if($periodo){
            $notificacion=array(
                'message' => 'Periodo Eliminado',
                'alert-type' => 'success'
            );
            return back()->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Periodo no Eliminado',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }       
    }

    /**
     * Busca el periodo.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function search(Request $request) 
    {
        return view('administrador.periodo.index', [
            'periodo' => Periodo::query()
                ->where('per_nombre', 'like', '%' . $request->buscar . '%')
                ->orWhere('per_estado', 'like', '%' . $request->buscar  . '%')
                ->select('*')
                ->paginate(10),
        ]);
    }
}
