@extends('backend.app')

@section('title')
Modulo Docente - Consultar Calificaciones (Proyectos Escolares) - {{$tutproyecto->oferta->periodo->per_nombre}} - {{$tutproyecto->oferta->curso->seccion->sec_nombre}} - {{$tutproyecto->oferta->curso->cur_nombre}} {{$tutproyecto->oferta->curso->cur_paralelo}} - Quimestre 2
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) - Modulo Docente - Consultar Calificaciones (Proyectos Escolares) -->
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Consultar Calificaciones (Proyectos Escolares)</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header - Modulo Docente - Consultar Calificaciones (Proyectos Escolares) -->

  <!-- Main content -->
  <section class="content">
    <div class="card">  
        <div class="card-header">
            <h3 class="card-title">Periodo: {{$tutproyecto->oferta->periodo->per_nombre}} / Seccion: {{$tutproyecto->oferta->curso->seccion->sec_nombre}} / Curso: {{$tutproyecto->oferta->curso->cur_nombre}} {{$tutproyecto->oferta->curso->cur_paralelo}} / Tutor de Proyecto Escolar: {{$tutproyecto->personal->pers_nombres}} {{$tutproyecto->personal->pers_apellidos}} - Quimestre: 2</h3> 
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="overflow:scroll;">
            <table id="example2" class="table table-bordered table-striped table-count">
                <thead>
                    <tr align="center">
                        <th>Nombres y Apellidos</th>
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
                    <tr align="center">
                        <td>
                            {{$proyescolar->matricula->alumno->alum_nombres}} {{$proyescolar->matricula->alumno->alum_apellidos}}
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
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <a href="{{url('docente/proyescolar/cursos', ['pers_id' => $tutproyecto->pers_id])}}">
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