<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Oferta;
use App\Models\Personal;
use App\Models\Curso;
use App\Models\Periodo;

class OfertaController extends Controller
{
    /**
     * Muestra la lista de las ofertas registradas.
     *
     * @return \Illuminate\Http\Response
    */

    public function index()
    {
        $ofertas = Oferta::query()->paginate(10);
        return view('administrador.oferta.index', ['ofertas' => $ofertas]);
    }

    /**
     * Muestra el formulario para crear ofertas.
     *
     * @return \Illuminate\Http\Response
    */

    public function create()
    {
        $cursos = Curso::all();
        $periodos = Periodo::all();
        $docentes = Personal::all();
        return view('administrador.oferta.create', compact('cursos', 'periodos', 'docentes'));
    }

    /**
     * Muestra el formulario para buscar el personal por cedula para crear oferta.
     *
     * @return \Illuminate\Http\Response
    */

    public function searchncedula()
    {
        $cursos = Curso::all();
        $periodos = Periodo::all();
        $docentes = Personal::all();
        return view('administrador.oferta.searchncedula', compact('cursos', 'periodos', 'docentes'));
    }

    /**
     * Sirve para encontrar el dato que busca por el numero de cedula de un docente.
     *
     * @return \Illuminate\Http\Response
    */

    public function searchcedula(Request $request)
    {    
        $cursos = Curso::all();
        $periodos = Periodo::all();
        $docentes = Personal::where('pers_ncedula', $request->input('pers_ncedula'))->orWhere('pers_nombres', $request->input('pers_ncedula'))->orWhere('pers_apellidos', $request->input('pers_ncedula'))->get();
        if (empty($docentes)) {
            $notificacion=array(
                'message' => 'Docente no encontrado. Intente de nuevo con otro dato.',
                'alert-type' => 'error'
            );        
            return back()->with($notificacion);
        } 
    
        return view('administrador.oferta.create', compact('cursos','periodos','docentes'));
    }

    /**
     * Guarda la oferta creada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */

    public function store(Request $request)
    {
        $request->validate([
            'per_id' => 'required',
            'cur_id' => 'required',
            'pers_id' => 'required',      
            'ofer_estado' => 'required'    
        ]);    

        $form_data = array(           
            'per_id' => $request->per_id,
            'cur_id'  => $request->cur_id,   
            'pers_id' =>  $request->pers_id,
            'ofer_estado' => $request->ofer_estado
        );   

        $insertar = Oferta::create($form_data);

        if($insertar){
            $notificacion=array(
                'message' => 'Oferta Registrada. El docente seleccionado a sido asignado a su curso.',
                'alert-type' => 'success'
            );
            return redirect('administrador/oferta/index')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Oferta no registrada. Verifique que este correctamente seleccionado los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }    
    }

    /**
     * Muestra la forma para editar la oferta seleccionada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function edit($ofer_id)
    {
        return view('administrador.oferta.edit', [
            'oferta' => Oferta::query()->findOrFail($ofer_id),            
            'periodos' => Periodo::query()->get(),
            'cursos' => Curso::query()->get(),
            'personales' => Personal::query()->get()       
        ]); 
    }

    /**
     * Actualiza la oferta seleccionada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function update(Request $request)
    {
        $ofer_id = $request->ofer_id;
        
        $request->validate([                 
            'per_id' => 'required',
            'cur_id' => 'required',
            'pers_id' => 'required',      
            'ofer_estado' => 'required'    
        ]);   

        $form_data = array(                   
            'per_id' => $request->per_id,
            'cur_id'  => $request->cur_id,   
            'pers_id' =>  $request->pers_id,
            'ofer_estado' => $request->ofer_estado
        );   

        $actualizar = Oferta::query()->whereKey($ofer_id)->update($form_data);

        if($actualizar){
            $notificacion=array(
                'message' => 'Oferta Actualizada. Los datos de la oferta seleccionada han sido actualizadas.',
                'alert-type' => 'success'
            );
            return redirect('administrador/oferta/index')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Oferta no Actualizada. Verifique que este correctamente seleccionado los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }       
    }

    /**
     * Elmina una oferta seleccionada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function destroy(Request $request)
    {
        $oferta = Oferta::findOrFail($request->ofer_id);
        $oferta->delete();
        if($oferta){
            $notificacion=array(
                'message' => 'Oferta Eliminada',
                'alert-type' => 'success'
            );
            return back()->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Oferta no Eliminada',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }       
    }

    /**
     * Busca la oferta.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function search(Request $request) 
    {
        return view('administrador.oferta.index', [
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
