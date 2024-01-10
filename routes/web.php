<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Administrador\AdministradorController;
use App\Http\Controllers\Administrador\PersonalController;
use App\Http\Controllers\Administrador\AlumController;
use App\Http\Controllers\Administrador\CursoController;
use App\Http\Controllers\Administrador\PeriodoController;
use App\Http\Controllers\Administrador\UserController;
use App\Http\Controllers\Administrador\AreaController;
use App\Http\Controllers\Administrador\AsignaturaController;
use App\Http\Controllers\Administrador\OfertaController;
use App\Http\Controllers\Administrador\PadreApoderadoController;
use App\Http\Controllers\Administrador\MatriculaController;
use App\Http\Controllers\Administrador\MallaController;
use App\Http\Controllers\Administrador\TutorProyectoController;
use App\Http\Controllers\Administrador\CalificacionController;
use App\Http\Controllers\Administrador\ComportamientoController;
use App\Http\Controllers\Administrador\ProyEscolarController;
use App\Http\Controllers\Secretario\SecretarioController;
use App\Http\Controllers\Secretario\PersonController;
use App\Http\Controllers\Secretario\UsuarioController;
use App\Http\Controllers\Secretario\AlumnController;
use App\Http\Controllers\Secretario\OfertaCursoController;
use App\Http\Controllers\Secretario\PadreApodController;
use App\Http\Controllers\Secretario\MatriculasController;
use App\Http\Controllers\Secretario\ListCalifController;
use App\Http\Controllers\Secretario\ListComporController;
use App\Http\Controllers\Secretario\ListProyController;
use App\Http\Controllers\Docente\DocenteController;
use App\Http\Controllers\Docente\CalificacionesController;
use App\Http\Controllers\Docente\ComportamientosController;
use App\Http\Controllers\Docente\ProyEscolarCalController;
use App\Http\Controllers\Rector\RectorController;
use App\Http\Controllers\Rector\AlumnosController;
use App\Http\Controllers\Rector\PadresApoderadosController;
use App\Http\Controllers\Rector\CalifController;
use App\Http\Controllers\Rector\ComporController;
use App\Http\Controllers\Rector\ProyEscController;
use App\Http\Controllers\Alumno\AlumnoController;
use App\Http\Controllers\Alumno\CalifAlumController;
use App\Http\Controllers\Alumno\ComporAlumController;
use App\Http\Controllers\Alumno\ProyEscAlumController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Ruta Administrador/a
Route::prefix('administrador')->middleware(['auth','isAdmin'])->group(function()
{
    // Dashboard - Administrador
    Route::get("/dashboard",[AdministradorController::class, 'administradorDashboard'])->name("administrador.dashboard");  

    // Datos Personales - Administrador
    Route::get("/editar-datos-personales/{id}",[AdministradorController::class, 'editarDatos']);
    Route::post("/editar-datos-personales/update",[AdministradorController::class, 'update']);
    Route::get("/cambiar-password/{id}",[AdministradorController::class, 'cambiarPassword']);
    Route::post("/cambiar-password/update-password",[AdministradorController::class, 'updatePassword']);

    // Usuario - Administrador
    Route::get("/users/index",[UserController::class, 'index']);
    Route::get("/users/create/{pers_id}",[PersonalController::class, 'createuserpersonal']);
    Route::get("/users/createalumuser/{alum_id}",[AlumController::class, 'createalumuser']);
    Route::post("/users/store",[UserController::class, 'store']);
    Route::post("/users/update",[UserController::class, 'update']);
    Route::get("/users/password/{id}",[UserController::class, 'password']);
    Route::post("/users/updatepassword",[UserController::class, 'updatepassword']);
    Route::get("/users/edit/{id}",[UserController::class, 'edit']);
    Route::delete("/users/destroy",[UserController::class, 'destroy']);
    //Route::any("/users/index/search",[UserController::class, 'search']);
    Route::get('/users/show/{id}',[UserController::class, 'show']);

    // Periodo - Administrador
    Route::get("/periodo/index",[PeriodoController::class, 'index']);
    Route::get("/periodo/create",[PeriodoController::class, 'create']);
    Route::post("/periodo/store",[PeriodoController::class, 'store']);
    Route::post("/periodo/update",[PeriodoController::class, 'update']);
    Route::get("/periodo/edit/{pers_id}",[PeriodoController::class, 'edit']);
    Route::delete("/periodo/destroy",[PeriodoController::class, 'destroy']);
    Route::any("/periodo/index/search",[PeriodoController::class, 'search']);

    // Curso - Administrador
    Route::get("/curso/index",[CursoController::class, 'index']);
    Route::get("/curso/create",[CursoController::class, 'create']);
    Route::post("/curso/store",[CursoController::class, 'store']);
    Route::post("/curso/update",[CursoController::class, 'update']);
    Route::get("/curso/edit/{cur_id}",[CursoController::class, 'edit']);
    Route::delete("/curso/destroy",[CursoController::class, 'destroy']);
    Route::any("/curso/index/search",[CursoController::class, 'search']);

    // Area - Administrador
    Route::get("/area/index",[AreaController::class, 'index']);
    Route::get("/area/create",[AreaController::class, 'create']);
    Route::post("/area/store",[AreaController::class, 'store']);
    Route::post("/area/update",[AreaController::class, 'update']);
    Route::get("/area/edit/{area_id}",[AreaController::class, 'edit']);
    Route::delete("/area/destroy",[AreaController::class, 'destroy']);
    Route::any("/area/index/search",[AreaController::class, 'search']);

    // Asignatura - Administrador
    Route::get("/asignatura/index",[AsignaturaController::class, 'index']);
    Route::get("/asignatura/create",[AsignaturaController::class, 'create']);
    Route::post("/asignatura/store",[AsignaturaController::class, 'store']);
    Route::post("/asignatura/update",[AsignaturaController::class, 'update']);
    Route::get("/asignatura/edit/{asig_id}",[AsignaturaController::class, 'edit']);
    Route::delete("/asignatura/destroy",[AsignaturaController::class, 'destroy']);
    Route::any("/asignatura/index/search",[AsignaturaController::class, 'search']);

    // Oferta - Administrador
    Route::get("/oferta/index",[OfertaController::class, 'index']);
    Route::get("/oferta/create",[OfertaController::class, 'create']);
    Route::get("/oferta/searchncedula",[OfertaController::class, 'searchncedula']);
    Route::get('/oferta/searchcedula', [OfertaController::class, 'searchcedula']);
    Route::post('/oferta/searchcedula', [OfertaController::class, 'searchcedula']);
    Route::post("/oferta/store",[OfertaController::class, 'store']);
    Route::post("/oferta/update",[OfertaController::class, 'update']);
    Route::get("/oferta/edit/{asig_id}",[OfertaController::class, 'edit']);
    Route::delete("/oferta/destroy",[OfertaController::class, 'destroy']);
    Route::any("/oferta/index/search",[OfertaController::class, 'search']);

    // Personal - Administrador
    Route::get("/personal/index",[PersonalController::class, 'index']);
    Route::get("/personal/create",[PersonalController::class, 'create']);
    Route::post("/personal/store",[PersonalController::class, 'store']);
    Route::post("/personal/update",[PersonalController::class, 'update']);
    Route::post("/personal/password",[PersonalController::class, 'password']);
    Route::get("/personal/edit/{pers_id}",[PersonalController::class, 'edit']);
    Route::delete("/personal/destroy",[PersonalController::class, 'destroy']);
    Route::any("/personal/index/search",[PersonalController::class, 'search']);
    Route::get('/personal/show/{pers_id}',[PersonalController::class, 'show']);

    // PadreApoderado - Administrador
    Route::get("/padreapoderado/index",[PadreApoderadoController::class, 'index']);
    Route::get("/padreapoderado/create",[PadreApoderadoController::class, 'create']);
    Route::post("/padreapoderado/store",[PadreApoderadoController::class, 'store']);
    Route::post("/padreapoderado/update",[PadreApoderadoController::class, 'update']);
    Route::post("/padreapoderado/password",[PadreApoderadoController::class, 'password']);
    Route::get("/padreapoderado/edit/{pad_id}",[PadreApoderadoController::class, 'edit']);
    Route::delete("/padreapoderado/destroy",[PadreApoderadoController::class, 'destroy']);
    Route::any("/padreapoderado/index/search",[PadreApoderadoController::class, 'search']);
    Route::get('/padreapoderado/show/{pad_id}',[PadreApoderadoController::class, 'show']);
    Route::get("/padreapoderado/searchncedulaalumno",[PadreApoderadoController::class, 'searchncedulaalumno']);
    Route::post('/padreapoderado/searchcedulaalumno', [PadreApoderadoController::class, 'searchcedulaalumno']);
    Route::get('/padreapoderado/searchcedulaalumno', [PadreApoderadoController::class, 'searchcedulaalumno']);
    Route::get("/padreapoderado/createpadreapoderado/{alum_id}",[AlumController::class, 'createpadreapoderado']);
    Route::get('/padreapoderado/searchcedulaalumnoedit', [PadreApoderadoController::class, 'searchcedulaalumnoedit']);
    Route::post('/padreapoderado/searchcedulaalumnoedit', [PadreApoderadoController::class, 'searchcedulaalumnoedit']);
    Route::get("/padreapoderado/modify/{pad_id}",[PadreApoderadoController::class, 'modify']);
    //Route::post('/padreapoderado/datospersonalesalumno', [PadreApoderadoController::class, 'datospersonalesalumno']);

    // Alumno - Administrador
    Route::get("/alumno/index",[AlumController::class, 'index']);
    Route::get("/alumno/create",[AlumController::class, 'create']);
    Route::post("/alumno/store",[AlumController::class, 'store']);
    Route::post("/alumno/update",[AlumController::class, 'update']);
    Route::post("/alumno/password",[AlumController::class, 'password']);
    Route::get("/alumno/edit/{alum_id}",[AlumController::class, 'edit']);
    Route::delete("/alumno/destroy",[AlumController::class, 'destroy']);
    Route::any("/alumno/index/search",[AlumController::class, 'search']);
    Route::get('/alumno/show/{alum_id}',[AlumController::class, 'show']);
    Route::get('/alumno/show/elaboracion-ficha/{alum_id}',[AlumController::class, 'preparacionFicha']);
    Route::post('/alumno/show/elaboracion-ficha/generarFichaMatriculaPDF','App\Http\Controllers\Administrador\AlumController@generarFichaMatriculaPDF');   

    // Matricula - Administrador
    Route::get("/matricula/index",[MatriculaController::class, 'index']);
    Route::get("/matricula/table",[MatriculaController::class, 'table']);
    Route::get("/matricula/create",[MatriculaController::class, 'create']);
    Route::get("/matricula/searchncedula",[MatriculaController::class, 'searchncedula']);
    Route::get('/matricula/searchcedula', [MatriculaController::class, 'searchcedula']);
    Route::post('/matricula/searchcedula', [MatriculaController::class, 'searchcedula']);
    Route::post("/matricula/store",[MatriculaController::class, 'store']);
    Route::get("/matricula/listado/{ofer_id}",[MatriculaController::class, 'listado']);
    Route::get("/matricula/cambiar/{mat_id}",[MatriculaController::class, 'cambiar']);
    Route::post("/matricula/change",[MatriculaController::class, 'change']);
    Route::get("/matricula/reemplazar/{mat_id}",[MatriculaController::class, 'reemplazar']);
    Route::get('/matricula/searchalumnoreemplazar', [MatriculaController::class, 'searchalumnoreemplazar']);
    Route::get('/matricula/searchalumnoreemplazar/{mat_id}', [MatriculaController::class, 'searchalumnoreemplazar']);
    Route::post('/matricula/searchalumnoreemplazar', [MatriculaController::class, 'searchalumnoreemplazar']);
    Route::get("/matricula/reemplazarform/{mat_id}",[MatriculaController::class, 'reemplazarform']);
    Route::post('/matricula/replace', [MatriculaController::class, 'replace']);
    Route::delete("/matricula/destroy",[MatriculaController::class, 'destroy']);
    Route::get('/matricula/elaboracion-ficha/{mat_id}',[MatriculaController::class, 'preparacionFicha']);
    Route::post('/matricula/elaboracion-ficha/generarFichaMatriculaPDF','App\Http\Controllers\Administrador\MatriculaController@generarFichaMatriculaPDF');  
    Route::get('/matricula/listado/elaboracion-ficha/{mat_id}',[MatriculaController::class, 'preparacionFicMatricula']);
    Route::post('/matricula/listado/elaboracion-ficha/generarFicMatriculaPDF','App\Http\Controllers\Administrador\MatriculaController@generarFicMatriculaPDF');  
    Route::any("/matricula/index/search",[MatriculaController::class, 'search']);

    // Asignación (Malla) - Administrador
    Route::get("/malla/index",[MallaController::class, 'index']);
    Route::get("/malla/create",[MallaController::class, 'create']);
    Route::post("/malla/store",[MallaController::class, 'store']);
    Route::get("/malla/asignacion/{ofer_id}",[MallaController::class, 'asignacion']);
    Route::get('/malla/searchcedula', [MallaController::class, 'searchcedula']);
    Route::post('/malla/searchcedula', [MallaController::class, 'searchcedula']);
    Route::get("/malla/asignar",[MallaController::class, 'asignar']);
    Route::get("/malla/edit/{mal_id}",[MallaController::class, 'edit']);
    Route::post("/malla/update",[MallaController::class, 'update']);
    Route::delete("/malla/destroy",[MallaController::class, 'destroy']);
    Route::get('/malla/searchdocente', [MallaController::class, 'searchdocente']);
    Route::get('/malla/searchdocente/{mal_id}', [MallaController::class, 'searchdocente']);
    Route::post('/malla/searchdocente', [MallaController::class, 'searchdocente']);
    Route::get("/malla/editform/{mal_id}",[MallaController::class, 'editform']);
    Route::post("/malla/updateform",[MallaController::class, 'updateform']);
    Route::any("/malla/index/search",[MallaController::class, 'search']);

    // TutorProyecto - Administrador
    Route::get("/tutorproyecto/index",[TutorProyectoController::class, 'index']);
    Route::get("/tutorproyecto/create",[TutorProyectoController::class, 'create']);
    Route::get("/tutorproyecto/asignar",[TutorProyectoController::class, 'asignar']);
    Route::get("/tutorproyecto/searchdocente/{tutproy_id}",[TutorProyectoController::class, 'searchdocente']);
    Route::get("/tutorproyecto/searchdocente",[TutorProyectoController::class, 'searchdocente']);
    Route::post("/tutorproyecto/searchdocente",[TutorProyectoController::class, 'searchdocente']);
    Route::get("/tutorproyecto/searchcedula",[TutorProyectoController::class, 'searchcedula']);
    Route::post('/tutorproyecto/searchcedula', [TutorProyectoController::class, 'searchcedula']);
    Route::post("/tutorproyecto/store",[TutorProyectoController::class, 'store']);
    Route::post("/tutorproyecto/update",[TutorProyectoController::class, 'update']);
    Route::get("/tutorproyecto/edit/{tutproy_id}",[TutorProyectoController::class, 'edit']);
    Route::get("/tutorproyecto/editform/{tutproy_id}",[TutorProyectoController::class, 'editform']);
    Route::get("/tutorproyecto/show/{tutproy_id}",[TutorProyectoController::class, 'show']);
    Route::delete("/tutorproyecto/destroy",[TutorProyectoController::class, 'destroy']);
    Route::any("/tutorproyecto/index/search",[TutorProyectoController::class, 'search']);

    // Calificacion - Administrador
    Route::get("/calificacion/index",[CalificacionController::class, 'index']);
    Route::get("/calificacion/asignar/{ofer_id}",[CalificacionController::class, 'asignar']);
    Route::get("/calificacion/asignaturas/{ofer_id}",[CalificacionController::class, 'asignaturas']);
    Route::get("/calificacion/asignaturas/controlasignacion/{mal_id}",[CalificacionController::class, 'controlasignacion']);
    Route::get("/calificacion/asignaturas/controlasignacion/edit/{cal_id}",[CalificacionController::class, 'edit']);
    Route::get("/calificacion/asignaturas/controlasignacion/reemplazar/{cal_id}",[CalificacionController::class, 'reemplazar']);
    Route::post("/calificacion/asignaturas/controlasignacion/update",[CalificacionController::class, 'update']);
    Route::post("/calificacion/store",[CalificacionController::class, 'store']);
    Route::delete("/calificacion/asignaturas/destroy",[CalificacionController::class, 'destroy']);
    Route::get("/calificacion/asignaturas/controlasignacion/reemplazarform/{cal_id}",[CalificacionController::class, 'reemplazarform']);
    Route::post('/calificacion/asignaturas/controlasignacion/searchalumnoreemplazar', [CalificacionController::class, 'searchalumnoreemplazar']);
    Route::get("/calificacion/cursos",[CalificacionController::class, 'cursos']);
    Route::get("/calificacion/cursos/listado/{ofer_id}",[CalificacionController::class, 'listado']);
    Route::get("/calificacion/cursos/listado/ver-calificacion-q1/{mat_id}",[CalificacionController::class, 'verCalificacionQ1']);
    Route::get("/calificacion/cursos/listado/ver-calificacion-q2/{mat_id}",[CalificacionController::class, 'verCalificacionQ2']);  
    Route::get("/calificacion/cursos/listado/ver-calificacion-anual/{mat_id}",[CalificacionController::class, 'verCalificacionAnual']);  
    Route::get("/calificacion/cursos/materias/{ofer_id}",[CalificacionController::class, 'seleccionarAsignatura']);
    Route::get("/calificacion/asignaturas/consultar-calificacion-prom-p1q1/{mal_id}",[CalificacionController::class, 'consultarPromP1Q1']);
    Route::get("/calificacion/asignaturas/consultar-calificacion-prom-p2q1/{mal_id}",[CalificacionController::class, 'consultarPromP2Q1']);
    Route::get("/calificacion/asignaturas/consultar-calificacion-prom-q1/{mal_id}",[CalificacionController::class, 'consultarPromQ1']);
    Route::get("/calificacion/asignaturas/consultar-calificacion-prom-p1q2/{mal_id}",[CalificacionController::class, 'consultarPromP1Q2']);
    Route::get("/calificacion/asignaturas/consultar-calificacion-prom-p2q2/{mal_id}",[CalificacionController::class, 'consultarPromP2Q2']);
    Route::get("/calificacion/asignaturas/consultar-calificacion-prom-q2/{mal_id}",[CalificacionController::class, 'consultarPromQ2']);
    Route::get("/calificacion/asignaturas/consultar-calificacion-prom-anual/{mal_id}",[CalificacionController::class, 'consultarPromAnual']);
    Route::get("/calificacion/cursos/materias/consultar-calificacion-prom-p1q1/{mal_id}",[CalificacionController::class, 'consultarCalifPromP1Q1']);
    Route::get("/calificacion/cursos/materias/consultar-calificacion-prom-p2q1/{mal_id}",[CalificacionController::class, 'consultarCalifPromP2Q1']);
    Route::get("/calificacion/cursos/materias/consultar-calificacion-prom-q1/{mal_id}",[CalificacionController::class, 'consultarCalifPromQ1']);
    Route::get("/calificacion/cursos/materias/consultar-calificacion-prom-p1q2/{mal_id}",[CalificacionController::class, 'consultarCalifPromP1Q2']);
    Route::get("/calificacion/cursos/materias/consultar-calificacion-prom-p2q2/{mal_id}",[CalificacionController::class, 'consultarCalifPromP2Q2']);
    Route::get("/calificacion/cursos/materias/consultar-calificacion-prom-q2/{mal_id}",[CalificacionController::class, 'consultarCalifPromQ2']);
    Route::get("/calificacion/cursos/materias/consultar-calificacion-prom-anual/{mal_id}",[CalificacionController::class, 'consultarCalifPromAnual']);
    Route::post('/calificacion/cursos/materias/generarPDFPromP1Q1','App\Http\Controllers\Administrador\CalificacionController@generarPDFPromP1Q1');   
    Route::post('/calificacion/cursos/materias/generarPDFPromP2Q1','App\Http\Controllers\Administrador\CalificacionController@generarPDFPromP2Q1');
    Route::post('/calificacion/cursos/materias/generarPDFPromQ1','App\Http\Controllers\Administrador\CalificacionController@generarPDFPromQ1');      
    Route::post('/calificacion/cursos/materias/generarPDFPromP1Q2','App\Http\Controllers\Administrador\CalificacionController@generarPDFPromP1Q2');   
    Route::post('/calificacion/cursos/materias/generarPDFPromP2Q2','App\Http\Controllers\Administrador\CalificacionController@generarPDFPromP2Q2');   
    Route::post('/calificacion/cursos/materias/generarPDFPromQ2','App\Http\Controllers\Administrador\CalificacionController@generarPDFPromQ2');
    Route::post('/calificacion/cursos/materias/generarPDFPromAnual','App\Http\Controllers\Administrador\CalificacionController@generarPDFPromAnual');    
    Route::post('/calificacion/cursos/materias/generarPDFCalifAnual','App\Http\Controllers\Administrador\CalificacionController@generarPDFCalifAnual'); 
    Route::post('/calificacion/cursos/listado/ver-calificacion-q1/generarPDFPromQ1Certificado/{mat_id}','App\Http\Controllers\Administrador\CalificacionController@generarPDFPromQ1Certificado');          
    Route::post('/calificacion/cursos/listado/ver-calificacion-q2/generarPDFPromQ2Certificado/{mat_id}','App\Http\Controllers\Administrador\CalificacionController@generarPDFPromQ2Certificado');          
    Route::post('/calificacion/cursos/listado/ver-calificacion-anual/generarPDFPromAnualCertificado/{mat_id}','App\Http\Controllers\Administrador\CalificacionController@generarPDFPromAnualCertificado');   
    Route::post('/calificacion/cursos/materias/exportReportCalifP1Q1Excel','App\Http\Controllers\Administrador\CalificacionController@exportReportCalifP1Q1Excel'); 
    Route::post('/calificacion/cursos/materias/exportReportCalifP2Q1Excel','App\Http\Controllers\Administrador\CalificacionController@exportReportCalifP2Q1Excel');  
    Route::post('/calificacion/cursos/materias/exportReportCalifQ1Excel','App\Http\Controllers\Administrador\CalificacionController@exportReportCalifQ1Excel');   
    Route::post('/calificacion/cursos/materias/exportReportCalifP1Q2Excel','App\Http\Controllers\Administrador\CalificacionController@exportReportCalifP1Q2Excel');   
    Route::post('/calificacion/cursos/materias/exportReportCalifP2Q2Excel','App\Http\Controllers\Administrador\CalificacionController@exportReportCalifP2Q2Excel');   
    Route::post('/calificacion/cursos/materias/exportReportCalifQ2Excel','App\Http\Controllers\Administrador\CalificacionController@exportReportCalifQ2Excel');   
    Route::any("/calificacion/index/search",[CalificacionController::class, 'search']);
    Route::any("/calificacion/cursos/searchcurso",[CalificacionController::class, 'searchcurso']);

    // Comportamiento - Administrador
    Route::get("/comportamiento/index",[ComportamientoController::class, 'index']);
    Route::get("/comportamiento/asignar/{ofer_id}",[ComportamientoController::class, 'asignar']);
    Route::get("/comportamiento/controlasignacion/{ofer_id}",[ComportamientoController::class, 'controlasignacion']);
    Route::get("/comportamiento/controlasignacion/edit/{cond_id}",[ComportamientoController::class, 'edit']);
    Route::get("/comportamiento/controlasignacion/reemplazar/{cond_id}",[ComportamientoController::class, 'reemplazar']);
    Route::post("/comportamiento/controlasignacion/update",[ComportamientoController::class, 'update']);
    Route::post("/comportamiento/store",[ComportamientoController::class, 'store']);
    Route::delete("/comportamiento/controlasignacion/destroy",[ComportamientoController::class, 'destroy']);
    Route::get("/comportamiento/consultar-comportamiento-prom-q1/{ofer_id}",[ComportamientoController::class, 'consultarPromCompQ1']);
    Route::get("/comportamiento/consultar-comportamiento-prom-q2/{ofer_id}",[ComportamientoController::class, 'consultarPromCompQ2']);
    Route::get("/comportamiento/consultar-comportamiento-prom-anual/{ofer_id}",[ComportamientoController::class, 'consultarPromCompAnual']);
    Route::get("/comportamiento/cursos",[ComportamientoController::class, 'cursos']);
    Route::get("/comportamiento/cursos/consultar-comportamiento-prom-q1/{ofer_id}",[ComportamientoController::class, 'consultarPromComporQ1']);
    Route::get("/comportamiento/cursos/consultar-comportamiento-prom-q2/{ofer_id}",[ComportamientoController::class, 'consultarPromComporQ2']);
    Route::get("/comportamiento/cursos/consultar-comportamiento-prom-anual/{ofer_id}",[ComportamientoController::class, 'consultarPromComporAnual']);
    Route::post('/comportamiento/cursos/generarPDFCompPromQ1','App\Http\Controllers\Administrador\ComportamientoController@generarPDFCompPromQ1');   
    Route::post('/comportamiento/cursos/generarPDFCompPromQ2','App\Http\Controllers\Administrador\ComportamientoController@generarPDFCompPromQ2');
    Route::post('/comportamiento/cursos/generarPDFCompPromAnual','App\Http\Controllers\Administrador\ComportamientoController@generarPDFCompPromAnual');      
    Route::any("/comportamiento/index/search",[ComportamientoController::class, 'search']);
    Route::any("/comportamiento/cursos/searchcurso",[ComportamientoController::class, 'searchcurso']);

    // Proyecto Escolar - Administrador
    Route::get("/proyectoescolar/index",[ProyEscolarController::class, 'index']);
    Route::get("/proyectoescolar/asignar/{ofer_id}",[ProyEscolarController::class, 'asignar']);
    Route::get("/proyectoescolar/seleccionlista/{ofer_id}",[ProyEscolarController::class, 'seleccionlista']);
    Route::get("/proyectoescolar/seleccionlista/controlasignacion/{tutproy_id}",[ProyEscolarController::class, 'controlasignacion']);
    Route::get("/proyectoescolar/seleccionlista/controlasignacion/edit/{proy_id}",[ProyEscolarController::class, 'edit']);
    Route::get("/proyectoescolar/seleccionlista/controlasignacion/reemplazar/{proy_id}",[ProyEscolarController::class, 'reemplazar']);
    Route::post("/proyectoescolar/seleccionlista/controlasignacion/update",[ProyEscolarController::class, 'update']);
    Route::post("/proyectoescolar/store",[ProyEscolarController::class, 'store']);
    Route::delete("/proyectoescolar/seleccionlista/destroy",[ProyEscolarController::class, 'destroy']);
    Route::get("/proyectoescolar/seleccionlista/consultar-calificacion-proyecto-escolar-prom-q1/{tutproy_id}",[ProyEscolarController::class, 'consultarPromProyEscQ1']);
    Route::get("/proyectoescolar/seleccionlista/consultar-calificacion-proyecto-escolar-prom-q2/{tutproy_id}",[ProyEscolarController::class, 'consultarPromProyEscQ2']);
    Route::get("/proyectoescolar/seleccionlista/consultar-calificacion-proyecto-escolar-prom/{tutproy_id}",[ProyEscolarController::class, 'consultarPromProyEsc']);
    Route::get("/proyectoescolar/cursos/consultar-calificacion-proyecto-escolar-prom-q1/{tutproy_id}",[ProyEscolarController::class, 'consulPromProyEscQ1']);
    Route::get("/proyectoescolar/cursos/consultar-calificacion-proyecto-escolar-prom-q2/{tutproy_id}",[ProyEscolarController::class, 'consulPromProyEscQ2']);
    Route::get("/proyectoescolar/cursos/consultar-calificacion-proyecto-escolar-prom/{tutproy_id}",[ProyEscolarController::class, 'consulPromProyEsc']);
    Route::get("/proyectoescolar/cursos",[ProyEscolarController::class, 'cursos']);
    Route::post('/proyectoescolar/cursos/generarPDFProyEscPromP1Q1','App\Http\Controllers\Administrador\ProyEscolarController@generarPDFProyEscPromP1Q1');
    Route::post('/proyectoescolar/cursos/generarPDFProyEscPromP2Q1','App\Http\Controllers\Administrador\ProyEscolarController@generarPDFProyEscPromP2Q1');
    Route::post('/proyectoescolar/cursos/generarPDFProyEscPromQ1','App\Http\Controllers\Administrador\ProyEscolarController@generarPDFProyEscPromQ1');
    Route::post('/proyectoescolar/cursos/generarPDFProyEscPromP1Q2','App\Http\Controllers\Administrador\ProyEscolarController@generarPDFProyEscPromP1Q2');   
    Route::post('/proyectoescolar/cursos/generarPDFProyEscPromP2Q2','App\Http\Controllers\Administrador\ProyEscolarController@generarPDFProyEscPromP2Q2');   
    Route::post('/proyectoescolar/cursos/generarPDFProyEscPromQ2','App\Http\Controllers\Administrador\ProyEscolarController@generarPDFProyEscPromQ2');
    Route::post('/proyectoescolar/cursos/generarPDFProyEscPromAnual','App\Http\Controllers\Administrador\ProyEscolarController@generarPDFProyEscPromAnual');   
    Route::any("/proyectoescolar/index/search",[ProyEscolarController::class, 'search']);
    Route::any("/proyectoescolar/cursos/searchcurso",[ProyEscolarController::class, 'searchcurso']);
});

