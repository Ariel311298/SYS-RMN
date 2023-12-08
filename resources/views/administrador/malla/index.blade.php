@extends('backend.app')

@section('title')
Modulo Administrador - Control de Asignaciones (Malla Curricular)
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) - Modulo Administrador/a - Control de Asignaciones (Malla Curricular) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Modulo Administrador/a - Control de Asignaciones (Malla Curricular)</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header - Modulo Administrador/a - Control de Asignaciones (Malla Curricular) -->

        <!-- Main content -->
        <section class="content">
            <div class="card">  
                <div class="card-header">
                    <h3 class="card-title">Tabla de Cursos</h3>
                    <a href="/administrador/malla/create">
                        <button type="button" class="btn btn-primary float-right" title="Nueva Asignación">
                            Nueva Asignacion
                            <i class="fas fa-plus"></i>
                        </button>
                    </a>   
                </div>
                <!-- /.card-header --> 
                <div class="card-body" style="overflow:scroll;">
                    <div class="col-md-8 offset-md-2">
                        <form action="{{url('administrador/malla/index/search')}}" method="POST" enctype="multipart/form-data">
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
                                <th>Periodo</th>
                                <th>Curso</th>
                                <th>Paralelo</th>
                                <th>Tutor de Curso</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ofertas as $oferta)   
                                @if($oferta->ofer_estado == 1)  
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
                                        <a href="{{url('administrador/malla/asignacion', ['ofer_id' => $oferta->ofer_id])}}">
                                            <button type="button" class="btn btn-secondary center-block" title="Ver Asignaciones (Malla Curricular)">
                                                <i class="fas fa-chalkboard-teacher"></i>
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