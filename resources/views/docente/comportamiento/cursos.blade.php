@extends('backend.app')

@section('title')
Modulo Docente - Registrar Calificaciones / Consultar (Comportamiento) - Cursos
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) - Modulo Docente - Registrar / Consultar Calificaciones (Comportamiento) - Cursos -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Modulo Docente - Registrar / Consultar Calificaciones (Comportamiento) - Cursos</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header - Modulo Docente - Registrar / Consultar Calificaciones (Comportamiento) - Cursos -->

        <!-- Main content -->
        <section class="content">
            <div class="card">  
                <div class="card-header">
                    <h3 class="card-title">Tabla de Cursos</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="overflow:scroll;">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr align="center">
                                <th rowspan="2">Periodo</th>
                                <th rowspan="2">Curso</th>
                                <th rowspan="2">Paralelo</th>
                                <th rowspan="2">Tutor de Curso</th>
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
                            @foreach($cursos as $course)
                            @if($course->ofer_estado == 1)    
                            <tr align="center">
                                <td>{{$course->periodo->per_nombre}}</td>
                                <td>
                                    {{$course->curso->cur_nombre}}                                                
                                </td>
                                <td>
                                    {{$course->curso->cur_paralelo}}                                                
                                </td>
                                <td>
                                    {{$course->personal->pers_nombres}} {{$course->personal->pers_apellidos}}     
                                </td>
                                <td>
                                    @if($course->ofer_estado == 1)   
                                        <p>Activo</p>
                                    @else
                                        <p>Desactivado</p>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('docente/comportamiento/cursos/ingreso-comportamiento', ['ofer_id' => $course->ofer_id])}}">
                                        <button type="button" class="btn btn-primary center-block" title="Registrar Notas de Comportamiento">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                    </a>                                             
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary" title="Consultar Calificaciones (Comportamiento)"> <i class="fas fa-table"></i></button>
                                        <button type="button" class="btn btn-secondary dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item" href="{{url('docente/comportamiento/cursos/consultar-comportamiento-prom-q1', ['ofer_id' => $course->ofer_id])}}">Prom. Quimestral (Q1)</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{url('docente/comportamiento/cursos/consultar-comportamiento-prom-q2', ['ofer_id' => $course->ofer_id])}}">Prom. Quimestral (Q2)</a> 
                                        <div class="dropdown-divider"></div>  
                                        <a class="dropdown-item" href="{{url('docente/comportamiento/cursos/consultar-comportamiento-prom-anual', ['ofer_id' => $course->ofer_id])}}">Prom. Anual</a> 
                                    </div>                                        
                                </td>
                                <td>
                                <div class="btn-group">
                                <button type="button" class="btn btn-danger" title="Generar Reporte en PDF de Calificaciones del Comportamiento"><i class="fas fa-file-pdf"></i></button>
                                <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                    <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item" data-toggle="modal" data-target="#val-comp-calificacion" data-ofer_id="{{$course->ofer_id}}">Prom. Quimestral (Q1)</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#val-comp-calificacion2" data-ofer_id="{{$course->ofer_id}}">Prom. Quimestral (Q2)</a> 
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#val-comp-calificacion3" data-ofer_id="{{$course->ofer_id}}">Prom. Anual</a>   
                                </div>
                                <!-- Reporte PDF - Comportamiento - Q1 -->
                                <div class="modal fade" id="val-comp-calificacion">
                                <div class="modal-dialog">
                                <div class="modal-content bg-danger">
                                <div class="modal-header">
                                    <h4 class="modal-title">Generar Reporte de Calificaciones de Comportamiento en PDF - Quimestre: 1</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{url('docente/comportamiento/cursos/generarPDFCompPromQ1')}}" method="post">
                                {{csrf_field()}}
                                <div class="modal-body">      
                                    <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                                    <strong><p>Abreviatura:</p></strong>
                                    <input type="hidden" name="ofer_id" id="ofer_id" value="">
                                    <select name="abreviatura" id="abreviatura" type='text' class="form-control" required>
                                    <option value="Lcdo.">Lcdo.</option>
                                    <option value="Lcda.">Lcda.</option>
                                    <option value="Profr.">Profr.</option>
                                    <option value="Profa.">Profa.</option>
                                    <option value="Mgtr.">Mgtr.</option>
                                    <option value="Tnlgo.">Tnlgo.</option>
                                    <option value="Tnlga.">Tnlga.</option>
                                    <option value="Arq.">Arq.</option>
                                    <option value="Ing.">Ing.</option>
                                    </select>
                                    <br>
                                    <strong><p>Nombres y Apellidos del Docente:</p></strong>
                                    <input type="hidden" name="ofer_id" id="ofer_id" value="">
                                    <input type="text" id="nom_ape_tutor_curso" class="form-control" name="nom_ape_tutor_curso" required>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">
                                        Cerrar
                                        <i class="fas fa-arrow-left"></i>
                                    </button>
                                    <button class="btn btn-outline-light" type="submit">
                                        Generar Reporte
                                        <i class="fas fa-file-pdf"></i>
                                    </button>
                                </div>
                                </form>
                                </div>
                                <!-- /.modal-content Reporte PDF - Comportamiento - Q1 -->
                                </div>
                                <!-- /.modal-dialog Reporte PDF - Comportamiento - Q1 -->
                                </div>
                                <!-- /.modal Reporte PDF - Comportamiento - Q1 -->

                                <!-- Reporte PDF - Comportamiento - Q2 -->
                                <div class="modal fade" id="val-comp-calificacion2">
                                <div class="modal-dialog">
                                <div class="modal-content bg-danger">
                                <div class="modal-header">
                                    <h4 class="modal-title">Generar Reporte de Calificaciones de Comportamiento en PDF - Quimestre: 2</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{url('docente/comportamiento/cursos/generarPDFCompPromQ2')}}" method="post">
                                {{csrf_field()}}
                                <div class="modal-body">      
                                    <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                                    <strong><p>Abreviatura:</p></strong>
                                    <input type="hidden" name="ofer_id" id="ofer_id" value="">
                                    <select name="abreviatura" id="abreviatura" type='text' class="form-control" required>
                                    <option value="Lcdo.">Lcdo.</option>
                                    <option value="Lcda.">Lcda.</option>
                                    <option value="Profr.">Profr.</option>
                                    <option value="Profa.">Profa.</option>
                                    <option value="Mgtr.">Mgtr.</option>
                                    <option value="Tnlgo.">Tnlgo.</option>
                                    <option value="Tnlga.">Tnlga.</option>
                                    <option value="Arq.">Arq.</option>
                                    <option value="Ing.">Ing.</option>
                                    </select>
                                    <br>
                                    <strong><p>Nombres y Apellidos del Docente:</p></strong>
                                    <input type="hidden" name="ofer_id" id="ofer_id" value="">
                                    <input type="text" id="nom_ape_tutor_curso" class="form-control" name="nom_ape_tutor_curso" required>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">
                                        Cerrar
                                        <i class="fas fa-arrow-left"></i>
                                    </button>
                                    <button class="btn btn-outline-light" type="submit">
                                        Generar Reporte
                                        <i class="fas fa-file-pdf"></i>
                                    </button>
                                </div>
                                </form>
                                </div>
                                <!-- /.modal-content Reporte PDF - Comportamiento - Q2 -->
                                </div>
                                <!-- /.modal-dialog Reporte PDF - Comportamiento - Q2 -->
                                </div>
                                <!-- /.modal Reporte PDF - Comportamiento - Q2 -->

                                <!-- Reporte PDF - Comportamiento - Prom. Anual -->
                                <div class="modal fade" id="val-comp-calificacion3">
                                <div class="modal-dialog">
                                <div class="modal-content bg-danger">
                                <div class="modal-header">
                                    <h4 class="modal-title">Generar Reporte de Calificaciones de Comportamiento Anual en PDF</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{url('docente/comportamiento/cursos/generarPDFCompPromAnual')}}" method="post">
                                {{csrf_field()}}
                                <div class="modal-body">      
                                    <p>Seleccione la abreviatura y edite los nombres y apellidos</p>
                                    <strong><p>Tutor de Curso</p></strong>                                     
                                    <p>Abreviatura:</p>
                                    <input type="hidden" name="ofer_id" id="ofer_id" value="">
                                    <select name="abreviatura" id="abreviatura" type='text' class="form-control" required>
                                    <option value="Lcdo.">Lcdo.</option>
                                    <option value="Lcda.">Lcda.</option>
                                    <option value="Profr.">Profr.</option>
                                    <option value="Profa.">Profa.</option>
                                    <option value="Mgtr.">Mgtr.</option>
                                    <option value="Tnlgo.">Tnlgo.</option>
                                    <option value="Tnlga.">Tnlga.</option>
                                    <option value="Arq.">Arq.</option>
                                    <option value="Ing.">Ing.</option>
                                    </select>
                                    <br>
                                    <p>Nombres y Apellidos del Docente:</p>
                                    <input type="hidden" name="ofer_id" id="ofer_id" value="">
                                    <input type="text" id="nom_ape_tutor_curso" class="form-control" name="nom_ape_tutor_curso" required>
                                </div>
                                <div class="modal-body">  
                                <strong><p>Rector/a de la Institución Educativa</p></strong>
                                <p>Abreviatura:</p>
                                <input type="hidden" name="ofer_id" id="ofer_id" value="">
                                <select name="abreviatura_rector" id="abreviatura_rector" type='text' class="form-control" required>
                                  <option value="Lcdo.">Lcdo.</option>
                                  <option value="Lcda.">Lcda.</option>
                                  <option value="Profr.">Profr.</option>
                                  <option value="Profa.">Profa.</option>
                                  <option value="Mgtr.">Mgtr.</option>
                                  <option value="Tnlgo.">Tnlgo.</option>
                                  <option value="Tnlga.">Tnlga.</option>
                                  <option value="Arq.">Arq.</option>
                                  <option value="Ing.">Ing.</option>
                                </select>
                                <br>
                                <p>Nombres y Apellidos del Rector/a:</p>
                                <input type="hidden" name="ofer_id" id="ofer_id" value="">
                                <input type="text" id="nom_ape_rector" class="form-control" name="nom_ape_rector" required>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">
                                        Cerrar
                                        <i class="fas fa-arrow-left"></i>
                                    </button>
                                    <button class="btn btn-outline-light" type="submit">
                                        Generar Reporte
                                        <i class="fas fa-file-pdf"></i>
                                    </button>
                                </div>
                                </form>
                                </div>
                                <!-- /.modal-content Reporte PDF - Comportamiento - Prom. Anual -->
                                </div>
                                <!-- /.modal-dialog Reporte PDF - Comportamiento - Prom. Anual -->
                                </div>
                                <!-- /.modal Reporte PDF - Comportamiento - Prom. Anual -->
                            </td>
                            </tr>
                            @else
                            <tr align="center">
                                <td>{{$course->periodo->per_nombre}}</td>
                                <td>
                                    {{$course->curso->cur_nombre}}                                                
                                </td>
                                <td>
                                    {{$course->curso->cur_paralelo}}                                                
                                </td>
                                <td>
                                    {{$course->personal->pers_nombres}} {{$course->personal->pers_apellidos}}     
                                </td>
                                <td>
                                    @if($course->ofer_estado == 1)   
                                        <p>Activo</p>
                                    @else
                                        <p>Desactivado</p>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary" title="Consultar Calificaciones (Comportamiento)"> <i class="fas fa-table"></i></button>
                                        <button type="button" class="btn btn-secondary dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item" href="{{url('docente/comportamiento/cursos/consultar-comportamiento-prom-q1', ['ofer_id' => $course->ofer_id])}}">Prom. Quimestral (Q1)</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{url('docente/comportamiento/cursos/consultar-comportamiento-prom-q2', ['ofer_id' => $course->ofer_id])}}">Prom. Quimestral (Q2)</a> 
                                        <div class="dropdown-divider"></div>  
                                        <a class="dropdown-item" href="{{url('docente/comportamiento/cursos/consultar-comportamiento-prom-anual', ['ofer_id' => $course->ofer_id])}}">Prom. Anual</a> 
                                    </div>                                        
                                </td>
                                <td colspan="2">
                                <div class="btn-group">
                                <button type="button" class="btn btn-danger" title="Generar Reporte en PDF de Calificaciones del Comportamiento"><i class="fas fa-file-pdf"></i></button>
                                <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                    <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item" data-toggle="modal" data-target="#val-comp-calificacion" data-ofer_id="{{$course->ofer_id}}">Prom. Quimestral (Q1)</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#val-comp-calificacion2" data-ofer_id="{{$course->ofer_id}}">Prom. Quimestral (Q2)</a> 
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#val-comp-calificacion3" data-ofer_id="{{$course->ofer_id}}">Prom. Anual</a>   
                                </div>
                                <!-- Reporte PDF - Comportamiento - Q1 -->
                                <div class="modal fade" id="val-comp-calificacion">
                                <div class="modal-dialog">
                                <div class="modal-content bg-danger">
                                <div class="modal-header">
                                    <h4 class="modal-title">Generar Reporte de Calificaciones de Comportamiento en PDF - Quimestre: 1</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{url('docente/comportamiento/cursos/generarPDFCompPromQ1')}}" method="post">
                                {{csrf_field()}}
                                <div class="modal-body">      
                                    <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                                    <strong><p>Abreviatura:</p></strong>
                                    <input type="hidden" name="ofer_id" id="ofer_id" value="">
                                    <select name="abreviatura" id="abreviatura" type='text' class="form-control" required>
                                    <option value="Lcdo.">Lcdo.</option>
                                    <option value="Lcda.">Lcda.</option>
                                    <option value="Profr.">Profr.</option>
                                    <option value="Profa.">Profa.</option>
                                    <option value="Mgtr.">Mgtr.</option>
                                    <option value="Tnlgo.">Tnlgo.</option>
                                    <option value="Tnlga.">Tnlga.</option>
                                    <option value="Arq.">Arq.</option>
                                    <option value="Ing.">Ing.</option>
                                    </select>
                                    <br>
                                    <strong><p>Nombres y Apellidos del Docente:</p></strong>
                                    <input type="hidden" name="ofer_id" id="ofer_id" value="">
                                    <input type="text" id="nom_ape_tutor_curso" class="form-control" name="nom_ape_tutor_curso" required>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">
                                        Cerrar
                                        <i class="fas fa-arrow-left"></i>
                                    </button>
                                    <button class="btn btn-outline-light" type="submit">
                                        Generar Reporte
                                        <i class="fas fa-file-pdf"></i>
                                    </button>
                                </div>
                                </form>
                                </div>
                                <!-- /.modal-content Reporte PDF - Comportamiento - Q1 -->
                                </div>
                                <!-- /.modal-dialog Reporte PDF - Comportamiento - Q1 -->
                                </div>
                                <!-- /.modal Reporte PDF - Comportamiento - Q1 -->

                                <!-- Reporte PDF - Comportamiento - Q2 -->
                                <div class="modal fade" id="val-comp-calificacion2">
                                <div class="modal-dialog">
                                <div class="modal-content bg-danger">
                                <div class="modal-header">
                                    <h4 class="modal-title">Generar Reporte de Calificaciones de Comportamiento en PDF - Quimestre: 2</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{url('docente/comportamiento/cursos/generarPDFCompPromQ2')}}" method="post">
                                {{csrf_field()}}
                                <div class="modal-body">      
                                    <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                                    <strong><p>Abreviatura:</p></strong>
                                    <input type="hidden" name="ofer_id" id="ofer_id" value="">
                                    <select name="abreviatura" id="abreviatura" type='text' class="form-control" required>
                                    <option value="Lcdo.">Lcdo.</option>
                                    <option value="Lcda.">Lcda.</option>
                                    <option value="Profr.">Profr.</option>
                                    <option value="Profa.">Profa.</option>
                                    <option value="Mgtr.">Mgtr.</option>
                                    <option value="Tnlgo.">Tnlgo.</option>
                                    <option value="Tnlga.">Tnlga.</option>
                                    <option value="Arq.">Arq.</option>
                                    <option value="Ing.">Ing.</option>
                                    </select>
                                    <br>
                                    <strong><p>Nombres y Apellidos del Docente:</p></strong>
                                    <input type="hidden" name="ofer_id" id="ofer_id" value="">
                                    <input type="text" id="nom_ape_tutor_curso" class="form-control" name="nom_ape_tutor_curso" required>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">
                                        Cerrar
                                        <i class="fas fa-arrow-left"></i>
                                    </button>
                                    <button class="btn btn-outline-light" type="submit">
                                        Generar Reporte
                                        <i class="fas fa-file-pdf"></i>
                                    </button>
                                </div>
                                </form>
                                </div>
                                <!-- /.modal-content Reporte PDF - Comportamiento - Q2 -->
                                </div>
                                <!-- /.modal-dialog Reporte PDF - Comportamiento - Q2 -->
                                </div>
                                <!-- /.modal Reporte PDF - Comportamiento - Q2 -->

                                <!-- Reporte PDF - Comportamiento - Prom. Anual -->
                                <div class="modal fade" id="val-comp-calificacion3">
                                <div class="modal-dialog">
                                <div class="modal-content bg-danger">
                                <div class="modal-header">
                                    <h4 class="modal-title">Generar Reporte de Calificaciones de Comportamiento Anual en PDF</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{url('docente/comportamiento/cursos/generarPDFCompPromAnual')}}" method="post">
                                {{csrf_field()}}
                                <div class="modal-body">      
                                    <p>Seleccione la abreviatura y edite los nombres y apellidos</p>
                                    <strong><p>Tutor de Curso</p></strong>                                     
                                    <p>Abreviatura:</p>
                                    <input type="hidden" name="ofer_id" id="ofer_id" value="">
                                    <select name="abreviatura" id="abreviatura" type='text' class="form-control" required>
                                    <option value="Lcdo.">Lcdo.</option>
                                    <option value="Lcda.">Lcda.</option>
                                    <option value="Profr.">Profr.</option>
                                    <option value="Profa.">Profa.</option>
                                    <option value="Mgtr.">Mgtr.</option>
                                    <option value="Tnlgo.">Tnlgo.</option>
                                    <option value="Tnlga.">Tnlga.</option>
                                    <option value="Arq.">Arq.</option>
                                    <option value="Ing.">Ing.</option>
                                    </select>
                                    <br>
                                    <p>Nombres y Apellidos del Docente:</p>
                                    <input type="hidden" name="ofer_id" id="ofer_id" value="">
                                    <input type="text" id="nom_ape_tutor_curso" class="form-control" name="nom_ape_tutor_curso" required>
                                </div>
                                <div class="modal-body">  
                                <strong><p>Rector/a de la Institución Educativa</p></strong>
                                <p>Abreviatura:</p>
                                <input type="hidden" name="ofer_id" id="ofer_id" value="">
                                <select name="abreviatura_rector" id="abreviatura_rector" type='text' class="form-control" required>
                                  <option value="Lcdo.">Lcdo.</option>
                                  <option value="Lcda.">Lcda.</option>
                                  <option value="Profr.">Profr.</option>
                                  <option value="Profa.">Profa.</option>
                                  <option value="Mgtr.">Mgtr.</option>
                                  <option value="Tnlgo.">Tnlgo.</option>
                                  <option value="Tnlga.">Tnlga.</option>
                                  <option value="Arq.">Arq.</option>
                                  <option value="Ing.">Ing.</option>
                                </select>
                                <br>
                                <p>Nombres y Apellidos del Rector/a:</p>
                                <input type="hidden" name="ofer_id" id="ofer_id" value="">
                                <input type="text" id="nom_ape_rector" class="form-control" name="nom_ape_rector" required>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">
                                        Cerrar
                                        <i class="fas fa-arrow-left"></i>
                                    </button>
                                    <button class="btn btn-outline-light" type="submit">
                                        Generar Reporte
                                        <i class="fas fa-file-pdf"></i>
                                    </button>
                                </div>
                                </form>
                                </div>
                                <!-- /.modal-content Reporte PDF - Comportamiento - Prom. Anual -->
                                </div>
                                <!-- /.modal-dialog Reporte PDF - Comportamiento - Prom. Anual -->
                                </div>
                                <!-- /.modal Reporte PDF - Comportamiento - Prom. Anual -->
                            </td>
                            </tr>
                            @endif
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
      "lengthChange": false, "autoWidth": false, "paging": false, "info": false, "ordering": true, "responsive": false,
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