@extends('backend.app')

@section('title')
Modulo Docente - Consulta de Calificaciones - {{$malla->oferta->periodo->per_nombre}} - {{$malla->oferta->curso->seccion->sec_nombre}} - {{$malla->oferta->curso->cur_nombre}} {{$malla->oferta->curso->cur_paralelo}} - {{$malla->asignatura->asig_nom}} - Quimestre 2
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) - Modulo Docente - Consulta de Calificaciones -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Consulta de Calificaciones</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Modulo Docente - Consulta de Calificaciones -->

    <!-- Main content -->
    <section class="content">
        <div class="card">  
            <div class="card-header">
                <h3 class="card-title">Periodo: {{$malla->oferta->periodo->per_nombre}} / Seccion: {{$malla->oferta->curso->seccion->sec_nombre}} / Curso: {{$malla->oferta->curso->cur_nombre}} {{$malla->oferta->curso->cur_paralelo}} / Docente Encargado: {{$malla->personal->pers_nombres}} {{$malla->personal->pers_apellidos}} / Asignatura: {{$malla->asignatura->asig_nom}} - Quimestre: 2</h3> 
            </div>

            <div class="card-body" style="overflow:scroll;"> 
                <table id="mine" class="table table-bordered table-striped">
                    <thead>
                        <tr align="center">
                            <th scope="col">Nombres y Apellidos</th>
                            <th scope="col">Prom. Parc 1</th>
                            <th scope="col">Prom. Parc 2</th>
                            <th scope="col">Prom.Parcial</th>
                            <th scope="col">%Prom</th>
                            <th scope="col">Examen</th>
                            <th scope="col">%Exam</th>
                            <th scope="col">Prom.Q2</th>
                            <th scope="col">EC (Prom.Q2)</th>
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
                                @if($calificacion->cal_promP1Q2)
                                    {{$calificacion->cal_promP1Q2}}
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 100px;">
                                @if($calificacion->cal_promP2Q2)
                                    {{$calificacion->cal_promP2Q2}}
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 100px;">
                                @if($calificacion->cal_promParQ2)
                                    {{$calificacion->cal_promParQ2}}
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 100px;">
                                @if($calificacion->cal_promQ2_80)
                                    {{$calificacion->cal_promQ2_80}}
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 100px;">
                                @if($calificacion->cal_examQ2_10)
                                    {{$calificacion->cal_examQ2_10}}
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 100px;">
                                @if($calificacion->cal_examQ2_20)
                                    {{$calificacion->cal_examQ2_20}}
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 100px;">
                                @if($calificacion->cal_promTotalQ2)
                                    {{$calificacion->cal_promTotalQ2}}
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 100px;">
                                @if($calificacion->cal_escalaQ2)
                                    {{$calificacion->cal_escalaQ2}}
                                @else
                                    NAAR
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
                <a href="{{url('docente/calificacion/cursos/materias', ['ofer_id' => $malla->ofer_id])}}">
                    <button type="button" class="btn btn-warning center-block">
                        Regresar
                        <i class="fas fa-arrow-left"></i>
                    </button>
                </a>
                <a href="{{url('docente/calificacion/cursos', ['pers_id' => $malla->oferta->pers_id])}}">
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