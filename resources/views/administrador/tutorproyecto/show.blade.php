@extends('backend.app')

@section('title')
Modulo Administrador - Consultar Tutor de Proyectos Escolares
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) - Administrador/a - Consultar Tutor de Proyectos Escolares -->

  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Modulo Administrador/a - Consultar Tutor de Proyectos Escolares</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header - Administrador/a - Consultar Tutor de Proyectos Escolares -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Consultar Tutor de Proyectos Escolares</h3>
            </div>
            <!-- /.card-header -->
            
            <!-- form start -->
              <div class="card-body">
                  <div class="form-group">
                      <h3 class="profile-username text-center">{{$tutorproyecto->personal->pers_nombres}} {{$tutorproyecto->personal->pers_apellidos}}</h3>
                      <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                          <b>Periodo:</b> 
                            <a class="float-right">{{$tutorproyecto->oferta->periodo->per_nombre}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Seccion:</b> <a class="float-right">{{$tutorproyecto->oferta->curso->seccion->sec_nombre}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Curso:</b> 
                          <a class="float-right">{{$tutorproyecto->oferta->curso->cur_nombre}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Paralelo:</b> 
                          <a class="float-right">{{$tutorproyecto->oferta->curso->cur_paralelo}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Tutor de Curso:</b> 
                          <a class="float-right">{{$tutorproyecto->oferta->personal->pers_nombres}} {{$tutorproyecto->oferta->personal->pers_apellidos}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Estado:</b> 
                          @if($tutorproyecto->tutproy_estado == 1)
                            <a class="float-right">Activo</a>
                          @else
                            <a class="float-right">Desactivado</a>
                          @endif        
                        </li>
                      </ul>
                  </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <a href="/administrador/tutorproyecto/index">
                  <button type="button" class="btn btn-danger center-block">
                    Regresar
                    <i class="fas fa-arrow-left"></i>
                  </button>
                </a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          </form>
          <!-- /.form POST-->
        </div>      
      <!-- /.form -->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection