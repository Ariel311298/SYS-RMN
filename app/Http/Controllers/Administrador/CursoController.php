<?php

namespace App\Http\Controllers\Administrador;

use App\Models\Seccion;
use App\Models\Curso;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CursoController extends Controller
{
    /**
     * Muestra la lista de cursos registrados.
     *
     * @return \Illuminate\Http\Response
    */

    public function index()
    {
        $cursos = Curso::sortable()->paginate(10);
        return view('administrador.curso.index', ['cursos' => $cursos]);   
    }

    /**
     * Muestra el formulario para crear el curso.
     *
     * @return \Illuminate\Http\Response
    */

    public function create()
    {
        $secciones = Seccion::all();
        return view('administrador.curso.create', compact('secciones'));
    }

    /**
     * Crea el curso.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */

    public function store(Request $request)
    {
        $request->validate([
            'sec_id' => 'required',
            'cur_nivel' => 'required|max:35|min:5',      
            'cur_nombre' => 'required|max:25|min:5', 
            'cur_paralelo' => 'required|max:1',
            'cur_estado' => 'required'      
        ]);    

        $form_data = array(           
            'sec_id' => $request->sec_id,
            'cur_nivel'  => $request->cur_nivel,   
            'cur_nombre' =>  $request->cur_nombre,
            'cur_paralelo' => $request->cur_paralelo, 
            'cur_estado' => $request->cur_estado  
        );   

        $insertar = Curso::create($form_data);
        
        if($insertar){
            $notificacion=array(
                'message' => 'Curso Registrado',
                'alert-type' => 'success'
            );
            return redirect('administrador/curso/index')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Curso no Registrado. Verifique que este correctamente ingresado los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        } 
    }

    /**
     * Muestra la forma para editar el curso seleccionado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function edit($id)
    {
        return view('administrador.curso.edit', [
            'curso' => Curso::query()->findOrFail($id),            
            'seccion' => Seccion::query()->get()    
        ]); 
    }

    /**
     * Actualiza el curso seleccionado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function update(Request $request)
    {
        $cur_id = $request->cur_id;
        
        $request->validate([                 
            'sec_id' => 'required',
            'cur_nivel' => 'required|max:35|min:5',      
            'cur_nombre' => 'required|max:25|min:5', 
            'cur_paralelo' => 'required|max:1',
            'cur_estado' => 'required'   
        ]);   

        $form_data = array(                   
            'sec_id' => $request->sec_id,
            'cur_nivel'  => $request->cur_nivel,   
            'cur_nombre' =>  $request->cur_nombre,
            'cur_paralelo' => $request->cur_paralelo, 
            'cur_estado' => $request->cur_estado  
        );   

        $actualizar = Curso::query()->whereKey($cur_id)->update($form_data);

        if($actualizar){
            $notificacion=array(
                'message' => 'Curso Actualizado. Los datos de este curso han sido actualizados.',
                'alert-type' => 'success'
            );
            return redirect('administrador/curso/index')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Curso no Actualizado. Verifique que este correctamente ingresado los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }
    }

    /**
     * Borra el curso seleccionado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function destroy(Request $request)
    {
        $curso = Curso::findOrFail($request->cur_id);
        $curso->delete();

        if($curso){
            $notificacion=array(
                'message' => 'Curso Eliminado',
                'alert-type' => 'success'
            );
            return back()->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Curso no Eliminado',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }  
    }

    /**
     * Busca el curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function search(Request $request) 
    {
        return view('administrador.curso.index', [
            'cursos' => Curso::join('seccion', 'curso.sec_id', '=', 'seccion.sec_id')
                ->where('seccion.sec_nombre', 'like', '%' . $request->buscar . '%')
                ->orWhere('curso.cur_nivel', 'like', '%' . $request->buscar  . '%')
                ->orWhere('curso.cur_nombre', 'like', '%' . $request->buscar  . '%')
                ->orWhere('curso.cur_paralelo', 'like', '%' . $request->buscar  . '%')
                ->orWhere(DB::raw("CONCAT(curso.cur_nombre, ' ', curso.cur_paralelo)"), 'LIKE', "%" . $request->buscar . "%")
                ->orWhere('curso.cur_estado', 'like', '%' . $request->buscar  . '%')
                ->select('*')
                ->paginate(10),
        ]);
    }
}
