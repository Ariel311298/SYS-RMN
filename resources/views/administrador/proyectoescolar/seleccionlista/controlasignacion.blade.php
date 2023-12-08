@extends('backend.app')

@section('title')
Modulo Administrador - Control de Asignaciones (Proyectos Escolares) - {{$tutorproyecto->oferta->periodo->per_nombre}} - {{$tutorproyecto->oferta->curso->seccion->sec_nombre}} - {{$tutorproyecto->oferta->curso->cur_nombre}} {{$tutorproyecto->oferta->curso->cur_paralelo}}
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) - Modulo Administrador/a - Control de Asignaciones (Proyectos Escolares) -->
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Control de Asignaciones (Proyectos Escolares)</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header - Modulo Administrador/a - Control de Asignaciones (Proyectos Escolares) -->

  <!-- Main content -->
  <section class="content">
    <div class="card">  
        <div class="card-header">
            <h3 class="card-title">Periodo: {{$tutorproyecto->oferta->periodo->per_nombre}} / Seccion: {{$tutorproyecto->oferta->curso->seccion->sec_nombre}} / Curso: {{$tutorproyecto->oferta->curso->cur_nombre}} {{$tutorproyecto->oferta->curso->cur_paralelo}} / Tutor de Proyecto Escolar: {{$tutorproyecto->personal->pers_nombres}} {{$tutorproyecto->personal->pers_apellidos}}</h3> 
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="overflow:scroll;">
            <table id="example2" class="table table-bordered table-striped table-count">
                <thead>
                    <tr align="center">
                      <th>Periodo - Seccion - Curso</th>
                      <th>Nombres y Apellidos</th>
                      <th>Estado</th>
                      <th colspan="3">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($proyescolares as $proyescolar)   
                    <tr align="center">
                        <td>
                            {{$proyescolar->tutorproyecto->oferta->periodo->per_nombre}} - {{$proyescolar->tutorproyecto->oferta->curso->seccion->sec_nombre}} - {{$proyescolar->tutorproyecto->oferta->curso->cur_nombre}} {{$proyescolar->tutorproyecto->oferta->curso->cur_paralelo}}                                        
                        </td>
                        <td>
                            {{$proyescolar->matricula->alumno->alum_nombres}} {{$proyescolar->matricula->alumno->alum_apellidos}}
                        </td>
                        <td>
                            @if($proyescolar->proy_estado == 1)   
                                <p>Activo</p>
                            @else
                                <p>Desactivado</p>
                            @endif                                               
                        </td>
                        <td>
                            <a href="{{url('administrador/proyectoescolar/seleccionlista/controlasignacion/edit', ['proy_id' => $proyescolar->proy_id])}}">
                            <button type="button" class="btn btn-secondary center-block" title="Cambiar Asignacion">
                                <i class="fas fa-edit"></i>
                            </button>
                            </a>    
                        </td>
                        <td>
                            <a href="{{url('administrador/proyectoescolar/seleccionlista/controlasignacion/reemplazar', ['proy_id' => $proyescolar->proy_id])}}">
                            <button type="button" class="btn btn-info center-block" title="Reemplazar Asignacion">
                                <i class="fas fa-people-arrows"></i>
                            </button>
                            </a>    
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger center-block" data-toggle="modal" data-target="#delete-proyasignacion" title="Eliminar Asignacion" data-proy_id={{$proyescolar->proy_id}}>
                                <i class="fas fa-trash"></i>
                            </button>
                            <div class="modal fade" id="delete-proyasignacion">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-danger">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Eliminar Asignacion</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{url('administrador/proyectoescolar/seleccionlista/destroy')}}" method="post">
                                            {{method_field('delete')}}            
                                            {{csrf_field()}}
                                        <div class="modal-body">
                                            <p>¿Esta seguro de eliminar a este alumno de esta lista?</p>
                                            <input type="hidden" name="proy_id" id="proy_id" value="">
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">
                                                Cerrar
                                                <i class="fas fa-arrow-left"></i>
                                            </button>
                                            <button class="btn btn-outline-light" type="submit">
                                                Borrar
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->         
                        </td>  
                    </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <a href="{{url('administrador/proyectoescolar/seleccionlista', ['ofer_id' => $tutorproyecto->oferta->ofer_id])}}">
                <button type="button" class="btn btn-warning center-block">
                    Regresar
                    <i class="fas fa-arrow-left"></i>
                </button>
            </a>
            <a href="/administrador/proyectoescolar/index">
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