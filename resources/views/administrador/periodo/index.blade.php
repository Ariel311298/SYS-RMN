@extends('backend.app')

@section('title')
Modulo Administrador - Gestionar Periodos
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) - Modulo Administrador/a - Gestionar Periodos -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Modulo Administrador/a - Gestionar Periodos</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header - Modulo Administrador/a - Gestionar Periodos -->

        <!-- Main content -->
        <section class="content">
            <div class="card">  
                <div class="card-header">
                    <h3 class="card-title">Tabla de Periodos</h3>    
                    <a href="/administrador/periodo/create">
                        <button type="button" class="btn btn-primary float-right" title="Nuevo Periodo">
                            Nuevo Periodo
                            <i class="fas fa-plus"></i>
                        </button>
                    </a>    
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="overflow:scroll;">
                    <div class="col-md-8 offset-md-2">
                        <form action="{{url('administrador/periodo/index/search')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group">
                                <input type="search" class="form-control form-control-lg" placeholder="Ingrese el periodo" name="buscar">
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
                                <th rowspan="2">@sortablelink('per_nombre','Periodo')</th>
                                <th rowspan="2">@sortablelink('per_fec_inicio','Fecha de Inicio')</th>
                                <th rowspan="2">@sortablelink('per_fec_fin','Fecha de Fin')</th>
                                <th rowspan="2">@sortablelink('per_estado','Estado')</th>
                                <th colspan="2">Opciones</th>
                            </tr>
                            <tr align="center">
                                <th>#1</th>
                                <th>#2</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($periodo as $period)   
                            <tr align="center">
                                <td>{{$period->per_nombre}}</td>
                                <td>{{ Carbon\Carbon::parse($period->per_fec_inicio)->format('d-m-Y') }}</td>
                                <td>{{ Carbon\Carbon::parse($period->per_fec_fin)->format('d-m-Y') }}</td>
                                <td>
                                    @if($period->per_estado == 1)   
                                        <p>Activo</p>
                                    @else
                                        <p>Desactivado</p>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('administrador/periodo/edit', ['per_id' => $period->per_id ])}}">
                                        <button type="button" class="btn btn-secondary center-block" title="Editar Periodo">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>                                             
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger center-block" data-toggle="modal" data-target="#delete-periodo" title="Eliminar Periodo" data-per_id="{{$period->per_id}}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <div class="modal fade" id="delete-periodo">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-danger">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Eliminar Periodo</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{url('administrador/periodo/destroy')}}" method="post">
                                                    {{method_field('delete')}}            
                                                    {{csrf_field()}}
                                                    <div class="modal-body">
                                                        <p>¿Esta seguro de eliminar este periodo?</p>
                                                        <input type="hidden" name="per_id" id="per_id" value="">
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
                    {{$periodo->appends(Request::only('buscar'))->render()}}  
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

