@extends('backend.app')

@section('title')
Modulo Administrador - Consultar Calificaciones - Asignaturas - {{$oferta->periodo->per_nombre}} - {{$oferta->curso->seccion->sec_nombre}} - {{$oferta->curso->cur_nombre}} {{$oferta->curso->cur_paralelo}}
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) - Modulo Administrador/a - Consultar Calificaciones - Asignaturas -->
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Consultar Calificaciones - Asignaturas</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header - Modulo Administrador/a - Consultar Calificaciones - Asignaturas -->

  <!-- Main content -->
  <section class="content">
    <div class="card">  
        <div class="card-header">
            <h3 class="card-title">Periodo: {{$oferta->periodo->per_nombre}} / Seccion: {{$oferta->curso->seccion->sec_nombre}} / Curso: {{$oferta->curso->cur_nombre}} {{$oferta->curso->cur_paralelo}} / Tutor de Curso: {{$oferta->personal->pers_nombres}} {{$oferta->personal->pers_apellidos}}</h3> 
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="overflow:scroll;">
        <table id="example2" class="table table-bordered table-striped table-count">
            <thead>
                <tr align="center">
                  <th>Curso</th>
                  <th>Paralelo</th>
                  <th>Asignatura</th>
                  <th>Docente</th>
                  <th>Estado</th>
                  <th colspan="3">Opciones</th>
                </tr>
            </thead>
            <tbody>
              @foreach($mallas as $malla)   
                <tr align="center">
                  <td>
                    {{$malla->oferta->curso->cur_nombre}}
                  </td>
                  <td>
                    {{$malla->oferta->curso->cur_paralelo}}                                                            
                  </td>
                  <td>
                    {{$malla->asignatura->asig_nom}}                                                            
                  </td>
                  <td>
                    {{$malla->personal->pers_nombres}} {{$malla->personal->pers_apellidos}}                                                            
                  </td>
                  <td>
                    @if($malla->mal_estado == 1)   
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
                        <a class="dropdown-item" href="{{url('administrador/calificacion/cursos/materias/consultar-calificacion-prom-p1q1', ['mal_id' => $malla->mal_id])}}">Prom. Parcial 1 (Q1)</a>
                        <a class="dropdown-item" href="{{url('administrador/calificacion/cursos/materias/consultar-calificacion-prom-p2q1', ['mal_id' => $malla->mal_id])}}">Prom. Parcial 2 (Q1)</a>
                        <a class="dropdown-item" href="{{url('administrador/calificacion/cursos/materias/consultar-calificacion-prom-q1', ['mal_id' => $malla->mal_id])}}">Prom. Quimestral (Q1)</a>
                      <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{url('administrador/calificacion/cursos/materias/consultar-calificacion-prom-p1q2', ['mal_id' => $malla->mal_id])}}">Prom. Parcial 1 (Q2)</a> 
                        <a class="dropdown-item" href="{{url('administrador/calificacion/cursos/materias/consultar-calificacion-prom-p2q2', ['mal_id' => $malla->mal_id])}}">Prom. Parcial 2 (Q2)</a>  
                        <a class="dropdown-item" href="{{url('administrador/calificacion/cursos/materias/consultar-calificacion-prom-q2', ['mal_id' => $malla->mal_id])}}">Prom. Quimestral (Q2)</a>
                      <div class="dropdown-divider"></div>  
                        <a class="dropdown-item" href="{{url('administrador/calificacion/cursos/materias/consultar-calificacion-prom-anual', ['mal_id' => $malla->mal_id])}}">Prom. Anual</a> 
                    </div>
                  </td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-danger" title="Generar Reporte en PDF de Calificaciones"><i class="fas fa-file-pdf"></i></button>
                      <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion" data-mal_id="{{$malla->mal_id}}">Prom. Parcial 1 (Q1)</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion2" data-mal_id="{{$malla->mal_id}}">Prom. Parcial 2 (Q1)</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion3" data-mal_id="{{$malla->mal_id}}">Prom. Quimestral (Q1)</a>
                      <div class="dropdown-divider"></div>
                        <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion4" data-mal_id="{{$malla->mal_id}}">Prom. Parcial 1 (Q2)</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion5" data-mal_id="{{$malla->mal_id}}">Prom. Parcial 2 (Q2)</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion6" data-mal_id="{{$malla->mal_id}}">Prom. Quimestral (Q2)</a>  
                      <div class="dropdown-divider"></div>
                        <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion7" data-mal_id="{{$malla->mal_id}}">Prom. Anual</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion8" data-mal_id="{{$malla->mal_id}}">Cuadro de Calificaciones Anuales</a>  
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
                          <form action="{{url('administrador/calificacion/cursos/materias/generarPDFPromP1Q1')}}" method="post">
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
                          <form action="{{url('administrador/calificacion/cursos/materias/generarPDFPromP2Q1')}}" method="post">
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
                          <form action="{{url('administrador/calificacion/cursos/materias/generarPDFPromQ1')}}" method="post">
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
                          <form action="{{url('administrador/calificacion/cursos/materias/generarPDFPromP1Q2')}}" method="post">
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
                          <form action="{{url('administrador/calificacion/cursos/materias/generarPDFPromP2Q2')}}" method="post">
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
                          <form action="{{url('administrador/calificacion/cursos/materias/generarPDFPromQ2')}}" method="post">
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
                          <form action="{{url('administrador/calificacion/cursos/materias/generarPDFPromAnual')}}" method="post">
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
                          <form action="{{url('administrador/calificacion/cursos/materias/generarPDFCalifAnual')}}" method="post">
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
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-success" title="Generar Reporte en Excel de Calificaciones"> <i class="fas fa-file-excel"></i></button>
                      <button type="button" class="btn btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion-excel" data-mal_id="{{$malla->mal_id}}">Prom. Parcial 1 (Q1)</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion-excel2" data-mal_id="{{$malla->mal_id}}">Prom. Parcial 2 (Q1)</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion-excel3" data-mal_id="{{$malla->mal_id}}">Prom. Quimestral (Q1)</a>
                      <div class="dropdown-divider"></div>
                        <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion-excel4" data-mal_id="{{$malla->mal_id}}">Prom. Parcial 1 (Q2)</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion-excel5" data-mal_id="{{$malla->mal_id}}">Prom. Parcial 2 (Q2)</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion-excel6" data-mal_id="{{$malla->mal_id}}">Prom. Quimestral (Q2)</a>  
                      <div class="dropdown-divider"></div>
                        <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion-excel7" data-mal_id="{{$malla->mal_id}}">Prom. Anual</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#val-calificacion-excel8" data-mal_id="{{$malla->mal_id}}">Cuadro de Calificaciones Anuales</a>  
                    </div>        

                    <!-- Reporte Excel - P1Q1 -->
                    <div class="modal fade" id="val-calificacion-excel">
                      <div class="modal-dialog">
                        <div class="modal-content bg-success">
                          <div class="modal-header">
                            <h4 class="modal-title">Generar Reporte en Excel - Parcial: 1 / Quimestre: 1</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="{{url('administrador/calificacion/cursos/materias/exportReportCalifP1Q1Excel')}}" method="post">
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
                                  <i class="fas fa-file-excel"></i>
                              </button>
                          </div>
                          </form>
                        </div>
                        <!-- /.modal-content Reporte Excel - P1Q1 -->
                      </div>
                      <!-- /.modal-dialog Reporte Excel - P1Q1 -->
                    </div>
                    <!-- /.modal Reporte Excel - P1Q1 -->

                     <!-- Reporte Excel - P2Q1 -->
                     <div class="modal fade" id="val-calificacion-excel2">
                      <div class="modal-dialog">
                        <div class="modal-content bg-success">
                          <div class="modal-header">
                            <h4 class="modal-title">Generar Reporte en Excel - Parcial: 2 / Quimestre: 1</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="{{url('administrador/calificacion/cursos/materias/exportReportCalifP2Q1Excel')}}" method="post">
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
                                  <i class="fas fa-file-excel"></i>
                              </button>
                          </div>
                          </form>
                        </div>
                        <!-- /.modal-content Reporte Excel - P2Q1 -->
                      </div>
                      <!-- /.modal-dialog Reporte Excel - P2Q1 -->
                    </div>
                    <!-- /.modal Reporte Excel - P2Q1 -->

                      <!-- Reporte Excel - Q1 -->
                      <div class="modal fade" id="val-calificacion-excel3">
                      <div class="modal-dialog">
                        <div class="modal-content bg-success">
                          <div class="modal-header">
                            <h4 class="modal-title">Generar Reporte en Excel - Quimestre: 1</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="{{url('administrador/calificacion/cursos/materias/exportReportCalifQ1Excel')}}" method="post">
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
                                  <i class="fas fa-file-excel"></i>
                              </button>
                          </div>
                          </form>
                        </div>
                        <!-- /.modal-content Reporte Excel - Q1 -->
                      </div>
                      <!-- /.modal-dialog Reporte Excel - Q1 -->
                    </div>
                    <!-- /.modal Reporte Excel - Q1 -->

                    <!-- Reporte Excel - P1Q2 -->
                    <div class="modal fade" id="val-calificacion-excel4">
                      <div class="modal-dialog">
                        <div class="modal-content bg-success">
                          <div class="modal-header">
                            <h4 class="modal-title">Generar Reporte en Excel - Parcial: 1 / Quimestre: 2</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="{{url('administrador/calificacion/cursos/materias/exportReportCalifP1Q2Excel')}}" method="post">
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
                                  <i class="fas fa-file-excel"></i>
                              </button>
                          </div>
                          </form>
                        </div>
                        <!-- /.modal-content Reporte Excel - P1Q2 -->
                      </div>
                      <!-- /.modal-dialog Reporte Excel - P1Q2 -->
                    </div>
                    <!-- /.modal Reporte Excel - P1Q2 -->

                    <!-- Reporte Excel - P2Q2 -->
                    <div class="modal fade" id="val-calificacion-excel5">
                      <div class="modal-dialog">
                        <div class="modal-content bg-success">
                          <div class="modal-header">
                            <h4 class="modal-title">Generar Reporte en Excel - Parcial: 2 / Quimestre: 2</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="{{url('administrador/calificacion/cursos/materias/exportReportCalifP2Q2Excel')}}" method="post">
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
                                  <i class="fas fa-file-excel"></i>
                              </button>
                          </div>
                          </form>
                        </div>
                        <!-- /.modal-content Reporte Excel - P2Q2 -->
                      </div>
                      <!-- /.modal-dialog Reporte Excel - P2Q2 -->
                    </div>
                    <!-- /.modal Reporte Excel - P2Q2 -->  

                     <!-- Reporte Excel - Q2 -->
                     <div class="modal fade" id="val-calificacion-excel6">
                      <div class="modal-dialog">
                        <div class="modal-content bg-success">
                          <div class="modal-header">
                            <h4 class="modal-title">Generar Reporte en Excel - Quimestre: 2</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="{{url('administrador/calificacion/cursos/materias/exportReportCalifQ2Excel')}}" method="post">
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
                                  <i class="fas fa-file-excel"></i>
                              </button>
                          </div>
                          </form>
                        </div>
                        <!-- /.modal-content Reporte Excel - Q2 -->
                      </div>
                      <!-- /.modal-dialog Reporte Excel - Q2 -->
                    </div>
                    <!-- /.modal Reporte Excel - Q2 -->
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <a href="/administrador/calificacion/cursos">
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
