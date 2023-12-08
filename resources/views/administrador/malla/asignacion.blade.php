@extends('backend.app')

@section('title')
Modulo Administrador - Administracion de Asignaciones (Malla Curricular) - {{$oferta->curso->cur_nombre}} {{$oferta->curso->cur_paralelo}}
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) - Modulo Administrador/a - Administracion de Asignaciones (Malla Curricular) -->
  <div class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
              <div class="col-sm-6">
                  <h1 class="m-0">Administracion de Asignaciones (Malla Curricular)</h1>
              </div><!-- /.col -->
          </div><!-- /.row -->
      </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header - Modulo Administrador/a - Administracion de Asignaciones (Malla Curricular) -->

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
                    <th colspan="2">Opciones</th>
                  </tr>
              </thead>
              <tbody>
                @foreach($mallas as $malla)   
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
                      <a href="{{url('administrador/malla/edit', ['mal_id' => $malla->mal_id])}}">
                        <button type="button" class="btn btn-secondary center-block" title="Editar Asignación">
                          <i class="fas fa-edit"></i>
                        </button>
                      </a>                                       
                    </td>
                    <td>
                      <button type="button" class="btn btn-danger center-block" data-toggle="modal" data-target="#delete-malla" title="Eliminar Asignacion" data-mal_id={{$malla->mal_id}}>
                        <i class="fas fa-trash"></i>
                      </button>                                                         
                      <div class="modal fade" id="delete-malla">
                        <div class="modal-dialog">
                          <div class="modal-content bg-danger">
                            <div class="modal-header">
                              <h4 class="modal-title">Eliminar Asignación</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{url('administrador/malla/destroy')}}" method="post">
                              {{method_field('delete')}}            
                              {{csrf_field()}}
                              <div class="modal-body">
                                <p>¿Esta seguro de eliminar esta asignacion?</p>
                                <input type="hidden" name="mal_id" id="mal_id" value="">
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
              <a href="/administrador/malla/index">
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

