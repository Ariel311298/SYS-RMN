@extends('backend.app')

@section('title')
Modulo Administrador - Gestionar Asignaciones (Proyectos Escolares) - {{$oferta->curso->cur_nombre}} {{$oferta->curso->cur_paralelo}}
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) - Modulo Administrador/a - Gestionar Asignaciones (Proyectos Escolares) - Tutor de Proyectos Escolares -->
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Gestionar Asignaciones (Proyectos Escolares)</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header - Modulo Administrador/a - Gestionar Asignaciones (Proyectos Escolares) - Tutor de Proyectos Escolares -->

  <!-- Main content -->
  <section class="content">
    <div class="card">  
        <div class="card-header">
            <h3 class="card-title">Periodo: {{$oferta->periodo->per_nombre}} / Seccion: {{$oferta->curso->seccion->sec_nombre}} / Curso: {{$oferta->curso->cur_nombre}} {{$oferta->curso->cur_paralelo}} / Tutor de Curso: {{$oferta->personal->pers_nombres}} {{$oferta->personal->pers_apellidos}}</h3> 
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example2" class="table table-bordered table-striped table-count">
                <thead>
                    <tr align="center">
                      <th>Curso</th>
                      <th>Paralelo</th>
                      <th>Docente</th>
                      <th>Estado</th>
                      <th colspan="2">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($tutorproyectos as $tutorproyecto)
                    @if($tutorproyecto->tutproy_estado == 1)    
                    <tr align="center">
                      <td>
                        {{$tutorproyecto->oferta->curso->cur_nombre}}
                      </td>
                      <td>
                        {{$tutorproyecto->oferta->curso->cur_paralelo}}                                                            
                      </td>
                      <td>
                        {{$tutorproyecto->personal->pers_nombres}} {{$tutorproyecto->personal->pers_apellidos}}                                                            
                      </td>
                      <td>
                        @if($tutorproyecto->tutproy_estado == 1)   
                          <p>Activo</p>
                        @else
                          <p>Desactivado</p>
                        @endif                                               
                      </td>
                      <td>
                        <a href="{{url('administrador/proyectoescolar/seleccionlista/controlasignacion', ['tutproy_id' => $tutorproyecto->tutproy_id])}}">
                          <button type="button" class="btn btn-info center-block" title="Control de Asignaciones de Alumnos">
                            <i class="fas fa-wrench"></i>
                          </button>
                        </a>    
                      </td>
                      <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-secondary" title="Consultar Calificaciones (Proyecto Escolar)"> <i class="fas fa-table"></i></button>
                        <button type="button" class="btn btn-secondary dropdown-toggle dropdown-icon" data-toggle="dropdown">
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <a class="dropdown-item" href="{{url('administrador/proyectoescolar/seleccionlista/consultar-calificacion-proyecto-escolar-prom-q1', ['tutproy_id' => $tutorproyecto->tutproy_id])}}">Prom. Quimestral (Q1)</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="{{url('administrador/proyectoescolar/seleccionlista/consultar-calificacion-proyecto-escolar-prom-q2', ['tutproy_id' => $tutorproyecto->tutproy_id])}}">Prom. Quimestral (Q2)</a> 
                          <div class="dropdown-divider"></div>  
                          <a class="dropdown-item" href="{{url('administrador/proyectoescolar/seleccionlista/consultar-calificacion-proyecto-escolar-prom', ['tutproy_id' => $tutorproyecto->tutproy_id])}}">Prom. Anual</a>  
                      </td>
                      </div>
                    </tr>
                    @endif
                  @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <a href="/administrador/proyectoescolar/index">
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

@section('js')
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