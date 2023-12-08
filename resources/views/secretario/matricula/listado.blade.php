@extends('backend.app')

@section('title')
Modulo Secretario - Ver Estudiantes Matriculados - {{$ofertas->curso->cur_nombre}} {{$ofertas->curso->cur_paralelo}}
@endsection

<style>
    .table-count {
        font-family: arial, sans-serif;
        counter-reset: serial-number; 
    }

    .table-count td:first-child:before {
        counter-increment: serial-number;  /* Incrementa el contador de las columnas. */
        content: counter(serial-number);  /* Muestra el contador. */
    }
</style>

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) - Modulo Secretario/a - Ver Estudiantes Matriculados -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Lista de estudiantes</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header - Modulo Secretario/a - Ver Estudiantes Matriculados -->

        <!-- Main content -->
        <section class="content">
            <div class="card">  
                <div class="card-header">
                    <h3 class="card-title">Periodo: {{$ofertas->periodo->per_nombre}} / Seccion: {{$ofertas->curso->seccion->sec_nombre}} / Curso: {{$ofertas->curso->cur_nombre}} {{$ofertas->curso->cur_paralelo}} / Tutor de Curso: {{$ofertas->personal->pers_nombres}} {{$ofertas->personal->pers_apellidos}}</h3> 
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="overflow:scroll;">
                    <table id="example2" class="table table-bordered table-striped table-count">
                        <thead>
                            <tr align="center">
                                <th>N°</th>
                                <th scope="col">Nombres y Apellidos</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($alumnos->matriculas as $matricula)  
                            @if($matricula->mat_estado == 1)
                            <tr align="center">
                                <td>&nbsp;</td>
                                <td>
                                    {{$matricula->alumno->alum_nombres}} {{$matricula->alumno->alum_apellidos}}                                                    
                                </td>
                                <td>
                                    @if($matricula->mat_estado == 1)   
                                        <p>Activo</p>
                                    @else
                                        <p>Desactivado</p>
                                    @endif                                               
                                </td>
                                <td>
                                    <a href="{{url('secretario/matricula/listado/elaboracion-ficha', ['alum_id' => $matricula->alum_id])}}">
                                        <button type="button" class="btn btn-primary center-block" title="Elaborar Ficha de Matricula">
                                            Elaborar Ficha
                                            <i class="fas fa-pen-square"></i>
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
                    <a href="/secretario/matricula/index">
                        <button type="button" class="btn btn-danger center-block">
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