@extends('backend.app')

@section('title')
Modulo Docente - Ingreso de Calificaciones - Asignaturas - {{$malla->oferta->periodo->per_nombre}} - {{$malla->oferta->curso->seccion->sec_nombre}} - {{$malla->oferta->curso->cur_nombre}} {{$malla->oferta->curso->cur_paralelo}} - {{$malla->asignatura->asig_nom}}
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) - Modulo Docente - Ingreso de Calificaciones - Asignaturas -->
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Ingreso de Calificaciones - Asignaturas</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header - Modulo Docente - Ingreso de Calificaciones - Asignaturas -->

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
            <input type="checkbox" checked="checked" data-id="2">
            <label>
                Deberes (P1Q1)
            </label>
            <input type="checkbox" checked="checked" data-id="3">
            <label>
                Act.Individual (P1Q1)
            </label>
            <input type="checkbox" checked="checked" data-id="4">
            <label >
                Act.Grupal (P1Q1)
            </label>
            <input type="checkbox" checked="checked" data-id="5">
            <label>
                Lecciones (P1Q1)
            </label>
            <input type="checkbox" checked="checked" data-id="6">
            <label>
                Prueba (P1Q1)
            </label>
            <input type="checkbox" checked="checked" data-id="8">
            <label>
                Deberes (P2Q1)
            </label>
            <input type="checkbox" checked="checked" data-id="9">
            <label>
                Act.Individual (P2Q1)
            </label>
            <input type="checkbox" checked="checked" data-id="10">
            <label>
                Act.Grupal (P2Q1)
            </label>
            <br>
            <input type="checkbox" checked="checked" data-id="11">
            <label>
                Lecciones (P2Q1)
            </label>
            <input type="checkbox" checked="checked" data-id="12">
            <label>
                Prueba (P2Q1)
            </label>
            <input type="checkbox" checked="checked" data-id="14">
            <label>
                Prom.Parcial (Q1)
            </label>
            <input type="checkbox" checked="checked" data-id="15">
            <label>
                %Prom (Q1)
            </label>
            <input type="checkbox" checked="checked" data-id="16">
            <label>
                Examen (Q1)
            </label>
            <input type="checkbox" checked="checked" data-id="17">
            <label>
                %Exam (Q1)
            </label>
            <input type="checkbox" checked="checked" data-id="18">
            <label>
                Prom.Q1
            </label>
            <input type="checkbox" checked="checked" data-id="19">
            <label>
                EC (Prom.Q1)
            </label>
            <br> 
            <h3 class="card-title"><b>Segundo Quimestre:</b></h3>
            <br> 
            <input type="checkbox" checked="checked" data-id="20">
            <label>
                Deberes (P1Q2)
            </label>
            <input type="checkbox" checked="checked" data-id="21">
            <label>
                Act.Individual (P1Q2)
            </label>
            <input type="checkbox" checked="checked" data-id="22">
            <label>
                Act.Grupal (P1Q2)
            </label>
            <input type="checkbox" checked="checked" data-id="23">
            <label>
                Lecciones (P1Q2)
            </label>
            <input type="checkbox" checked="checked" data-id="24">
            <label>
                Prueba (P1Q2)
            </label>
            <input type="checkbox" checked="checked" data-id="26">
            <label>
                Deberes (P2Q2)
            </label>
            <input type="checkbox" checked="checked" data-id="27">
            <label>
                Act.Individual (P2Q2)
            </label>
            <input type="checkbox" checked="checked" data-id="28">
            <label>
                Act.Grupal (P2Q2)
            </label>
            <br>
            <input type="checkbox" checked="checked" data-id="29">
            <label>
                Lecciones (P2Q2)
            </label>
            <input type="checkbox" checked="checked" data-id="30">
            <label>
                Prueba (P2Q2)
            </label>
            <input type="checkbox" checked="checked" data-id="32">
            <label>
                Prom.Parcial (Q2)
            </label>
            <input type="checkbox" checked="checked" data-id="33"
            <label>
                %Prom (Q2)
            </label>
            <input type="checkbox" checked="checked" data-id="34">
            <label>
                Examen (Q2)
            </label>
            <input type="checkbox" checked="checked" data-id="35">
            <label>
                %Exam (Q2)
            </label>
            <input type="checkbox" checked="checked" data-id="36">
            <label for="checkboxPrimary37">
                Prom.Q2
            </label>
            <input type="checkbox" checked="checked" data-id="37">
            <label>
                EC (Q2)
            </label>
            <br> 
            <h3 class="card-title"><b>Promedio Anual y Examenes de Recuperación:</b></h3>
            <br> 
            <input type="checkbox" checked="checked" data-id="38">
            <label>
                Prom.Anual
            </label>
            <input type="checkbox" checked="checked" data-id="39">
            <label>
                EC (Prom.Anual)
            </label>
            <input type="checkbox" checked="checked" data-id="40">
            <label>
                Estatus
            </label>
            <input type="checkbox" checked="checked" data-id="41">
            <label>
                Examen Mejora
            </label>
            <input type="checkbox" checked="checked" data-id="42">
            <label>
                Ex.Supletorio
            </label>
            <input type="checkbox" checked="checked" data-id="43">
            <label>
                Ex.Remedial
            </label>
            <input type="checkbox" checked="checked" data-id="44">
            <label>
                Ex.Gracia
            </label>
        </div>
        <!-- /.card-header -->
    
        <div class="card-body" style="overflow:scroll;">
            <form method="POST" action="{{url('docente/calificacion/asignaturas/ingresocalificacion/save')}}" enctype="multipart/form-data">
            @csrf  
            <table id="mine" class="table table-bordered table-striped">
                <thead>
                    <tr align="center">
                        <th scope="col">Asignatura</th>
                        <th scope="col">Nombres y Apellidos</th>
                        <th scope="col">Deberes</th>
                        <th scope="col">Act.Individual</th>
                        <th scope="col">Act.Grupal</th>
                        <th scope="col">Lecciones</th>            
                        <th scope="col">Prueba</th>
                        <th scope="col">Prom. Parc 1</th>
                        <th scope="col">Deberes</th>
                        <th scope="col">Act.Individual</th>
                        <th scope="col">Act.Grupal</th>
                        <th scope="col">Lecciones</th>            
                        <th scope="col">Prueba</th>
                        <th scope="col">Prom. Parc 2</th>
                        <th scope="col">Prom.Parcial</th>
                        <th scope="col">%Prom</th>
                        <th scope="col">Examen</th>
                        <th scope="col">%Exam</th>
                        <th scope="col">Prom.Q1</th>
                        <th scope="col">EC (Prom.Q1)</th>
                        <th scope="col">Deberes</th>
                        <th scope="col">Act.Individual</th>
                        <th scope="col">Act.Grupal</th>
                        <th scope="col">Lecciones</th>            
                        <th scope="col">Prueba</th>
                        <th scope="col">Prom. Parc 1</th>
                        <th scope="col">Deberes</th>
                        <th scope="col">Act.Individual</th>
                        <th scope="col">Act.Grupal</th>
                        <th scope="col">Lecciones</th>            
                        <th scope="col">Prueba</th>
                        <th scope="col">Prom. Parc 2</th>
                        <th scope="col">Prom.Parcial</th>
                        <th scope="col">%Prom</th>
                        <th scope="col">Examen</th>
                        <th scope="col">%Exam</th>
                        <th scope="col">Prom.Q2</th>
                        <th scope="col">EC (Q2)</th>
                        <th scope="col">Prom.Anual</th>
                        <th scope="col">EC (Prom.Anual)</th>
                        <th scope="col">Estatus</th>
                        <th scope="col">Examen Mejora</th>
                        <th scope="col">Ex.Supletorio</th>
                        <th scope="col">Ex.Remedial</th>
                        <th scope="col">Ex.Gracia</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($calificaciones as $calificacion)   
                  @if($calificacion->cal_estado == 1)  
                    <tr align="center" class="multiCalc">
                        <td style="min-width: 100px;">
                            <input type="hidden" class="form-control @error('mal_id') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][mal_id]" readonly="readonly" value="{{$calificacion->mal_id}}" style="text-align:center;" required>
                            {{$calificacion->malla->asignatura->asig_nom}}                                             
                        </td>
                        <td style="min-width: 200px;">
                            <input type="hidden" class="form-control @error('mat_id') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][mat_id]" readonly="readonly" value="{{$calificacion->mat_id}}" style="text-align:center;" required>
                            {{$calificacion->matricula->alumno->alum_nombres}} {{$calificacion->matricula->alumno->alum_apellidos}}
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_deberP1Q1)   
                                <input type="text" class="cal_deberP1Q1 form-control @error('cal_deberP1Q1') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_deberP1Q1]" value="{{$calificacion->cal_deberP1Q1}}" style="text-align:center;"> 
                            @else
                                <input type="text" class="cal_deberP1Q1 form-control @error('cal_deberP1Q1') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_deberP1Q1]" value="0.00" style="text-align:center;"> 
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_actindP1Q1)  
                                <input type="text" class="cal_actindP1Q1 form-control @error('cal_actindP1Q1') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_actindP1Q1]" value="{{$calificacion->cal_actindP1Q1}}" style="text-align:center;">
                            @else
                                <input type="text" class="cal_actindP1Q1 form-control @error('cal_actindP1Q1') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_actindP1Q1]" value="0.00" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_actgruP1Q1)  
                                <input type="text" class="cal_actgruP1Q1 form-control @error('cal_actgruP1Q1') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_actgruP1Q1]" value="{{$calificacion->cal_actgruP1Q1}}" style="text-align:center;">
                            @else
                                <input type="text" class="cal_actgruP1Q1 form-control @error('cal_actgruP1Q1') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_actgruP1Q1]" value="0.00" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_lecP1Q1)  
                                <input type="text" class="cal_lecP1Q1 form-control @error('cal_lecP1Q1') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_lecP1Q1]" value="{{$calificacion->cal_lecP1Q1}}" style="text-align:center;"> 
                            @else
                                <input type="text" class="cal_lecP1Q1 form-control @error('cal_lecP1Q1') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_lecP1Q1]" value="0.00" style="text-align:center;"> 
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_pruP1Q1)
                                <input type="text" class="cal_pruP1Q1 form-control @error('cal_pruP1Q1') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_pruP1Q1]" value="{{$calificacion->cal_pruP1Q1}}" style="text-align:center;"> 
                            @else
                                <input type="text" class="cal_pruP1Q1 form-control @error('cal_pruP1Q1') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_pruP1Q1]" value="0.00" style="text-align:center;"> 
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_promP1Q1)
                                <input type="text" class="cal_promP1Q1 form-control @error('cal_promP1Q1') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_promP1Q1]" value="{{$calificacion->cal_promP1Q1}}" readonly="readonly" style="text-align:center;">
                            @else
                                <input type="text" class="cal_promP1Q1 form-control @error('cal_promP1Q1') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_promP1Q1]" value="0.00" readonly="readonly" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_deberP2Q1)
                                <input type="text" class="cal_deberP2Q1 form-control @error('cal_deberP2Q1') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_deberP2Q1]" value="{{$calificacion->cal_deberP2Q1}}" style="text-align:center;">
                            @else
                                <input type="text" class="cal_deberP2Q1 form-control @error('cal_deberP2Q1') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_deberP2Q1]" value="0.00" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_actindP2Q1)
                                <input type="text" class="cal_actindP2Q1 form-control @error('cal_actindP2Q1') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_actindP2Q1]" value="{{$calificacion->cal_actindP2Q1}}" style="text-align:center;">
                            @else
                                <input type="text" class="cal_actindP2Q1 form-control @error('cal_actindP2Q1') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_actindP2Q1]" value="0.00" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_actgruP2Q1)
                                <input type="text" class="cal_actgruP2Q1 form-control @error('cal_actgruP2Q1') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_actgruP2Q1]" value="{{$calificacion->cal_actgruP2Q1}}" style="text-align:center;"> 
                            @else
                                <input type="text" class="cal_actgruP2Q1 form-control @error('cal_actgruP2Q1') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_actgruP2Q1]" value="0.00" style="text-align:center;"> 
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_lecP2Q1)
                                <input type="text" class="cal_lecP2Q1 form-control @error('cal_lecP2Q1') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_lecP2Q1]" value="{{$calificacion->cal_lecP2Q1}}" style="text-align:center;"> 
                            @else
                                <input type="text" class="cal_lecP2Q1 form-control @error('cal_lecP2Q1') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_lecP2Q1]" value="0.00" style="text-align:center;"> 
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_pruP2Q1)
                                <input type="text" class="cal_pruP2Q1 form-control @error('cal_pruP2Q1') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_pruP2Q1]" value="{{$calificacion->cal_pruP2Q1}}" style="text-align:center;"> 
                            @else
                                <input type="text" class="cal_pruP2Q1 form-control @error('cal_pruP2Q1') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_pruP2Q1]" value="0.00" style="text-align:center;"> 
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_promP2Q1)
                                <input type="text" class="cal_promP2Q1 form-control @error('cal_promP2Q1') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_promP2Q1]" value="{{$calificacion->cal_promP2Q1}}" readonly="readonly" style="text-align:center;"> 
                            @else
                                <input type="text" class="cal_promP2Q1 form-control @error('cal_promP2Q1') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_promP2Q1]" value="0.00" readonly="readonly" style="text-align:center;"> 
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_promParQ1)
                                <input type="text" class="cal_promParQ1 form-control @error('cal_promParQ1') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_promParQ1]" value="{{$calificacion->cal_promParQ1}}" readonly="readonly" style="text-align:center;">
                            @else
                                <input type="text" class="cal_promParQ1 form-control @error('cal_promParQ1') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_promParQ1]" value="0.00" readonly="readonly" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_promQ1_80)
                                <input type="text" class="cal_promQ1_80 form-control @error('cal_promQ1_80') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_promQ1_80]" value="{{$calificacion->cal_promQ1_80}}" readonly="readonly" style="text-align:center;">
                            @else
                                <input type="text" class="cal_promQ1_80 form-control @error('cal_promQ1_80') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_promQ1_80]" value="0.00" readonly="readonly" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_examQ1_10)
                                <input type="text" class="cal_examQ1_10 form-control @error('cal_examQ1_10') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_examQ1_10]" value="{{$calificacion->cal_examQ1_10}}" style="text-align:center;">
                            @else
                                <input type="text" class="cal_examQ1_10 form-control @error('cal_examQ1_10') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_examQ1_10]" value="0.00" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_examQ1_20)
                                <input type="text" class="cal_examQ1_20 form-control @error('cal_examQ1_20') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_examQ1_20]" value="{{$calificacion->cal_examQ1_20}}" readonly="readonly" style="text-align:center;">
                            @else
                                <input type="text" class="cal_examQ1_20 form-control @error('cal_examQ1_20') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_examQ1_20]" value="0.00" readonly="readonly" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_promTotalQ1)
                                <input type="text" class="cal_promTotalQ1 form-control @error('cal_promTotalQ1') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_promTotalQ1]" value="{{$calificacion->cal_promTotalQ1}}" readonly="readonly" style="text-align:center;">
                            @else
                                <input type="text" class="cal_promTotalQ1 form-control @error('cal_promTotalQ1') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_promTotalQ1]" value="0.00" readonly="readonly" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_escalaQ1)
                                <input type="text" class="cal_escalaQ1 form-control @error('cal_escalaQ1') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_escalaQ1]" value="{{$calificacion->cal_escalaQ1}}" readonly="readonly" style="text-align:center;">
                            @else
                                <input type="text" class="cal_escalaQ1 form-control @error('cal_escalaQ1') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_escalaQ1]" value="NAAR" readonly="readonly" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_deberP1Q2)
                                <input type="text" class="cal_deberP1Q2 form-control @error('cal_deberP1Q2') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_deberP1Q2]" value="{{$calificacion->cal_deberP1Q2}}" style="text-align:center;">
                            @else
                                <input type="text" class="cal_deberP1Q2 form-control @error('cal_deberP1Q2') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_deberP1Q2]" value="0.00" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_actindP1Q2)
                                <input type="text" class="cal_actindP1Q2 form-control @error('cal_actindP1Q2') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_actindP1Q2]" value="{{$calificacion->cal_actindP1Q2}}" style="text-align:center;">
                            @else
                                <input type="text" class="cal_actindP1Q2 form-control @error('cal_actindP1Q2') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_actindP1Q2]" value="0.00" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_actgruP1Q2)
                                <input type="text" class="cal_actgruP1Q2 form-control @error('cal_actgruP1Q2') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_actgruP1Q2]" value="{{$calificacion->cal_actgruP1Q2}}" style="text-align:center;">     
                            @else
                                <input type="text" class="cal_actgruP1Q2 form-control @error('cal_actgruP1Q2') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_actgruP1Q2]" value="0.00" style="text-align:center;">     
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_lecP1Q2)
                                <input type="text" class="cal_lecP1Q2 form-control @error('cal_lecP1Q2') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_lecP1Q2]" value="{{$calificacion->cal_lecP1Q2}}" style="text-align:center;">
                            @else
                                <input type="text" class="cal_lecP1Q2 form-control @error('cal_lecP1Q2') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_lecP1Q2]" value="0.00" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_pruP1Q2)
                                <input type="text" class="cal_pruP1Q2 form-control @error('cal_pruP1Q2') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_pruP1Q2]" value="{{$calificacion->cal_pruP1Q2}}" style="text-align:center;">                             
                            @else
                                <input type="text" class="cal_pruP1Q2 form-control @error('cal_pruP1Q2') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_pruP1Q2]" value="0.00" style="text-align:center;">                             
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_promP1Q2)
                                <input type="text" class="cal_promP1Q2 form-control @error('cal_promP1Q2') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_promP1Q2]" value="{{$calificacion->cal_promP1Q2}}" readonly="readonly" style="text-align:center;"> 
                            @else
                                <input type="text" class="cal_promP1Q2 form-control @error('cal_promP1Q2') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_promP1Q2]" value="0.00" readonly="readonly" style="text-align:center;"> 
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_deberP2Q2)
                                <input type="text" class="cal_deberP2Q2 form-control @error('cal_deberP2Q2') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_deberP2Q2]" value="{{$calificacion->cal_deberP2Q2}}" style="text-align:center;">
                            @else
                                <input type="text" class="cal_deberP2Q2 form-control @error('cal_deberP2Q2') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_deberP2Q2]" value="0.00" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_actindP2Q2)
                                <input type="text" class="cal_actindP2Q2 form-control @error('cal_actindP2Q2') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_actindP2Q2]" value="{{$calificacion->cal_actindP2Q2}}" style="text-align:center;">
                            @else
                                <input type="text" class="cal_actindP2Q2 form-control @error('cal_actindP2Q2') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_actindP2Q2]" value="0.00" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_actgruP2Q2)
                                <input type="text" class="cal_actgruP2Q2 form-control @error('cal_actgruP2Q2') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_actgruP2Q2]" value="{{$calificacion->cal_actgruP2Q2}}" style="text-align:center;">
                            @else
                                <input type="text" class="cal_actgruP2Q2 form-control @error('cal_actgruP2Q2') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_actgruP2Q2]" value="0.00" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_lecP2Q2)
                                <input type="text" class="cal_lecP2Q2 form-control @error('cal_lecP2Q2') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_lecP2Q2]" value="{{$calificacion->cal_lecP2Q2}}" style="text-align:center;">
                            @else
                                <input type="text" class="cal_lecP2Q2 form-control @error('cal_lecP2Q2') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_lecP2Q2]" value="0.00" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_pruP2Q2)
                                <input type="text" class="cal_pruP2Q2 form-control @error('cal_pruP2Q2') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_pruP2Q2]" value="{{$calificacion->cal_pruP2Q2}}" style="text-align:center;">
                            @else
                                <input type="text" class="cal_pruP2Q2 form-control @error('cal_pruP2Q2') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_pruP2Q2]" value="0.00" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_promP2Q2)
                                <input type="text" class="cal_promP2Q2 form-control @error('cal_promP2Q2') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_promP2Q2]" value="{{$calificacion->cal_promP2Q2}}" readonly="readonly" style="text-align:center;">
                            @else
                                <input type="text" class="cal_promP2Q2 form-control @error('cal_promP2Q2') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_promP2Q2]" value="0.00" readonly="readonly" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_promParQ2)
                                <input type="text" class="cal_promParQ2 form-control @error('cal_promParQ2') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_promParQ2]" value="{{$calificacion->cal_promParQ2}}" readonly="readonly" style="text-align:center;">
                            @else
                                <input type="text" class="cal_promParQ2 form-control @error('cal_promParQ2') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_promParQ2]" value="0.00" readonly="readonly" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_promQ2_80)
                                <input type="text" class="cal_promQ2_80 form-control @error('cal_promQ2_80') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_promQ2_80]" value="{{$calificacion->cal_promQ2_80}}" readonly="readonly" style="text-align:center;">
                            @else
                                <input type="text" class="cal_promQ2_80 form-control @error('cal_promQ2_80') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_promQ2_80]" value="0.00" readonly="readonly" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_examQ2_10)
                                <input type="text" class="cal_examQ2_10 form-control @error('cal_examQ2_10') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_examQ2_10]" value="{{$calificacion->cal_examQ2_10}}" style="text-align:center;">
                            @else
                                <input type="text" class="cal_examQ2_10 form-control @error('cal_examQ2_10') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_examQ2_10]" value="0.00" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_examQ2_20)
                                <input type="text" class="cal_examQ2_20 form-control @error('cal_examQ2_20') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_examQ2_20]" value="{{$calificacion->cal_examQ2_20}}" readonly="readonly" style="text-align:center;">
                            @else
                                <input type="text" class="cal_examQ2_20 form-control @error('cal_examQ2_20') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_examQ2_20]" value="0.00" readonly="readonly" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_promTotalQ2)
                                <input type="text" class="cal_promTotalQ2 form-control @error('cal_promTotalQ2') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_promTotalQ2]" value="{{$calificacion->cal_promTotalQ2}}" readonly="readonly" style="text-align:center;">
                            @else
                                <input type="text" class="cal_promTotalQ2 form-control @error('cal_promTotalQ2') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_promTotalQ2]" value="0.00" readonly="readonly" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_escalaQ2)
                                <input type="text" class="cal_escalaQ2 form-control @error('cal_escalaQ2') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_escalaQ2]" value="{{$calificacion->cal_escalaQ2}}" readonly="readonly" style="text-align:center;"> 
                            @else
                                <input type="text" class="cal_escalaQ2 form-control @error('cal_escalaQ2') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_escalaQ2]" value="NAAR" readonly="readonly" style="text-align:center;"> 
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_promAnual)
                                <input type="text" class="cal_promAnual form-control @error('cal_promAnual') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_promAnual]" value="{{$calificacion->cal_promAnual}}" readonly="readonly" style="text-align:center;">
                            @else
                                <input type="text" class="cal_promAnual form-control @error('cal_promAnual') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_promAnual]" value="0.00" readonly="readonly" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_escalaAnual)
                                <input type="text" class="cal_escalaAnual form-control @error('cal_escalaAnual') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_escalaAnual]" value="{{$calificacion->cal_escalaAnual}}" readonly="readonly" style="text-align:center;"> 
                            @else
                                <input type="text" class="cal_escalaAnual form-control @error('cal_escalaAnual') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_escalaAnual]" value="NAAR" readonly="readonly" style="text-align:center;"> 
                            @endif
                        </td>
                        <td style="min-width: 150px;">
                            @if($calificacion->cal_estatus)
                                <input type="text" class="cal_estatus form-control @error('cal_estatus') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_estatus]" value="{{$calificacion->cal_estatus}}" readonly="readonly" style="text-align:center;">
                            @else
                                <input type="text" class="cal_estatus form-control @error('cal_estatus') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_estatus]" value="REPROBADO" readonly="readonly" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_examMejora)
                                <input type="text" class="cal_examMejora form-control @error('cal_examMejora') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_examMejora]" value="{{$calificacion->cal_examMejora}}" style="text-align:center;">
                            @else
                                <input type="text" class="cal_examMejora form-control @error('cal_examMejora') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_examMejora]" value="0.00" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_examSupletorio)
                                <input type="text" class="cal_examSupletorio form-control @error('cal_examSupletorio') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_examSupletorio]" value="{{$calificacion->cal_examSupletorio}}" style="text-align:center;">
                            @else
                                <input type="text" class="cal_examSupletorio form-control @error('cal_examSupletorio') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_examSupletorio]" value="0.00" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_examRemedial)
                                <input type="text" class="cal_examRemedial form-control @error('cal_examRemedial') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_examRemedial]" value="{{$calificacion->cal_examRemedial}}" style="text-align:center;">
                            @else
                                <input type="text" class="cal_examRemedial form-control @error('cal_examRemedial') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_examRemedial]" value="0.00" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($calificacion->cal_examGracia)
                                <input type="text" class="cal_examGracia form-control @error('cal_examGracia') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_examGracia]" value="{{$calificacion->cal_examGracia}}" style="text-align:center;"> 
                            @else
                                <input type="text" class="cal_examGracia form-control @error('cal_examGracia') is-invalid @enderror" name="calificaciones[{{ $calificacion->cal_id }}][cal_examGracia]" value="0.00" style="text-align:center;"> 
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
                <button type="submit" class="btn btn-primary">
                    Guardar
                    <i class="fas fa-save"></i>
                </button>
                <a href="{{url('docente/calificacion/asignaturas', ['pers_id' => $malla->pers_id])}}">
                    <button type="button" class="btn btn-warning center-block">
                        Regresar
                        <i class="fas fa-arrow-left"></i>
                    </button>
                </a>
            </div>
        </form> 
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

