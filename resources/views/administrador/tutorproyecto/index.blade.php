@extends('backend.app')

@section('title')
Modulo Administrador - Control de Asignaciones de Tutores de Proyecto Escolar
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) - Modulo Administrador/a - Control de Asignaciones de Tutores de Proyecto Escolar -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Modulo Administrador/a - Control de Asignaciones de Tutores de Proyecto Escolar</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header - Modulo Administrador/a - Gestionar Asignaciones (Malla Curricular) -->

        <!-- Main content -->
        <section class="content">
            <div class="card">  
                <div class="card-header">
                    <h3 class="card-title">Tabla de Cursos</h3>
                    <a href="/administrador/tutorproyecto/create">
                        <button type="button" class="btn btn-primary float-right" title="Nuevo Tutor de Proyectos Escolares">
                            Nuevo Tutor
                            <i class="fas fa-plus"></i>
                        </button>
                    </a>   
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="overflow:scroll;">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr align="center">
                                <th rowspan="2">Periodo</th>
                                <th rowspan="2">Seccion</th>
                                <th rowspan="2">Curso</th>
                                <th rowspan="2">Paralelo</th>
                                <th rowspan="2">Tutor de Proyecto Escolar</th>
                                <th rowspan="2">Estado</th>
                                <th colspan="3">Opciones</th>
                            </tr>
                            <tr align="center">
                                <th>#1</th>
                                <th>#2</th>
                                <th>#3</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tutorproyectos as $tutorproyecto)   
                            <tr align="center">
                                <td>{{$tutorproyecto->oferta->periodo->per_nombre}}</td>
                                <td>{{$tutorproyecto->oferta->curso->seccion->sec_nombre}}</td>
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
                                    <a href="{{url('administrador/tutorproyecto/edit', ['tutproy_id' => $tutorproyecto->tutproy_id])}}">
                                        <button type="button" class="btn btn-secondary center-block" title="Editar Tutor de Curso">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>                                             
                                </td>
                                <td>
                                <button type="button" class="btn btn-danger center-block" data-toggle="modal" data-target="#delete-tutor" title="Eliminar Tutor de Proyecto Escolar" data-tutproy_id={{$tutorproyecto->tutproy_id}}>
                                    <i class="fas fa-trash"></i>
                                </button>
                                <div class="modal fade" id="delete-tutor">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-danger">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Eliminar Tutor de Proyecto Escolar</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{url('administrador/tutorproyecto/destroy')}}" method="post">
                                                {{method_field('delete')}}            
                                                {{csrf_field()}}
                                                <div class="modal-body">
                                                    <p>¿Esta seguro de eliminar a este tutor de proyecto escolar?</p>
                                                    <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
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
                                <td>
                                    <a href="{{url('administrador/tutorproyecto/show', ['tutproy_id' => $tutorproyecto->tutproy_id])}}">
                                        <button type="button" class="btn btn-primary center-block" title="Consultar Tutor de Curso">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </a>  
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    
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
      "lengthChange": false, "autoWidth": false, "paging": false, "info": false, "ordering": true, "responsive": false, "searching": true
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