// Ruta Secretario/a
Route::prefix('secretario')->middleware(['auth','isSecretario'])->group(function()
{
    // Dashboard - Secretario
    Route::get("/dashboard",[SecretarioController::class, 'secretarioDashboard'])->name("secretario.dashboard");

    // Datos Personales - Secretario
    Route::get("/editar-datos-personales/{id}",[SecretarioController::class, 'editarDatos']);
    Route::post("/editar-datos-personales/update",[SecretarioController::class, 'update']);
    Route::get("/cambiar-password/{id}",[SecretarioController::class, 'cambiarPassword']);
    Route::post("/cambiar-password/update-password",[SecretarioController::class, 'updatePassword']);

    // Personal - Secretario
    Route::get("/personal/index",[PersonController::class, 'index']);
    Route::get("/personal/create",[PersonController::class, 'create']);
    Route::post("/personal/store",[PersonController::class, 'store']);
    Route::post("/personal/update",[PersonController::class, 'update']);
    Route::post("/personal/password",[PersonController::class, 'password']);
    Route::get("/personal/edit/{pers_id}",[PersonController::class, 'edit']);
    Route::delete("/personal/destroy",[PersonController::class, 'destroy']);
    Route::any("/personal/index/search",[PersonController::class, 'search']);
    Route::get('/personal/show/{pers_id}',[PersonController::class, 'show']);

    // Usuario - Secretario
    Route::get("/users/index",[UsuarioController::class, 'index']);
    Route::get("/users/create/{pers_id}",[PersonController::class, 'createuserpersonal']);
    Route::get("/users/createalumuser/{alum_id}",[AlumnController::class, 'createalumuser']);
    Route::post("/users/store",[UsuarioController::class, 'store']);
    Route::post("/users/update",[UsuarioController::class, 'update']);
    Route::get("/users/password/{id}",[UsuarioController::class, 'password']);
    Route::post("/users/updatepassword",[UsuarioController::class, 'updatepassword']);
    Route::get("/users/edit/{id}",[UsuarioController::class, 'edit']);
    Route::delete("/users/destroy",[UsuarioController::class, 'destroy']);
    Route::any("/users/index/search",[UsuarioController::class, 'search']);
    Route::get('/users/show/{id}',[UsuarioController::class, 'show']);

    // Alumno - Secretario
    Route::get("/alumno/index",[AlumnController::class, 'index']);
    Route::get("/alumno/create",[AlumnController::class, 'create']);
    Route::post("/alumno/store",[AlumnController::class, 'store']);
    Route::post("/alumno/update",[AlumnController::class, 'update']);
    Route::post("/alumno/password",[AlumnController::class, 'password']);
    Route::get("/alumno/edit/{alum_id}",[AlumnController::class, 'edit']);
    Route::delete("/alumno/destroy",[AlumnController::class, 'destroy']);
    Route::any("/alumno/index/search",[AlumnController::class, 'search']);
    Route::get('/alumno/show/{alum_id}',[AlumnController::class, 'show']);
    Route::get('/alumno/show/elaboracion-ficha/{alum_id}',[AlumnController::class, 'preparacionFicha']);
    Route::post('/alumno/show/elaboracion-ficha/generarFichaMatriculaPDF','App\Http\Controllers\Secretario\AlumnController@generarFichaMatriculaPDF');   

    // Oferta - Secretario
    Route::get("/oferta/index",[OfertaCursoController::class, 'index']);
    Route::get("/oferta/create",[OfertaCursoController::class, 'create']);
    Route::get("/oferta/searchncedula",[OfertaCursoController::class, 'searchncedula']);
    Route::get('/oferta/searchcedula', [OfertaCursoController::class, 'searchcedula']);
    Route::post('/oferta/searchcedula', [OfertaCursoController::class, 'searchcedula']);
    Route::post("/oferta/store",[OfertaCursoController::class, 'store']);
    Route::post("/oferta/update",[OfertaCursoController::class, 'update']);
    Route::get("/oferta/edit/{asig_id}",[OfertaCursoController::class, 'edit']);
    Route::delete("/oferta/destroy",[OfertaCursoController::class, 'destroy']);
    Route::any("/oferta/index/search",[OfertaCursoController::class, 'search']);

    // PadreApoderado - Secretario
    Route::get("/padreapoderado/index",[PadreApodController::class, 'index']);
    Route::get("/padreapoderado/create",[PadreApodController::class, 'create']);
    Route::post("/padreapoderado/store",[PadreApodController::class, 'store']);
    Route::post("/padreapoderado/update",[PadreApodController::class, 'update']);
    Route::post("/padreapoderado/password",[PadreApodController::class, 'password']);
    Route::get("/padreapoderado/edit/{pad_id}",[PadreApodController::class, 'edit']);
    Route::delete("/padreapoderado/destroy",[PadreApodController::class, 'destroy']);
    Route::any("/padreapoderado/index/search",[PadreApodController::class, 'search']);
    Route::get('/padreapoderado/show/{pad_id}',[PadreApodController::class, 'show']);
    Route::get("/padreapoderado/searchncedulaalumno",[PadreApodController::class, 'searchncedulaalumno']);
    Route::get('/padreapoderado/searchcedulaalumno', [PadreApodController::class, 'searchcedulaalumno']);
    Route::post('/padreapoderado/searchcedulaalumno', [PadreApodController::class, 'searchcedulaalumno']);
    Route::get("/padreapoderado/createpadreapoderado/{alum_id}",[AlumnController::class, 'createpadreapoderado']);
    Route::get('/padreapoderado/searchcedulaalumnoedit', [PadreApodController::class, 'searchcedulaalumnoedit']);
    Route::get('/padreapoderado/searchcedulaalumnoedit/{pad_id}', [PadreApodController::class, 'searchcedulaalumnoedit']); 
    Route::post('/padreapoderado/searchcedulaalumnoedit', [PadreApodController::class, 'searchcedulaalumnoedit']);
    Route::get("/padreapoderado/modify/{pad_id}",[PadreApodController::class, 'modify']);

    // Matricula - Secretario
    Route::get("/matricula/index",[MatriculasController::class, 'index']);
    Route::get("/matricula/table",[MatriculasController::class, 'table']);
    Route::get("/matricula/create",[MatriculasController::class, 'create']);
    Route::get("/matricula/searchncedula",[MatriculasController::class, 'searchncedula']);
    Route::post('/matricula/searchcedula', [MatriculasController::class, 'searchcedula']);
    Route::post("/matricula/store",[MatriculasController::class, 'store']);
    Route::get("/matricula/listado/{ofer_id}",[MatriculasController::class, 'listado']);
    Route::get("/matricula/cambiar/{mat_id}",[MatriculasController::class, 'cambiar']);
    Route::post("/matricula/change",[MatriculasController::class, 'change']);
    Route::get("/matricula/reemplazar/{mat_id}",[MatriculasController::class, 'reemplazar']);
    Route::post('/matricula/searchalumnoreemplazar', [MatriculasController::class, 'searchalumnoreemplazar']);
    Route::get("/matricula/reemplazarform/{mat_id}",[MatriculasController::class, 'reemplazarform']);
    Route::post('/matricula/replace', [MatriculasController::class, 'replace']);
    Route::delete("/matricula/destroy",[MatriculasController::class, 'destroy']);
    Route::get('/matricula/generar-lista/{ofer_id}','App\Http\Controllers\Secretario\MatriculasController@generarListaCursoPDF');   
    Route::get('/matricula/elaboracion-ficha/{mat_id}',[MatriculasController::class, 'preparacionFicha']);
    Route::post('/matricula/elaboracion-ficha/generarFichaMatriculaPDF','App\Http\Controllers\Secretario\MatriculasController@generarFichaMatriculaPDF');  
    Route::get('/matricula/listado/elaboracion-ficha/{mat_id}',[MatriculasController::class, 'preparacionFicMatricula']);
    Route::post('/matricula/listado/elaboracion-ficha/generarFicMatriculaPDF','App\Http\Controllers\Secretario\MatriculasController@generarFicMatriculaPDF');  
    Route::any("/matricula/index/search",[MatriculasController::class, 'search']);

    // Calificacion - Secretario
    Route::get("/calificacion/index",[ListCalifController::class, 'index']);
    Route::get("/calificacion/asignar/{ofer_id}",[ListCalifController::class, 'asignar']);
    Route::get("/calificacion/asignaturas/{ofer_id}",[ListCalifController::class, 'asignaturas']);
    Route::get("/calificacion/asignaturas/controlasignacion/{mal_id}",[ListCalifController::class, 'controlasignacion']);
    Route::get("/calificacion/asignaturas/controlasignacion/edit/{cal_id}",[ListCalifController::class, 'edit']);
    Route::get("/calificacion/asignaturas/controlasignacion/reemplazar/{cal_id}",[ListCalifController::class, 'reemplazar']);
    Route::post("/calificacion/asignaturas/controlasignacion/update",[ListCalifController::class, 'update']);
    Route::post("/calificacion/store",[ListCalifController::class, 'store']);
    Route::delete("/calificacion/asignaturas/destroy",[ListCalifController::class, 'destroy']);
    Route::get("/calificacion/asignaturas/controlasignacion/reemplazarform/{cal_id}",[ListCalifController::class, 'reemplazarform']);
    Route::post('/calificacion/asignaturas/controlasignacion/searchalumnoreemplazar', [ListCalifController::class, 'searchalumnoreemplazar']);
    Route::get("/calificacion/cursos",[ListCalifController::class, 'cursos']);
    Route::get("/calificacion/cursos/listado/{ofer_id}",[ListCalifController::class, 'listado']);
    Route::get("/calificacion/cursos/listado/ver-calificacion-q1/{mat_id}",[ListCalifController::class, 'verCalificacionQ1']);
    Route::get("/calificacion/cursos/listado/ver-calificacion-q2/{mat_id}",[ListCalifController::class, 'verCalificacionQ2']);  
    Route::get("/calificacion/cursos/listado/ver-calificacion-anual/{mat_id}",[ListCalifController::class, 'verCalificacionAnual']);  
    Route::get("/calificacion/cursos/materias/{ofer_id}",[ListCalifController::class, 'seleccionarAsignatura']);
    Route::get("/calificacion/cursos/materias/consultar-calificacion-prom-p1q1/{mal_id}",[ListCalifController::class, 'consultarCalifPromP1Q1']);
    Route::get("/calificacion/cursos/materias/consultar-calificacion-prom-p2q1/{mal_id}",[ListCalifController::class, 'consultarCalifPromP2Q1']);
    Route::get("/calificacion/cursos/materias/consultar-calificacion-prom-q1/{mal_id}",[ListCalifController::class, 'consultarCalifPromQ1']);
    Route::get("/calificacion/cursos/materias/consultar-calificacion-prom-p1q2/{mal_id}",[ListCalifController::class, 'consultarCalifPromP1Q2']);
    Route::get("/calificacion/cursos/materias/consultar-calificacion-prom-p2q2/{mal_id}",[ListCalifController::class, 'consultarCalifPromP2Q2']);
    Route::get("/calificacion/cursos/materias/consultar-calificacion-prom-q2/{mal_id}",[ListCalifController::class, 'consultarCalifPromQ2']);
    Route::get("/calificacion/cursos/materias/consultar-calificacion-prom-anual/{mal_id}",[ListCalifController::class, 'consultarCalifPromAnual']);
    Route::post('/calificacion/cursos/materias/generarPDFPromP1Q1','App\Http\Controllers\Secretario\ListCalifController@generarPDFPromP1Q1');   
    Route::post('/calificacion/cursos/materias/generarPDFPromP2Q1','App\Http\Controllers\Secretario\ListCalifController@generarPDFPromP2Q1');
    Route::post('/calificacion/cursos/materias/generarPDFPromQ1','App\Http\Controllers\Secretario\ListCalifController@generarPDFPromQ1');      
    Route::post('/calificacion/cursos/materias/generarPDFPromP1Q2','App\Http\Controllers\Secretario\ListCalifController@generarPDFPromP1Q2');   
    Route::post('/calificacion/cursos/materias/generarPDFPromP2Q2','App\Http\Controllers\Secretario\ListCalifController@generarPDFPromP2Q2');   
    Route::post('/calificacion/cursos/materias/generarPDFPromQ2','App\Http\Controllers\Secretario\ListCalifController@generarPDFPromQ2');
    Route::post('/calificacion/cursos/materias/generarPDFPromAnual','App\Http\Controllers\Secretario\ListCalifController@generarPDFPromAnual');    
    Route::post('/calificacion/cursos/materias/generarPDFCalifAnual','App\Http\Controllers\Secretario\ListCalifController@generarPDFCalifAnual');      
    Route::post('/calificacion/cursos/listado/ver-calificacion-q1/generarPDFPromQ1Certificado/{mat_id}','App\Http\Controllers\Secretario\ListCalifController@generarPDFPromQ1Certificado');          
    Route::post('/calificacion/cursos/listado/ver-calificacion-q2/generarPDFPromQ2Certificado/{mat_id}','App\Http\Controllers\Secretario\ListCalifController@generarPDFPromQ2Certificado');          
    Route::post('/calificacion/cursos/listado/ver-calificacion-anual/generarPDFPromAnualCertificado/{mat_id}','App\Http\Controllers\Secretario\ListCalifController@generarPDFPromAnualCertificado');   
    Route::any("/calificacion/index/search",[ListCalifController::class, 'search']);
    Route::any("/calificacion/cursos/searchcurso",[ListCalifController::class, 'searchcurso']);

    // Comportamiento - Secretario
    Route::get("/comportamiento/index",[ListComporController::class, 'index']);
    Route::get("/comportamiento/asignar/{ofer_id}",[ListComporController::class, 'asignar']);
    Route::get("/comportamiento/controlasignacion/{ofer_id}",[ListComporController::class, 'controlasignacion']);
    Route::get("/comportamiento/controlasignacion/edit/{cond_id}",[ListComporController::class, 'edit']);
    Route::get("/comportamiento/controlasignacion/reemplazar/{cond_id}",[ListComporController::class, 'reemplazar']);
    Route::post("/comportamiento/controlasignacion/update",[ListComporController::class, 'update']);
    Route::post("/comportamiento/store",[ListComporController::class, 'store']);
    Route::delete("/comportamiento/controlasignacion/destroy",[ListComporController::class, 'destroy']);
    Route::get("/comportamiento/cursos",[ListComporController::class, 'cursos']);
    Route::get("/comportamiento/cursos/consultar-comportamiento-prom-q1/{ofer_id}",[ListComporController::class, 'consultarPromCompQ1']);
    Route::get("/comportamiento/cursos/consultar-comportamiento-prom-q2/{ofer_id}",[ListComporController::class, 'consultarPromCompQ2']);
    Route::get("/comportamiento/cursos/consultar-comportamiento-prom-anual/{ofer_id}",[ListComporController::class, 'consultarPromCompAnual']);
    Route::post('/comportamiento/cursos/generarPDFCompPromQ1','App\Http\Controllers\Secretario\ListComporController@generarPDFCompPromQ1');   
    Route::post('/comportamiento/cursos/generarPDFCompPromQ2','App\Http\Controllers\Secretario\ListComporController@generarPDFCompPromQ2');
    Route::post('/comportamiento/cursos/generarPDFCompPromAnual','App\Http\Controllers\Secretario\ListComporController@generarPDFCompPromAnual');      
    Route::any("/comportamiento/index/search",[ListComporController::class, 'search']);
    Route::any("/comportamiento/cursos/searchcurso",[ListComporController::class, 'searchcurso']);

    // Proyecto Escolar - Secretario
    Route::get("/proyectoescolar/index",[ListProyController::class, 'index']);
    Route::get("/proyectoescolar/asignar/{ofer_id}",[ListProyController::class, 'asignar']);
    Route::get("/proyectoescolar/seleccionlista/{ofer_id}",[ListProyController::class, 'seleccionlista']);
    Route::get("/proyectoescolar/seleccionlista/controlasignacion/{tutproy_id}",[ListProyController::class, 'controlasignacion']);
    Route::get("/proyectoescolar/seleccionlista/controlasignacion/edit/{proy_id}",[ListProyController::class, 'edit']);
    Route::get("/proyectoescolar/seleccionlista/controlasignacion/reemplazar/{proy_id}",[ListProyController::class, 'reemplazar']);
    Route::post("/proyectoescolar/seleccionlista/controlasignacion/update",[ListProyController::class, 'update']);
    Route::post("/proyectoescolar/store",[ListProyController::class, 'store']);
    Route::delete("/proyectoescolar/seleccionlista/destroy",[ListProyController::class, 'destroy']);
    Route::get("/proyectoescolar/cursos/consultar-calificacion-proyecto-escolar-prom-q1/{tutproy_id}",[ListProyController::class, 'consultarPromProyEscQ1']);
    Route::get("/proyectoescolar/cursos/consultar-calificacion-proyecto-escolar-prom-q2/{tutproy_id}",[ListProyController::class, 'consultarPromProyEscQ2']);
    Route::get("/proyectoescolar/cursos/consultar-calificacion-proyecto-escolar-prom/{tutproy_id}",[ListProyController::class, 'consultarPromProyEsc']);
    Route::get("/proyectoescolar/cursos",[ListProyController::class, 'cursos']);
    Route::post('/proyectoescolar/cursos/generarPDFProyEscPromP1Q1','App\Http\Controllers\Secretario\ListProyController@generarPDFProyEscPromP1Q1');
    Route::post('/proyectoescolar/cursos/generarPDFProyEscPromP2Q1','App\Http\Controllers\Secretario\ListProyController@generarPDFProyEscPromP2Q1');
    Route::post('/proyectoescolar/cursos/generarPDFProyEscPromQ1','App\Http\Controllers\Secretario\ListProyController@generarPDFProyEscPromQ1');
    Route::post('/proyectoescolar/cursos/generarPDFProyEscPromP1Q2','App\Http\Controllers\Secretario\ListProyController@generarPDFProyEscPromP1Q2');   
    Route::post('/proyectoescolar/cursos/generarPDFProyEscPromP2Q2','App\Http\Controllers\Secretario\ListProyController@generarPDFProyEscPromP2Q2');   
    Route::post('/proyectoescolar/cursos/generarPDFProyEscPromQ2','App\Http\Controllers\Secretario\ListProyController@generarPDFProyEscPromQ2');
    Route::post('/proyectoescolar/cursos/generarPDFProyEscPromAnual','App\Http\Controllers\Secretario\ListProyController@generarPDFProyEscPromAnual');
    Route::any("/proyectoescolar/index/search",[ListProyController::class, 'search']);
    Route::any("/proyectoescolar/cursos/searchcurso",[ListProyController::class, 'searchcurso']);      
});

