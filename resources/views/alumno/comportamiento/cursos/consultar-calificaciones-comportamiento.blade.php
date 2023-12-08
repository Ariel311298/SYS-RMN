@extends('backend.app')

@section('title')
Modulo Alumno - Consulta de Calificaciones del Comportamiento - {{$matricula->oferta->periodo->per_nombre}} - {{$matricula->oferta->curso->seccion->sec_nombre}} - {{$matricula->oferta->curso->cur_nombre}} {{$matricula->oferta->curso->cur_paralelo}}
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) - Modulo Alumno - Consulta de Calificaciones del Comportamiento -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Consulta de Calificaciones del Comportamiento</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Modulo Alumno - Consulta de Calificaciones del Comportamiento -->

    <!-- Main content -->
    <section class="content">
        <div class="card">  
            <div class="card-header">
                <h3 class="card-title">Periodo: {{$matricula->oferta->periodo->per_nombre}} / Seccion: {{$matricula->oferta->curso->seccion->sec_nombre}} / Curso: {{$matricula->oferta->curso->cur_nombre}} {{$matricula->oferta->curso->cur_paralelo}} / Tutor de Curso: {{$matricula->oferta->personal->pers_nombres}} {{$matricula->oferta->personal->pers_apellidos}}</h3> 
            </div>
            <!-- /.card-header -->

            <div class="card-body" style="overflow:scroll;"> 
                <table id="column" class="table table-bordered table-striped">
                    <thead>
                        <tr align="center">
                            <th>Alumno</th>
                            <th>Prom.Q1</th>
                            <th>Prom.Q2</th>
                            <th>Prom.Anual</th>
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
                            @if($comportamiento->cond_notaQ1)
                                {{$comportamiento->cond_notaQ1}}
                            @else
                                D
                            @endif   
                        </td>
                        <td>
                            @if($comportamiento->cond_notaQ2)
                                {{$comportamiento->cond_notaQ2}}
                            @else
                                D
                            @endif   
                        </td>
                        <td>
                            @if($comportamiento->cond_notaAnual)
                                {{$comportamiento->cond_notaAnual}}
                            @else
                                D
                            @endif   
                        </td>
                        <td>
                            @if($comportamiento->cond_escalaAnual)
                                {{$comportamiento->cond_escalaAnual}}
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
                <a href="{{url('alumno/comportamiento/cursos', ['alum_id' => $matricula->alumno->alum_id])}}">
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

@section('js')

<!-- Page specific script -->
<script>
$(document).ready(function(){
    $('input').on('change',function(){
        var id = $(this).data('id')
        
        if ($(this).prop('checked'))
        $('table tr').each(function(i,v){
            $(v).find('td').eq(id).show();
            $(v).find('th').eq(id).show();
        })
        else
            $('table tr').each(function(i,v){
            $(v).find('td').eq(id).hide();
            $(v).find('th').eq(id).hide();
        })
    })
});
</script>
@endsection