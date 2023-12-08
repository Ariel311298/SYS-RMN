<?php

namespace App\Http\Controllers\Rector;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Personal;
use Illuminate\Support\Facades\DB;
use App\Models\Users;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class RectorController extends Controller
{

     public function __construct()
     {
        $this->middleware('auth');
     }

    /**
     * Accede al dashboard del rol de rector
     *
     * @return \Illuminate\Http\Response
    */

     public function rectorDashboard()
     {
         return view('rector.dashboard');
     }

    /**
     * Acceso a la vista de acceso a la edicion de datos del rol de rector.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Personal  $personal
     * @return \Illuminate\Http\Response
    */

    public function editarDatos($id)
    {
        $personal = Personal::query()->findOrFail($id);
        return view('rector.editar-datos-personales', ['personal' => $personal]); 
    } 

    /**
     * Actualizar los datos personales del usuario con rol de rector.
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
                'pers_email_inst' => 'nullable|max:255|min:5',
                'pers_tip_sangre' => 'nullable|max:5|min:3',
                'pers_dis_tipo' => 'nullable|max:20|min:5',
                'pers_dis_porcentaje' => 'nullable|numeric|digits_between:1,3',
                'pers_num_car_conadis' => 'nullable|numeric|digits_between:9,10',
                'pers_est_civil' => 'required|max:12|min:5', 
                'pers_nivel' => 'required|max:15|min:5',       
                'pers_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:255'      
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
                'pers_ncedula' => 'required|numeric|digits_between:9,10',
                'pers_npasaporte' => 'nullable|numeric|digits_between:9,10',     
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
                'pers_email_inst' => 'nullable|max:255|min:5',
                'pers_tip_sangre' => 'nullable|max:5|min:3',
                'pers_dis_tipo' => 'nullable|max:20|min:5',
                'pers_dis_porcentaje' => 'nullable|numeric|digits_between:1,3',
                'pers_num_car_conadis' => 'nullable|numeric|digits_between:9,10',
                'pers_est_civil' => 'required|max:12|min:5', 
                'pers_nivel' => 'required|max:15|min:5'  
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
            'pers_foto' => $image_name
        );
                             
        $actualizar = Personal::query()->whereKey($pers_id)->update($form_data);

        if($actualizar){
            $notificacion=array(
                'message' => 'Sus datos han sido actualizados.',
                'alert-type' => 'success'
            );
            return redirect('rector/dashboard')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Datos no Actualizados. Verifique que este correctamente ingresado los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        };
    }

    /**
     * Acceso a la vista de acceso a la vista de cambio de contraseña del rol de rector.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Personal  $personal
     * @return \Illuminate\Http\Response
    */

    public function cambiarPassword($id)
    {
        $user = Users::query()->findOrFail($id);
        return view('rector.cambiar-password', ['user' => $user]); 
    } 

    /**
     * Actualiza la contraseña del usuario con el rol de rector.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Personal  $personal
     * @return \Illuminate\Http\Response
    */

    public function updatePassword(Request $request)
    {
        $id = $request->id;
        $user = Users::find($id);
        
        $request->validate([
            'password' => 'required|min:5|max:255'         
        ]);
            
        $form_data = array(
            'password' => Hash::make($request->password) 
        );
                    
        $cambiar_password = Users::query()->whereKey($id)->update($form_data);

        if($cambiar_password){
            $notificacion=array(
                'message' => 'Su contraseña ha sido actualizada',
                'alert-type' => 'success'
            );
            return redirect('rector/dashboard')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Contraseña no actualizada.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }           
    }
}
