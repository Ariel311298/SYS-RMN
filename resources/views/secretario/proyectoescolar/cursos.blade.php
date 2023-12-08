@extends('backend.app')

@section('title')
Modulo Secretario - Seleccionar Curso (Proyectos Escolares)
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) - Modulo Secretario/a - Seleccionar Curso (Proyecto Escolar) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Modulo Secretario/a - Seleccionar Curso (Proyecto Escolar)</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header - Modulo Secretario/a - Seleccionar Curso (Proyecto Escolar) -->

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
                                <th rowspan="2">Seccion</th>
                                <th rowspan="2">Curso</th>
                                <th rowspan="2">Paralelo</th>
                                <th rowspan="2">Tutor de Proyecto Escolar</th>
                                <th rowspan="2">Estado</th>
                                <th colspan="2">Opciones</th>
                            </tr>
                            <tr align="center">
                                <th>#1</th>
                                <th>#2</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($tutorproyectos as $tutorproyecto)   
                        @if($tutorproyecto->tutproy_estado == 1)   
                            <tr align="center">
                                <td>{{$tutorproyecto->oferta->periodo->per_nombre}}</td>
                                <td>{{$tutorproyecto->oferta->curso->seccion->sec_nombre}}</td>
                                <td>
                                    {{$tutorproyecto->oferta->curso->cur_nombre}}                                                
                                </td>
                                <td>
                                    {{$tutorproyecto->oferta->curso->cur_paralelo}}                                                
                                </td>
                                <td>
                                    {{$tutorproyecto->personal->pers_nombres}} {{$tutorproyecto->personal->pers_apellidos}}     
                                </td>
                                <td>
                                    @if($tutorproyecto->tutproy_estado == 1)   
                                        <p>Activo</p>
                                    @else
                                        <p>Desactivado</p>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary" title="Consultar Calificaciones (Proyectos Escolares)"> <i class="fas fa-table"></i></button>
                                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item" href="{{url('secretario/proyectoescolar/cursos/consultar-calificacion-proyecto-escolar-prom-q1', ['tutproy_id' => $tutorproyecto->tutproy_id])}}">Prom. Quimestral (Q1)</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{url('secretario/proyectoescolar/cursos/consultar-calificacion-proyecto-escolar-prom-q2', ['tutproy_id' => $tutorproyecto->tutproy_id])}}">Prom. Quimestral (Q2)</a> 
                                        <div class="dropdown-divider"></div>  
                                        <a class="dropdown-item" href="{{url('secretario/proyectoescolar/cursos/consultar-calificacion-proyecto-escolar-prom', ['tutproy_id' => $tutorproyecto->tutproy_id])}}">Prom. Anual</a> 
                                    </div>                                             
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger" title="Generar Reporte en PDF de Calificaciones"><i class="fas fa-file-pdf"></i></button>
                                        <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <a class="dropdown-item" data-toggle="modal" data-target="#val-calif-proy-escolar" data-tutproy_id="{{$tutorproyecto->tutproy_id}}">Prom. Parcial 1 (Q1)</a>
                                            <a class="dropdown-item" data-toggle="modal" data-target="#val-calif-proy-escolar2" data-tutproy_id="{{$tutorproyecto->tutproy_id}}">Prom. Parcial 2 (Q1)</a>
                                            <a class="dropdown-item" data-toggle="modal" data-target="#val-calif-proy-escolar3" data-tutproy_id="{{$tutorproyecto->tutproy_id}}">Prom. Quimestral (Q1)</a>
                                        <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" data-toggle="modal" data-target="#val-calif-proy-escolar4" data-tutproy_id="{{$tutorproyecto->tutproy_id}}">Prom. Parcial 1 (Q2)</a>
                                            <a class="dropdown-item" data-toggle="modal" data-target="#val-calif-proy-escolar5" data-tutproy_id="{{$tutorproyecto->tutproy_id}}">Prom. Parcial 2 (Q2)</a>
                                            <a class="dropdown-item" data-toggle="modal" data-target="#val-calif-proy-escolar6" data-tutproy_id="{{$tutorproyecto->tutproy_id}}">Prom. Quimestral (Q2)</a>  
                                        <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" data-toggle="modal" data-target="#val-calif-proy-escolar7" data-tutproy_id="{{$tutorproyecto->tutproy_id}}">Cuadro de Calificacion Anual</a>  
                                    </div>
                                    <!-- Reporte PDF - P1Q1 - Proyecto Escolar -->
                                    <div class="modal fade" id="val-calif-proy-escolar">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-danger">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Generar Reporte de Calificaciones de Proyecto Escolar en PDF - Parcial: 1 / Quimestre: 1</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{url('secretario/proyectoescolar/cursos/generarPDFProyEscPromP1Q1')}}" method="post">
                                        {{csrf_field()}}
                                        <div class="modal-body">      
                                            <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                                            <strong><p>Abreviatura:</p></strong>
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
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
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
                                            <input type="text" id="nom_ape_tutor_proy" class="form-control" name="nom_ape_tutor_proy" required>
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
                                        <!-- /.modal-content Reporte PDF - P1Q1 -->
                                    </div>
                                    <!-- /.modal-dialog Reporte PDF - P1Q1 -->
                                    </div>
                                    <!-- /.modal Reporte PDF - P1Q1 -->

                                    <!-- Reporte PDF - P2Q1 - Proyecto Escolar -->
                                    <div class="modal fade" id="val-calif-proy-escolar2">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-danger">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Generar Reporte de Calificaciones de Proyecto Escolar en PDF - Parcial: 2 / Quimestre: 1</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{url('secretario/proyectoescolar/cursos/generarPDFProyEscPromP2Q1')}}" method="post">
                                        {{csrf_field()}}
                                        <div class="modal-body">      
                                            <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                                            <strong><p>Abreviatura:</p></strong>
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
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
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
                                            <input type="text" id="nom_ape_tutor_proy" class="form-control" name="nom_ape_tutor_proy" required>
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
                                        <!-- /.modal-content Reporte PDF - P2Q1 -->
                                    </div>
                                    <!-- /.modal-dialog Reporte PDF - P2Q1 -->
                                    </div>
                                    <!-- /.modal Reporte PDF - P2Q1 -->

                                    <!-- Reporte PDF - Q1 - Proyecto Escolar -->
                                    <div class="modal fade" id="val-calif-proy-escolar3">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-danger">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Generar Reporte de Calificaciones de Proyecto Escolar en PDF - Quimestre: 1</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{url('secretario/proyectoescolar/cursos/generarPDFProyEscPromQ1')}}" method="post">
                                        {{csrf_field()}}
                                        <div class="modal-body">      
                                            <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                                            <strong><p>Abreviatura:</p></strong>
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
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
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
                                            <input type="text" id="nom_ape_tutor_proy" class="form-control" name="nom_ape_tutor_proy" required>
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
                                        <!-- /.modal-content Reporte PDF - Q1 -->
                                    </div>
                                    <!-- /.modal-dialog Reporte PDF - Q1 -->
                                    </div>
                                    <!-- /.modal Reporte PDF - Q1 -->

                                    <!-- Reporte PDF - P1Q2 - Proyecto Escolar -->
                                    <div class="modal fade" id="val-calif-proy-escolar4">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-danger">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Generar Reporte de Calificaciones de Proyecto Escolar en PDF - Parcial: 1 / Quimestre: 2</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{url('secretario/proyectoescolar/cursos/generarPDFProyEscPromP1Q2')}}" method="post">
                                        {{csrf_field()}}
                                        <div class="modal-body">      
                                            <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                                            <strong><p>Abreviatura:</p></strong>
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
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
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
                                            <input type="text" id="nom_ape_tutor_proy" class="form-control" name="nom_ape_tutor_proy" required>
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
                                        <!-- /.modal-content Reporte PDF - P1Q2 -->
                                    </div>
                                    <!-- /.modal-dialog Reporte PDF - P1Q2 -->
                                    </div>
                                    <!-- /.modal Reporte PDF - P1Q2 -->
                                    
                                    <!-- Reporte PDF - P2Q2 - Proyecto Escolar -->
                                    <div class="modal fade" id="val-calif-proy-escolar5">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-danger">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Generar Reporte de Calificaciones de Proyecto Escolar en PDF - Parcial: 2 / Quimestre: 2</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{url('secretario/proyectoescolar/cursos/generarPDFProyEscPromP2Q2')}}" method="post">
                                        {{csrf_field()}}
                                        <div class="modal-body">      
                                            <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                                            <strong><p>Abreviatura:</p></strong>
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
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
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
                                            <input type="text" id="nom_ape_tutor_proy" class="form-control" name="nom_ape_tutor_proy" required>
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
                                        <!-- /.modal-content Reporte PDF - P2Q2 -->
                                    </div>
                                    <!-- /.modal-dialog Reporte PDF - P2Q2 -->
                                    </div>
                                    <!-- /.modal Reporte PDF - P2Q2 -->

                                    <!-- Reporte PDF - Q2 - Proyecto Escolar -->
                                    <div class="modal fade" id="val-calif-proy-escolar6">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-danger">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Generar Reporte de Calificaciones de Proyecto Escolar en PDF - Quimestre: 2</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{url('secretario/proyectoescolar/cursos/generarPDFProyEscPromQ2')}}" method="post">
                                        {{csrf_field()}}
                                        <div class="modal-body">      
                                            <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                                            <strong><p>Abreviatura:</p></strong>
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
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
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
                                            <input type="text" id="nom_ape_tutor_proy" class="form-control" name="nom_ape_tutor_proy" required>
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
                                        <!-- /.modal-content Reporte PDF - Q2 -->
                                    </div>
                                    <!-- /.modal-dialog Reporte PDF - Q2 -->
                                    </div>
                                    <!-- /.modal Reporte PDF - Q2 -->

                                    <!-- Reporte PDF - Anual - Proyecto Escolar -->
                                    <div class="modal fade" id="val-calif-proy-escolar7">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-danger">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Generar Reporte de Calificaciones de Proyecto Escolar en PDF - Anual</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{url('secretario/proyectoescolar/cursos/generarPDFProyEscPromAnual')}}" method="post">
                                        {{csrf_field()}}
                                        <div class="modal-body"> 
                                            <strong><p>Tutor de Proyectos Escolares</p></strong>        
                                            <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                                            <p>Abreviatura:</p>
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
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
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
                                            <input type="text" id="nom_ape_tutor_proy" class="form-control" name="nom_ape_tutor_proy" required>
                                        </div>
                                        <div class="modal-body">  
                                            <strong><p>Rector/a de la Institución Educativa</p></strong>
                                            <p>Abreviatura:</p>
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
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
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
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
                                        <!-- /.modal-content Reporte PDF - Anual - Proyecto Escolar -->
                                    </div>
                                    <!-- /.modal-dialog Reporte PDF - Anual - Proyecto Escolar -->
                                    </div>
                                    <!-- /.modal Reporte PDF - Anual - Proyecto Escolar -->
                                </td>
                            </tr>
                            @elseif($tutorproyecto->tutproy_estado == 0)
                            <tr align="center">
                                <td>{{$tutorproyecto->oferta->periodo->per_nombre}}</td>
                                <td>{{$tutorproyecto->oferta->curso->seccion->sec_nombre}}</td>
                                <td>
                                    {{$tutorproyecto->oferta->curso->cur_nombre}}                                                
                                </td>
                                <td>
                                    {{$tutorproyecto->oferta->curso->cur_paralelo}}                                                
                                </td>
                                <td>
                                    {{$tutorproyecto->personal->pers_nombres}} {{$tutorproyecto->personal->pers_apellidos}}     
                                </td>
                                <td>
                                    @if($tutorproyecto->tutproy_estado == 1)   
                                        <p>Activo</p>
                                    @else
                                        <p>Desactivado</p>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary" title="Consultar Calificaciones (Proyectos Escolares)"> <i class="fas fa-table"></i></button>
                                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item" href="{{url('secretario/proyectoescolar/cursos/consultar-calificacion-proyecto-escolar-prom-q1', ['tutproy_id' => $tutorproyecto->tutproy_id])}}">Prom. Quimestral (Q1)</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{url('secretario/proyectoescolar/cursos/consultar-calificacion-proyecto-escolar-prom-q2', ['tutproy_id' => $tutorproyecto->tutproy_id])}}">Prom. Quimestral (Q2)</a> 
                                        <div class="dropdown-divider"></div>  
                                        <a class="dropdown-item" href="{{url('secretario/proyectoescolar/cursos/consultar-calificacion-proyecto-escolar-prom', ['tutproy_id' => $tutorproyecto->tutproy_id])}}">Prom. Anual</a> 
                                    </div>                                             
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger" title="Generar Reporte en PDF de Calificaciones"><i class="fas fa-file-pdf"></i></button>
                                        <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <a class="dropdown-item" data-toggle="modal" data-target="#val-calif-proy-escolar" data-tutproy_id="{{$tutorproyecto->tutproy_id}}">Prom. Parcial 1 (Q1)</a>
                                            <a class="dropdown-item" data-toggle="modal" data-target="#val-calif-proy-escolar2" data-tutproy_id="{{$tutorproyecto->tutproy_id}}">Prom. Parcial 2 (Q1)</a>
                                            <a class="dropdown-item" data-toggle="modal" data-target="#val-calif-proy-escolar3" data-tutproy_id="{{$tutorproyecto->tutproy_id}}">Prom. Quimestral (Q1)</a>
                                        <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" data-toggle="modal" data-target="#val-calif-proy-escolar4" data-tutproy_id="{{$tutorproyecto->tutproy_id}}">Prom. Parcial 1 (Q2)</a>
                                            <a class="dropdown-item" data-toggle="modal" data-target="#val-calif-proy-escolar5" data-tutproy_id="{{$tutorproyecto->tutproy_id}}">Prom. Parcial 2 (Q2)</a>
                                            <a class="dropdown-item" data-toggle="modal" data-target="#val-calif-proy-escolar6" data-tutproy_id="{{$tutorproyecto->tutproy_id}}">Prom. Quimestral (Q2)</a>  
                                        <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" data-toggle="modal" data-target="#val-calif-proy-escolar7" data-tutproy_id="{{$tutorproyecto->tutproy_id}}">Cuadro de Calificacion Anual</a>  
                                    </div>
                                    <!-- Reporte PDF - P1Q1 - Proyecto Escolar -->
                                    <div class="modal fade" id="val-calif-proy-escolar">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-danger">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Generar Reporte de Calificaciones de Proyecto Escolar en PDF - Parcial: 1 / Quimestre: 1</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{url('secretario/proyectoescolar/cursos/generarPDFProyEscPromP1Q1')}}" method="post">
                                        {{csrf_field()}}
                                        <div class="modal-body">      
                                            <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                                            <strong><p>Abreviatura:</p></strong>
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
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
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
                                            <input type="text" id="nom_ape_tutor_proy" class="form-control" name="nom_ape_tutor_proy" required>
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
                                        <!-- /.modal-content Reporte PDF - P1Q1 -->
                                    </div>
                                    <!-- /.modal-dialog Reporte PDF - P1Q1 -->
                                    </div>
                                    <!-- /.modal Reporte PDF - P1Q1 -->

                                    <!-- Reporte PDF - P2Q1 - Proyecto Escolar -->
                                    <div class="modal fade" id="val-calif-proy-escolar2">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-danger">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Generar Reporte de Calificaciones de Proyecto Escolar en PDF - Parcial: 2 / Quimestre: 1</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{url('secretario/proyectoescolar/cursos/generarPDFProyEscPromP2Q1')}}" method="post">
                                        {{csrf_field()}}
                                        <div class="modal-body">      
                                            <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                                            <strong><p>Abreviatura:</p></strong>
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
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
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
                                            <input type="text" id="nom_ape_tutor_proy" class="form-control" name="nom_ape_tutor_proy" required>
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
                                        <!-- /.modal-content Reporte PDF - P2Q1 -->
                                    </div>
                                    <!-- /.modal-dialog Reporte PDF - P2Q1 -->
                                    </div>
                                    <!-- /.modal Reporte PDF - P2Q1 -->

                                    <!-- Reporte PDF - Q1 - Proyecto Escolar -->
                                    <div class="modal fade" id="val-calif-proy-escolar3">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-danger">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Generar Reporte de Calificaciones de Proyecto Escolar en PDF - Quimestre: 1</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{url('secretario/proyectoescolar/cursos/generarPDFProyEscPromQ1')}}" method="post">
                                        {{csrf_field()}}
                                        <div class="modal-body">      
                                            <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                                            <strong><p>Abreviatura:</p></strong>
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
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
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
                                            <input type="text" id="nom_ape_tutor_proy" class="form-control" name="nom_ape_tutor_proy" required>
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
                                        <!-- /.modal-content Reporte PDF - Q1 -->
                                    </div>
                                    <!-- /.modal-dialog Reporte PDF - Q1 -->
                                    </div>
                                    <!-- /.modal Reporte PDF - Q1 -->

                                    <!-- Reporte PDF - P1Q2 - Proyecto Escolar -->
                                    <div class="modal fade" id="val-calif-proy-escolar4">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-danger">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Generar Reporte de Calificaciones de Proyecto Escolar en PDF - Parcial: 1 / Quimestre: 2</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{url('secretario/proyectoescolar/cursos/generarPDFProyEscPromP1Q2')}}" method="post">
                                        {{csrf_field()}}
                                        <div class="modal-body">      
                                            <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                                            <strong><p>Abreviatura:</p></strong>
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
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
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
                                            <input type="text" id="nom_ape_tutor_proy" class="form-control" name="nom_ape_tutor_proy" required>
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
                                        <!-- /.modal-content Reporte PDF - P1Q2 -->
                                    </div>
                                    <!-- /.modal-dialog Reporte PDF - P1Q2 -->
                                    </div>
                                    <!-- /.modal Reporte PDF - P1Q2 -->
                                    
                                    <!-- Reporte PDF - P2Q2 - Proyecto Escolar -->
                                    <div class="modal fade" id="val-calif-proy-escolar5">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-danger">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Generar Reporte de Calificaciones de Proyecto Escolar en PDF - Parcial: 2 / Quimestre: 2</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{url('secretario/proyectoescolar/cursos/generarPDFProyEscPromP2Q2')}}" method="post">
                                        {{csrf_field()}}
                                        <div class="modal-body">      
                                            <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                                            <strong><p>Abreviatura:</p></strong>
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
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
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
                                            <input type="text" id="nom_ape_tutor_proy" class="form-control" name="nom_ape_tutor_proy" required>
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
                                        <!-- /.modal-content Reporte PDF - P2Q2 -->
                                    </div>
                                    <!-- /.modal-dialog Reporte PDF - P2Q2 -->
                                    </div>
                                    <!-- /.modal Reporte PDF - P2Q2 -->

                                    <!-- Reporte PDF - Q2 - Proyecto Escolar -->
                                    <div class="modal fade" id="val-calif-proy-escolar6">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-danger">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Generar Reporte de Calificaciones de Proyecto Escolar en PDF - Quimestre: 2</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{url('secretario/proyectoescolar/cursos/generarPDFProyEscPromQ2')}}" method="post">
                                        {{csrf_field()}}
                                        <div class="modal-body">      
                                            <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                                            <strong><p>Abreviatura:</p></strong>
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
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
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
                                            <input type="text" id="nom_ape_tutor_proy" class="form-control" name="nom_ape_tutor_proy" required>
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
                                        <!-- /.modal-content Reporte PDF - Q2 -->
                                    </div>
                                    <!-- /.modal-dialog Reporte PDF - Q2 -->
                                    </div>
                                    <!-- /.modal Reporte PDF - Q2 -->

                                    <!-- Reporte PDF - Anual - Proyecto Escolar -->
                                    <div class="modal fade" id="val-calif-proy-escolar7">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-danger">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Generar Reporte de Calificaciones de Proyecto Escolar en PDF - Anual</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{url('secretario/proyectoescolar/cursos/generarPDFProyEscPromAnual')}}" method="post">
                                        {{csrf_field()}}
                                        <div class="modal-body"> 
                                            <strong><p>Tutor de Proyectos Escolares</p></strong>        
                                            <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                                            <p>Abreviatura:</p>
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
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
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
                                            <input type="text" id="nom_ape_tutor_proy" class="form-control" name="nom_ape_tutor_proy" required>
                                        </div>
                                        <div class="modal-body">  
                                            <strong><p>Rector/a de la Institución Educativa</p></strong>
                                            <p>Abreviatura:</p>
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
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
                                            <input type="hidden" name="tutproy_id" id="tutproy_id" value="">
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
                                        <!-- /.modal-content Reporte PDF - Anual - Proyecto Escolar -->
                                    </div>
                                    <!-- /.modal-dialog Reporte PDF - Anual - Proyecto Escolar -->
                                    </div>
                                    <!-- /.modal Reporte PDF - Anual - Proyecto Escolar -->
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
        "lengthChange": false, "autoWidth": false, "paging": false, "info": false, "ordering": true, "responsive": false, "searching": true
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