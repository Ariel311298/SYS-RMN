@extends('backend.app')

@section('title')
Modulo Administrador - Gestionar Usuarios
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) - Modulo Administrador/a - Gestionar Usuarios -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Modulo Administrador/a - Gestionar Usuarios</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header - Modulo Administrador/a - Gestionar Usuarios -->

        <!-- Main content -->
        <section class="content">
            <div class="card">  
                <div class="card-header">
                    <h3 class="card-title">Tabla de Usuarios</h3>
                </div>

                <!-- /.card-header -->
                <div class="card-body" style="overflow:scroll;">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr align="center">
                                <th rowspan="2">Rol</th>
                                <th rowspan="2">Nombres y Apellidos</th>
                                <th rowspan="2">Nombre de Usuario</th>
                                <th rowspan="2">Email</th>
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
                            @foreach($users as $user)  
                            <tr align="center">
                                <td>{{$user->rol->rol_nombre}}</td>
                                <td>
                                    @if($user->pers_id)   
                                        {{$user->personal->pers_nombres}} {{$user->personal->pers_apellidos}}    
                                    @else
                                        {{$user->alumno->alum_nombres}} {{$user->alumno->alum_apellidos}}
                                    @endif   
                                </td>
                                <td>{{$user->name}}</td>
                                <td>
                                    {{$user->email}}
                                </td>
                                <td>
                                    @if($user->usu_estado == 1)   
                                        <p>Activo</p>
                                    @else
                                        <p>Desactivado</p>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('administrador/users/edit', ['id' => $user->id ])}}">
                                        <button type="button" class="btn btn-secondary center-block" title="Editar Usuario">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>   
                                </td>                                          
                                <td>
                                    <button type="button" class="btn btn-danger center-block" data-toggle="modal" data-target="#delete-user" title="Eliminar Usuario" data-id="{{$user->id}}">
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
                                            <form action="{{url('administrador/users/destroy')}}" method="post">
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
                                <a href="{{url('administrador/users/password', ['id' => $user->id ])}}">
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
        "lengthChange": false, "ordering": true, "autoWidth": false, "paging": false, "info": false, "responsive": false, "searching": true, 
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



