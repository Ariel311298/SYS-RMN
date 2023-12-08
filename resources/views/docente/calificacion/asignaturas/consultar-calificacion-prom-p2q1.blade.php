@extends('backend.app')

@section('title')
Modulo Docente - Consulta de Calificaciones - {{$malla->oferta->periodo->per_nombre}} - {{$malla->oferta->curso->seccion->sec_nombre}} - {{$malla->oferta->curso->cur_nombre}} {{$malla->oferta->curso->cur_paralelo}} - {{$malla->asignatura->asig_nom}} - Parcial 2 - Quimestre 1
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
                <h3 class="card-title">Periodo: {{$malla->oferta->periodo->per_nombre}} / Seccion: {{$malla->oferta->curso->seccion->sec_nombre}} / Curso: {{$malla->oferta->curso->cur_nombre}} {{$malla->oferta->curso->cur_paralelo}} / Docente Encargado: {{$malla->personal->pers_nombres}} {{$malla->personal->pers_apellidos}} / Asignatura: {{$malla->asignatura->asig_nom}} / Parcial: 2 / Quimestre: 1</h3> 
            </div>

            <div class="card-body" style="overflow:scroll;"> 
                <table id="mine" class="table table-bordered table-striped">
                    <thead>
                        <tr align="center">
                            <th scope="col">Nombres y Apellidos</th>
                            <th scope="col">Deberes</th>
                            <th scope="col">Act.Individual</th>
                            <th scope="col">Act.Grupal</th>
                            <th scope="col">Lecciones</th>            
                            <th scope="col">Prueba</th>
                            <th scope="col">Prom. Parc 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($calificaciones as $calificacion)    
                        <tr align="center" class="multiCalc">
                            <td style="min-width: 200px;">
                                {{$calificacion->matricula->alumno->alum_nombres}} {{$calificacion->matricula->alumno->alum_apellidos}}
                            </td>
                            <td style="min-width: 100px;">
                                @if($calificacion->cal_deberP2Q1)
                                    {{$calificacion->cal_deberP2Q1}}
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 100px;">
                                @if($calificacion->cal_actindP2Q1)
                                    {{$calificacion->cal_actindP2Q1}}
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 100px;">
                                @if($calificacion->cal_actgruP2Q1)
                                    {{$calificacion->cal_actgruP2Q1}} 
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 100px;">
                                @if($calificacion->cal_lecP2Q1)
                                    {{$calificacion->cal_lecP2Q1}} 
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 100px;">
                                @if($calificacion->cal_pruP2Q1)
                                    {{$calificacion->cal_pruP2Q1}}
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 100px;">
                                @if($calificacion->cal_promP2Q1)
                                    {{$calificacion->cal_promP2Q1}}
                                @else
                                    0.00
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{url('docente/calificacion/asignaturas', ['pers_id' => $malla->pers_id])}}">
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