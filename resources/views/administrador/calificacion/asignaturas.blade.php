@extends('backend.app')

@section('title')
Modulo Administrador - Gestionar Asignaciones (Calificaciones) - Asignaturas - {{$oferta->periodo->per_nombre}} - {{$oferta->curso->seccion->sec_nombre}} - {{$oferta->curso->cur_nombre}} {{$oferta->curso->cur_paralelo}}
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) - Modulo Administrador/a - Gestionar Asignaciones (Calificaciones) - Asignaturas -->
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Gestionar Asignaciones (Calificaciones) - Asignaturas</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header - Modulo Administrador/a - Gestionar Asignaciones (Calificaciones) - Asignaturas -->

  <!-- Main content -->
  <section class="content">
    <div class="card">  
        <div class="card-header">
            <h3 class="card-title">Periodo: {{$oferta->periodo->per_nombre}} / Seccion: {{$oferta->curso->seccion->sec_nombre}} / Curso: {{$oferta->curso->cur_nombre}} {{$oferta->curso->cur_paralelo}} / Tutor de Curso: {{$oferta->personal->pers_nombres}} {{$oferta->personal->pers_apellidos}}</h3> 
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="overflow:scroll;">
            <table id="example1" class="table table-bordered table-striped table-count">
                <thead>
                    <tr align="center">
                      <th>Curso</th>
                      <th>Paralelo</th>
                      <th>Asignatura</th>
                      <th>Docente</th>
                      <th>Estado</th>
                      <th colspan="3">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($mallas as $malla)  
                    @if($malla->mal_estado == 1) 
                    <tr align="center">
                      <td>
                        {{$malla->oferta->curso->cur_nombre}}
                      </td>
                      <td>
                        {{$malla->oferta->curso->cur_paralelo}}                                                            
                      </td>
                      <td>
                        {{$malla->asignatura->asig_nom}}                                                            
                      </td>
                      <td>
                        {{$malla->personal->pers_nombres}} {{$malla->personal->pers_apellidos}}                                                            
                      </td>
                      <td>
                        @if($malla->mal_estado == 1)   
                          <p>Activo</p>
                        @else
                          <p>Desactivado</p>
                        @endif                                               
                      </td>
                      <td>
                        <a href="{{url('administrador/calificacion/asignaturas/controlasignacion', ['mal_id' => $malla->mal_id])}}">
                          <button type="button" class="btn btn-primary center-block" title="Control de Lista de Alumnos">
                            <i class="fas fa-wrench"></i>
                          </button>
                        </a>    
                      </td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-secondary" title="Consultar Calificaciones"> <i class="fas fa-table"></i></button>
                          <button type="button" class="btn btn-secondary dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" href="{{url('administrador/calificacion/asignaturas/consultar-calificacion-prom-p1q1', ['mal_id' => $malla->mal_id])}}">Prom. Parcial 1 (Q1)</a>
                            <a class="dropdown-item" href="{{url('administrador/calificacion/asignaturas/consultar-calificacion-prom-p2q1', ['mal_id' => $malla->mal_id])}}">Prom. Parcial 2 (Q1)</a>
                            <a class="dropdown-item" href="{{url('administrador/calificacion/asignaturas/consultar-calificacion-prom-q1', ['mal_id' => $malla->mal_id])}}">Prom. Quimestral (Q1)</a>
                          <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{url('administrador/calificacion/asignaturas/consultar-calificacion-prom-p1q2', ['mal_id' => $malla->mal_id])}}">Prom. Parcial 1 (Q2)</a> 
                            <a class="dropdown-item" href="{{url('administrador/calificacion/asignaturas/consultar-calificacion-prom-p2q2', ['mal_id' => $malla->mal_id])}}">Prom. Parcial 2 (Q2)</a>  
                            <a class="dropdown-item" href="{{url('administrador/calificacion/asignaturas/consultar-calificacion-prom-q2', ['mal_id' => $malla->mal_id])}}">Prom. Quimestral (Q2)</a>
                          <div class="dropdown-divider"></div>  
                            <a class="dropdown-item" href="{{url('administrador/calificacion/asignaturas/consultar-calificacion-prom-anual', ['mal_id' => $malla->mal_id])}}">Prom. Anual</a> 
                        </div>
                      </td>
                    </tr>
                    @endif
                  @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <a href="/administrador/calificacion/index">
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


