@extends('backend.app')

@section('title')
Modulo Administrador - Consulta de Calificaciones (Comportamiento) - {{$oferta->periodo->per_nombre}} - {{$oferta->curso->seccion->sec_nombre}} - {{$oferta->curso->cur_nombre}} {{$oferta->curso->cur_paralelo}} - {{$oferta->personal->pers_nombres}} {{$oferta->personal->pers_apellidos}} - Quimestre 2
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) - Modulo Administrador/a - Consulta de Calificaciones (Comportamiento) -->
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Consulta de Calificaciones (Comportamiento)</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header - Modulo Administrador/a - Consulta de Calificaciones (Comportamiento) -->

  <!-- Main content -->
  <section class="content">
    <div class="card">  
        <div class="card-header">
            <h3 class="card-title">Periodo: {{$oferta->periodo->per_nombre}} / Seccion: {{$oferta->curso->seccion->sec_nombre}} / Curso: {{$oferta->curso->cur_nombre}} {{$oferta->curso->cur_paralelo}} / Tutor de Curso: {{$oferta->personal->pers_nombres}} {{$oferta->personal->pers_apellidos}} - Quimestre: 2</h3> 
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="overflow:scroll;">
            <table id="example2" class="table table-bordered table-striped table-count">
                <thead>
                    <tr align="center">
                      <th>Nombres y Apellidos</th>
                      <th>Prom.Q2</th>
                      <th>Escala</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($comportamientos as $comportamiento)   
                    @if($comportamiento->cond_estado == 1) 
                    <tr align="center">
                        <td>
                            {{$comportamiento->matricula->alumno->alum_nombres}} {{$comportamiento->matricula->alumno->alum_apellidos}}
                        </td>
                        <td>
                            @if($comportamiento->cond_notaQ2)
                                {{$comportamiento->cond_notaQ2}}
                            @else
                                D
                            @endif   
                        </td>
                        <td>
                            @if($comportamiento->cond_escalaQ2)
                                {{$comportamiento->cond_escalaQ2}}
                            @else
                                Falta reiteradamente en el cumplimiento de los compromisos establecidos para la sana convivencia social.
                            @endif   
                        </td>
                    </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <a href="/administrador/comportamiento/index">
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