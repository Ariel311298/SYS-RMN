@extends('backend.app')

@section('title')
Modulo Docente - Listado de Estudiantes - {{$ofertas->curso->cur_nombre}} {{$ofertas->curso->cur_paralelo}}
@endsection

<style>
    .table-count {
        counter-reset: serial-number; 
    }
    .table-count td:first-child:before {
        counter-increment: serial-number;  /* Incrementa el contador de las columnas. */
        content: counter(serial-number);  /* Muestra el contador. */
    }
</style>

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) - Modulo Docente - Ver Estudiantes Matriculados -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Listado de estudiantes</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Modulo Docente - Ver Estudiantes Matriculados -->

    <!-- Main content -->
    <section class="content">
        <div class="card">  
            <div class="card-header">
                <h3 class="card-title">Periodo: {{$ofertas->periodo->per_nombre}} / Seccion: {{$ofertas->curso->seccion->sec_nombre}} / Curso: {{$ofertas->curso->cur_nombre}} {{$ofertas->curso->cur_paralelo}} / Tutor de Curso: {{$ofertas->personal->pers_nombres}} {{$ofertas->personal->pers_apellidos}}</h3> 
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="overflow:scroll;">
                <table id="example2" class="table table-bordered table-striped table-count">
                    <thead>
                        <tr align="center">
                            <th>N°</th>
                            <th>Nombres y Apellidos</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alumnos->matriculas as $matricula)   
                        <tr align="center">
                            <td>&nbsp;</td>
                            <td>
                                {{$matricula->alumno->alum_nombres}} {{$matricula->alumno->alum_apellidos}}                                                    
                            </td>
                            <td>
                                @if($matricula->mat_estado == 1)   
                                    <p>Activo</p>
                                @else
                                    <p>Desactivado</p>
                                @endif                                               
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary" title="Consultar Calificaciones"> <i class="fas fa-eye"></i></button>
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item" href="{{url('docente/calificacion/cursos/listado/ver-calificacion-q1', ['mat_id' => $matricula->mat_id])}}">Prom. Quimestral (Q1)</a>
                                    <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{url('docente/calificacion/cursos/listado/ver-calificacion-q2', ['mat_id' => $matricula->mat_id])}}">Prom. Quimestral (Q2)</a>
                                    <div class="dropdown-divider"></div>  
                                        <a class="dropdown-item" href="{{url('docente/calificacion/cursos/listado/ver-calificacion-anual', ['mat_id' => $matricula->mat_id])}}">Prom. Anual</a> 
                                </div>      
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{url('docente/calificacion/cursos', ['pers_id' => $ofertas->pers_id])}}">
                    <button type="button" class="btn btn-warning center-block">
                        Regresar
                        <i class="fas fa-arrow-left"></i>
                    </button>
                </a>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

