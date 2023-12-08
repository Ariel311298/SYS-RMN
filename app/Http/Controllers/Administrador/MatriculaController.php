<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Oferta;
use App\Models\Alumno;
use App\Models\Matricula;
use Barryvdh\DomPDF\Facade\Pdf;

class MatriculaController extends Controller
{
    /**
     * Muestra la lista de cursos disponibles para ver las matriculas almacenadas en cada curso. 
     *
     * @return \Illuminate\Http\Response
    */

    public function index()
    {
        $ofertas = Oferta::query()->paginate(10);
        return view('administrador.matricula.index', ['ofertas' => $ofertas]);
    }

    /**
     * Muestra la lista de matriculas registradas para su administración. 
     *
     * @return \Illuminate\Http\Response
    */

    public function table()
    {
        $matriculas = Matricula::all();
        return view('administrador.matricula.table', ['matriculas' => $matriculas]);
    }

    /**
     * Muestra el formulario para crear matriculas.
     *
     * @return \Illuminate\Http\Response
    */

    public function create()
    {
        $ofertas = Oferta::all();
        $alumnos = Alumno::all();
        return view('administrador.matricula.create', compact('ofertas', 'alumnos'));
    }

    /**
     * Muestra el formulario para buscar el alumno por cedula para crear la matricula.
     *
     * @return \Illuminate\Http\Response
    */

    public function searchncedula()
    {
        return view('administrador.matricula.searchncedula');
    }

    /**
     * Sirve para encontrar el dato que busca por el numero de cedula de un alumno.
     *
     * @return \Illuminate\Http\Response
    */

    public function searchcedula(Request $request)
    {
   
        $ofertas = Oferta::all();
        $alumno = Alumno::where('alum_ncedula', $request->input('alum_ncedula'))->orWhere('alum_nombres', 'like', '%' . $request->input('alum_ncedula'). '%')->orWhere('alum_apellidos', 'like', '%' . $request->input('alum_ncedula') . '%')->get();

        if (empty($alumno)) {
            $notificacion=array(
                'message' => 'Alumno no encontrado. Intente de nuevo con otro dato.',
                'alert-type' => 'error'
            );        
            return back()->with($notificacion);
        } 

        return view('administrador.matricula.create', compact('ofertas','alumno'));
    }

    /**
     *  Guarda la matricula del estudiante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    
    public function store(Request $request)
    {
        $request->validate([
            'ofer_id' => 'required',
            'alum_id' => 'required',
            'mat_estado' => 'required'    
        ]);    

        $form_data = array(           
            'ofer_id' => $request->ofer_id,
            'alum_id'  => $request->alum_id,   
            'mat_estado' => $request->mat_estado
        );   

        $insertar = Matricula::create($form_data);

        if($insertar){
            $notificacion=array(
                'message' => 'Matricula Registrada',
                'alert-type' => 'success'
            );
            return redirect('administrador/matricula/index')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Matricula no registrada. Verifique que este correctamente ingresado los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }     
    }

    /**
     * Muestra la tabla de alumnos matriculados de un curso seleccionado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    
    public function listado($ofer_id)
    {       
        $ofertas = Oferta::query()->findOrFail($ofer_id);
        $alumnos = Oferta::with('matriculas')->findOrFail($ofer_id);

        return view('administrador.matricula.listado', compact('ofertas','alumnos'));
    }

    /**
     * Mostrar el formulario para cambiar el curso de un alumno seleccionado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    
    public function cambiar($mat_id)
    {
        return view('administrador.matricula.cambiar', [
            'matricula' => Matricula::query()->findOrFail($mat_id),        
            'alumno' => Alumno::query()->get(),
            'ofertas' => Oferta::query()->get()     
        ]);
    }

    /**
     * Cambia de curso a un alumno seleccionado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function change(Request $request)
    {
        $mat_id = $request->mat_id;
          
        $request->validate([
            'ofer_id' => 'required',    
            'alum_id' => 'required',
            'mat_estado' => 'required'         
        ]);
                  
        $form_data = array(
            'ofer_id' => $request->ofer_id,
            'alum_id' => $request->alum_id,   
            'mat_estado' => $request->mat_estado 
        );
                    
        $cambiar = Matricula::query()->whereKey($mat_id)->update($form_data);

        if($cambiar){
            $notificacion=array(
                'message' => 'Los datos de este matricula han sido actualizados correctamente.',
                'alert-type' => 'success'
            );
            return redirect('administrador/matricula/table')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Datos no actualizados. Verifique que este correctamente seleccionado las opciones.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }    
    }

    /**
     * Muestra la forma para reemplazar la matricula seleccionada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    
    public function reemplazar($mat_id)
    {
        return view('administrador.matricula.reemplazar', [
            'matricula' => Matricula::query()->findOrFail($mat_id),        
            'alumnos' => Alumno::query()->get(),
            'ofertas' => Oferta::query()->get()         
        ]);  
    }
    
    /**
     * Sirve para encontrar el dato que busca por el número de cedula de un alumno
     * o solo por los nombres o solo por los apellidos para cambiar de curso a un alumno seleccionado.
     *
     * @return \Illuminate\Http\Response
    */

