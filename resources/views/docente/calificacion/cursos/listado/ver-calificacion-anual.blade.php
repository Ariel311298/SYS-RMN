@extends('backend.app')

@section('title')
Modulo Docente - Consulta de Calificaciones - {{$matricula->oferta->periodo->per_nombre}} - {{$matricula->oferta->curso->seccion->sec_nombre}} - {{$matricula->oferta->curso->cur_nombre}} {{$matricula->oferta->curso->cur_paralelo}} - Calificaciones Anual
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) - Modulo Docente - Consulta de Calificaciones -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Consulta de Calificaciones - Generación de Certificado Anual</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Modulo Docente - Consulta de Calificaciones -->

    <!-- Main content -->
    <section class="content">
        <div class="card">  
            <div class="card-header">
                <h3 class="card-title">Periodo: {{$matricula->oferta->periodo->per_nombre}} / Seccion: {{$matricula->oferta->curso->seccion->sec_nombre}} / Curso: {{$matricula->oferta->curso->cur_nombre}} {{$matricula->oferta->curso->cur_paralelo}} / Tutor de Curso: {{$matricula->oferta->personal->pers_nombres}} {{$matricula->oferta->personal->pers_apellidos}} / Alumno: {{$matricula->alumno->alum_nombres}} {{$matricula->alumno->alum_apellidos}}</h3> 
            </div>
            <div class="card-header">
                <h4 class="card-title"><strong>Calificaciones</strong></h4> 
            </div>
            <form action="{{action('App\Http\Controllers\Docente\CalificacionesController@generarPDFPromAnualCertificado', ['mat_id' => $matricula->mat_id])}}" method="post">
            {{csrf_field()}}
            <div class="card-body" style="overflow:scroll;"> 
                <table id="column" class="table table-bordered table-striped">
                    <thead>
                        <tr align="center">
                            <th scope="col">Asignaturas</th>
                            <th scope="col">Prom.Q1</th>
                            <th scope="col">Prom.Q2</th>
                            <th scope="col">Prom.Anual</th>
                            <th scope="col">Letras</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($calificaciones as $calificacion)  
                        @if($calificacion->cal_estado == 1)  
                        <tr align="center" class="multiCalc">
                            <td style="min-width: 200px;">
                                {{$calificacion->malla->asignatura->asig_nom}} 
                            </td>
                            <td style="min-width: 20px;">
                                @if($calificacion->cal_promTotalQ1)
                                    {{$calificacion->cal_promTotalQ1}}
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
                                @if($calificacion->cal_escalaAnual)
                                    {{$calificacion->cal_escalaAnual}}
                                @else
                                    N/A
                                @endif   
                            </td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body Calificaciones -->

            <div class="card-header">
                <h4 class="card-title"><strong>Comportamiento</strong></h4> 
            </div>

            <div class="card-body" style="overflow:scroll;"> 
                <table id="column" class="table table-bordered table-striped">
                    <thead>
                        <tr align="center">
                            <th>Prom.Q1</th>
                            <th>Prom.Q2</th>
                            <th>Prom.Anual</th>
                            <th>Escala Anual</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($comportamientos as $comportamiento) 
                        @if($comportamiento->cond_estado == 1)
                        <tr align="center" class="multiCalc">
                        <td style="min-width: 200px;">
                                @if($comportamiento->cond_notaQ1)
                                    {{$comportamiento->cond_notaQ1}}
                                @else
                                    D
                                @endif   
                            </td>
                            <td style="min-width: 200px;">
                                @if($comportamiento->cond_notaQ2)
                                    {{$comportamiento->cond_notaQ2}}
                                @else
                                    D
                                @endif   
                            </td>
                            <td style="min-width: 20px;">
                                @if($comportamiento->cond_notaAnual)
                                    {{$comportamiento->cond_notaAnual}}
                                @else
                                    N/A
                                @endif   
                            </td>
                            <td style="min-width: 20px;">
                                @if($comportamiento->cond_escalaAnual)
                                    {{$comportamiento->cond_escalaAnual}}
                                @else
                                    N/A
                                @endif   
                            </td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body Comportamiento -->

            <div class="card-header">
                <h4 class="card-title"><strong>Configuracion para generación del certtificado anual</strong></h4> 
            </div>

            <div class="card-body" style="overflow:scroll;"> 
                <strong><p>Periodo (Ingrese el año lectivo) *:</p></strong>
                <input name ="mat_id" type="hidden" value ="{{old('mat_id', $matricula->mat_id)}}">
                <input type="text" id="periodo" class="form-control" name="periodo" required>
                <br>
                <strong><p>Curso (Ingrese el curso en Mayusculas) *:</p></strong>
                <input name ="mat_id" type="hidden" value ="{{old('mat_id', $matricula->mat_id)}}">
                <input type="text" id="curso" class="form-control" name="curso" required>
                <br>
                <strong><p>Promedio General Anual (Ingrese el promedio general anual calculado) *:</p></strong>
                <input name ="mat_id" type="hidden" value ="{{old('mat_id', $matricula->mat_id)}}">
                <input type="text" id="promedio_anual" class="form-control" name="promedio_anual" required>
                <br>
                <strong><p>Escala Cualitativa General "Prom. Anual" (Seleccione la escala cualitativa general del Promedio Anual) *:</p></strong>
                <input name ="mat_id" type="hidden" value ="{{old('mat_id', $matricula->mat_id)}}">
                <select name="escala_prom_anual" id="escala_prom_anual" type='text' class="form-control" required>
                    <option value="DAR">DAR</option>
                    <option value="AAR">AAR</option>
                    <option value="PAAR">PAAR</option>
                    <option value="NAAR">NAAR</option>
                </select>
                <br>
                <strong><p>Observación (Ingrese la observación relacionado con la promoción del estudiante al curso proximo)*:</p></strong>
                <input name ="mat_id" type="hidden" value ="{{old('mat_id', $matricula->mat_id)}}">
                <input type="text" id="observacion" class="form-control" name="observacion" required>
                <br>
                <strong><p>Abreviatura (Seleccione la abreviatura para el Tutor de Curso) *:</p></strong>
                <input name ="mat_id" type="hidden" value ="{{old('mat_id', $matricula->mat_id)}}">
                <select name="abreviatura" id="abreviatura" type='text' class="form-control" required>
                    <option value="LCDO.">LCDO.</option>
                    <option value="LCDA.">LCDA.</option>
                    <option value="PROFR.">PROFR.</option>
                    <option value="PROFA.">PROFA.</option>
                    <option value="MGTR.">MGTR.</option>
                    <option value="TNLGO.">TNLGO.</option>
                    <option value="TNLGA.">TNLGA.</option>
                    <option value="ARQ.">ARQ.</option>
                    <option value="ING.">ING.</option>
                </select>
                <br>
                <strong><p>Nombre y Apellido del Tutor de Curso (Ingrese los nombres y apellidos del tutor de curso) *:</p></strong>
                <input name ="mat_id" type="hidden" value ="{{old('mat_id', $matricula->mat_id)}}">
                <input type="text" id="nom_ape_tutor" class="form-control" name="nom_ape_tutor" required>
                <br>
                <strong><p>Abreviatura (Seleccione la abreviatura para el Rector/a) *:</p></strong>
                <input name ="mat_id" type="hidden" value ="{{old('mat_id', $matricula->mat_id)}}">
                <select name="abreviatura_rector" id="abreviatura_rector" type='text' class="form-control" required>
                    <option value="LCDO.">LCDO.</option>
                    <option value="LCDA.">LCDA.</option>
                    <option value="PROFR.">PROFR.</option>
                    <option value="PROFA.">PROFA.</option>
                    <option value="MGTR.">MGTR.</option>
                    <option value="TNLGO.">TNLGO.</option>
                    <option value="TNLGA.">TNLGA.</option>
                    <option value="ARQ.">ARQ.</option>
                    <option value="ING.">ING.</option>
                </select>
                <br>
                <strong><p>Nombre y Apellido del Rector/a (Ingrese los nombres y apellidos del rector/a) *:</p></strong>
                <input name ="mat_id" type="hidden" value ="{{old('mat_id', $matricula->mat_id)}}">
                <input type="text" id="nom_ape_rector" class="form-control" name="nom_ape_rector" required>
            </div>
            <!-- /.card-body Configuracion para generación del certificado del Primer Quimestre -->

            <div class="card-footer">
                <a href="{{url('docente/calificacion/cursos/listado', ['ofer_id' => $matricula->ofer_id])}}">
                    <button type="button" class="btn btn-warning center-block">
                        Regresar
                        <i class="fas fa-arrow-left"></i>
                    </button>
                </a>
                <a href="{{url('docente/calificacion/cursos', ['pers_id' => $matricula->oferta->pers_id])}}">
                    <button type="button" class="btn btn-info center-block">
                        Volver al menu de cursos
                        <i class="fas fa-home"></i>
                    </button>
                </a>
                <button class="btn btn-danger" type="submit">
                    Generar Certificado Anual
                    <i class="fas fa-file-pdf"></i>
                </button>
            </div>
        </div>
        <!-- /.card -->
        </form>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('js')

@endsection