// Ruta Docente
Route::prefix('docente')->middleware(['auth','isDocente'])->group(function()
{
    // Dashboard - Docente
    Route::get("/dashboard",[DocenteController::class, 'docenteDashboard'])->name("docente.dashboard");

    // Datos Personales - Docente
    Route::get("/editar-datos-personales/{id}",[DocenteController::class, 'editarDatos']);
    Route::post("/editar-datos-personales/update",[DocenteController::class, 'update']);
    Route::get("/cambiar-password/{id}",[DocenteController::class, 'cambiarPassword']);
    Route::post("/cambiar-password/update-password",[DocenteController::class, 'updatePassword']);

    // Calificacion - Docente
    Route::get("/calificacion/asignaturas/{id}",[CalificacionesController::class, 'asignaturas']);
    Route::get("/calificacion/asignaturas/ingresocalificacion/{mal_id}",[CalificacionesController::class, 'ingresocalificacion']);
    Route::post("/calificacion/asignaturas/ingresocalificacion/save",[CalificacionesController::class, 'save']);
    Route::get("/calificacion/asignaturas/consultar-calificacion-prom-p1q1/{mal_id}",[CalificacionesController::class, 'consultarCalifPromP1Q1']);
    Route::get("/calificacion/asignaturas/consultar-calificacion-prom-p2q1/{mal_id}",[CalificacionesController::class, 'consultarCalifPromP2Q1']);
    Route::get("/calificacion/asignaturas/consultar-calificacion-prom-q1/{mal_id}",[CalificacionesController::class, 'consultarCalifPromQ1']);
    Route::get("/calificacion/asignaturas/consultar-calificacion-prom-p1q2/{mal_id}",[CalificacionesController::class, 'consultarCalifPromP1Q2']);
    Route::get("/calificacion/asignaturas/consultar-calificacion-prom-p2q2/{mal_id}",[CalificacionesController::class, 'consultarCalifPromP2Q2']);
    Route::get("/calificacion/asignaturas/consultar-calificacion-prom-q2/{mal_id}",[CalificacionesController::class, 'consultarCalifPromQ2']);
    Route::get("/calificacion/asignaturas/consultar-calificacion-prom-anual/{mal_id}",[CalificacionesController::class, 'consultarCalifPromAnual']);
    Route::get("/calificacion/cursos/{id}",[CalificacionesController::class, 'cursos']);
    Route::get("/calificacion/curso-actual/{id}",[CalificacionesController::class, 'cursoActual']);
    Route::get("/calificacion/cursos/listado/{ofer_id}",[CalificacionesController::class, 'listado']);
    Route::get("/calificacion/cursos/listado/ver-calificacion-q1/{mat_id}",[CalificacionesController::class, 'verCalificacionQ1']);
    Route::get("/calificacion/cursos/listado/ver-calificacion-q2/{mat_id}",[CalificacionesController::class, 'verCalificacionQ2']);  
    Route::get("/calificacion/cursos/listado/ver-calificacion-anual/{mat_id}",[CalificacionesController::class, 'verCalificacionAnual']);  
    Route::get("/calificacion/cursos/materias/{ofer_id}",[CalificacionesController::class, 'seleccionarAsignatura']);
    Route::get("/calificacion/curso-actual/materias/{ofer_id}",[CalificacionesController::class, 'seleccionarAsignaturaCursActual']);
    Route::get("/calificacion/cursos/materias/consultar-calificacion-prom-p1q1/{mal_id}",[CalificacionesController::class, 'consultarCalPromP1Q1']);
    Route::get("/calificacion/cursos/materias/consultar-calificacion-prom-p2q1/{mal_id}",[CalificacionesController::class, 'consultarCalPromP2Q1']);
    Route::get("/calificacion/cursos/materias/consultar-calificacion-prom-q1/{mal_id}",[CalificacionesController::class, 'consultarCalPromQ1']);
    Route::get("/calificacion/cursos/materias/consultar-calificacion-prom-p1q2/{mal_id}",[CalificacionesController::class, 'consultarCalPromP1Q2']);
    Route::get("/calificacion/cursos/materias/consultar-calificacion-prom-p2q2/{mal_id}",[CalificacionesController::class, 'consultarCalPromP2Q2']);
    Route::get("/calificacion/cursos/materias/consultar-calificacion-prom-q2/{mal_id}",[CalificacionesController::class, 'consultarCalPromQ2']);
    Route::get("/calificacion/cursos/materias/consultar-calificacion-prom-anual/{mal_id}",[CalificacionesController::class, 'consultarCalPromAnual']);
    Route::get("/calificacion/curso-actual/materias/consultar-calificacion-prom-p1q1/{mal_id}",[CalificacionesController::class, 'consultarCalPromP1Q1CurActual']);
    Route::get("/calificacion/curso-actual/materias/consultar-calificacion-prom-p2q1/{mal_id}",[CalificacionesController::class, 'consultarCalPromP2Q1CurActual']);
    Route::get("/calificacion/curso-actual/materias/consultar-calificacion-prom-q1/{mal_id}",[CalificacionesController::class, 'consultarCalPromQ1CurActual']);
    Route::get("/calificacion/curso-actual/materias/consultar-calificacion-prom-p1q2/{mal_id}",[CalificacionesController::class, 'consultarCalPromP1Q2CurActual']);
    Route::get("/calificacion/curso-actual/materias/consultar-calificacion-prom-p2q2/{mal_id}",[CalificacionesController::class, 'consultarCalPromP2Q2CurActual']);
    Route::get("/calificacion/curso-actual/materias/consultar-calificacion-prom-q2/{mal_id}",[CalificacionesController::class, 'consultarCalPromQ2CurActual']);
    Route::get("/calificacion/curso-actual/materias/consultar-calificacion-prom-anual/{mal_id}",[CalificacionesController::class, 'consultarCalPromAnualCurActual']);
    Route::post('/calificacion/asignaturas/generarPDFPromP1Q1','App\Http\Controllers\Docente\CalificacionesController@generarPDFPromP1Q1');   
    Route::post('/calificacion/asignaturas/generarPDFPromP2Q1','App\Http\Controllers\Docente\CalificacionesController@generarPDFPromP2Q1');
    Route::post('/calificacion/asignaturas/generarPDFPromQ1','App\Http\Controllers\Docente\CalificacionesController@generarPDFPromQ1');      
    Route::post('/calificacion/asignaturas/generarPDFPromP1Q2','App\Http\Controllers\Docente\CalificacionesController@generarPDFPromP1Q2');   
    Route::post('/calificacion/asignaturas/generarPDFPromP2Q2','App\Http\Controllers\Docente\CalificacionesController@generarPDFPromP2Q2');   
    Route::post('/calificacion/asignaturas/generarPDFPromQ2','App\Http\Controllers\Docente\CalificacionesController@generarPDFPromQ2');
    Route::post('/calificacion/asignaturas/generarPDFPromAnual','App\Http\Controllers\Docente\CalificacionesController@generarPDFPromAnual');    
    Route::post('/calificacion/asignaturas/generarPDFCalifAnual','App\Http\Controllers\Docente\CalificacionesController@generarPDFCalifAnual');      
    Route::post('/calificacion/cursos/materias/generarPDFPromCalifP1Q1','App\Http\Controllers\Docente\CalificacionesController@generarPDFPromCalifP1Q1');   
    Route::post('/calificacion/cursos/materias/generarPDFPromCalifP2Q1','App\Http\Controllers\Docente\CalificacionesController@generarPDFPromCalifP2Q1');
    Route::post('/calificacion/cursos/materias/generarPDFPromCalifQ1','App\Http\Controllers\Docente\CalificacionesController@generarPDFPromCalifQ1');      
    Route::post('/calificacion/cursos/materias/generarPDFPromCalifP1Q2','App\Http\Controllers\Docente\CalificacionesController@generarPDFPromCalifP1Q2');   
    Route::post('/calificacion/cursos/materias/generarPDFPromCalifP2Q2','App\Http\Controllers\Docente\CalificacionesController@generarPDFPromCalifP2Q2');   
    Route::post('/calificacion/cursos/materias/generarPDFPromCalifQ2','App\Http\Controllers\Docente\CalificacionesController@generarPDFPromCalifQ2');
    Route::post('/calificacion/cursos/materias/generarPDFPromCalifAnual','App\Http\Controllers\Docente\CalificacionesController@generarPDFPromCalifAnual');    
    Route::post('/calificacion/cursos/materias/generarPDFCalifPromAnual','App\Http\Controllers\Docente\CalificacionesController@generarPDFCalifPromAnual');  
    Route::post('/calificacion/curso-actual/materias/generarPDFPromCalifP1Q1','App\Http\Controllers\Docente\CalificacionesController@generarPDFPromCalifP1Q1CurActual');   
    Route::post('/calificacion/curso-actual/materias/generarPDFPromCalifP2Q1','App\Http\Controllers\Docente\CalificacionesController@generarPDFPromCalifP2Q1CurActual');
    Route::post('/calificacion/curso-actual/materias/generarPDFPromCalifQ1','App\Http\Controllers\Docente\CalificacionesController@generarPDFPromCalifQ1CurActual');      
    Route::post('/calificacion/curso-actual/materias/generarPDFPromCalifP1Q2','App\Http\Controllers\Docente\CalificacionesController@generarPDFPromCalifP1Q2CurActual');   
    Route::post('/calificacion/curso-actual/materias/generarPDFPromCalifP2Q2','App\Http\Controllers\Docente\CalificacionesController@generarPDFPromCalifP2Q2CurActual');   
    Route::post('/calificacion/curso-actual/materias/generarPDFPromCalifQ2','App\Http\Controllers\Docente\CalificacionesController@generarPDFPromCalifQ2CurActual');
    Route::post('/calificacion/curso-actual/materias/generarPDFPromCalifAnual','App\Http\Controllers\Docente\CalificacionesController@generarPDFPromCalifAnualCurActual');    
    Route::post('/calificacion/curso-actual/materias/generarPDFCalifPromAnual','App\Http\Controllers\Docente\CalificacionesController@generarPDFCalifPromAnualCurActual');      
    Route::post('/calificacion/cursos/listado/ver-calificacion-q1/generarPDFPromQ1Certificado/{mat_id}','App\Http\Controllers\Docente\CalificacionesController@generarPDFPromQ1Certificado');          
    Route::post('/calificacion/cursos/listado/ver-calificacion-q2/generarPDFPromQ2Certificado/{mat_id}','App\Http\Controllers\Docente\CalificacionesController@generarPDFPromQ2Certificado');          
    Route::post('/calificacion/cursos/listado/ver-calificacion-anual/generarPDFPromAnualCertificado/{mat_id}','App\Http\Controllers\Docente\CalificacionesController@generarPDFPromAnualCertificado');

    // Comportamiento - Docente
    Route::get("/comportamiento/cursos/{id}",[ComportamientosController::class, 'cursos']);
    Route::get("/comportamiento/cursos/ingreso-comportamiento/{ofer_id}",[ComportamientosController::class, 'ingresoComportamiento']);
    Route::post("/comportamiento/cursos/ingreso-comportamiento/save",[ComportamientosController::class, 'save']);
    Route::get("/comportamiento/cursos/consultar-comportamiento-prom-q1/{ofer_id}",[ComportamientosController::class, 'consultarPromCompQ1']);
    Route::get("/comportamiento/cursos/consultar-comportamiento-prom-q2/{ofer_id}",[ComportamientosController::class, 'consultarPromCompQ2']);
    Route::get("/comportamiento/cursos/consultar-comportamiento-prom-anual/{ofer_id}",[ComportamientosController::class, 'consultarPromCompAnual']);
    Route::post('/comportamiento/cursos/generarPDFCompPromQ1','App\Http\Controllers\Docente\ComportamientosController@generarPDFCompPromQ1');   
    Route::post('/comportamiento/cursos/generarPDFCompPromQ2','App\Http\Controllers\Docente\ComportamientosController@generarPDFCompPromQ2');
    Route::post('/comportamiento/cursos/generarPDFCompPromAnual','App\Http\Controllers\Docente\ComportamientosController@generarPDFCompPromAnual');      

    // Proyecto Escolar - Docente
    Route::get("/proyescolar/cursos/{id}",[ProyEscolarCalController::class, 'cursos']);
    Route::get("/proyescolar/cursos/ingreso-calificacion-proyecto/{tutproy_id}",[ProyEscolarCalController::class, 'ingresoCalificacionProyecto']);
    Route::post("/proyescolar/cursos/ingreso-calificacion-proyecto/save",[ProyEscolarCalController::class, 'save']);
    Route::get("/proyescolar/cursos/consultar-calificacion-proyecto-escolar-prom-q1/{tutproy_id}",[ProyEscolarCalController::class, 'consultarPromProyEscQ1']);
    Route::get("/proyescolar/cursos/consultar-calificacion-proyecto-escolar-prom-q2/{tutproy_id}",[ProyEscolarCalController::class, 'consultarPromProyEscQ2']);
    Route::get("/proyescolar/cursos/consultar-calificacion-proyecto-escolar-prom/{tutproy_id}",[ProyEscolarCalController::class, 'consultarPromProyEsc']);
    Route::get("/proyescolar/aulas/{id}",[ProyEscolarCalController::class, 'aulas']);
    Route::get("/proyescolar/curso-actual/{id}",[ProyEscolarCalController::class, 'cursoActual']);
    Route::get("/proyescolar/aulas/curso-proyecto/{ofer_id}",[ProyEscolarCalController::class, 'seleccionLista']);
    Route::get("/proyescolar/curso-actual/curso-proyecto/{ofer_id}",[ProyEscolarCalController::class, 'seleccionListaCurActual']);
    Route::get("/proyescolar/aulas/curso-proyecto/consultar-calificacion-proyecto-escolar-prom-q1/{tutproy_id}",[ProyEscolarCalController::class, 'consulPromProyEscQ1']);
    Route::get("/proyescolar/aulas/curso-proyecto/consultar-calificacion-proyecto-escolar-prom-q2/{tutproy_id}",[ProyEscolarCalController::class, 'consulPromProyEscQ2']);
    Route::get("/proyescolar/aulas/curso-proyecto/consultar-calificacion-proyecto-escolar-prom/{tutproy_id}",[ProyEscolarCalController::class, 'consulPromProyEsc']);
    Route::get("/proyescolar/curso-actual/curso-proyecto/consultar-calificacion-proyecto-escolar-prom-q1/{tutproy_id}",[ProyEscolarCalController::class, 'consulPromProyEscQ1CurActual']);
    Route::get("/proyescolar/curso-actual/curso-proyecto/consultar-calificacion-proyecto-escolar-prom-q2/{tutproy_id}",[ProyEscolarCalController::class, 'consulPromProyEscQ2CurActual']);
    Route::get("/proyescolar/curso-actual/curso-proyecto/consultar-calificacion-proyecto-escolar-prom/{tutproy_id}",[ProyEscolarCalController::class, 'consulPromProyEscCurActual']);
    Route::post('/proyescolar/cursos/generarPDFProyEscPromP1Q1','App\Http\Controllers\Docente\ProyEscolarCalController@generarPDFProyEscPromP1Q1');
    Route::post('/proyescolar/cursos/generarPDFProyEscPromP2Q1','App\Http\Controllers\Docente\ProyEscolarCalController@generarPDFProyEscPromP2Q1');
    Route::post('/proyescolar/cursos/generarPDFProyEscPromQ1','App\Http\Controllers\Docente\ProyEscolarCalController@generarPDFProyEscPromQ1');
    Route::post('/proyescolar/cursos/generarPDFProyEscPromP1Q2','App\Http\Controllers\Docente\ProyEscolarCalController@generarPDFProyEscPromP1Q2');   
    Route::post('/proyescolar/cursos/generarPDFProyEscPromP2Q2','App\Http\Controllers\Docente\ProyEscolarCalController@generarPDFProyEscPromP2Q2');   
    Route::post('/proyescolar/cursos/generarPDFProyEscPromQ2','App\Http\Controllers\Docente\ProyEscolarCalController@generarPDFProyEscPromQ2');
    Route::post('/proyescolar/cursos/generarPDFProyEscPromAnual','App\Http\Controllers\Docente\ProyEscolarCalController@generarPDFProyEscPromAnual');     
    Route::post('/proyescolar/aulas/curso-proyecto/generarPDFProyEscolarPromP1Q1','App\Http\Controllers\Docente\ProyEscolarCalController@generarPDFProyEscolarPromP1Q1');
    Route::post('/proyescolar/aulas/curso-proyecto/generarPDFProyEscolarPromP2Q1','App\Http\Controllers\Docente\ProyEscolarCalController@generarPDFProyEscolarPromP2Q1');
    Route::post('/proyescolar/aulas/curso-proyecto/generarPDFProyEscolarPromQ1','App\Http\Controllers\Docente\ProyEscolarCalController@generarPDFProyEscolarPromQ1');
    Route::post('/proyescolar/aulas/curso-proyecto/generarPDFProyEscolarPromP1Q2','App\Http\Controllers\Docente\ProyEscolarCalController@generarPDFProyEscolarPromP1Q2');   
    Route::post('/proyescolar/aulas/curso-proyecto/generarPDFProyEscolarPromP2Q2','App\Http\Controllers\Docente\ProyEscolarCalController@generarPDFProyEscolarPromP2Q2');   
    Route::post('/proyescolar/aulas/curso-proyecto/generarPDFProyEscolarPromQ2','App\Http\Controllers\Docente\ProyEscolarCalController@generarPDFProyEscolarPromQ2');
    Route::post('/proyescolar/aulas/curso-proyecto/generarPDFProyEscolarPromAnual','App\Http\Controllers\Docente\ProyEscolarCalController@generarPDFProyEscolarPromAnual'); 
    Route::post('/proyescolar/curso-actual/curso-proyecto/generarPDFProyEscolarPromP1Q1','App\Http\Controllers\Docente\ProyEscolarCalController@generarPDFProyEscolarPromP1Q1CurActual');
    Route::post('/proyescolar/curso-actual/curso-proyecto/generarPDFProyEscolarPromP2Q1','App\Http\Controllers\Docente\ProyEscolarCalController@generarPDFProyEscolarPromP2Q1CurActual');
    Route::post('/proyescolar/curso-actual/curso-proyecto/generarPDFProyEscolarPromQ1','App\Http\Controllers\Docente\ProyEscolarCalController@generarPDFProyEscolarPromQ1CurActual');
    Route::post('/proyescolar/curso-actual/curso-proyecto/generarPDFProyEscolarPromP1Q2','App\Http\Controllers\Docente\ProyEscolarCalController@generarPDFProyEscolarPromP1Q2CurActual');   
    Route::post('/proyescolar/curso-actual/curso-proyecto/generarPDFProyEscolarPromP2Q2','App\Http\Controllers\Docente\ProyEscolarCalController@generarPDFProyEscolarPromP2Q2CurActual');   
    Route::post('/proyescolar/curso-actual/curso-proyecto/generarPDFProyEscolarPromQ2','App\Http\Controllers\Docente\ProyEscolarCalController@generarPDFProyEscolarPromQ2CurActual');
    Route::post('/proyescolar/curso-actual/curso-proyecto/generarPDFProyEscolarPromAnual','App\Http\Controllers\Docente\ProyEscolarCalController@generarPDFProyEscolarPromAnualCurActual');             
});

