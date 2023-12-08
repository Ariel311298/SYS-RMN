@extends('backend.app')

@section('title')
Modulo Administrador - Gestionar Matriculas - Control de Matriculas
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) - Modulo Administrador/a - Gestionar Matriculas - Control de Matriculas -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Modulo Administrador/a - Gestionar Matriculas - Control de Matriculas</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header - Modulo Administrador/a - Gestionar Matriculas - Control de Matriculas -->

        <!-- Main content -->
        <section class="content">
            <div class="card">  
                <div class="card-header">
                    <h3 class="card-title">Control de Matriculas</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="overflow:scroll;">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr align="center">
                                <th rowspan="2">Periodo</th>
                                <th rowspan="2">Seccion</th>
                                <th rowspan="2">Curso</th>
                                <th rowspan="2">Nombres</th>
                                <th rowspan="2">Apellidos</th>
                                <th rowspan="2">Estado</th>
                                <th colspan="4">Opciones</th>
                            </tr>
                            <tr align="center">
                                <th>#1</th>
                                <th>#2</th>
                                <th>#3</th>
                                <th>#4</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($matriculas as $matricula)   
                            <tr align="center">
                                <td>{{$matricula->oferta->periodo->per_nombre}}</td>
                                <td>{{$matricula->oferta->curso->seccion->sec_nombre}}</td>
                                <td>
                                    {{$matricula->oferta->curso->cur_nombre}} - {{$matricula->oferta->curso->cur_paralelo}}                                                     
                                </td>
                                <td>
                                    {{$matricula->alumno->alum_nombres}}
                                </td>
                                <td>
                                    {{$matricula->alumno->alum_apellidos}}
                                </td>
                                <td>
                                    @if($matricula->mat_estado == 1)   
                                        <p>Activo</p>
                                    @else
                                        <p>Desactivado</p>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('administrador/matricula/cambiar', ['mat_id' => $matricula->mat_id])}}">
                                        <button type="button" class="btn btn-secondary center-block" title="Cambiar Curso">
                                            <i class="fas fa-arrows-alt-h"></i>
                                        </button>
                                    </a>                                             
                                </td>
                                <td>
                                    <a href="{{url('administrador/matricula/reemplazar', ['mat_id' => $matricula->mat_id])}}">
                                        <button type="button" class="btn btn-success center-block" title="Reemplazar Matricula">
                                            <i class="fas fa-people-arrows"></i>
                                        </button>
                                    </a>                                             
                                </td>
                                <td>
                                    <a href="{{url('administrador/matricula/elaboracion-ficha', ['mat_id' => $matricula->mat_id])}}">
                                        <button type="button" class="btn btn-primary center-block" title="Elaborar Ficha de Matricula">
                                            <i class="fas fa-pen-square"></i>
                                        </button>
                                    </a> 
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger center-block" data-toggle="modal" data-target="#delete-matricula" title="Eliminar Matricula" data-mat_id={{$matricula->mat_id}}>
                                        <i class="fas fa-trash"></i>
                                    </button>
                                        <div class="modal fade" id="delete-matricula">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-danger">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Eliminar Matricula</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{url('administrador/matricula/destroy')}}" method="post">
                                                    {{method_field('delete')}}            
                                                    {{csrf_field()}}
                                                <div class="modal-body">
                                                    <p>¿Esta seguro de eliminar esta matricula?</p>
                                                    <input type="hidden" name="mat_id" id="mat_id" value="">
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
                    <a href="/administrador/matricula/index">
                        <button type="button" class="btn btn-warning float-right" title="Regresar">
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
      "lengthChange": false, "autoWidth": false, "paging": false, "info": false, "ordering": true, "responsive": false,
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