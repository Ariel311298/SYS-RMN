<?php

namespace App\Http\Controllers\Secretario;

use Illuminate\Http\Request;
use App\Models\Personal;
use App\Models\Rol;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PersonController extends Controller
{
    /**
     * Mostrar el personal registrado. 
     *
     * @return \Illuminate\Http\Response
    */

    public function index()
    {        
        $personal = Personal::sortable()->paginate(10);
        return view('secretario.personal.index', ['personal' => $personal]);          
    }

    /**
     * Muestra la vista para crear la persona.
     *
     * @return \Illuminate\Http\Response
    */

    public function create()
    {
        return view('secretario.personal.create');
    }

    /**
     * Crea el personal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    
    public function store(Request $request)
    {
        $new_name = $request->hidden_image;  
        $pers_foto = $request->file('pers_foto');
        if($pers_foto != ''){
            $request->validate([
                'pers_ncedula' => 'required|unique:personal|numeric|digits_between:9,10',
                'pers_npasaporte' => 'nullable|unique:personal|numeric|digits_between:9,10',     
                'pers_nombres' => 'required|regex:/^[\pL\s\-]+$/u|max:50|min:3',
                'pers_apellidos' => 'required|regex:/^[\pL\s\-]+$/u|max:50|min:3',       
                'pers_fec_nac' => 'required|before:today',
                'pers_telf_convencional' => 'nullable|numeric|digits_between:8,9',  
                'pers_num_celular' => 'nullable|numeric|digits_between:9,10',
                'pers_barrio' => 'nullable|max:50|min:5',
                'pers_direccion' => 'required|max:255|min:5',
                'pers_nacionalidad' => 'required|max:15|min:5',
                'pers_genero' => 'required|max:10|min:5',
                'pers_etnia' => 'required|max:18|min:5',         
                'pers_email_inst' => 'nullable|unique:personal|max:255|min:5',
                'pers_tip_sangre' => 'nullable|max:5|min:3',
                'pers_dis_tipo' => 'nullable|max:20|min:5',
                'pers_dis_porcentaje' => 'nullable|numeric|digits_between:1,3',
                'pers_num_car_conadis' => 'nullable|unique:personal|numeric|digits_between:9,10',
                'pers_est_civil' => 'required|max:12|min:5', 
                'pers_nivel' => 'required|max:15|min:5',    
                'pers_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:255',
                'pers_estado' => 'required'      
            ]);   
            
        if($request->hasFile('pers_foto')){   
            $new_name = rand() . '.' . $pers_foto->getClientOriginalExtension();
            $pers_foto->move(public_path('uploads/saved/personal'),$new_name);
        }

        } else {
            $request->validate([
                'pers_ncedula' => 'required|unique:personal|numeric|digits_between:9,10',
                'pers_npasaporte' => 'nullable|unique:personal|numeric|digits_between:9,10',     
                'pers_nombres' => 'required|max:50|min:3|regex:/^[\pL\s\-]+$/u',
                'pers_apellidos' => 'required|max:50|min:3|regex:/^[\pL\s\-]+$/u',       
                'pers_fec_nac' => 'required|before:today',
                'pers_telf_convencional' => 'nullable|numeric|digits_between:8,9',  
                'pers_num_celular' => 'nullable|numeric|digits_between:9,10',
                'pers_barrio' => 'nullable|max:50|min:5',
                'pers_direccion' => 'required|max:255|min:5',
                'pers_nacionalidad' => 'required|max:15|min:5',
                'pers_genero' => 'required|max:10|min:5',
                'pers_etnia' => 'required|max:18|min:5',         
                'pers_email_inst' => 'nullable|unique:personal|max:255|min:5',
                'pers_tip_sangre' => 'nullable|max:5|min:3',
                'pers_dis_tipo' => 'nullable|max:20|min:5',
                'pers_dis_porcentaje' => 'nullable|numeric|digits_between:1,3',
                'pers_num_car_conadis' => 'nullable|numeric|digits_between:9,10|unique:personal',
                'pers_est_civil' => 'required|max:12|min:5', 
                'pers_nivel' => 'required|max:15|min:5',       
                'pers_estado' => 'required'  
            ]);
        }
        
        $form_data = array(
            'pers_ncedula' => $request->pers_ncedula,
            'pers_npasaporte' => $request->pers_npasaporte, 
            'pers_nombres' => $request->pers_nombres, 
            'pers_apellidos' => $request->pers_apellidos, 
            'pers_fec_nac' => $request->pers_fec_nac,
            'pers_telf_convencional' => $request->pers_telf_convencional,
            'pers_num_celular' => $request->pers_num_celular,
            'pers_barrio' => $request->pers_barrio,
            'pers_direccion' => $request->pers_direccion,
            'pers_nacionalidad' => $request->pers_nacionalidad,
            'pers_genero' => $request->pers_genero, 
            'pers_etnia' => $request->pers_etnia,
            'pers_genero' => $request->pers_genero,
            'pers_email_inst' => $request->pers_email_inst, 
            'pers_tip_sangre' => $request->pers_tip_sangre,
            'pers_dis_tipo' => $request->pers_dis_tipo,
            'pers_dis_porcentaje' => $request->pers_dis_porcentaje,
            'pers_num_car_conadis' => $request->pers_num_car_conadis,
            'pers_est_civil' => $request->pers_est_civil,
            'pers_nivel' => $request->pers_nivel,          
            'pers_foto' => $new_name,       
            'pers_estado' => $request->pers_estado  
        );
         
        $insertar = Personal::create($form_data);            
        
        if($insertar){
            $notificacion=array(
                'message' => 'Docente Registrado',
                'alert-type' => 'success'
            );
            return redirect('secretario/personal/index')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Docente no Registrado. Verifique que este correctamente ingresado los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        } 
    }

    /**
     * Muestra la vista para editar el personal. 
     *
     * @param  \App\Personal  $personal
     * @return \Illuminate\Http\Response
    */
    
    public function edit($pers_id)
    {
          $personal = Personal::query()->findOrFail($pers_id);
          return view('secretario.personal.edit', compact('personal'));        
    }

    /**
     * Actualizar los datos personales de la persona.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Personal  $personal
     * @return \Illuminate\Http\Response
    */
    
    public function update(Request $request)
    {
        $pers_id = $request->pers_id;
        $personal = Personal::find($pers_id);
        $image_name = $request->hidden_image;  
        $pers_foto = $request->file('pers_foto');
        $destination = 'uploads/saved/personal/'.$personal->pers_foto;
        if($pers_foto != ''){
            $request->validate([
                'pers_ncedula' => 'required|numeric|digits_between:9,10',
                'pers_npasaporte' => 'nullable|numeric|digits_between:9,10',     
                'pers_nombres' => 'required|max:50|min:3|regex:/^[\pL\s\-]+$/u',
                'pers_apellidos' => 'required|max:50|min:3|regex:/^[\pL\s\-]+$/u',       
                'pers_fec_nac' => 'required|before:today',
                'pers_telf_convencional' => 'nullable|numeric|digits_between:8,9',  
                'pers_num_celular' => 'nullable|numeric|digits_between:9,10',
                'pers_barrio' => 'nullable|max:50|min:5',
                'pers_direccion' => 'required|max:255|min:5',
                'pers_nacionalidad' => 'required|max:15|min:5',
                'pers_genero' => 'required|max:10|min:5',
                'pers_etnia' => 'required|max:18|min:5',         
                'pers_email_inst' => 'nullable|max:255|min:5',
                'pers_tip_sangre' => 'nullable|max:5|min:3',
                'pers_dis_tipo' => 'nullable|max:20|min:5',
                'pers_dis_porcentaje' => 'nullable|numeric|digits_between:1,3',
                'pers_num_car_conadis' => 'nullable|numeric|digits_between:9,10',
                'pers_est_civil' => 'required|max:12|min:5', 
                'pers_nivel' => 'required|max:15|min:5',       
                'pers_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:255',
                'pers_estado' => 'required'          
            ]);
           
            if($request->hasFile('pers_foto')){   
                $image_name = rand() . '.' . $pers_foto->getClientOriginalExtension();
                $pers_foto->move(public_path('uploads/saved/personal'), $image_name);
            }
        
            if (File::exists($destination))
            {
                File::delete($destination);
            } 
              
        } else {
            $request->validate([
                'pers_ncedula' => 'required|max:10|min:5|numeric|digits_between:9,10',
                'pers_npasaporte' => 'nullable|max:10|min:5|numeric|digits_between:9,10',     
                'pers_nombres' => 'required|max:50|min:3|regex:/^[\pL\s\-]+$/u',
                'pers_apellidos' => 'required|max:50|min:3|regex:/^[\pL\s\-]+$/u',       
                'pers_fec_nac' => 'required|before:today',
                'pers_telf_convencional' => 'nullable|numeric|digits_between:8,9',  
                'pers_num_celular' => 'nullable|numeric|digits_between:9,10',
                'pers_barrio' => 'nullable|max:50|min:5',
                'pers_direccion' => 'required|max:255|min:5',
                'pers_nacionalidad' => 'required|max:15|min:5',
                'pers_genero' => 'required|max:10|min:5',
                'pers_etnia' => 'required|max:18|min:5',         
                'pers_email_inst' => 'nullable|max:255|min:5',
                'pers_tip_sangre' => 'nullable|max:5|min:3',
                'pers_dis_tipo' => 'nullable|max:20|min:5',
                'pers_dis_porcentaje' => 'nullable|numeric|digits_between:1,3',
                'pers_num_car_conadis' => 'nullable|numeric|digits_between:9,10',
                'pers_est_civil' => 'required|max:12|min:5', 
                'pers_nivel' => 'required|max:15|min:5',
                'pers_estado' => 'required' 

            ]);
        }
      
        $form_data = array(
            'pers_ncedula' => $request->pers_ncedula,
            'pers_npasaporte' => $request->pers_npasaporte, 
            'pers_nombres' => $request->pers_nombres, 
            'pers_apellidos' => $request->pers_apellidos, 
            'pers_fec_nac' => $request->pers_fec_nac,
            'pers_telf_convencional' => $request->pers_telf_convencional,
            'pers_num_celular' => $request->pers_num_celular,
            'pers_barrio' => $request->pers_barrio,
            'pers_direccion' => $request->pers_direccion,
            'pers_nacionalidad' => $request->pers_nacionalidad,
            'pers_genero' => $request->pers_genero, 
            'pers_etnia' => $request->pers_etnia,
            'pers_genero' => $request->pers_genero,
            'pers_email_inst' => $request->pers_email_inst, 
            'pers_tip_sangre' => $request->pers_tip_sangre,
            'pers_dis_tipo' => $request->pers_dis_tipo,
            'pers_dis_porcentaje' => $request->pers_dis_porcentaje,
            'pers_num_car_conadis' => $request->pers_num_car_conadis,
            'pers_est_civil' => $request->pers_est_civil,
            'pers_nivel' => $request->pers_nivel,          
            'pers_foto' => $image_name,
            'pers_estado' => $request->pers_estado    
        );
                             
        $actualizar = Personal::query()->whereKey($pers_id)->update($form_data);

        if($actualizar){
            $notificacion=array(
                'message' => 'Los datos de este docente estan actualizados.',
                'alert-type' => 'success'
            );
            return redirect('secretario/personal/index')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Docente no Actualizado. Verifique que este correctamente ingresado los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }
    }

     /**
     * Destruye el id de la persona seleccionada.
     *
     * @param  \App\Personal  $personal
     * @return \Illuminate\Http\Response
    */
    
    public function destroy(Request $request)
    {
        $personal = Personal::findOrFail($request->pers_id);
        $pers_foto = $request->file('pers_foto');
        $destination = 'uploads/saved/personal/'.$personal->pers_foto;
        if (File::exists($destination))
        {
            File::delete($destination);
        } 
        $personal->delete();

        if($personal){
            $notificacion=array(
                'message' => 'Docente Eliminado',
                'alert-type' => 'success'
            );
            return back()->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Docente no Eliminado',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }        
    }
    
    /**
     * Muestra los datos personales de la persona seleccionada.
     *
     * @param  \App\Personal  $personal
     * @return \Illuminate\Http\Response
    */

    public function show($pers_id)
    {
        $personal = Personal::query()->findOrFail($pers_id);
        return view('secretario.personal.show', compact('personal')); 
    }  

    /**
     * Muestra la vista para crear un usuario con los datos del personal obtenidos.
     *
     * @param  \App\Personal  $personal
     * @return \Illuminate\Http\Response
    */

    public function createuserpersonal($pers_id)
    {
        $personal = Personal::query()->findOrFail($pers_id);
        $roles = Rol::all();
        return view('secretario.users.create', compact('personal','roles')); 
    }

    /**
     * Busca el nombre y apellido de cualquier empleado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function search(Request $request) {
        return view('secretario.personal.index', [
            'personal' => Personal::query()
            ->where('pers_ncedula', 'like', '%' . $request->buscar . '%')
            ->orWhere('pers_nombres', 'like', '%' . $request->buscar . '%')
            ->orWhere('pers_apellidos', 'like', '%' . $request->buscar . '%')
            ->orWhere(DB::raw("CONCAT(personal.pers_nombres, ' ', personal.pers_apellidos)"), 'LIKE', "%" . $request->buscar . "%")                 
            ->orWhere('pers_estado', 'like', '%' . $request->buscar . '%')
            ->select('*')
            ->paginate(10)
        ]);
    }
}
