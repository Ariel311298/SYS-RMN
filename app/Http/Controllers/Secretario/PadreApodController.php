<?php

namespace App\Http\Controllers\Secretario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Alumno;
use App\Models\PadreApoderado;

class PadreApodController extends Controller
{
    /**
     * Muestra la lista de los padres o representantes registrados.
     *
     * @return \Illuminate\Http\Response
    */

    public function index()
    {
        $padresapoderados = PadreApoderado::query()->paginate(10);
        return view('secretario.padreapoderado.index', ['padresapoderados' => $padresapoderados]);   
    }

    /**
     * Muestra el formulario para registrar los padres de familia o representante.
     *
     * @return \Illuminate\Http\Response
    */

    public function create()
    {
        $alumnos = Alumno::all();
        return view('secretario.padreapoderado.create', compact('alumnos'));
    }

    /**
     * Guarda los datos personales de los padres de familia o representante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */

    public function store(Request $request)
    {
        $request->validate([
            'alum_id' => 'required',
            'pad_ncedula' => 'required|unique:padre_apoderado|numeric|digits_between:9,10',
            'pad_npasaporte' => 'nullable|unique:padre_apoderado|numeric|digits_between:9,10',
            'pad_nombres' => 'required|regex:/^[\pL\s\-]+$/u|max:50|min:5',
            'pad_apellidos' => 'required|regex:/^[\pL\s\-]+$/u|max:50|min:5',   
            'pad_nacionalidad' => 'required|max:15|min:5', 
            'pad_email' => 'nullable|max:255|min:5',
            'pad_ocupacion' => 'required|regex:/^[\pL\s\-]+$/u|max:50|min:5',
            'pad_nivel' => 'nullable|max:15|min:5',
            'pad_direccion' => 'required|max:255|min:5',
            'pad_telf_celular' => 'nullable|digits_between:9,10',
            'pad_telf_convencional' => 'nullable|digits_between:8,9',
            'pad_fec_nac' => 'required|before:today',
            'pad_parentesco' => 'required|max:15|min:3',
            'pad_estado' => 'required'        
        ]);    

        $form_data = array(           
            'alum_id' => $request->alum_id,
            'pad_ncedula'  => $request->pad_ncedula,   
            'pad_npasaporte' =>  $request->pad_npasaporte,
            'pad_nombres'  => $request->pad_nombres,   
            'pad_apellidos' =>  $request->pad_apellidos,
            'pad_nacionalidad'  => $request->pad_nacionalidad,   
            'pad_email' =>  $request->pad_email,
            'pad_ocupacion'  => $request->pad_ocupacion,   
            'pad_nivel' =>  $request->pad_nivel,
            'pad_direccion'  => $request->pad_direccion,   
            'pad_telf_celular' =>  $request->pad_telf_celular,
            'pad_telf_convencional' =>  $request->pad_telf_convencional,
            'pad_fec_nac' =>  $request->pad_fec_nac,
            'pad_parentesco' =>  $request->pad_parentesco,
            'pad_estado' => $request->pad_estado
        );   

        $insertar = PadreApoderado::create($form_data);
        
        if($insertar){
            $notificacion=array(
                'message' => 'Datos Personales del Padre/Madre/Apoderado Registrado',
                'alert-type' => 'success'
            );
            return redirect('secretario/padreapoderado/index')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Datos no registrados. Verifique que este correctamente ingresado los datos.',
                'alert-type' => 'error'
            );
            return redirect('secretario/padreapoderado/index')->with($notificacion);
        }    
    }

    /**
     * Muestra los datos personales de la persona seleccionada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function show($pad_id)
    {
        $padreapoderado = PadreApoderado::query()->findOrFail($pad_id);
        return view('secretario.padreapoderado.show', compact('padreapoderado')); 
    }

    /**
     * Muestra la vista para editar los datos personales del padre, madre o representante seleccionado. 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function edit($pad_id)
    {
        return view('secretario.padreapoderado.edit', [
            'padreapoderado' => PadreApoderado::query()->findOrFail($pad_id),            
            'alumno' => Alumno::query()->get()       
        ]); 
    }

    /**
     * Actualizar los datos personales del padre, madre o representante seleccionado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function update(Request $request)
    {
        $pad_id = $request->pad_id;
        
        $request->validate([                 
            'alum_id' => 'required',
            'pad_ncedula' => 'required|numeric|digits_between:9,10',
            'pad_npasaporte' => 'nullable|numeric|digits_between:9,10',
            'pad_nombres' => 'required|regex:/^[\pL\s\-]+$/u|max:50|min:5',
            'pad_apellidos' => 'required|regex:/^[\pL\s\-]+$/u|max:50|min:5',   
            'pad_nacionalidad' => 'required|max:15|min:5', 
            'pad_email' => 'nullable|max:255|min:5',
            'pad_ocupacion' => 'required|regex:/^[\pL\s\-]+$/u|max:50|min:5',
            'pad_nivel' => 'nullable|max:15|min:5',
            'pad_direccion' => 'required|max:255|min:5',
            'pad_telf_celular' => 'nullable|digits_between:9,10',
            'pad_telf_convencional' => 'nullable|digits_between:8,9',
            'pad_fec_nac' => 'required|before:today',
            'pad_parentesco' => 'required|max:15|min:3',
            'pad_estado' => 'required'        
        ]);   

        $form_data = array(                   
            'alum_id' => $request->alum_id,
            'pad_ncedula'  => $request->pad_ncedula,   
            'pad_npasaporte' =>  $request->pad_npasaporte,
            'pad_nombres'  => $request->pad_nombres,   
            'pad_apellidos' =>  $request->pad_apellidos,
            'pad_nacionalidad'  => $request->pad_nacionalidad,   
            'pad_email' =>  $request->pad_email,
            'pad_ocupacion'  => $request->pad_ocupacion,   
            'pad_nivel' =>  $request->pad_nivel,
            'pad_direccion'  => $request->pad_direccion,   
            'pad_telf_celular' =>  $request->pad_telf_celular,
            'pad_telf_convencional' =>  $request->pad_telf_convencional,
            'pad_fec_nac' =>  $request->pad_fec_nac,
            'pad_parentesco' =>  $request->pad_parentesco,
            'pad_estado' => $request->pad_estado
        );   

        $actualizar = PadreApoderado::query()->whereKey($pad_id)->update($form_data);

        if($actualizar){
            $notificacion=array(
                'message' => 'Los datos de este registro seleccionado han sido actualizados correctamente.',
                'alert-type' => 'success'
            );
            return redirect('secretario/padreapoderado/index')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Datos no actualizados. Verifique que este correctamente ingresado los datos personales del registro seleccionado.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }    
    }

    /**
     * Elimina los datos personales de un padre, madre o representante seleccionado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function destroy(Request $request)
    {
        $padreapoderado = PadreApoderado::findOrFail($request->pad_id);
        $padreapoderado->delete();
        if($padreapoderado){
            $notificacion=array(
                'message' => 'Registro Eliminado',
                'alert-type' => 'success'
            );
            return back()->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Registro no Eliminado',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }                    
    }

    /**
     * Muestra el formulario para buscar el personal por cedula para crear un padre, madre o representante.
     *
     * @return \Illuminate\Http\Response
    */

    public function searchncedulaalumno()
    {
        return view('secretario.padreapoderado.searchncedulaalumno');
    }

    /**
     * Sirve para encontrar los datos personales que busca por el número de cedula o nombres o apellidos de un alumno.
     *
     * @return \Illuminate\Http\Response
    */

    public function searchcedulaalumno(Request $request)
    {
        $padresapoderados = PadreApoderado::all();
        $alumno = Alumno::where('alum_ncedula', 'like', '%' . $request->input('alum_ncedula'). '%')->orWhere('alum_nombres', 'like', '%' . $request->input('alum_ncedula'). '%')->orWhere('alum_apellidos', 'like', '%' . $request->input('alum_ncedula') . '%')->get();

        if (empty($alumno)) {
            $notificacion=array(
                'message' => 'Alumno no encontrado. Intente de nuevo con otro dato.',
                'alert-type' => 'error'
            );        
            return back()->with($notificacion);
        } 

        return view('secretario.padreapoderado.create', compact('padresapoderados','alumno'));
    }

    /**
     * Sirve para encontrar el dato que busca por el número de cedula de un alumno o por
     * solo los nombres o por solo los apellidos para editar en caso de modificar datos personales
     * de un padre o madre o apoderado.
     *
     * @return \Illuminate\Http\Response
    */

    public function searchcedulaalumnoedit(Request $request)
    {
        $pad_id = $request->pad_id;
        $padreapoderado = PadreApoderado::query()->findOrFail($pad_id);
        $alumno = Alumno::where('alum_ncedula', $request->input('alum_ncedula'))->orWhere('alum_nombres', 'like', '%' . $request->input('alum_ncedula'). '%')->orWhere('alum_apellidos', 'like', '%' . $request->input('alum_ncedula') . '%')->get();
        
        if (empty($alumno)) {
            $notificacion=array(
                'message' => 'Alumno no encontrado. Intente de nuevo con otro dato.',
                'alert-type' => 'error'
            );        
            return back()->with($notificacion);
        } 

        return view('secretario.padreapoderado.modify', compact('padreapoderado','alumno'));
    }

    /**
     * Muestra el formulario para editar los datos personales del padre, madre o representante por medio de la busqueda del numero de cedula del alumno.
     *
     * @return \Illuminate\Http\Response
    */

    public function modify($pad_id)
    {
        return view('secretario.padreapoderado.modify', [
            'padreapoderado' => PadreApoderado::query()->findOrFail($pad_id)                
        ]); 
    }

    /**
     * Busca los datos de cualquier padre de familia.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function search(Request $request) 
    {
        return view('secretario.padreapoderado.index', [
            'padresapoderados' => PadreApoderado::join('alumno', 'padre_apoderado.alum_id', '=', 'alumno.alum_id')    
                ->where('padre_apoderado.pad_nombres', 'like', '%' . $request->buscar . '%')
                ->orWhere('padre_apoderado.pad_apellidos', 'like', '%' . $request->buscar  . '%')
                ->orWhere(DB::raw("CONCAT(padre_apoderado.pad_nombres, ' ', padre_apoderado.pad_apellidos)"), 'LIKE', "%" . $request->buscar . "%")
                ->orWhere('padre_apoderado.pad_parentesco', 'like', '%' . $request->buscar  . '%')
                ->orWhere('alumno.alum_nombres', 'like', '%' . $request->buscar  . '%')
                ->orWhere('alumno.alum_apellidos', 'like', '%' . $request->buscar  . '%')
                ->orWhere(DB::raw("CONCAT(alumno.alum_nombres, ' ', alumno.alum_apellidos)"), 'LIKE', "%" . $request->buscar . "%")
                ->orWhere('padre_apoderado.pad_estado', 'like', '%' . $request->buscar  . '%')
                ->select('*')
                ->paginate(10),
        ]);
    }
}
