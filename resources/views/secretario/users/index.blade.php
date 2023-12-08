@extends('backend.app')

@section('title')
Modulo Secretario - Gestionar Usuarios
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) - Modulo Secretario/a - Gestionar Usuarios -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Modulo Secretario/a - Gestionar Usuarios</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header - Modulo Secretario/a - Gestionar Usuarios -->

        <!-- Main content -->
        <section class="content">
            <div class="card">  
                <div class="card-header">
                    <h3 class="card-title">Tabla de Usuarios</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="overflow:scroll;">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr align="center">
                                <th rowspan="2">Rol</th>
                                <th rowspan="2">N ° Cedula</th>
                                <th rowspan="2">Nombres y Apellidos</th>
                                <th rowspan="2">Nombre de Usuario</th>
                                <th rowspan="2">Email</th>
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
                            @foreach($users as $usr)   
                            <tr align="center">
                                <td>{{$usr->rol->rol_nombre}}</td>
                                <td>
                                    @if($usr->pers_id)   
                                        {{$usr->personal->pers_ncedula}}     
                                    @else
                                        {{$usr->alumno->alum_ncedula}}
                                    @endif                                       
                                </td>
                                <td>
                                    @if($usr->pers_id)   
                                        {{$usr->personal->pers_nombres}} {{$usr->personal->pers_apellidos}}    
                                    @else
                                        {{$usr->alumno->alum_nombres}} {{$usr->alumno->alum_apellidos}}
                                    @endif   
                                </td>
                                <td>{{$usr->name}}</td>
                                <td>
                                    {{$usr->email}}
                                </td>
                                <td>
                                    @if($usr->usu_estado == 1)   
                                        <p>Activo</p>
                                    @else
                                        <p>Desactivado</p>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('secretario/users/edit', ['id' => $usr->id ])}}">
                                        <button type="button" class="btn btn-secondary center-block" title="Editar Usuario">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>                                             
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger center-block" data-toggle="modal" data-target="#delete-user" title="Eliminar Usuario" data-id={{$usr->id}}>
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <div class="modal fade" id="delete-user">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-danger">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Eliminar Usuario</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{url('secretario/users/destroy')}}" method="post">
                                                {{method_field('delete')}}            
                                                {{csrf_field()}}
                                            <div class="modal-body">
                                                <p>¿Esta seguro de eliminar a este usuario?</p>
                                                <input type="hidden" name="id" id="id" value="">
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
                                <a href="{{url('secretario/users/show', ['id' => $usr->id ])}}">
                                    <button type="button" class="btn btn-primary center-block" title="Consultar Datos Personales">
                                        <i class="fas fa-eye"></i>
                                    </button> 
                                </td>
                                <td>
                                <a href="{{url('secretario/users/password', ['id' => $usr->id ])}}">
                                    <button type="button" class="btn btn-warning center-block" title="Cambiar Contraseña">
                                        <i class="fas fa-key"></i>
                                    </button> 
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

