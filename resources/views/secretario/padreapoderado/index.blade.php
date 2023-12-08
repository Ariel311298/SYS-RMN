@extends('backend.app')

@section('title')
Modulo Secretario - Lista de Padres/Apoderados
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) - Modulo Secretario/a - Lista de Padres/Apoderados -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Modulo Secretario/a - Lista de Padres/Apoderados</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header - Modulo Secretario/a - Lista de Padres/Apoderados -->

        <!-- Main content -->
        <section class="content">
            <div class="card">  
                <div class="card-header">
                    <h3 class="card-title">Tabla de Padres/Apoderados Registrados</h3>    
                    <a href="/secretario/padreapoderado/searchncedulaalumno">
                        <button type="button" class="btn btn-primary float-right" title="Nuevo Padre o Representante">
                            Nuevo Padre o Representante
                            <i class="fas fa-plus"></i>
                        </button>
                    </a>    
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="overflow:scroll;">
                    <div class="col-md-8 offset-md-2">
                        <form action="{{url('secretario/padreapoderado/index/search')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group">
                                <input type="search" class="form-control form-control-lg" placeholder="Ingrese el nombre o el apellido o el parentesco" name="buscar">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-lg btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr align="center">
                                <th rowspan="2">Nombres y Apellidos</th>
                                <th rowspan="2">Parentesco</th>
                                <th rowspan="2">Estudiante</th>
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
                            @foreach($padresapoderados as $padreapoderado)   
                            <tr align="center">
                                <td>{{$padreapoderado->pad_nombres}} {{$padreapoderado->pad_apellidos}}</td>
                                <td>{{$padreapoderado->pad_parentesco}}</td>
                                <td>
                                    {{$padreapoderado->alumno->alum_nombres}} {{$padreapoderado->alumno->alum_apellidos}}
                                </td>
                                <td>
                                    @if($padreapoderado->pad_estado == 1)   
                                        <p>Activo</p>
                                    @else
                                        <p>Desactivado</p>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('secretario/padreapoderado/edit', ['pad_id' => $padreapoderado->pad_id ])}}">
                                        <button type="button" class="btn btn-secondary center-block" title="Editar Informacion">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>                                             
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger center-block" data-toggle="modal" data-target="#delete-padreapoderado" title="Eliminar Información" data-pad_id={{$padreapoderado->pad_id}}>
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <div class="modal fade" id="delete-padreapoderado">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-danger">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Eliminar Padre o Representante</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{url('secretario/padreapoderado/destroy')}}" method="post">
                                                    {{method_field('delete')}}            
                                                    {{csrf_field()}}
                                                    <div class="modal-body">
                                                        <p>¿Esta seguro de eliminar este dato?</p>
                                                        <input type="hidden" name="pad_id" id="pad_id" value="">
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
                                    <a href="{{url('secretario/padreapoderado/show', ['pad_id' => $padreapoderado->pad_id ])}}">
                                        <button type="button" class="btn btn-primary center-block" title="Consultar Datos Personales">
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
                {{$padresapoderados->appends(Request::only('pad_nombres'))->links()}}  
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