    public function searchalumnoreemplazar(Request $request)
    {
        $mat_id = $request->mat_id;
        $matricula = Matricula::query()->findOrFail($mat_id);
        $ofertas = Oferta::all();
        $alumno = Alumno::where('alum_ncedula', $request->input('alum_ncedula'))->orWhere('alum_nombres', 'like', '%' . $request->input('alum_ncedula'). '%')->orWhere('alum_apellidos', 'like', '%' . $request->input('alum_ncedula') . '%')->get();
    
        if (empty($alumno)) {
            $notificacion=array(
                'message' => 'Alumno no encontrado. Intente de nuevo con otro dato.',
                'alert-type' => 'error'
            );        
            return back()->with($notificacion);
        } 

        return view('administrador.matricula.reemplazarform', compact('matricula','alumno','ofertas'));
    }

    /**
     * Muestra el formulario para reemplazar la matricula por medio de la busqueda del numero de cedula o por nombres o por apellidos del alumno.
     *
     * @return \Illuminate\Http\Response
    */

    public function reemplazarform($mat_id)
    {
        return view('administrador.matricula.reemplazarform', [
            'matricula' => Matricula::query()->findOrFail($mat_id),
            'ofertas' => Oferta::all()                    
        ]); 
    }

    /**
     * Reemplaza la matricula de un alumno seleccionado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function replace(Request $request)
    {        
        $mat_id = $request->mat_id;
          
        $request->validate([
            'ofer_id' => 'required',    
            'alum_id' => 'required'            
        ]);
        
        $form_data = array(
            'ofer_id' => $request->ofer_id,
            'alum_id' => $request->alum_id 
        );
                  
        $reemplazar = Matricula::query()->whereKey($mat_id)->update($form_data);

        if($reemplazar){
            $notificacion=array(
                'message' => 'Los datos de este matricula han sido reemplazados correctamente.',
                'alert-type' => 'success'
            );
            return redirect('administrador/matricula/table')->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Datos no actualizados. Verifique que este correctamente seleccionado las opciones.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }    
    }

    /**
     * Eliminación de la matricula seleccionada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function destroy(Request $request)
    {
        $matricula = Matricula::findOrFail($request->mat_id);
        $matricula->delete();

        if($matricula){
            $notificacion=array(
                'message' => 'Matricula Eliminada',
                'alert-type' => 'success'
            );
            return back()->with($notificacion);
        }else{
            $notificacion=array(
                'message' => 'Matricula no Eliminada',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }    
    }
   
    /**
     *  Acceso a la vista de preparacion de ficha de matricula.
    */

    public function preparacionFicha($mat_id)
    {       
        $matricula = Matricula::query()->findOrFail($mat_id);
        return view('administrador.matricula.elaboracion-ficha', compact('matricula'));
    }

    /**
     *  Acceso a la vista de preparacion de ficha de matricula desde el alumno seleccionado de un curso escogidos.
    */

    public function preparacionFicMatricula($mat_id)
    {       
        $matricula = Matricula::query()->findOrFail($mat_id);
        return view('administrador.matricula.listado.elaboracion-ficha', compact('matricula'));
    }

    /*
        Generación de la ficha de matricula del alumno seleccionado en PDF.
    */

    public function generarFichaMatriculaPDF(Request $request)
    {    
        $mat_id = $request->mat_id;   
        $matricula = Matricula::query()->findOrFail($mat_id);

        $pdf = Pdf::loadView('administrador.matricula.fic-matricula-pdf.fichaMatricula', compact('matricula'), [
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
            'padr_ape' => $request->input('padr_ape'),
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
            'mad_ape' => $request->input('mad_ape'),
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
            'rep_ape' => $request->input('rep_ape'),
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

    /*
        Generación de la ficha de matricula del alumno seleccionado en PDF desde un alumno seleccionado de un curso escogido.
    */

    public function generarFicMatriculaPDF(Request $request)
    {    
        $mat_id = $request->mat_id;   
        $matricula = Matricula::query()->findOrFail($mat_id);

        $pdf = Pdf::loadView('administrador.matricula.listado.fic-matricula-pdf.fichaMatricula', compact('matricula'), [
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
            'padr_ape' => $request->input('padr_ape'),
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
            'mad_ape' => $request->input('mad_ape'),
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
            'rep_ape' => $request->input('rep_ape'),
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
     * Busca la oferta.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function search(Request $request) 
    {
        return view('administrador.matricula.index', [
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
