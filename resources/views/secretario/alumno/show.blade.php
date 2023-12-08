@extends('backend.app')

@section('title')
Modulo Secretario - Consultar Datos Personales del Alumno
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) - Secretario/a - Consultar Datos Personales del Alumno -->
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Modulo Secretario/a - Consultar Datos Personales del Alumno</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Secretario/a - Consultar Datos Personales del Alumno -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Consultar Datos Personales (Alumno)</h3>
              </div>
              <!-- /.card-header -->
              
              <!-- form start -->
                <div class="card-body">
                    <div class="form-group">
                        <div class="text-center">
                            @if($alumno->alum_foto)
                                <img src="{{ asset('uploads/saved/alumno/'.$alumno->alum_foto) }}" class="profile-user-img img-fluid img-circle" width="70" height="70" align="center">
                            @else
                                <img src="/uploads/logo/alumno.png" class="profile-user-img img-fluid img-circle" width="70" height="70" align="center">
                            @endif
                        </div>
                        <h3 class="profile-username text-center">{{$alumno->alum_nombres}} {{$alumno->alum_apellidos}}</h3>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>N ° Cedula:</b> <a class="float-right">{{$alumno->alum_ncedula}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>N ° Pasaporte:</b> 
                                @if($alumno->alum_npasaporte)
                                    <a class="float-right">{{$alumno->alum_npasaporte}}</a>
                                @else
                                    <a class="float-right">N/A</a>
                                @endif
                            </li>
                            <li class="list-group-item">
                                <b>Fecha de Nacimiento:</b> <a class="float-right">{{$alumno->alum_fec_nac->format('d/m/Y')}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Barrio:</b> 
                                @if($alumno->alum_barrio)
                                    <a class="float-right">{{$alumno->alum_barrio}}</a>
                                @else
                                    <a class="float-right">N/A</a>
                                @endif
                            </li>
                            <li class="list-group-item">
                                <b>Genero:</b> 
                                <a class="float-right">{{$alumno->alum_genero}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Nacionalidad:</b> 
                                <a class="float-right">{{$alumno->alum_nacionalidad}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Etnia:</b> 
                                <a class="float-right">{{$alumno->alum_etnia}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Tipo de Discapacidad:</b> 
                                @if($alumno->alum_dis_tipo)
                                    <a class="float-right">{{$alumno->alum_dis_tipo}}</a>
                                @else
                                    <a class="float-right">N/A</a>
                                @endif                   
                            </li>
                            <li class="list-group-item">
                                <b>% Porcentaje de Discapacidad:</b> 
                                @if($alumno->alum_dis_porcentaje)
                                    <a class="float-right">{{$alumno->alum_dis_porcentaje}}</a>
                                @else
                                    <a class="float-right">N/A</a>
                                @endif                   
                            </li>
                            <li class="list-group-item">
                                <b>N ° Conadis:</b> 
                                @if($alumno->alum_num_car_conadis)
                                    <a class="float-right">{{$alumno->alum_num_car_conadis}}</a>
                                @else
                                    <a class="float-right">N/A</a>
                                @endif                   
                            </li>
                            <li class="list-group-item">
                                <b>Estado:</b> 
                                @if($alumno->alum_estado == 1)
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
                  <a href="/secretario/alumno/index">
                    <button type="button" class="btn btn-danger center-block">
                      Regresar
                      <i class="fas fa-arrow-left"></i>
                    </button>
                  </a>
                  <a href="{{url('secretario/alumno/show/elaboracion-ficha', ['alum_id' => $alumno->alum_id])}}">
                    <button type="button" class="btn btn-primary center-block" title="Elaborar Ficha de Matricula">
                      Elaborar Ficha
                      <i class="fas fa-pen-square"></i>
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