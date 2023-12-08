<?php

namespace App\Http\Controllers\Secretario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\Rol;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\Matricula;
use App\Models\PadreApoderado;

class AlumnController extends Controller
{
    /**
     * Mostrar los alumnos registrados. 
     *
     * @return \Illuminate\Http\Response
    */

    public function index()
    {
        $alumno = Alumno::sortable()->paginate(10);
        return view('secretario.alumno.index', ['alumno' => $alumno]);
    }

    /**
     * Muestra la vista para crear el alumno.
     *
     * @return \Illuminate\Http\Response
    */

    public function create()
    {
        return view('secretario.alumno.create');
    }

    /**
     * Crea el alumno.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */

    public function store(Request $request)
    {
        $new_name = $request->hidden_image;  
        $alum_foto = $request->file('alum_foto');
        if($alum_foto != ''){
            $request->validate([
                'alum_ncedula' => 'nullable|unique:alumno|numeric|digits_between:9,10',
                'alum_npasaporte' => 'nullable|unique:alumno|numeric|digits_between:9,10',     
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
                'alum_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:255',
                'alum_estado' => 'required'        
            ]);   
            
        if($request->hasFile('alum_foto')){   
            $new_name = rand() . '.' . $alum_foto->getClientOriginalExtension();
            $alum_foto->move(public_path('uploads/saved/alumno'),$new_name);
        }

        } else {
            $request->validate([
                'alum_ncedula' => 'nullable|unique:alumno|numeric|digits_between:9,10',
                'alum_npasaporte' => 'nullable|unique:alumno|numeric|digits_between:9,10',     
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
                'alum_estado' => 'required'     
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
            'alum_foto' => $new_name,       
            'alum_estado' => $request->alum_estado  
        );
         
        $insertar = Alumno::create($form_data);   
        
        if($insertar){
            $notificacion=array(
                'message' => 'Alumno Registrado',
                'alert-type' => 'success'
            );
            return redirect('secretario/alumno/index')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Alumno no registrado. Verifique que este correctamente ingresado los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }           
    }

    /**
     * Muestra los datos personales del alumno.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($alum_id)
    {
        $alumno = Alumno::query()->findOrFail($alum_id);
        return view('secretario.alumno.show', compact('alumno'));        
    }

    /**
     * Muestra la vista para editar el personal. 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function edit($alum_id)
    {
        $alumno = Alumno::query()->findOrFail($alum_id);
        return view('secretario.alumno.edit', compact('alumno'));        
    }

    /**
     * Actualizar los datos personales del alumno.
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
                'alum_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:255',
                'alum_estado' => 'required'  
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
                'alum_num_car_conadis' => 'nullable|numeric|digits_between:9,10',  
                'alum_estado' => 'required' 
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
            'alum_foto' => $image_name,       
            'alum_estado' => $request->alum_estado        
        );
                             
        $actualizar = Alumno::query()->whereKey($alum_id)->update($form_data);

        if($actualizar){
            $notificacion=array(
                'message' => 'Los datos de este alumno han sido actualizados correctamente.',
                'alert-type' => 'success'
            );
            return redirect('secretario/alumno/index')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Datos no actualizados. Verifique que este correctamente ingresado los datos personales del alumno.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }
    }

    /**
     * Borrar datos personales del alumno.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function destroy(Request $request)
    {
        $alumno = Alumno::findOrFail($request->alum_id);
        $alum_foto = $request->file('alum_foto');
        $destination = 'uploads/saved/alumno/'.$alumno->alum_foto;
        if (File::exists($destination))
        {
            File::delete($destination);
        } 
        $alumno->delete();

        if($alumno){
            $notificacion=array(
                'message' => 'Alumno Eliminado',
                'alert-type' => 'success'
            );
            return back()->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Alumno no Eliminado',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }               
    }

    /*
        Acceso a la vista para crear usuario al alumno seleccionado.
    */

    public function createalumuser($alum_id)
    {
        $alumno = Alumno::query()->findOrFail($alum_id);
        $roles = Rol::all();
        return view('secretario.users.createalumuser', compact('alumno','roles')); 
    }

    /*
        Acceso a la vista para registrar los datos personales del representante, padre o madre de familia.
    */

    public function createpadreapoderado($alum_id)
    {
        $alumno = Alumno::query()->findOrFail($alum_id);
        return view('secretario.padreapoderado.createpadreapoderado', compact('alumno')); 
    }

    /**
     *  Acceso a la vista de preparacion de ficha de matricula.
    */

    public function preparacionFicha($alum_id)
    {       
        $alumno = Alumno::query()->findOrFail($alum_id);
        $cursos = Alumno::with('matriculas')->findOrFail($alum_id);
        $datos = Alumno::with('padresapoderados')->findOrFail($alum_id);

        return view('secretario.alumno.show.elaboracion-ficha', compact('cursos','alumno','datos'));
    }

    /*
        Generación de la ficha de matricula del alumno seleccionado en PDF.
    */

    public function generarFichaMatriculaPDF(Request $request)
    {    
        $alum_id = $request->alum_id;   
        $alumno = Alumno::query()->findOrFail($alum_id);
        $curso = Alumno::with('matriculas')->findOrFail($alum_id);

        $pdf = Pdf::loadView('secretario.alumno.show.fic-matricula-pdf.fichaMatricula', compact('alumno','curso'), [
            'n_matricula' => $request->input('n_matricula'),
            'fecha_ingreso' => date('d/m/Y', strtotime($request->input('fecha_ingreso'))),
            'periodo' => $request->input('periodo'),
            'curso_mat' => $request->input('curso_mat'),
            'paralelo_mat' => $request->input('paralelo_mat'),
            'promedio_general' => $request->input('promedio_general'),
            'doc_identidad' => $request->input('doc_identidad'),
            'certif_promocion' => $request->input('certif_promocion'),
            'informe_medico' => $request->input('informe_medico'),
            'cert_vacunas' => $request->input('cert_vacunas'),
            'informe_nee' => $request->input('informe_nee'),
            'nom_funcionario' => $request->input('nom_funcionario'),
            'padr_nom_ape' => $request->input('padr_nom_ape'),
            'padr_nacionalidad' => $request->input('padr_nacionalidad'),
            'padr_email' => $request->input('padr_email'),
            'padr_ocupacion' => $request->input('padr_ocupacion'),
            'padr_nivel_instruccion' => $request->input('padr_nivel_instruccion'),
            'padr_direccion' => $request->input('padr_direccion'),
            'padr_n_cedula' => $request->input('padr_n_cedula'),
            'padr_n_pasaporte' => $request->input('padr_n_pasaporte'),
            'padr_telf_convencional' => $request->input('padr_telf_convencional'),
            'padr_telf_celular' => $request->input('padr_telf_celular'),
            'padr_fec_nacimiento' => $request->input('padr_fec_nacimiento'),
            'mad_nom_ape' => $request->input('mad_nom_ape'),
            'mad_nacionalidad' => $request->input('mad_nacionalidad'),
            'mad_email' => $request->input('mad_email'),
            'mad_ocupacion' => $request->input('mad_ocupacion'),
            'mad_nivel_instruccion' => $request->input('mad_nivel_instruccion'),
            'mad_direccion' => $request->input('mad_direccion'),
            'mad_n_cedula' => $request->input('mad_n_cedula'),
            'mad_n_pasaporte' => $request->input('mad_n_pasaporte'),
            'mad_telf_convencional' => $request->input('mad_telf_convencional'),
            'mad_telf_celular' => $request->input('mad_telf_celular'),
            'mad_fec_nacimiento' => $request->input('mad_fec_nacimiento'),
            'rep_nom_ape' => $request->input('rep_nom_ape'),
            'rep_nacionalidad' => $request->input('rep_nacionalidad'),
            'rep_email' => $request->input('rep_email'),
            'rep_ocupacion' => $request->input('rep_ocupacion'),
            'rep_nivel_instruccion' => $request->input('rep_nivel_instruccion'),
            'rep_direccion' => $request->input('rep_direccion'),
            'rep_n_cedula' => $request->input('rep_n_cedula'),
            'rep_n_pasaporte' => $request->input('rep_n_pasaporte'),
            'rep_telf_convencional' => $request->input('rep_telf_convencional'),
            'rep_telf_celular' => $request->input('rep_telf_celular'),
            'rep_fec_nacimiento' => $request->input('rep_fec_nacimiento'),
            'inst_procedencia' => $request->input('inst_procedencia'),
            'mot_cambio' => $request->input('mot_cambio'),
            'curs_repetidos' => $request->input('curs_repetidos'),
            'prom_general_acad' => $request->input('prom_general_acad'),
            'enfermedades' => $request->input('enfermedades'),
            'medic_frecuente' => $request->input('medic_frecuente'),
            'alergias' => $request->input('alergias'),
            'observaciones' => $request->input('observaciones'),

        ]);
        return $pdf->download('fichaMatricula.pdf');
    }

    /**
     * Busca el alumno.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function search(Request $request) 
    {
        return view('secretario.alumno.index', [
            'alumno' => Alumno::query()
                ->where('alum_ncedula', 'like', '%' . $request->buscar . '%')
                ->orWhere('alum_nombres', 'like', '%' . $request->buscar  . '%')
                ->orWhere('alum_apellidos', 'like', '%' . $request->buscar  . '%')
                ->orWhere('alum_estado', 'like', '%' . $request->buscar  . '%')
                ->select('*')
                ->paginate(10),
        ]);
    }
}
