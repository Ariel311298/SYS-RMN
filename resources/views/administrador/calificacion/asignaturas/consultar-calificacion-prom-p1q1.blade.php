@extends('backend.app')

@section('title')
Modulo Administrador - Consulta de Calificaciones - {{$malla->oferta->periodo->per_nombre}} - {{$malla->oferta->curso->seccion->sec_nombre}} - {{$malla->oferta->curso->cur_nombre}} {{$malla->oferta->curso->cur_paralelo}} - {{$malla->asignatura->asig_nom}} - Parcial 1 - Quimestre 1
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) - Modulo Adiministrador - Consulta de Calificaciones -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Consulta de Calificaciones</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Modulo Administrador - Consulta de Calificaciones -->

    <!-- Main content -->
    <section class="content">
        <div class="card">  
            <div class="card-header">
                <h3 class="card-title">Periodo: {{$malla->oferta->periodo->per_nombre}} / Seccion: {{$malla->oferta->curso->seccion->sec_nombre}} / Curso: {{$malla->oferta->curso->cur_nombre}} {{$malla->oferta->curso->cur_paralelo}} / Docente Encargado: {{$malla->personal->pers_nombres}} {{$malla->personal->pers_apellidos}} / Asignatura: {{$malla->asignatura->asig_nom}} / Parcial: 1 / Quimestre: 1</h3> 
            </div>

            <div class="card-body" style="overflow:scroll;"> 
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr align="center">
                            <th scope="col">Nombres y Apellidos</th>
                            <th scope="col">Deberes</th>
                            <th scope="col">Act.Individual</th>
                            <th scope="col">Act.Grupal</th>
                            <th scope="col">Lecciones</th>            
                            <th scope="col">Prueba</th>
                            <th scope="col">Prom. Parc 1</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($calificaciones as $calificacion) 
                            @if($calificacion->cal_estado == 1)    
                            <tr align="center" class="multiCalc">
                                <td style="min-width: 200px;">
                                    {{$calificacion->matricula->alumno->alum_nombres}} {{$calificacion->matricula->alumno->alum_apellidos}}
                                </td>
                                <td style="min-width: 100px;">
                                    @if($calificacion->cal_deberP1Q1)   
                                        {{$calificacion->cal_deberP1Q1}}
                                    @else
                                        0.00 
                                    @endif
                                </td>
                                <td style="min-width: 100px;">
                                    @if($calificacion->cal_actindP1Q1)  
                                        {{$calificacion->cal_actindP1Q1}}
                                    @else
                                        0.00
                                    @endif
                                </td>
                                <td style="min-width: 100px;">
                                    @if($calificacion->cal_actgruP1Q1)  
                                        {{$calificacion->cal_actgruP1Q1}} 
                                    @else
                                        0.00
                                    @endif
                                </td>
                                <td style="min-width: 100px;">
                                    @if($calificacion->cal_lecP1Q1)  
                                        {{$calificacion->cal_lecP1Q1}} 
                                    @else
                                        0.00
                                    @endif
                                </td>
                                <td style="min-width: 100px;">
                                    @if($calificacion->cal_pruP1Q1)
                                        {{$calificacion->cal_pruP1Q1}}  
                                    @else
                                        0.00
                                    @endif
                                </td>
                                <td style="min-width: 100px;">
                                    @if($calificacion->cal_promP1Q1)
                                        {{$calificacion->cal_promP1Q1}}  
                                    @else
                                        0.00
                                    @endif
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{url('administrador/calificacion/asignaturas', ['ofer_id' => $malla->oferta->ofer_id])}}">
                    <button type="button" class="btn btn-warning center-block">
                        Regresar
                        <i class="fas fa-arrow-left"></i>
                    </button>
                </a>
                <a href="/administrador/calificacion/index">
                    <button type="button" class="btn btn-danger center-block">
                        Volver al menu de cursos
                        <i class="fas fa-home"></i>
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


@section('js')
<script>
  $(function () {
    $("#example1").DataTable({
      "lengthChange": false, "autoWidth": false, "paging": false, "info": false, "ordering": false, "responsive": false, "searching": false,
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