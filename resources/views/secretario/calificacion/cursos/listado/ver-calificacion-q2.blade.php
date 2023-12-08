@extends('backend.app')

@section('title')
Modulo Secretario - Consulta de Calificaciones - {{$matricula->oferta->periodo->per_nombre}} - {{$matricula->oferta->curso->seccion->sec_nombre}} - {{$matricula->oferta->curso->cur_nombre}} {{$matricula->oferta->curso->cur_paralelo}} - Quimestre: 2
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) - Modulo Secretario - Consulta de Calificaciones -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Consulta de Calificaciones - Generación de Certificado del Segundo Quimestre</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Modulo Secretario - Consulta de Calificaciones -->

    <!-- Main content -->
    <section class="content">
        <div class="card">  
            <div class="card-header">
                <h3 class="card-title">Periodo: {{$matricula->oferta->periodo->per_nombre}} / Seccion: {{$matricula->oferta->curso->seccion->sec_nombre}} / Curso: {{$matricula->oferta->curso->cur_nombre}} {{$matricula->oferta->curso->cur_paralelo}} / Tutor de Curso: {{$matricula->oferta->personal->pers_nombres}} {{$matricula->oferta->personal->pers_apellidos}} / Alumno: {{$matricula->alumno->alum_nombres}} {{$matricula->alumno->alum_apellidos}}</h3> 
            </div>
            <div class="card-header">
                <h4 class="card-title"><strong>Calificaciones</strong></h4> 
            </div>
            <div class="card-body" style="overflow:scroll;"> 
                <table id="column" class="table table-bordered table-striped">
                    <thead>
                        <tr align="center">
                            <th scope="col">Asignaturas</th>
                            <th scope="col">P1</th>
                            <th scope="col">P2</th>
                            <th scope="col">Prom.Parc</th>
                            <th scope="col">%Prom(80%)</th>
                            <th scope="col">Exam</th>
                            <th scope="col">%Exam</th>
                            <th scope="col">Prom.Q2</th>
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
                            <td style="min-width: 10px;">
                                @if($calificacion->cal_promParQ2)
                                    {{$calificacion->cal_promParQ2}}
                                @else
                                    0.00
                                @endif
                            </td>
                            <td style="min-width: 10px;">
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
                            <th>Prom.Q2</th>
                            <th>Escala</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($comportamientos as $comportamiento) 
                        @if($comportamiento->cond_estado == 1) 
                        <tr align="center" class="multiCalc">
                            <td style="min-width: 200px;">
                                @if($comportamiento->cond_notaQ2)
                                    {{$comportamiento->cond_notaQ2}}
                                @else
                                    D
                                @endif   
                            </td>
                            <td style="min-width: 20px;">
                                @if($comportamiento->cond_escalaQ2)
                                    {{$comportamiento->cond_escalaQ2}}
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
                <h4 class="card-title"><strong>Proyecto Escolar</strong></h4> 
            </div>

            <div class="card-body" style="overflow:scroll;"> 
                <table id="column" class="table table-bordered table-striped">
                    <thead>
                        <tr align="center">
                            <th>P1</th>
                            <th>P2</th>
                            <th>Prom.Q2</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($proyescolares as $proyescolar)
                        @if($proyescolar->proy_estado == 1)     
                        <tr align="center" class="multiCalc">
                        <td>
                            @if($proyescolar->proy_prom_parcialP1Q2)
                                {{$proyescolar->proy_prom_parcialP1Q2}}
                            @else
                                N/A
                            @endif                                        
                        </td>
                        <td>
                            @if($proyescolar->proy_prom_parcialP2Q2)
                                {{$proyescolar->proy_prom_parcialP2Q2}}
                            @else
                                N/A
                            @endif                                        
                        </td>
                        <td>
                            @if($proyescolar->proy_promTotalQ2)
                                {{$proyescolar->proy_promTotalQ2}}
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
            <!-- /.card-body Proyecto Escolar -->

            <div class="card-header">
                <h4 class="card-title"><strong>Configuracion para generación del certificado del Segundo Quimestre</strong></h4> 
            </div>
            <form action="{{action('App\Http\Controllers\Secretario\ListCalifController@generarPDFPromQ2Certificado', ['mat_id' => $matricula->mat_id])}}" method="post">
            {{csrf_field()}}
            <div class="card-body" style="overflow:scroll;"> 
                <strong><p>Periodo (Ingrese el año lectivo) *:</p></strong>
                <input name ="mat_id" type="hidden" value ="{{old('mat_id', $matricula->mat_id)}}">
                <input type="text" id="periodo" class="form-control" name="periodo" required>
                <br>
                <strong><p>Curso y Sección (Ingrese el curso y la sección en Mayusculas) *:</p></strong>
                <input name ="mat_id" type="hidden" value ="{{old('mat_id', $matricula->mat_id)}}">
                <input type="text" id="curso_seccion" class="form-control" name="curso_seccion" required>
                <br>
                <strong><p>Suma General "Q2" (Ingrese la suma general calculada del Segundo Quimestre) *:</p></strong>
                <input name ="mat_id" type="hidden" value ="{{old('mat_id', $matricula->mat_id)}}">
                <input type="text" id="suma_q2" class="form-control" name="suma_q2" required>
                <br>
                <strong><p>Promedio General "Q2" (Ingrese el promedio general calculado del Segundo Quimestre) *:</p></strong>
                <input name ="mat_id" type="hidden" value ="{{old('mat_id', $matricula->mat_id)}}">
                <input type="text" id="promedio_q2" class="form-control" name="promedio_q2" required>
                <br>
                <strong><p>Escala Cualitativa General "Prom. Q2" (Seleccione la escala cualitativa general del Segundo Quimestre) *:</p></strong>
                <input name ="mat_id" type="hidden" value ="{{old('mat_id', $matricula->mat_id)}}">
                <select name="escala_prom_q2" id="escala_prom_q2" type='text' class="form-control" required>
                    <option value="DAR">DAR</option>
                    <option value="AAR">AAR</option>
                    <option value="PAAR">PAAR</option>
                    <option value="NAAR">NAAR</option>
                </select>
                <br>
                <strong><p>Recomendaciones *:</p></strong>
                <input name ="mat_id" type="hidden" value ="{{old('mat_id', $matricula->mat_id)}}">
                <input type="text" id="recomendaciones" class="form-control" name="recomendaciones" required>
                <br>
                <strong><p>Fecha de Emisión (Ingrese la fecha de emisión del certificado quimestral) *:</p></strong>
                <input name ="mat_id" type="hidden" value ="{{old('mat_id', $matricula->mat_id)}}">
                <input type="text" id="fecha_emision" class="form-control" name="fecha_emision" required>
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
                <a href="{{url('secretario/calificacion/cursos/listado', ['ofer_id' => $matricula->ofer_id])}}">
                    <button type="button" class="btn btn-warning center-block">
                        Regresar
                        <i class="fas fa-arrow-left"></i>
                    </button>
                </a>
                <a href="/secretario/calificacion/cursos">
                    <button type="button" class="btn btn-info center-block">
                        Volver al menu de cursos
                        <i class="fas fa-home"></i>
                    </button>
                </a>
                <button class="btn btn-danger" type="submit">
                    Generar Certificado Quimestral
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