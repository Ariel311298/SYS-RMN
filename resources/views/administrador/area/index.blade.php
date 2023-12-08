@extends('backend.app')

@section('title')
Modulo Administrador - Gestionar Areas
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) - Modulo Administrador/a - Gestionar Areas -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Modulo Administrador/a - Gestionar Areas</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header - Modulo Administrador/a - Gestionar Areas -->

        <!-- Main content -->
        <section class="content">
            <div class="card">  
                <div class="card-header">
                    <h3 class="card-title">Tabla de Areas</h3>    
                    <a href="/administrador/area/create">
                        <button type="button" class="btn btn-primary float-right" title="Nueva Area">
                            Nueva Area
                            <i class="fas fa-plus"></i>
                        </button>
                    </a>    
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="overflow:scroll;">
                    <div class="col-md-8 offset-md-2">
                        <form action="{{url('administrador/area/index/search')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group">
                                <input type="search" class="form-control form-control-lg" placeholder="Ingrese el area" name="buscar">
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
                                <th rowspan="2">@sortablelink('area_nombre','Area')</th>
                                <th rowspan="2">@sortablelink('area_estado','Estado')</th>
                                <th colspan="2">Opciones</th>
                            </tr>
                            <tr align="center">
                                <th>#1</th>
                                <th>#2</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($area as $discipline)   
                            <tr align="center">
                                <td>{{$discipline->area_nombre}}</td>
                                <td>
                                    @if($discipline->area_estado == 1)   
                                        <p>Activo</p>
                                    @else
                                        <p>Desactivado</p>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('administrador/area/edit', ['area_id' => $discipline->area_id ])}}">
                                        <button type="button" class="btn btn-secondary center-block" title="Editar Area">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>                                             
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger center-block" data-toggle="modal" data-target="#delete-area" title="Eliminar Area" data-area_id="{{$discipline->area_id}}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <div class="modal fade" id="delete-area">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-danger">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Eliminar Area</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{url('administrador/area/destroy')}}" method="post">
                                                    {{method_field('delete')}}            
                                                    {{csrf_field()}}
                                                    <div class="modal-body">
                                                        <p>¿Esta seguro de eliminar esta area?</p>
                                                        <input type="hidden" name="area_id" id="area_id" value="">
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
                {{$area->appends(Request::only('buscar'))->links()}}  
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
