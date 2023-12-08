@extends('backend.app')

@section('title')
Modulo Rector - Gestionar Matriculas
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) - Modulo Rector/a - Gestionar Matriculas -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Modulo Rector/a - Gestionar Matriculas</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Modulo Rector/a - Gestionar Matriculas -->

    <!-- Main content -->
    <section class="content">
        <div class="card">  
            <div class="card-header">
                <h3 class="card-title">Tabla de Cursos</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="overflow:scroll;">
                <div class="col-md-8 offset-md-2">
                    <form action="{{url('rector/matricula/index/search')}}" method="POST" enctype="multipart/form-data">
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
                            <th rowspan="2">Tutor de Curso</th>
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
                                <a href="{{url('rector/matricula/listado', ['ofer_id' => $oferta->ofer_id])}}">
                                    <button type="button" class="btn btn-primary center-block" title="Ver Alumnos">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </a>                                             
                            </td>
                            <td>
                                <a href="{{action('App\Http\Controllers\Rector\AlumnosController@generarListaCursoPDF', $oferta->ofer_id)}}">
                                    <button type="button" class="btn btn-danger center-block" title="Generar Lista de Alumnos en PDF">
                                        <i class="fas fa-file-pdf"></i>
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
      "lengthChange": false, "autoWidth": false, "paging": false, "info": false, "ordering": true, "responsive": false, "searching": false,
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
@endsection