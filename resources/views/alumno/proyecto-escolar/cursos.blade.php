@extends('backend.app')

@section('title')
Modulo Alumno - Consultar Calificaciones de Proyecto Escolar - Seleccionar Curso
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) - Modulo Alumno - Consultar Calificaciones de Proyecto Escolar - Seleccionar Curso -->
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Consultar Calificaciones de Proyecto Escolar - Seleccionar Curso</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header - Modulo Alumno - Consultar Calificaciones de Proyecto Escolar - Seleccionar Curso -->
    
  <!-- Main content -->
  <section class="content">
    <div class="card">  
        <div class="card-header">
            <h3 class="card-title">Tabla de Cursos</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr align="center">
                        <th>Periodo</th>
                        <th>Curso</th>
                        <th>Paralelo</th>
                        <th>Tutor de Curso</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cursos as $course)   
                    @if($course->mat_estado == 1) 
                    <tr align="center">
                        <td>{{$course->oferta->periodo->per_nombre}}</td>
                        <td>
                            {{$course->oferta->curso->cur_nombre}}                                                
                        </td>
                        <td>
                            {{$course->oferta->curso->cur_paralelo}}                                                
                        </td>
                        <td>
                            {{$course->oferta->personal->pers_nombres}} {{$course->oferta->personal->pers_apellidos}}     
                        </td>
                        <td>
                            @if($course->oferta->ofer_estado == 1)   
                                <p>Activo</p>
                            @else
                                <p>Desactivado</p>
                            @endif
                        </td>
                        <td>
                            <a href="{{url('alumno/proyecto-escolar/cursos/consultar-calificaciones-proyecto-escolar', ['mat_id' => $course->mat_id])}}">
                                <button type="button" class="btn btn-primary center-block" title="Ver Calificaciones del Proyecto Escolar">
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

@section('js')
<script>
  $(function () {
    $("#example1").DataTable({
      "lengthChange": false, "autoWidth": false, "paging": false, "info": false, "ordering": true, "responsive": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endsection