// Ruta Rector/a
Route::prefix('rector')->middleware(['auth','isRector'])->group(function()
{
    // Dashboard - Rector
    Route::get("/dashboard",[RectorController::class, 'rectorDashboard'])->name("rector.dashboard");

    // Datos Personales - Rector
    Route::get("/editar-datos-personales/{id}",[RectorController::class, 'editarDatos']);
    Route::post("/editar-datos-personales/update",[RectorController::class, 'update']);
    Route::get("/cambiar-password/{id}",[RectorController::class, 'cambiarPassword']);
    Route::post("/cambiar-password/update-password",[RectorController::class, 'updatePassword']);

    // Matricula - Rector
    Route::get("/matricula/index",[AlumnosController::class, 'index']);
    Route::get("/matricula/listado/{ofer_id}",[AlumnosController::class, 'listado']);
    Route::get('/matricula/generar-lista/{ofer_id}','App\Http\Controllers\Rector\AlumnosController@generarListaCursoPDF');   
    Route::any("/matricula/index/search",[AlumnosController::class, 'search']);

    // PadreApoderado - Rector
    Route::get("/padreapoderado/index",[PadreApoderadoController::class, 'index']);

    // Calificacion - Rector
    Route::get("/calificacion/cursos",[CalifController::class, 'cursos']);
    Route::get("/calificacion/cursos/materias/{ofer_id}",[CalifController::class, 'seleccionarAsignatura']);
    Route::get("/calificacion/cursos/listado/{ofer_id}",[CalifController::class, 'listado']);
    Route::get("/calificacion/cursos/listado/ver-calificacion-q1/{mat_id}",[CalifController::class, 'verCalificacionQ1']);
    Route::get("/calificacion/cursos/listado/ver-calificacion-q2/{mat_id}",[CalifController::class, 'verCalificacionQ2']);  
    Route::get("/calificacion/cursos/listado/ver-calificacion-anual/{mat_id}",[CalifController::class, 'verCalificacionAnual']);  
    Route::get("/calificacion/cursos/materias/consultar-calificacion-prom-p1q1/{mal_id}",[CalifController::class, 'consultarCalifPromP1Q1']);
    Route::get("/calificacion/cursos/materias/consultar-calificacion-prom-p2q1/{mal_id}",[CalifController::class, 'consultarCalifPromP2Q1']);
    Route::get("/calificacion/cursos/materias/consultar-calificacion-prom-q1/{mal_id}",[CalifController::class, 'consultarCalifPromQ1']);
    Route::get("/calificacion/cursos/materias/consultar-calificacion-prom-p1q2/{mal_id}",[CalifController::class, 'consultarCalifPromP1Q2']);
    Route::get("/calificacion/cursos/materias/consultar-calificacion-prom-p2q2/{mal_id}",[CalifController::class, 'consultarCalifPromP2Q2']);
    Route::get("/calificacion/cursos/materias/consultar-calificacion-prom-q2/{mal_id}",[CalifController::class, 'consultarCalifPromQ2']);
    Route::get("/calificacion/cursos/materias/consultar-calificacion-prom-anual/{mal_id}",[CalifController::class, 'consultarCalifPromAnual']);
    Route::post('/calificacion/cursos/materias/generarPDFPromP1Q1','App\Http\Controllers\Rector\CalifController@generarPDFPromP1Q1');   
    Route::post('/calificacion/cursos/materias/generarPDFPromP2Q1','App\Http\Controllers\Rector\CalifController@generarPDFPromP2Q1');
    Route::post('/calificacion/cursos/materias/generarPDFPromQ1','App\Http\Controllers\Rector\CalifController@generarPDFPromQ1');      
    Route::post('/calificacion/cursos/materias/generarPDFPromP1Q2','App\Http\Controllers\Rector\CalifController@generarPDFPromP1Q2');   
    Route::post('/calificacion/cursos/materias/generarPDFPromP2Q2','App\Http\Controllers\Rector\CalifController@generarPDFPromP2Q2');   
    Route::post('/calificacion/cursos/materias/generarPDFPromQ2','App\Http\Controllers\Rector\CalifController@generarPDFPromQ2');
    Route::post('/calificacion/cursos/materias/generarPDFPromAnual','App\Http\Controllers\Rector\CalifController@generarPDFPromAnual');    
    Route::post('/calificacion/cursos/materias/generarPDFCalifAnual','App\Http\Controllers\Rector\CalifController@generarPDFCalifAnual');      
    Route::post('/calificacion/cursos/listado/ver-calificacion-q1/generarPDFPromQ1Certificado/{mat_id}','App\Http\Controllers\Rector\CalifController@generarPDFPromQ1Certificado');          
    Route::post('/calificacion/cursos/listado/ver-calificacion-q2/generarPDFPromQ2Certificado/{mat_id}','App\Http\Controllers\Rector\CalifController@generarPDFPromQ2Certificado');          
    Route::post('/calificacion/cursos/listado/ver-calificacion-anual/generarPDFPromAnualCertificado/{mat_id}','App\Http\Controllers\Rector\CalifController@generarPDFPromAnualCertificado');   
    Route::any("/calificacion/cursos/search",[CalifController::class, 'search']);

    // Comportamiento - Rector
    Route::get("/comportamiento/cursos",[ComporController::class, 'cursos']);
    Route::get("/comportamiento/cursos/consultar-comportamiento-prom-q1/{ofer_id}",[ComporController::class, 'consultarPromCompQ1']);
    Route::get("/comportamiento/cursos/consultar-comportamiento-prom-q2/{ofer_id}",[ComporController::class, 'consultarPromCompQ2']);
    Route::get("/comportamiento/cursos/consultar-comportamiento-prom-anual/{ofer_id}",[ComporController::class, 'consultarPromCompAnual']);
    Route::post('/comportamiento/cursos/generarPDFCompPromQ1','App\Http\Controllers\Rector\ComporController@generarPDFCompPromQ1');   
    Route::post('/comportamiento/cursos/generarPDFCompPromQ2','App\Http\Controllers\Rector\ComporController@generarPDFCompPromQ2');
    Route::post('/comportamiento/cursos/generarPDFCompPromAnual','App\Http\Controllers\Rector\ComporController@generarPDFCompPromAnual');      
    Route::any("/comportamiento/cursos/search",[ComporController::class, 'search']);

    // Proyecto Escolar - Rector
    Route::get("/proyectoescolar/cursos/consultar-calificacion-proyecto-escolar-prom-q1/{tutproy_id}",[ProyEscController::class, 'consultarPromProyEscQ1']);
    Route::get("/proyectoescolar/cursos/consultar-calificacion-proyecto-escolar-prom-q2/{tutproy_id}",[ProyEscController::class, 'consultarPromProyEscQ2']);
    Route::get("/proyectoescolar/cursos/consultar-calificacion-proyecto-escolar-prom/{tutproy_id}",[ProyEscController::class, 'consultarPromProyEsc']);
    Route::get("/proyectoescolar/cursos",[ProyEscController::class, 'cursos']);
    Route::post('/proyectoescolar/cursos/generarPDFProyEscPromP1Q1','App\Http\Controllers\Rector\ProyEscController@generarPDFProyEscPromP1Q1');
    Route::post('/proyectoescolar/cursos/generarPDFProyEscPromP2Q1','App\Http\Controllers\Rector\ProyEscController@generarPDFProyEscPromP2Q1');
    Route::post('/proyectoescolar/cursos/generarPDFProyEscPromQ1','App\Http\Controllers\Rector\ProyEscController@generarPDFProyEscPromQ1');
    Route::post('/proyectoescolar/cursos/generarPDFProyEscPromP1Q2','App\Http\Controllers\Rector\ProyEscController@generarPDFProyEscPromP1Q2');   
    Route::post('/proyectoescolar/cursos/generarPDFProyEscPromP2Q2','App\Http\Controllers\Rector\ProyEscController@generarPDFProyEscPromP2Q2');   
    Route::post('/proyectoescolar/cursos/generarPDFProyEscPromQ2','App\Http\Controllers\Rector\ProyEscController@generarPDFProyEscPromQ2');
    Route::post('/proyectoescolar/cursos/generarPDFProyEscPromAnual','App\Http\Controllers\Rector\ProyEscController@generarPDFProyEscPromAnual');      
});

