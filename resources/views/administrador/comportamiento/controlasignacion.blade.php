@extends('backend.app')

@section('title')
Modulo Administrador - Control de Asignaciones (Comportamiento) - {{$oferta->periodo->per_nombre}} - {{$oferta->curso->seccion->sec_nombre}} - {{$oferta->curso->cur_nombre}} {{$oferta->curso->cur_paralelo}} - {{$oferta->personal->pers_nombres}} {{$oferta->personal->pers_apellidos}}
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) - Modulo Administrador/a - Control de Asignaciones (Comportamiento) -->
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Control de Asignaciones (Comportamiento)</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header - Modulo Administrador/a - Control de Asignaciones (Comportamiento) -->

  <!-- Main content -->
  <section class="content">
    <div class="card">  
        <div class="card-header">
            <h3 class="card-title">Periodo: {{$oferta->periodo->per_nombre}} / Seccion: {{$oferta->curso->seccion->sec_nombre}} / Curso: {{$oferta->curso->cur_nombre}} {{$oferta->curso->cur_paralelo}} / Tutor de Curso: {{$oferta->personal->pers_nombres}} {{$oferta->personal->pers_apellidos}}</h3> 
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
                  @foreach($comportamientos as $comportamiento)   
                    <tr align="center">
                        <td>
                            {{$comportamiento->oferta->periodo->per_nombre}} - {{$comportamiento->oferta->curso->seccion->sec_nombre}} - {{$comportamiento->oferta->curso->cur_nombre}} {{$comportamiento->oferta->curso->cur_paralelo}}                                        
                        </td>
                        <td>
                            {{$comportamiento->matricula->alumno->alum_nombres}} {{$comportamiento->matricula->alumno->alum_apellidos}}
                        </td>
                        <td>
                            @if($comportamiento->cond_estado == 1)   
                                <p>Activo</p>
                            @else
                                <p>Desactivado</p>
                            @endif                                               
                        </td>
                        <td>
                            <a href="{{url('administrador/comportamiento/controlasignacion/edit', ['cond_id' => $comportamiento->cond_id])}}">
                            <button type="button" class="btn btn-secondary center-block" title="Cambiar Asignacion">
                                <i class="fas fa-edit"></i>
                            </button>
                            </a>    
                        </td>
                        <td>
                            <a href="{{url('administrador/comportamiento/controlasignacion/reemplazar', ['cond_id' => $comportamiento->cond_id])}}">
                            <button type="button" class="btn btn-info center-block" title="Reemplazar Asignacion">
                                <i class="fas fa-people-arrows"></i>
                            </button>
                            </a>    
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger center-block" data-toggle="modal" data-target="#delete-comasignacion" title="Eliminar Asignacion" data-cond_id={{$comportamiento->cond_id}}>
                                <i class="fas fa-trash"></i>
                            </button>
                            <div class="modal fade" id="delete-comasignacion">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-danger">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Eliminar Asignacion</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{url('administrador/comportamiento/controlasignacion/destroy')}}" method="post">
                                            {{method_field('delete')}}            
                                            {{csrf_field()}}
                                        <div class="modal-body">
                                            <p>¿Esta seguro de eliminar a este alumno de esta lista?</p>
                                            <input type="hidden" name="cond_id" id="cond_id" value="">
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
            <a href="/administrador/comportamiento/index">
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
