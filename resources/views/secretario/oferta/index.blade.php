@extends('backend.app')

@section('title')
Modulo Secretario - Gestionar Ofertas
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) - Modulo Secretario/a - Gestionar Ofertas -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Modulo Secretario/a - Gestionar Ofertas</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header - Modulo Secretario/a - Gestionar Ofertas -->

        <!-- Main content -->
        <section class="content">
            <div class="card">  
                <div class="card-header">
                    <h3 class="card-title">Tabla de Ofertas</h3>
                    <a href="/secretario/oferta/searchncedula">
                        <button type="button" class="btn btn-primary float-right" title="Nueva Oferta">
                            Nueva Oferta
                            <i class="fas fa-plus"></i>
                        </button>
                    </a>   
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="overflow:scroll;">
                    <div class="col-md-8 offset-md-2">
                        <form action="{{url('secretario/oferta/index/search')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group">
                                <input type="search" class="form-control form-control-lg" placeholder="Ingrese el periodo o curso o paralelo o nombres y apellidos" name="buscar">
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
                                <th rowspan="2">Periodo</th>
                                <th rowspan="2">Curso</th>
                                <th rowspan="2">Paralelo</th>
                                <th rowspan="2">Nombres y Apellidos</th>
                                <th rowspan="2">Estado</th>
                                <th colspan="2">Opciones</th>
                            </tr>
                            <tr align="center">
                                <th>#1</th>
                                <th>#2</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ofertas as $oferta)   
                            <tr align="center">
                                <td>{{$oferta->periodo->per_nombre}}</td>
                                <td>
                                    {{$oferta->curso->cur_nombre}}                                                
                                </td>
                                <td>
                                    {{$oferta->curso->cur_paralelo}}                                                
                                </td>
                                <td>
                                    {{$oferta->personal->pers_nombres}} {{$oferta->personal->pers_apellidos}}     
                                </td>
                                <td>
                                    @if($oferta->ofer_estado == 1)   
                                        <p>Activo</p>
                                    @else
                                        <p>Desactivado</p>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('secretario/oferta/edit', ['ofer_id' => $oferta->ofer_id ])}}">
                                        <button type="button" class="btn btn-secondary center-block" title="Editar Oferta">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>                                             
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger center-block" data-toggle="modal" data-target="#delete-oferta" title="Eliminar Oferta" data-ofer_id={{$oferta->ofer_id}}>
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <div class="modal fade" id="delete-oferta">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-danger">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Eliminar Oferta</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{url('secretario/oferta/destroy')}}" method="post">
                                                {{method_field('delete')}}            
                                                {{csrf_field()}}
                                            <div class="modal-body">
                                                <p>¿Esta seguro de eliminar esta oferta?</p>
                                                <input type="hidden" name="ofer_id" id="ofer_id" value="">
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
                {{$ofertas->appends(Request::only('buscar'))->links()}}  
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

