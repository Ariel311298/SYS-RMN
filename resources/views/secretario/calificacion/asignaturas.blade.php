@extends('backend.app')

@section('title')
Modulo Secretario - Gestionar Asignaciones (Calificaciones) - Asignaturas - {{$oferta->periodo->per_nombre}} - {{$oferta->curso->seccion->sec_nombre}} - {{$oferta->curso->cur_nombre}} {{$oferta->curso->cur_paralelo}}
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) - Modulo Secretario/a - Gestionar Asignaciones (Calificaciones) - Asignaturas -->
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Gestionar Asignaciones (Calificaciones) - Asignaturas</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header - Modulo Secretario/a - Gestionar Asignaciones (Calificaciones) - Asignaturas -->

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
                      <th colspan="1">Opciones</th>
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
                        <a href="{{url('secretario/calificacion/asignaturas/controlasignacion', ['mal_id' => $malla->mal_id])}}">
                          <button type="button" class="btn btn-info center-block" title="Control de Lista de Alumnos">
                            <i class="fas fa-wrench"></i>
                          </button>
                        </a>    
                      </td>
                    </tr>
                    @endif
                  @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <a href="/secretario/calificacion/index">
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
  $(function () {
    $("#example1").DataTable({
      "lengthChange": false, "autoWidth": false, "paging": false, "info": false, "ordering": true, "responsive": false, "searching": false
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
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
