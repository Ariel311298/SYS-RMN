@extends('backend.app')

@section('title')
Modulo Docente - Consulta de Calificaciones - {{$malla->oferta->periodo->per_nombre}} - {{$malla->oferta->curso->seccion->sec_nombre}} - {{$malla->oferta->curso->cur_nombre}} {{$malla->oferta->curso->cur_paralelo}} - {{$malla->asignatura->asig_nom}}
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
                <h3 class="card-title">Periodo: {{$malla->oferta->periodo->per_nombre}} / Seccion: {{$malla->oferta->curso->seccion->sec_nombre}} / Curso: {{$malla->oferta->curso->cur_nombre}} {{$malla->oferta->curso->cur_paralelo}} / Docente Encargado: {{$malla->personal->pers_nombres}} {{$malla->personal->pers_apellidos}} / Asignatura: {{$malla->asignatura->asig_nom}}</h3> 
            </div>

            <div class="card-header clearfix">
                <h3 class="card-title"><b>Filtro</b></h3> 
                <br>
                <h3 class="card-title"><b>Primer Quimestre:</b></h3>
                <br>  
                <input type="checkbox" checked="checked" data-id="1">
                <label>
                    Parcial 1
                </label>
                <input type="checkbox" checked="checked" data-id="2">
                <label>
                    Parcial 2
                </label>
                <input type="checkbox" checked="checked" data-id="3">
                <label>
                    Prom. Parcial
                </label>
                <input type="checkbox" checked="checked" data-id="4">
                <label>
                    Prom.80%
                </label>
                <input type="checkbox" checked="checked" data-id="5">
                <label>
                    Examen
                </label>
                <input type="checkbox" checked="checked" data-id="6">
                <label>
                    Examen.20%
                </label>
                <input type="checkbox" checked="checked" data-id="7">
                <label>
                    Prom.Q1
                </label>
                <br>
                <h3 class="card-title"><b>Segundo Quimestre:</b></h3>
                <br>
                <input type="checkbox" checked="checked" data-id="8">
                <label>
                    Parcial 1
                </label>
                <input type="checkbox" checked="checked" data-id="9">
                <label>
                    Parcial 2
                </label>
                <input type="checkbox" checked="checked" data-id="10">
                <label>
                    Prom. Parcial
                </label>
                <input type="checkbox" checked="checked" data-id="11">
                <label>
                    Prom.80%
                </label>
                <input type="checkbox" checked="checked" data-id="12">
                <label>
                    Examen
                </label>
                <input type="checkbox" checked="checked" data-id="13">
                <label>
                    Examen.20%
                </label>
                <input type="checkbox" checked="checked" data-id="14">
                <label>
                    Prom.Q2
                </label>
                <br>
                <h3 class="card-title"><b>Examenes de Recuperación:</b></h3>
                <br> 
                <input type="checkbox" checked="checked" data-id="16">
                <label>
                    Exam. Mejora
                </label>
                <input type="checkbox" checked="checked" data-id="17">
                <label>
                    Exam. Supletorio
                </label>
                <input type="checkbox" checked="checked" data-id="18">
                <label>
                    Exam. Remedial
                </label>
                <input type="checkbox" checked="checked" data-id="19">
                <label>
                    Exam. Gracia
                </label>
            </div>
            <!-- /.card-header -->

            <div class="card-body" style="overflow:scroll;"> 
                <table id="column" class="table table-bordered table-striped">
                    <thead>
                        <tr align="center">
                            <th scope="col">Estudiante</th>
                            <th scope="col" class="q1">P1</th>
                            <th scope="col" class="q1">P2</th>
                            <th scope="col" class="q1">Prom.Parc</th>
                            <th scope="col" class="q1">%Prom(80%)</th>
                            <th scope="col" class="q1">Exam</th>
                            <th scope="col" class="q1">%Exam</th>
                            <th scope="col" class="q1">Prom.Q1</th>
                            <th scope="col" class="q2">P1</th>
                            <th scope="col" class="q2">P2</th>
                            <th scope="col" class="q2">Prom.Parc</th>
                            <th scope="col" class="q2">%Prom(80%)</th>
                            <th scope="col" class="q2">Exam</th>
                            <th scope="col" class="q2">%Exam</th>
                            <th scope="col" class="q2">Prom.Q2</th>
                            <th scope="col">Prom.Anual</th>
                            <th scope="col" class="exam_rec">Exam.Mej</th>
                            <th scope="col" class="exam_rec">Exam.Sup</th>
                            <th scope="col" class="exam_rec">Exam.Rem</th>
                            <th scope="col" class="exam_rec">Exam.Gra</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($calificaciones as $calificacion)
                        @if($calificacion->cal_estado == 1)    
                        <tr align="center" class="multiCalc">
                            <td style="min-width: 200px;">
                                {{$calificacion->matricula->alumno->alum_nombres}} {{$calificacion->matricula->alumno->alum_apellidos}}
                            </td>
                            <td style="min-width: 20px;">
                                @if($calificacion->cal_promP1Q1)
                                    {{$calificacion->cal_promP1Q1}}
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 20px;">
                                @if($calificacion->cal_promP2Q1)
                                    {{$calificacion->cal_promP2Q1}}
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 10px;">
                                @if($calificacion->cal_promParQ1)
                                    {{$calificacion->cal_promParQ1}}
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 10px;">
                                @if($calificacion->cal_promQ1_80)
                                    {{$calificacion->cal_promQ1_80}}
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 20px;">
                                @if($calificacion->cal_examQ1_10)
                                    {{$calificacion->cal_examQ1_10}}
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 20px;">
                                @if($calificacion->cal_examQ1_20)
                                    {{$calificacion->cal_examQ1_20}}
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 20px;">
                                @if($calificacion->cal_promTotalQ1)
                                    {{$calificacion->cal_promTotalQ1}}
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 20px;">
                                @if($calificacion->cal_promP1Q2)
                                    {{$calificacion->cal_promP1Q2}}
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 20px;">
                                @if($calificacion->cal_promP2Q2)
                                    {{$calificacion->cal_promP2Q2}}
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 20px;">
                                @if($calificacion->cal_promParQ2)
                                    {{$calificacion->cal_promParQ2}}
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 20px;">
                                @if($calificacion->cal_promQ2_80)
                                    {{$calificacion->cal_promQ2_80}}
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 20px;">
                                @if($calificacion->cal_examQ2_10)
                                    {{$calificacion->cal_examQ2_10}}
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 20px;">
                                @if($calificacion->cal_examQ2_20)
                                    {{$calificacion->cal_examQ2_20}}
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 20px;">
                                @if($calificacion->cal_promTotalQ2)
                                    {{$calificacion->cal_promTotalQ2}}
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 20px;">
                                @if($calificacion->cal_promAnual)
                                    {{$calificacion->cal_promAnual}}
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 20px;">
                                @if($calificacion->cal_examMejora)
                                    {{$calificacion->cal_examMejora}}
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 20px;">
                                @if($calificacion->cal_examSupletorio)
                                    {{$calificacion->cal_examSupletorio}}
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 20px;">
                                @if($calificacion->cal_examRemedial)
                                    {{$calificacion->cal_examRemedial}}
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 20px;">
                                @if($calificacion->cal_examGracia)
                                    {{$calificacion->cal_examGracia}}
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

@section('js')

<!-- Page specific script -->
<script>
$(document).ready(function(){
    $('input').on('change',function(){
        var id = $(this).data('id')
        
        if ($(this).prop('checked'))
        $('table tr').each(function(i,v){
            $(v).find('td').eq(id).show();
            $(v).find('th').eq(id).show();
        })
        else
            $('table tr').each(function(i,v){
            $(v).find('td').eq(id).hide();
            $(v).find('th').eq(id).hide();
        })
    })
});
</script>
@endsection