// Ruta Alumno/a
Route::prefix('alumno')->middleware(['auth','isAlumno'])->group(function()
{
    // Dashboard - Alumno
    Route::get("/dashboard",[AlumnoController::class, 'alumnoDashboard'])->name("alumno.dashboard");

    // Datos Personales - Alumno
    Route::get("/editar-datos-personales/{id}",[AlumnoController::class, 'editarDatos']);
    Route::post("/editar-datos-personales/update",[AlumnoController::class, 'update']);
    Route::get("/cambiar-password/{id}",[AlumnoController::class, 'cambiarPassword']);
    Route::post("/cambiar-password/update-password",[AlumnoController::class, 'updatePassword']);
    
    // Calificaciones - Alumno
    Route::get("/calificacion/cursos/{id}",[CalifAlumController::class, 'cursos']);
    Route::get("/calificacion/cursos/consultar-calificaciones/{mat_id}",[CalifAlumController::class, 'consultarCalificacion']); 
    
    // Comportamiento - Alumno
    Route::get("/comportamiento/cursos/{id}",[ComporAlumController::class, 'cursos']);
    Route::get("/comportamiento/cursos/consultar-calificaciones-comportamiento/{mat_id}",[ComporAlumController::class, 'consultarCalifComportamiento']); 

    // Proyecto Escolar - Alumno
    Route::get("/proyecto-escolar/cursos/{id}",[ProyEscAlumController::class, 'cursos']);
    Route::get("/proyecto-escolar/cursos/consultar-calificaciones-proyecto-escolar/{mat_id}",[ProyEscAlumController::class, 'consultarCalifProyEscolar']); 
});

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
