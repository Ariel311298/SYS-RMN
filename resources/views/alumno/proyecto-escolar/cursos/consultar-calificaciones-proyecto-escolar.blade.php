@extends('backend.app')

@section('title')
Modulo Alumno - Consulta de Calificaciones del Proyecto Escolar - {{$matricula->oferta->periodo->per_nombre}} - {{$matricula->oferta->curso->seccion->sec_nombre}} - {{$matricula->oferta->curso->cur_nombre}} {{$matricula->oferta->curso->cur_paralelo}}
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) - Modulo Alumno - Consulta de Calificaciones del Proyecto Escolar -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Consulta de Calificaciones del Proyecto Escolar</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Modulo Alumno - Consulta de Calificaciones del Proyecto Escolar -->

    <!-- Main content -->
    <section class="content">
        <div class="card">  
            <div class="card-header">
                <h3 class="card-title">Periodo: {{$matricula->oferta->periodo->per_nombre}} / Seccion: {{$matricula->oferta->curso->seccion->sec_nombre}} / Curso: {{$matricula->oferta->curso->cur_nombre}} {{$matricula->oferta->curso->cur_paralelo}} / Tutor de Curso: {{$matricula->oferta->personal->pers_nombres}} {{$matricula->oferta->personal->pers_apellidos}}</h3> 
            </div>
            <!-- /.card-header -->

            <div class="card-body" style="overflow:scroll;"> 
                <table id="column" class="table table-bordered table-striped">
                    <thead>
                        <tr align="center">
                            <th>Tutor de Proyecto Escolar</th>
                            <th>Prom. Parc 1</th>
                            <th>Prom. Parc 2</th>
                            <th>Prom.Q1</th>
                            <th>Prom. Parc 1</th>
                            <th>Prom. Parc 2</th>
                            <th>Prom.Q2</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($proyescolares as $proyescolar)  
                    @if($proyescolar->proy_estado == 1)   
                    <tr align="center">
                        <td>
                            {{$proyescolar->tutorproyecto->personal->pers_nombres}} {{$proyescolar->tutorproyecto->personal->pers_apellidos}}
                        </td>
                        <td>
                            @if($proyescolar->proy_prom_parcialP1Q1)
                                {{$proyescolar->proy_prom_parcialP1Q1}}
                            @else
                                R
                            @endif                                        
                        </td>
                        <td>
                            @if($proyescolar->proy_prom_parcialP2Q1)
                                {{$proyescolar->proy_prom_parcialP2Q1}}
                            @else
                                R
                            @endif                                        
                        </td>
                        <td>
                            @if($proyescolar->proy_promTotalQ1)
                                {{$proyescolar->proy_promTotalQ1}}
                            @else
                                R
                            @endif                                        
                        </td>
                        <td>
                            @if($proyescolar->proy_prom_parcialP1Q2)
                                {{$proyescolar->proy_prom_parcialP1Q2}}
                            @else
                                R
                            @endif                                        
                        </td>
                        <td>
                            @if($proyescolar->proy_prom_parcialP2Q2)
                                {{$proyescolar->proy_prom_parcialP2Q2}}
                            @else
                                R
                            @endif                                        
                        </td>
                        <td>
                            @if($proyescolar->proy_promTotalQ2)
                                {{$proyescolar->proy_promTotalQ2}}
                            @else
                                R
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
                <a href="{{url('alumno/proyecto-escolar/cursos', ['alum_id' => $matricula->alumno->alum_id])}}">
                    <button type="button" class="btn btn-danger center-block">
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