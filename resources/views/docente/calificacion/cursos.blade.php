@extends('backend.app')

@section('title')
Modulo Docente - Consultar Calificaciones - Seleccionar Curso
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) - Modulo Docente - Consultar Calificaciones - Seleccionar Curso -->
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Consultar Calificaciones - Seleccionar Curso</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header - Modulo Docente - Consultar Calificaciones - Seleccionar Curso -->
   <!-- Main content -->
  <section class="content">
    <div class="card">  
        <div class="card-header">
            <h3 class="card-title">Tabla de Cursos</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="overflow:scroll;">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr align="center">
                        <th rowspan="2">Periodo</th>
                        <th rowspan="2">Curso</th>
                        <th rowspan="2">Paralelo</th>
                        <th rowspan="2">Tutor de Curso</th>
                        <th rowspan="2">Estado</th>
                        <th colspan="2">Opciones</th>
                    </tr>
                    <tr align="center">
                        <th>#1</th>
                        <th>#2</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cursos as $course)   
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
                            <a href="{{url('docente/calificacion/cursos/materias', ['ofer_id' => $course->ofer_id])}}">
                                <button type="button" class="btn btn-primary center-block" title="Ver Asignaturas (Calificaciones)">
                                    <i class="fas fa-search"></i>
                                </button>
                            </a>  
                        </td>
                        <td>
                            <a href="{{url('docente/calificacion/cursos/listado', ['ofer_id' => $course->ofer_id])}}">
                                <button type="button" class="btn btn-secondary center-block" title="Ver Alumnos (Calificaciones)">
                                    <i class="fas fa-list"></i>
                                </button>
                            </a>                                             
                        </td>
                    </tr>
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

