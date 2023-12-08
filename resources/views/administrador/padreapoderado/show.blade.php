@extends('backend.app')

@section('title')
Modulo Administrador - Consultar Datos Personales del Padre o Apoderado
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) - Administrador/a - Consultar Datos Personales del Padre o Apoderado -->

  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Modulo Administrador/a - Consultar Datos Personales del Padre o Apoderado</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header - Administrador/a - Consultar Datos Personales del Padre o Apoderado -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Consultar Datos Personales del Padre o Apoderado</h3>
            </div>
            <!-- /.card-header -->
            
            <!-- form start -->
              <div class="card-body">
                  <div class="form-group">
                      <h3 class="profile-username text-center">{{$padreapoderado->pad_nombres}} {{$padreapoderado->pad_apellidos}}</h3>
                      <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                          <b>Nombre y Apellido del Hijo/a:</b> 
                            <a class="float-right">{{$padreapoderado->alumno->alum_nombres}} {{$padreapoderado->alumno->alum_apellidos}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>N ° Cedula:</b> <a class="float-right">{{$padreapoderado->pad_ncedula}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>N ° Pasaporte:</b> 
                          @if($padreapoderado->pad_npasaporte)
                            <a class="float-right">{{$padreapoderado->pad_npasaporte}}</a>
                          @else
                            <a class="float-right">N/A</a>
                          @endif
                        </li>
                        <li class="list-group-item">
                          <b>Nacionalidad:</b> 
                          <a class="float-right">{{$padreapoderado->pad_nacionalidad}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Email:</b> 
                          @if($padreapoderado->pad_email)
                            <a class="float-right">{{$padreapoderado->pad_email}}</a>
                          @else
                            <a class="float-right">N/A</a>  
                          @endif
                        </li>
                        <li class="list-group-item">
                          <b>Ocupación:</b> 
                          <a class="float-right">{{$padreapoderado->pad_ocupacion}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Nivel de Instruccion:</b> 
                          <a class="float-right">{{$padreapoderado->pad_nivel}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Direccion:</b> 
                          <a class="float-right">{{$padreapoderado->pad_direccion}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Telefono Celular:</b> 
                          @if($padreapoderado->pad_telf_celular)
                            <a class="float-right">{{$padreapoderado->pad_telf_celular}}</a>
                          @else
                            <a class="float-right">N/A</a>                              
                          @endif
                        </li>
                        <li class="list-group-item">
                          <b>Telefono Convencional:</b> 
                          @if($padreapoderado->pad_telf_convencional)
                            <a class="float-right">{{$padreapoderado->pad_telf_convencional}}</a>
                          @else
                            <a class="float-right">N/A</a>                              
                          @endif
                        </li>
                        <li class="list-group-item">
                          <b>Fecha de Nacimiento:</b> <a class="float-right">{{$padreapoderado->pad_fec_nac->format('d/m/Y')}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Parentesco:</b>
                          <a class="float-right">{{$padreapoderado->pad_parentesco}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Estado:</b> 
                          @if($padreapoderado->pad_estado == 1)
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
                <a href="/administrador/padreapoderado/index">
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