$(document).ready(function () {
    $(".multiCalc input").keyup(multInputs);
    function multInputs() {   
        $("tr.multiCalc").each(function () {   
            var cal_deberP1Q1 = parseFloat($('.cal_deberP1Q1', this).val()) || 0;
            var cal_actindP1Q1 = parseFloat($('.cal_actindP1Q1', this).val()) || 0;
            var cal_actgruP1Q1 = parseFloat($('.cal_actgruP1Q1', this).val()) || 0;
            var cal_lecP1Q1 = parseFloat($('.cal_lecP1Q1', this).val()) || 0;
            var cal_pruP1Q1 = parseFloat($('.cal_pruP1Q1', this).val()) || 0;          
            var divisionP1Q1 = 5;
            
            var valueP1Q1 =  ((cal_deberP1Q1 * 1) + (cal_actindP1Q1 * 1) +  (cal_actgruP1Q1 * 1) + (cal_lecP1Q1 * 1) + (cal_pruP1Q1 * 1)) / (divisionP1Q1 * 1);
            valueP1Q1 = valueP1Q1.toFixed(2);   
            $('.cal_promP1Q1',this).val(valueP1Q1);
                            
            var cal_deberP2Q1 = parseFloat($('.cal_deberP2Q1', this).val()) || 0;
            var cal_actindP2Q1 = parseFloat($('.cal_actindP2Q1', this).val()) || 0;
            var cal_actgruP2Q1 = parseFloat($('.cal_actgruP2Q1', this).val()) || 0;
            var cal_lecP2Q1 = parseFloat($('.cal_lecP2Q1', this).val()) || 0;
            var cal_pruP2Q1 = parseFloat($('.cal_pruP2Q1', this).val()) || 0;          
            var divisionP2Q1 = 5;
            
            var valueP2Q1 =  ((cal_deberP2Q1 * 1) + (cal_actindP2Q1 * 1) +  (cal_actgruP2Q1 * 1) + (cal_lecP2Q1 * 1) + (cal_pruP2Q1 * 1)) / (divisionP2Q1  * 1);
            valueP2Q1 = valueP2Q1.toFixed(2);   
            $('.cal_promP2Q1',this).val(valueP2Q1);                       
                           
            var divisionPQ1_10 = 2;   
            
            var valuePQ1_10 =  ((valueP1Q1  * 1) + (valueP2Q1 * 1)) / (divisionPQ1_10 * 1);
            valuePQ1_10 = valuePQ1_10.toFixed(2);   
            $('.cal_promParQ1',this).val(valuePQ1_10);      
                
            var value80PQ1 = 80;
            var value100PQ1 = 100;
            var valuePQ1_80 =  (valuePQ1_10 * 1) * (value80PQ1 * 1) / (value100PQ1 * 1);
            valuePQ1_80 = valuePQ1_80.toFixed(2);   
            $('.cal_promQ1_80',this).val(valuePQ1_80);         
        
            var cal_examQ1_10  = parseFloat($('.cal_examQ1_10', this).val()) || 0;
            var examen20Q1 = 0.20;

            var valueexamenQ1_20 =  (cal_examQ1_10 * 1) * (examen20Q1 * 1);
            valueexamenQ1_20 = valueexamenQ1_20.toFixed(2);   
            $('.cal_examQ1_20',this).val(valueexamenQ1_20);

            var valuePromQ1 =  (valuePQ1_80 * 1) + (valueexamenQ1_20 * 1);
            
            var valueescalaQ1; 
            
            if(valuePromQ1 >= 9.00 && valuePromQ1 <= 10.00){
                valueescalaQ1 = 'DAR';
            }else if (valuePromQ1 >= 7.00 && valuePromQ1 <= 8.99) {
                valueescalaQ1 = 'AAR';
            }else if (valuePromQ1 >= 4.01 && valuePromQ1 <= 6.99) {
                valueescalaQ1 = 'PAAR';
            }else if (valuePromQ1 <= 4.00) {
                valueescalaQ1 = 'NAAR';
            }else{
                valueescalaQ1 = 'Ingreso Invalido';
            }
        
            $('.cal_escalaQ1',this).val(valueescalaQ1);
    
            var cal_deberP1Q2 = parseFloat($('.cal_deberP1Q2', this).val()) || 0;
            var cal_actindP1Q2 = parseFloat($('.cal_actindP1Q2', this).val()) || 0;
            var cal_actgruP1Q2 = parseFloat($('.cal_actgruP1Q2', this).val()) || 0;
            var cal_lecP1Q2 = parseFloat($('.cal_lecP1Q2', this).val()) || 0;
            var cal_pruP1Q2 = parseFloat($('.cal_pruP1Q2', this).val()) || 0;          
            var divisionP1Q2 = 5;

            var valueP1Q2 = ((cal_deberP1Q2 * 1) + (cal_actindP1Q2 * 1) +  (cal_actgruP1Q2 * 1) + (cal_lecP1Q2 * 1) + (cal_pruP1Q2 * 1)) / (divisionP1Q2 * 1);
            valueP1Q2 = valueP1Q2.toFixed(2);   
            $('.cal_promP1Q2',this).val(valueP1Q2);       
                    
            var cal_deberP2Q2 = parseFloat($('.cal_deberP2Q2', this).val()) || 0;
            var cal_actindP2Q2 = parseFloat($('.cal_actindP2Q2', this).val()) || 0;
            var cal_actgruP2Q2 = parseFloat($('.cal_actgruP2Q2', this).val()) || 0;
            var cal_lecP2Q2 = parseFloat($('.cal_lecP2Q2', this).val()) || 0;
            var cal_pruP2Q2 = parseFloat($('.cal_pruP2Q2', this).val()) || 0;          
            var divisionP2Q2 = 5;
            
            var valueP2Q2 = ((cal_deberP2Q2 * 1) + (cal_actindP2Q2 * 1) + (cal_actgruP2Q2 * 1) + (cal_lecP2Q2 * 1) + (cal_pruP2Q2 * 1)) / (divisionP2Q2  * 1);
            valueP2Q2 = valueP2Q2.toFixed(2);   
            $('.cal_promP2Q2',this).val(valueP2Q2); 
                           
            var divisionPQ2_10 = 2;      
            var valuePQ2_10 =  ((valueP1Q2 * 1) + (valueP2Q2 * 1)) / (divisionPQ2_10 * 1);
            valuePQ2_10 = valuePQ2_10.toFixed(2);   
            $('.cal_promParQ2',this).val(valuePQ2_10);
            
            var value80PQ2 = 80;
            var value100PQ2 = 100;
            var valuePQ2_80 = (valuePQ2_10 * 1) * (value80PQ2 * 1) / (value100PQ2 * 1);
            valuePQ2_80 = valuePQ2_80.toFixed(2);   
            $('.cal_promQ2_80',this).val(valuePQ2_80);
                            
            var cal_examQ2_10  = parseFloat($('.cal_examQ2_10', this).val()) || 0;
            var examen20Q2 = 0.20;
            var valueexamenQ2_20 =  (cal_examQ2_10 * 1) * (examen20Q2 * 1);
            valueexamenQ2_20 = valueexamenQ2_20.toFixed(2);   
            $('.cal_examQ2_20',this).val(valueexamenQ2_20);
                    
            var valuePromQ2 =  (valuePQ2_80 * 1) + (valueexamenQ2_20 * 1);
                                
            var valueescalaQ2; 
            
            if(valuePromQ2 >= 9.00 && valuePromQ2 <= 10.00){
                valueescalaQ2 = 'DAR';
            }else if (valuePromQ2 >= 7.00 && valuePromQ2 <= 8.99) {
                valueescalaQ2 = 'AAR';
            }else if (valuePromQ2 >= 4.01 && valuePromQ2 <= 6.99) {
                valueescalaQ2 = 'PAAR';
            }else if (valuePromQ2 <= 4.00) {
                valueescalaQ2 = 'NAAR';
            }else{
        
            }     

            $('.cal_escalaQ2',this).val(valueescalaQ2);  
        
            var cal_examMejora = parseFloat($('.cal_examMejora', this).val()) || 0;
            var cal_examSupletorio = parseFloat($('.cal_examSupletorio', this).val()) || 0; 
            var cal_examRemedial = parseFloat($('.cal_examRemedial', this).val()) || 0; 
            var cal_examGracia = parseFloat($('.cal_examGracia', this).val()) || 0; 
            var valuePromAnual; 
            var divisionFinal = 2;   
    
            if(valuePromQ1 && valuePromQ2){
                valuePromAnual = ((valuePromQ1 * 1)  + (valuePromQ2 * 1)) / (divisionFinal * 1);
                if(cal_examMejora){
                if(valuePromAnual >= 7.00 && valuePromAnual <= 10.00){
                    if(valuePromQ1 > valuePromQ2){
                        valuePromQ2 = (cal_examMejora * 1);
                        valuePromAnual = ((valuePromQ1) + (valuePromQ2)) / (divisionFinal);       
                    }else if (valuePromQ2 > valuePromQ1){
                        valuePromQ1 = (cal_examMejora * 1);
                        valuePromAnual = ((valuePromQ1) + (valuePromQ2)) / (divisionFinal);                             
                    }       
                } 
            
                var valueescalaQ1; 
            
                if(valuePromQ1 >= 9.00 && valuePromQ1 <= 10.00){
                    valueescalaQ1 = 'DAR';
                }else if (valuePromQ1 >= 7.00 && valuePromQ1 <= 8.99) {
                    valueescalaQ1 = 'AAR';
                }else{
            
                }
        
                $('.cal_escalaQ1',this).val(valueescalaQ1);
    
                if(valuePromQ2 >= 9.00 && valuePromQ2 <= 10.00){
                    valueescalaQ2 = 'DAR';
                }else if (valuePromQ2 >= 7.00 && valuePromQ2 <= 8.99) {
                    valueescalaQ2 = 'AAR';
                }else{
            
                }     
    
                $('.cal_escalaQ2',this).val(valueescalaQ2);      
    
                } else if (cal_examSupletorio){
                    if(valuePromAnual >= 5.00 && valuePromAnual <= 6.99){
                        if(cal_examSupletorio >= 7){
                            valuePromAnual = (cal_examSupletorio = 7);
                            valueescalaAnual = 'AAR';
                            estadoAnual = 'APROBADO';
                        }else{
                            valuePromAnual; 
                            estadoAnual = 'REPROBADO';
                        }
                    }

                } else if (cal_examRemedial){
                    if(valuePromAnual <= 5.00){
                        if(cal_examRemedial >= 7){
                            valuePromAnual = (cal_examRemedial = 7);
                            valueescalaAnual = 'AAR';
                            estadoAnual = 'APROBADO';
                        }else{
                            valuePromAnual;
                            estadoAnual = 'REPROBADO';
                        }
                    }
                } else if (cal_examGracia){
                    if(valuePromAnual < 7.00){
                        if(cal_examGracia >= 7){
                            valuePromAnual = (cal_examGracia = 7);
                            valueescalaAnual = 'AAR';
                            estadoAnual = 'APROBADO';
                        }else{
                            valuePromAnual;
                            estadoAnual = 'REPROBADO';
                        }
                    }
                }
                    
                valuePromAnual = valuePromAnual.toFixed(2);             
                $('.cal_promAnual',this).val(valuePromAnual);
            }
        
            valuePromQ1 = valuePromQ1.toFixed(2);
            valuePromQ2 = valuePromQ2.toFixed(2);   
            $('.cal_promTotalQ1',this).val(valuePromQ1);
            $('.cal_promTotalQ2',this).val(valuePromQ2);
            
            var valueescalaAnual;
        
            if(valuePromAnual){  
                if(valuePromAnual >= 9.00 && valuePromAnual <= 10.00){
                    valueescalaAnual = 'DAR';
                }else if (valuePromAnual >= 7.00 && valuePromAnual <= 8.99) {
                    valueescalaAnual = 'AAR';
                }else if (valuePromAnual >= 4.01 && valuePromAnual <= 6.99) {
                    valueescalaAnual = 'PAAR';
                }else if (valuePromAnual <= 4.00) {
                    valueescalaAnual = 'NAAR';
                }
            }
            
            $('.cal_escalaAnual',this).val(valueescalaAnual);
    
            var estadoAnual;
            if(valuePromAnual){  
                if(valuePromAnual >= 7.00){
                    estadoAnual = 'APROBADO';
                }else if (valuePromAnual <= 6.99) {
                    estadoAnual = 'REPROBADO';
                }
            }
                
            $('.cal_estatus',this).val(estadoAnual);   
        });         
    }
});
</script>
<script>
    @if(Session::has('message'))
        var type="{{Session::get('alert-type','info')}}"
        switch(type){
            case 'info':
                toastr.info("{{Session::get('message')}}");
                break;
            case 'success':
                toastr.success("{{Session::get('message')}}");
                break;
            case 'warning':
                toastr.warning("{{Session::get('message')}}");
                break;
            case 'error':
                toastr.error("{{Session::get('message')}}");
                break;
        }     
    @endif
</script>
@endsection
