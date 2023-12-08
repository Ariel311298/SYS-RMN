@extends('backend.app')

@section('title')
Modulo Secretario - Gestionar Alumnos
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) - Modulo Secretario/a - Gestionar Alumnos -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Modulo Secretario/a - Gestionar Alumnos</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header - Modulo Secretario/a - Gestionar Alumnos -->

        <!-- Main content -->
        <section class="content">
            <div class="card">  
                <div class="card-header">
                    <h3 class="card-title">Tabla de Alumnos</h3>    
                    <a href="/secretario/alumno/create">
                        <button type="button" class="btn btn-primary float-right" title="Nuevo Alumno/a">
                            Nuevo Alumno/a
                            <i class="fas fa-plus"></i>
                        </button>
                    </a>    
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="overflow:scroll;">
                    <div class="col-md-8 offset-md-2">
                        <form action="{{url('secretario/alumno/index/search')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group">
                                <input type="search" class="form-control form-control-lg" placeholder="Ingrese el numero de cedula o nombres o apellidos del alumno" name="buscar">
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
                                <th rowspan="2">@sortablelink('alum_ncedula','N°Cedula')</th>
                                <th rowspan="2">@sortablelink('alum_nombres','Nombres')</th>
                                <th rowspan="2">@sortablelink('alum_apellidos','Apellidos')</th>
                                <th rowspan="2">Foto</th>
                                <th rowspan="2">@sortablelink('alum_estado','Estado')</th>
                                <th colspan="5">Opciones</th>
                            </tr>
                            <tr align="center">
                                <th>#1</th>
                                <th>#2</th>
                                <th>#3</th>
                                <th>#4</th>
                                <th>#5</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($alumno as $alm)   
                            <tr align="center">
                                <td>
                                    @if($alm->alum_ncedula)
                                        {{$alm->alum_ncedula}}
                                    @else
                                        <p>N/A</p>
                                    @endif
                                </td>
                                <td>{{$alm->alum_nombres}}</td>
                                <td>{{$alm->alum_apellidos}}</td>
                                <td>
                                    @if($alm->alum_foto)
                                        <img src="/uploads/saved/alumno/{{$alm->alum_foto}}" width="60"/>
                                    @else
                                        <img src="/uploads/logo/alumno.png" width="60"/>
                                    @endif    
                                </td>
                                <td>
                                    @if($alm->alum_estado == 1)   
                                        <p>Activo</p>
                                    @else
                                        <p>Desactivado</p>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('secretario/alumno/edit', ['alum_id' => $alm->alum_id ])}}">
                                        <button type="button" class="btn btn-secondary center-block" title="Editar Informacion">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>                                             
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger center-block" data-toggle="modal" data-target="#delete-alumno" title="Eliminar Información" data-alum_id={{$alm->alum_id}}>
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <div class="modal fade" id="delete-alumno">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-danger">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Eliminar Alumno</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{url('secretario/alumno/destroy')}}" method="post">
                                                    {{method_field('delete')}}            
                                                    {{csrf_field()}}
                                                    <div class="modal-body">
                                                        <p>¿Esta seguro de eliminar a este alumno?</p>
                                                        <input type="hidden" name="alum_id" id="alum_id" value="">
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
                                    <a href="{{url('secretario/alumno/show', ['alum_id' => $alm->alum_id ])}}">
                                        <button type="button" class="btn btn-primary center-block" title="Consultar Datos Personales">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </a> 
                                </td>
                                <td>
                                    <a href="{{url('secretario/users/createalumuser', ['alum_id' => $alm->alum_id ])}}">
                                        <button type="button" class="btn btn-warning center-block" title="Crear Usuario">
                                            <i class="fas fa-user-plus"></i>
                                        </button>
                                    </a>          
                                </td>
                                <td>
                                    <a href="{{url('secretario/padreapoderado/createpadreapoderado', ['alum_id' => $alm->alum_id ])}}">
                                        <button type="button" class="btn btn-success center-block" title="Crear Padre / Apoderado">
                                            <i class="fas fa-user-friends"></i>
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
                {{$alumno->appends(Request::only('alum_nombres'))->links()}}  
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
      "lengthChange": false, "autoWidth": false, "paging": false, "info": false, "ordering": false, "responsive": false, "searching": false
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

