<?php

namespace App\Http\Controllers\Alumno;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Alumno;
use Illuminate\Support\Facades\DB;
use App\Models\Users;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AlumnoController extends Controller
{   
     public function __construct()
     {
         $this->middleware('auth');
     }

    /**
     * Accede al dashboard del rol de alumno
     *
     * @return \Illuminate\Http\Response
    */

     public function alumnoDashboard()
     {
         return view('alumno.dashboard');
     }

    /**
     * Acceso a la vista de acceso a la edicion de datos del rol de alumno.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
    */

    public function editarDatos($id)
    {
        $alumno = Alumno::query()->findOrFail($id);
        return view('alumno.editar-datos-personales', ['alumno' => $alumno]); 
    } 

    /**
     * Actualiza los datos personales del alumno.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function update(Request $request)
    {
        $alum_id = $request->alum_id;
        $alumno = Alumno::find($alum_id);
        $image_name = $request->hidden_image;  
        $alum_foto = $request->file('alum_foto');
        $destination = 'uploads/saved/alumno/'.$alumno->alum_foto;
        if($alum_foto != ''){
            $request->validate([
                'alum_ncedula' => 'nullable|numeric|digits_between:9,10',
                'alum_npasaporte' => 'nullable|numeric|digits_between:9,10',     
                'alum_nombres' => 'required|regex:/^[\pL\s\-]+$/u|max:50|min:5',
                'alum_apellidos' => 'required|regex:/^[\pL\s\-]+$/u|max:50|min:5',       
                'alum_fec_nac' => 'required|before:today',
                'alum_barrio' => 'nullable|max:50|min:5',  
                'alum_genero' => 'required|max:10|min:5',
                'alum_nacionalidad' => 'required|max:15|min:5',
                'alum_etnia' => 'required|max:18|min:5',         
                'alum_dis_tipo' => 'nullable|max:20|min:5',
                'alum_dis_porcentaje' => 'nullable|numeric|digits_between:1,3',
                'alum_num_car_conadis' => 'nullable|numeric|digits_between:9,10',  
                'alum_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:255'  
            ]);
           
            if($request->hasFile('alum_foto')){   
                $image_name = rand() . '.' . $alum_foto->getClientOriginalExtension();
                $alum_foto->move(public_path('uploads/saved/alumno'), $image_name);
            }
        
            if (File::exists($destination))
            {
                File::delete($destination);
            } 
              
        } else {
            $request->validate([
                'alum_ncedula' => 'nullable|numeric|digits_between:9,10',
                'alum_npasaporte' => 'nullable|numeric|digits_between:9,10',     
                'alum_nombres' => 'required|regex:/^[\pL\s\-]+$/u|max:50|min:5',
                'alum_apellidos' => 'required|regex:/^[\pL\s\-]+$/u|max:50|min:5',       
                'alum_fec_nac' => 'required|before:today',
                'alum_barrio' => 'nullable|max:50|min:5',  
                'alum_genero' => 'required|max:10|min:5',
                'alum_nacionalidad' => 'required|max:15|min:5',
                'alum_etnia' => 'required|max:18|min:5',         
                'alum_dis_tipo' => 'nullable|max:20|min:5',
                'alum_dis_porcentaje' => 'nullable|numeric|digits_between:1,3',
                'alum_num_car_conadis' => 'nullable|numeric|digits_between:9,10'
            ]);
        }
      
        $form_data = array(
            'alum_ncedula' => $request->alum_ncedula,
            'alum_npasaporte' => $request->alum_npasaporte, 
            'alum_nombres' => $request->alum_nombres, 
            'alum_apellidos' => $request->alum_apellidos, 
            'alum_fec_nac' => $request->alum_fec_nac,
            'alum_barrio' => $request->alum_barrio,
            'alum_genero' => $request->alum_genero, 
            'alum_nacionalidad' => $request->alum_nacionalidad,
            'alum_etnia' => $request->alum_etnia,
            'alum_dis_tipo' => $request->alum_dis_tipo,
            'alum_dis_porcentaje' => $request->alum_dis_porcentaje,
            'alum_num_car_conadis' => $request->alum_num_car_conadis,        
            'alum_foto' => $image_name
        );
                             
        $actualizar = Alumno::query()->whereKey($alum_id)->update($form_data);

        if($actualizar){
            $notificacion=array(
                'message' => 'Los datos de este alumno han sido actualizados correctamente.',
                'alert-type' => 'success'
            );
            return redirect('alumno/dashboard')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Datos no actualizados. Verifique que este correctamente ingresado los datos personales del alumno.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }
    }

    /**
     * Acceso a la vista de acceso a la vista de cambio de contraseña del rol de alumno.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
    */

    public function cambiarPassword($id)
    {
        $user = Users::query()->findOrFail($id);
        return view('alumno.cambiar-password', ['user' => $user]); 
    } 

    /**
     * Actualiza la contraseña del usuario con el rol de alumno.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\\Models\Alumno  $alumno
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
            return redirect('alumno/dashboard')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Contraseña no actualizada.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }        
    }
}
