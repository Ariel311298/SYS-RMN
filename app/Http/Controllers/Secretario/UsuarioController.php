<?php

namespace App\Http\Controllers\Secretario;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Personal;
use App\Models\Rol;
use App\Models\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Muestra la lista de usuarios registrados.
     *
     * @return \Illuminate\Http\Response
    */

    public function index()
    {
        $users = Users::all();
        return view('secretario.users.index', ['users' => $users]);   
    }

    /**
     * Crea el usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */

    public function store(Request $request)
    {
        $request->validate([
            'rol_id' => 'required',
            'alum_id' => 'nullable',     
            'pers_id' => 'nullable',
            'name' => 'required|unique:users|max:255|min:5',      
            'email' => 'required|unique:users|max:255|min:5', 
            'password' => 'required|unique:users|max:255|min:5',
            'usu_estado' => 'required'      
        ]);    

        $form_data = array(           
            'rol_id' => $request->rol_id,
            'alum_id'  => $request->alum_id,   
            'pers_id' =>  $request->pers_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, 
            'usu_estado' => $request->usu_estado  
        );   

        $insertar = Users::create($form_data);

        if($insertar){
            $notificacion=array(
                'message' => 'Usuario Registrado',
                'alert-type' => 'success'
            );
            return redirect('secretario/users/index')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Usuario no Registrado. Verifique que este correctamente ingresado los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }    
    }

    /**
     * Mostrar los datos del usuario.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function show($id)
    {
        return view('secretario.users.show', [
            'user' => Users::query()->findOrFail($id),
            'personal' => Personal::query()->with(['personal'])->findOrFail($id),         
            'alumno' => Alumno::query()->with(['alumno'])->findOrFail($id),   
            'rol' => Rol::query()->with(['roles'])->findOrFail($id)
        ]);
    }

    /**
     * Muestra la forma para editar un usuario
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function edit($id)
    {
        return view('secretario.users.edit', [
            'user' => Users::query()->findOrFail($id),            
            'personal' => Personal::query()->get(),
            'alumno' => Alumno::query()->get(),
            'roles' => Rol::query()->get()    
        ]);         
    }

    /**
     * Actualizar los datos del usuario seleccionado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function update(Request $request)
    {
        $id = $request->id;
        
        $request->validate([                 
            'rol_id' => 'required',
            'alum_id' => 'nullable',     
            'pers_id' => 'nullable',
            'name' => 'required|max:255|min:5',      
            'email' => 'required|max:255|min:5'  
        ]);   

        $form_data = array(                   
            'rol_id' => $request->rol_id,
            'alum_id'  => $request->alum_id,   
            'pers_id' =>  $request->pers_id,
            'name' => $request->name,
            'email' => $request->email
        );   

        $actualizar = Users::query()->whereKey($id)->update($form_data);

        if($actualizar){
            $notificacion=array(
                'message' => 'Usuario Actualizado. Los datos de este usuario han sido actualizados.',
                'alert-type' => 'success'
            );
            return redirect('secretario/users/index')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Usuario no Actualizado. Verifique que este correctamente ingresado los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }
    }

    /**
     * Eliminación del usuario seleccionado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function destroy(Request $request)
    {
        $user = Users::findOrFail($request->id);
        $user->delete();

        if($user){
            $notificacion=array(
                'message' => 'Usuario Eliminado',
                'alert-type' => 'success'
            );
            return back()->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Usuario no Eliminado',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }   
    }

    public function password($id)
    {        
        return view('secretario.users.password', [
            'user' => Users::query()->findOrFail($id),            
            'personal' => Personal::query()->get(),
            'alumno' => Alumno::query()->get(),
            'roles' => Rol::query()->get()    
        ]);         
    }

    public function updatepassword(Request $request)
    {
        $id = $request->id;
        
        $request->validate([                 
            'alum_id' => 'nullable',     
            'pers_id' => 'nullable',
            'password' => 'required|max:255|min:5'  
        ]);   

        $form_data = array(                   
            'alum_id'  => $request->alum_id,   
            'pers_id' =>  $request->pers_id,
            'password' => Hash::make($request->password)           
        );   

        $actualizar_password = Users::query()->whereKey($id)->update($form_data);

        if($actualizar_password){
            $notificacion=array(
                'message' => 'La contraseña de este usuario ha sido actualizada',
                'alert-type' => 'success'
            );
            return redirect('secretario/users/index')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Contraseña no actualizada.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }      
    }
}
