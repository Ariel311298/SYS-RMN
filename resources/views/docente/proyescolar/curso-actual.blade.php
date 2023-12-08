@extends('backend.app')

@section('title')
Modulo Docente - Consultar Calificaciones de Proyecto Escolar - Curso Actual
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) - Modulo Docente - Consultar Calificaciones de Proyecto Escolar - Curso Actual -->
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Consultar Calificaciones de Proyecto Escolar - Curso Actual</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header - Modulo Docente - Consultar Calificaciones de Proyecto Escolar - Curso Actual -->
   <!-- Main content -->
  <section class="content">
    <div class="card">  
        <div class="card-header">
            <h3 class="card-title">Tabla de Cursos</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="overflow:scroll;">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr align="center">
                        <th>Periodo</th>
                        <th>Curso</th>
                        <th>Paralelo</th>
                        <th>Tutor de Curso</th>
                        <th>Estado</th>
                        <th colspan="1">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cursos as $course) 
                    @if($course->ofer_estado == 1)    
                    <tr align="center">
                        <td>{{$course->periodo->per_nombre}}</td>
                        <td>
                            {{$course->curso->cur_nombre}}                                                
                        </td>
                        <td>
                            {{$course->curso->cur_paralelo}}                                                
                        </td>
                        <td>
                            {{$course->personal->pers_nombres}} {{$course->personal->pers_apellidos}}     
                        </td>
                        <td>
                            @if($course->ofer_estado == 1)   
                                <p>Activo</p>
                            @else
                                <p>Desactivado</p>
                            @endif
                        </td>
                        <td>
                            <a href="{{url('docente/proyescolar/curso-actual/curso-proyecto', ['ofer_id' => $course->ofer_id])}}">
                                <button type="button" class="btn btn-primary center-block" title="Ver Asignaturas (Calificaciones)">
                                    <i class="fas fa-search"></i>
                                </button>
                            </a>  
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            
        </div>
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection