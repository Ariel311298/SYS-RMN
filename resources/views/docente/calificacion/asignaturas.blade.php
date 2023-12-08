@extends('backend.app')

@section('title')
Modulo Docente - Registrar / Consultar Calificaciones - Seleccionar Curso 
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) - Modulo Docente - Registrar / Consultar Calificaciones - Seleccionar Curso -->
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Registrar / Consultar Calificaciones - Seleccionar Curso</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header - Modulo Docente - Registrar / Consultar Calificaciones - Seleccionar Curso -->

  <!-- Main content -->
  <section class="content">
    <div class="card">  
        <div class="card-header">
            <h3 class="card-title">Tabla de Cursos</h3> 
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="overflow:scroll;">
          <table id="example1" class="table table-bordered table-striped table-count">
              <thead>
                  <tr align="center">
                    <th rowspan="2">Periodo</th>
                    <th rowspan="2">Seccion</th>
                    <th rowspan="2">Curso</th>
                    <th rowspan="2">Asignatura</th>
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
                @foreach($materias as $materia)
                @if($materia->mal_estado == 1)   
                  <tr align="center">
                    <td>
                      {{$materia->oferta->periodo->per_nombre}}
                    </td>
                    <td>
                      {{$materia->oferta->curso->seccion->sec_nombre}}
                    </td>
                    <td>
                      {{$materia->oferta->curso->cur_nombre}} {{$materia->oferta->curso->cur_paralelo}}                                                                                                    
                    </td>
                    <td>
                      {{$materia->asignatura->asig_nom}}                         
                    </td>
                    <td>
                      @if($materia->mal_estado == 1)   
                        <p>Activo</p>
                      @else
                        <p>Desactivado</p>
                      @endif                                               
                    </td>
                    <td>
                      <a href="{{url('docente/calificacion/asignaturas/ingresocalificacion', ['mal_id' => $materia->mal_id])}}">
                        <button type="button" class="btn btn-info center-block" title="Ingresar Calificaciones">
                          <i class="fas fa-pen"></i>
                        </button>
                      </a>   
                    </td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary" title="Consultar Calificaciones"> <i class="fas fa-table"></i></button>
                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown">
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <a class="dropdown-item" href="{{url('docente/calificacion/asignaturas/consultar-calificacion-prom-p1q1', ['mal_id' => $materia->mal_id])}}">Prom. Parcial 1 (Q1)</a>
                          <a class="dropdown-item" href="{{url('docente/calificacion/asignaturas/consultar-calificacion-prom-p2q1', ['mal_id' => $materia->mal_id])}}">Prom. Parcial 2 (Q1)</a>
                          <a class="dropdown-item" href="{{url('docente/calificacion/asignaturas/consultar-calificacion-prom-q1', ['mal_id' => $materia->mal_id])}}">Prom. Quimestral (Q1)</a>
                        <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="{{url('docente/calificacion/asignaturas/consultar-calificacion-prom-p1q2', ['mal_id' => $materia->mal_id])}}">Prom. Parcial 1 (Q2)</a> 
                          <a class="dropdown-item" href="{{url('docente/calificacion/asignaturas/consultar-calificacion-prom-p2q2', ['mal_id' => $materia->mal_id])}}">Prom. Parcial 2 (Q2)</a>  
                          <a class="dropdown-item" href="{{url('docente/calificacion/asignaturas/consultar-calificacion-prom-q2', ['mal_id' => $materia->mal_id])}}">Prom. Quimestral (Q2)</a>
                        <div class="dropdown-divider"></div>  
                          <a class="dropdown-item" href="{{url('docente/calificacion/asignaturas/consultar-calificacion-prom-anual', ['mal_id' => $materia->mal_id])}}">Prom. Anual</a> 
                      </div>
                    </td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-danger" title="Generar Reporte en PDF de Calificaciones"><i class="fas fa-file-pdf"></i></button>
                        <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion" data-mal_id="{{$materia->mal_id}}">Prom. Parcial 1 (Q1)</a>
                          <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion2" data-mal_id="{{$materia->mal_id}}">Prom. Parcial 2 (Q1)</a>
                          <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion3" data-mal_id="{{$materia->mal_id}}">Prom. Quimestral (Q1)</a>
                        <div class="dropdown-divider"></div>
                          <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion4" data-mal_id="{{$materia->mal_id}}">Prom. Parcial 1 (Q2)</a>
                          <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion5" data-mal_id="{{$materia->mal_id}}">Prom. Parcial 2 (Q2)</a>
                          <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion6" data-mal_id="{{$materia->mal_id}}">Prom. Quimestral (Q2)</a>  
                        <div class="dropdown-divider"></div>
                          <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion7" data-mal_id="{{$materia->mal_id}}">Prom. Anual</a>
                          <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion8" data-mal_id="{{$materia->mal_id}}">Cuadro de Calificaciones Anuales</a>  
                      </div>
                      <!-- Reporte PDF - P1Q1 -->
                      <div class="modal fade" id="val-calificacion">
                        <div class="modal-dialog">
                          <div class="modal-content bg-danger">
                            <div class="modal-header">
                              <h4 class="modal-title">Generar Reporte en PDF - Parcial: 1 / Quimestre: 1</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{url('docente/calificacion/asignaturas/generarPDFPromP1Q1')}}" method="post">
                            {{csrf_field()}}
                            <div class="modal-body">      
                              <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                              <strong><p>Abreviatura:</p></strong>
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
                              <input type="text" id="nom_ape_docente" class="form-control" name="nom_ape_docente" required>
                              <input type="hidden" name="mal_id" id="mal_id" value="">
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

                      <!-- Reporte PDF P2Q1 -->
                      <div class="modal fade" id="val-calificacion2">
                        <div class="modal-dialog">
                          <div class="modal-content bg-danger">
                            <div class="modal-header">
                              <h4 class="modal-title">Generar Reporte en PDF - Parcial: 2 / Quimestre: 1</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{url('docente/calificacion/asignaturas/generarPDFPromP2Q1')}}" method="post">
                            {{csrf_field()}}
                            <div class="modal-body">       
                              <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                              <strong><p>Abreviatura:</p></strong>
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
                              <input type="text" id="nom_ape_docente" class="form-control" name="nom_ape_docente" required>
                              <input type="hidden" name="mal_id" id="mal_id" value="">
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

                      <!-- Reporte PDF Q1 -->
                      <div class="modal fade" id="val-calificacion3">
                        <div class="modal-dialog">
                          <div class="modal-content bg-danger">
                            <div class="modal-header">
                              <h4 class="modal-title">Generar Reporte en PDF - Quimestre: 1</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{url('docente/calificacion/asignaturas/generarPDFPromQ1')}}" method="post">
                            {{csrf_field()}}
                            <div class="modal-body">  
                              <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                              <strong><p>Abreviatura:</p></strong>
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
                              <input type="text" id="nom_ape_docente" class="form-control" name="nom_ape_docente" required>
                              <input type="hidden" name="mal_id" id="mal_id" value="">
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
                                              
                      <!-- Reporte PDF P1Q2 -->
                      <div class="modal fade" id="val-calificacion4">
                        <div class="modal-dialog">
                          <div class="modal-content bg-danger">
                            <div class="modal-header">
                              <h4 class="modal-title">Generar Reporte en PDF - Parcial: 1 / Quimestre: 2</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{url('docente/calificacion/asignaturas/generarPDFPromP1Q2')}}" method="post">
                            {{csrf_field()}}
                            <div class="modal-body">      
                              <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                              <strong><p>Abreviatura:</p></strong>
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
                              <input type="text" id="nom_ape_docente" class="form-control" name="nom_ape_docente" required>
                              <input type="hidden" name="mal_id" id="mal_id" value="">
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

                      <!-- Reporte PDF - P2Q2 -->
                      <div class="modal fade" id="val-calificacion5">
                        <div class="modal-dialog">
                          <div class="modal-content bg-danger">
                            <div class="modal-header">
                              <h4 class="modal-title">Generar Reporte en PDF - Parcial: 2 / Quimestre: 2</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{url('docente/calificacion/asignaturas/generarPDFPromP2Q2')}}" method="post">
                            {{csrf_field()}}
                            <div class="modal-body">      
                              <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                              <strong><p>Abreviatura:</p></strong>
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
                              <input type="text" id="nom_ape_docente" class="form-control" name="nom_ape_docente" required>
                              <input type="hidden" name="mal_id" id="mal_id" value="">
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

                      <!-- Reporte PDF Q2 -->
                      <div class="modal fade" id="val-calificacion6">
                        <div class="modal-dialog">
                          <div class="modal-content bg-danger">
                            <div class="modal-header">
                              <h4 class="modal-title">Generar Reporte en PDF - Quimestre: 2</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{url('docente/calificacion/asignaturas/generarPDFPromQ2')}}" method="post">
                            {{csrf_field()}}
                            <div class="modal-body">  
                              <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                              <strong><p>Abreviatura:</p></strong>
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
                              <input type="text" id="nom_ape_docente" class="form-control" name="nom_ape_docente" required>
                              <input type="hidden" name="mal_id" id="mal_id" value="">
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

                      <!-- Reporte PDF - Promedio Anual -->
                      <div class="modal fade" id="val-calificacion7">
                        <div class="modal-dialog">
                          <div class="modal-content bg-danger">
                            <div class="modal-header">
                              <h4 class="modal-title">Generar Reporte en PDF - Promedio Anual</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{url('docente/calificacion/asignaturas/generarPDFPromAnual')}}" method="post">
                            {{csrf_field()}}
                            <div class="modal-body">  
                              <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                              <strong><p>Abreviatura:</p></strong>
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
                              <input type="text" id="nom_ape_docente" class="form-control" name="nom_ape_docente" required>
                              <input type="hidden" name="mal_id" id="mal_id" value="">
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
                          <!-- /.modal-content Reporte PDF - Promedio Anual -->
                        </div>
                        <!-- /.modal-dialog Reporte PDF - Promedio Anual -->
                      </div>
                      <!-- /.modal Reporte PDF - Promedio Anual -->

                      <!-- Reporte PDF - Cuadro de Calificacion Anuales -->
                      <div class="modal fade" id="val-calificacion8">
                        <div class="modal-dialog">
                          <div class="modal-content bg-danger">
                            <div class="modal-header">
                              <h4 class="modal-title">Generar Reporte en PDF - Cuadro de Calificaciones Anuales</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{url('docente/calificacion/asignaturas/generarPDFCalifAnual')}}" method="post">
                            {{csrf_field()}}
                            <div class="modal-body">  
                              <p>Seleccione la abreviatura para el docente encargado de la materia y el rector de la institución y edite los nombres y apellidos de los mismos.</p>                                
                              <strong><p>Docente de la materia</p></strong>                            
                              <p>Abreviatura:</p>
                              <input type="hidden" name="mal_id" id="mal_id" value="">
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
                              <input type="hidden" name="mal_id" id="mal_id" value="">
                              <input type="text" id="nom_ape_docente" class="form-control" name="nom_ape_docente" required>
                            </div>
                            <div class="modal-body">  
                              <strong><p>Rector/a de la Institución Educativa</p></strong>
                              <p>Abreviatura:</p>
                              <input type="hidden" name="mal_id" id="mal_id" value="">
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
                              <input type="hidden" name="mal_id" id="mal_id" value="">
                              <input type="text" id="nom_ape_rector" class="form-control" name="nom_ape_rector" required>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-outline-light" data-dismiss="modal">
                                    Cerrar
                                    <i class="fas fa-arrow-left"></i>
                                </button>
                                <button class="btn btn-outline-light" type="submit">
                                    Generar Cuadro
                                    <i class="fas fa-file-pdf"></i>
                                </button>
                            </div>
                            </form>
                          </div>
                          <!-- /.modal-content Reporte PDF - Promedio Anual -->
                        </div>
                        <!-- /.modal-dialog Reporte PDF - Promedio Anual -->
                      </div>
                      <!-- /.modal Reporte PDF - Promedio Anual -->
                    </td>
                  </tr>
                @else
                <tr align="center">
                    <td>
                      {{$materia->oferta->periodo->per_nombre}}
                    </td>
                    <td>
                      {{$materia->oferta->curso->seccion->sec_nombre}}
                    </td>
                    <td>
                      {{$materia->oferta->curso->cur_nombre}} {{$materia->oferta->curso->cur_paralelo}}                                                                                                    
                    </td>
                    <td>
                      {{$materia->asignatura->asig_nom}}                         
                    </td>
                    <td>
                      @if($materia->mal_estado == 1)   
                        <p>Activo</p>
                      @else
                        <p>Desactivado</p>
                      @endif                                               
                    </td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary" title="Consultar Calificaciones"> <i class="fas fa-table"></i></button>
                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown">
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <a class="dropdown-item" href="{{url('docente/calificacion/asignaturas/consultar-calificacion-prom-p1q1', ['mal_id' => $materia->mal_id])}}">Prom. Parcial 1 (Q1)</a>
                          <a class="dropdown-item" href="{{url('docente/calificacion/asignaturas/consultar-calificacion-prom-p2q1', ['mal_id' => $materia->mal_id])}}">Prom. Parcial 2 (Q1)</a>
                          <a class="dropdown-item" href="{{url('docente/calificacion/asignaturas/consultar-calificacion-prom-q1', ['mal_id' => $materia->mal_id])}}">Prom. Quimestral (Q1)</a>
                        <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="{{url('docente/calificacion/asignaturas/consultar-calificacion-prom-p1q2', ['mal_id' => $materia->mal_id])}}">Prom. Parcial 1 (Q2)</a> 
                          <a class="dropdown-item" href="{{url('docente/calificacion/asignaturas/consultar-calificacion-prom-p2q2', ['mal_id' => $materia->mal_id])}}">Prom. Parcial 2 (Q2)</a>  
                          <a class="dropdown-item" href="{{url('docente/calificacion/asignaturas/consultar-calificacion-prom-q2', ['mal_id' => $materia->mal_id])}}">Prom. Quimestral (Q2)</a>
                        <div class="dropdown-divider"></div>  
                          <a class="dropdown-item" href="{{url('docente/calificacion/asignaturas/consultar-calificacion-prom-anual', ['mal_id' => $materia->mal_id])}}">Prom. Anual</a> 
                      </div>
                    </td>
                    <td colspan="2">
                      <div class="btn-group">
                        <button type="button" class="btn btn-danger" title="Generar Reporte en PDF de Calificaciones"><i class="fas fa-file-pdf"></i></button>
                        <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion" data-mal_id="{{$materia->mal_id}}">Prom. Parcial 1 (Q1)</a>
                          <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion2" data-mal_id="{{$materia->mal_id}}">Prom. Parcial 2 (Q1)</a>
                          <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion3" data-mal_id="{{$materia->mal_id}}">Prom. Quimestral (Q1)</a>
                        <div class="dropdown-divider"></div>
                          <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion4" data-mal_id="{{$materia->mal_id}}">Prom. Parcial 1 (Q2)</a>
                          <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion5" data-mal_id="{{$materia->mal_id}}">Prom. Parcial 2 (Q2)</a>
                          <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion6" data-mal_id="{{$materia->mal_id}}">Prom. Quimestral (Q2)</a>  
                        <div class="dropdown-divider"></div>
                          <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion7" data-mal_id="{{$materia->mal_id}}">Prom. Anual</a>
                          <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion8" data-mal_id="{{$materia->mal_id}}">Cuadro de Calificaciones Anuales</a>  
                      </div>
                      <!-- Reporte PDF - P1Q1 -->
                      <div class="modal fade" id="val-calificacion">
                        <div class="modal-dialog">
                          <div class="modal-content bg-danger">
                            <div class="modal-header">
                              <h4 class="modal-title">Generar Reporte en PDF - Parcial: 1 / Quimestre: 1</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{url('docente/calificacion/asignaturas/generarPDFPromP1Q1')}}" method="post">
                            {{csrf_field()}}
                            <div class="modal-body">      
                              <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                              <strong><p>Abreviatura:</p></strong>
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
                              <input type="text" id="nom_ape_docente" class="form-control" name="nom_ape_docente" required>
                              <input type="hidden" name="mal_id" id="mal_id" value="">
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

                      <!-- Reporte PDF P2Q1 -->
                      <div class="modal fade" id="val-calificacion2">
                        <div class="modal-dialog">
                          <div class="modal-content bg-danger">
                            <div class="modal-header">
                              <h4 class="modal-title">Generar Reporte en PDF - Parcial: 2 / Quimestre: 1</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{url('docente/calificacion/asignaturas/generarPDFPromP2Q1')}}" method="post">
                            {{csrf_field()}}
                            <div class="modal-body">       
                              <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                              <strong><p>Abreviatura:</p></strong>
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
                              <input type="text" id="nom_ape_docente" class="form-control" name="nom_ape_docente" required>
                              <input type="hidden" name="mal_id" id="mal_id" value="">
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

                      <!-- Reporte PDF Q1 -->
                      <div class="modal fade" id="val-calificacion3">
                        <div class="modal-dialog">
                          <div class="modal-content bg-danger">
                            <div class="modal-header">
                              <h4 class="modal-title">Generar Reporte en PDF - Quimestre: 1</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{url('docente/calificacion/asignaturas/generarPDFPromQ1')}}" method="post">
                            {{csrf_field()}}
                            <div class="modal-body">  
                              <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                              <strong><p>Abreviatura:</p></strong>
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
                              <input type="text" id="nom_ape_docente" class="form-control" name="nom_ape_docente" required>
                              <input type="hidden" name="mal_id" id="mal_id" value="">
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
                                              
                      <!-- Reporte PDF P1Q2 -->
                      <div class="modal fade" id="val-calificacion4">
                        <div class="modal-dialog">
                          <div class="modal-content bg-danger">
                            <div class="modal-header">
                              <h4 class="modal-title">Generar Reporte en PDF - Parcial: 1 / Quimestre: 2</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{url('docente/calificacion/asignaturas/generarPDFPromP1Q2')}}" method="post">
                            {{csrf_field()}}
                            <div class="modal-body">      
                              <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                              <strong><p>Abreviatura:</p></strong>
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
                              <input type="text" id="nom_ape_docente" class="form-control" name="nom_ape_docente" required>
                              <input type="hidden" name="mal_id" id="mal_id" value="">
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

                      <!-- Reporte PDF - P2Q2 -->
                      <div class="modal fade" id="val-calificacion5">
                        <div class="modal-dialog">
                          <div class="modal-content bg-danger">
                            <div class="modal-header">
                              <h4 class="modal-title">Generar Reporte en PDF - Parcial: 2 / Quimestre: 2</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{url('docente/calificacion/asignaturas/generarPDFPromP2Q2')}}" method="post">
                            {{csrf_field()}}
                            <div class="modal-body">      
                              <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                              <strong><p>Abreviatura:</p></strong>
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
                              <input type="text" id="nom_ape_docente" class="form-control" name="nom_ape_docente" required>
                              <input type="hidden" name="mal_id" id="mal_id" value="">
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

                      <!-- Reporte PDF Q2 -->
                      <div class="modal fade" id="val-calificacion6">
                        <div class="modal-dialog">
                          <div class="modal-content bg-danger">
                            <div class="modal-header">
                              <h4 class="modal-title">Generar Reporte en PDF - Quimestre: 2</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{url('docente/calificacion/asignaturas/generarPDFPromQ2')}}" method="post">
                            {{csrf_field()}}
                            <div class="modal-body">  
                              <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                              <strong><p>Abreviatura:</p></strong>
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
                              <input type="text" id="nom_ape_docente" class="form-control" name="nom_ape_docente" required>
                              <input type="hidden" name="mal_id" id="mal_id" value="">
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

                      <!-- Reporte PDF - Promedio Anual -->
                      <div class="modal fade" id="val-calificacion7">
                        <div class="modal-dialog">
                          <div class="modal-content bg-danger">
                            <div class="modal-header">
                              <h4 class="modal-title">Generar Reporte en PDF - Promedio Anual</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{url('docente/calificacion/asignaturas/generarPDFPromAnual')}}" method="post">
                            {{csrf_field()}}
                            <div class="modal-body">  
                              <p>Seleccione la abreviatura y edite los nombres y apellidos</p>                                
                              <strong><p>Abreviatura:</p></strong>
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
                              <input type="text" id="nom_ape_docente" class="form-control" name="nom_ape_docente" required>
                              <input type="hidden" name="mal_id" id="mal_id" value="">
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
                          <!-- /.modal-content Reporte PDF - Promedio Anual -->
                        </div>
                        <!-- /.modal-dialog Reporte PDF - Promedio Anual -->
                      </div>
                      <!-- /.modal Reporte PDF - Promedio Anual -->

                      <!-- Reporte PDF - Cuadro de Calificacion Anuales -->
                      <div class="modal fade" id="val-calificacion8">
                        <div class="modal-dialog">
                          <div class="modal-content bg-danger">
                            <div class="modal-header">
                              <h4 class="modal-title">Generar Reporte en PDF - Cuadro de Calificaciones Anuales</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{url('docente/calificacion/asignaturas/generarPDFCalifAnual')}}" method="post">
                            {{csrf_field()}}
                            <div class="modal-body">  
                              <p>Seleccione la abreviatura para el docente encargado de la materia y el rector de la institución y edite los nombres y apellidos de los mismos.</p>                                
                              <strong><p>Docente de la materia</p></strong>                            
                              <p>Abreviatura:</p>
                              <input type="hidden" name="mal_id" id="mal_id" value="">
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
                              <input type="hidden" name="mal_id" id="mal_id" value="">
                              <input type="text" id="nom_ape_docente" class="form-control" name="nom_ape_docente" required>
                            </div>
                            <div class="modal-body">  
                              <strong><p>Rector/a de la Institución Educativa</p></strong>
                              <p>Abreviatura:</p>
                              <input type="hidden" name="mal_id" id="mal_id" value="">
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
                              <input type="hidden" name="mal_id" id="mal_id" value="">
                              <input type="text" id="nom_ape_rector" class="form-control" name="nom_ape_rector" required>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-outline-light" data-dismiss="modal">
                                    Cerrar
                                    <i class="fas fa-arrow-left"></i>
                                </button>
                                <button class="btn btn-outline-light" type="submit">
                                    Generar Cuadro
                                    <i class="fas fa-file-pdf"></i>
                                </button>
                            </div>
                            </form>
                          </div>
                          <!-- /.modal-content Reporte PDF - Promedio Anual -->
                        </div>
                        <!-- /.modal-dialog Reporte PDF - Promedio Anual -->
                      </div>
                      <!-- /.modal Reporte PDF - Promedio Anual -->
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
      "lengthChange": false, "autoWidth": false, "paging": false, "info": false, "ordering": true, "responsive": false, "searching": true,
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

