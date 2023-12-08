@extends('backend.app')

@section('title')
Modulo Secretario - Consultar Datos Personales
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) - Secretario/a - Consultar Datos Personales -->
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Modulo Secretario/a - Consultar Datos Personales</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Secretario/a - Consultar Datos Personales -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Consultar Datos Personales</h3>
              </div>
              <!-- /.card-header -->
              
              <!-- form start -->
                <div class="card-body">
                    <div class="form-group">
                        <div class="text-center">
                            @if($personal->pers_foto)
                                <img src="{{ asset('uploads/saved/personal/'.$personal->pers_foto) }}" class="profile-user-img img-fluid img-circle" width="70" height="70" align="center">
                            @else
                                <img src="/uploads/logo/teacher.png" class="profile-user-img img-fluid img-circle" width="70" height="70" align="center">
                            @endif
                        </div>
                        <h3 class="profile-username text-center">{{$personal->pers_nombres}} {{$personal->pers_apellidos}}</h3>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>N ° Cedula:</b> <a class="float-right">{{$personal->pers_ncedula}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>N ° Pasaporte:</b> 
                                @if($personal->pers_npasaporte)
                                    <a class="float-right">{{$personal->pers_npasaporte}}</a>
                                @else
                                    <a class="float-right">N/A</a>
                                @endif
                            </li>
                            <li class="list-group-item">
                                <b>Fecha de Nacimiento:</b> <a class="float-right">{{$personal->pers_fec_nac->format('d/m/Y')}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>N ° Telefono Convencional:</b> 
                                @if($personal->pers_telf_convencional)
                                    <a class="float-right">{{$personal->pers_telf_convencional}}</a>
                                @else
                                    <a class="float-right">N/A</a>
                                @endif
                            </li>
                            <li class="list-group-item">
                                <b>N ° Telefono Celular:</b> 
                                @if($personal->pers_num_celular)
                                    <a class="float-right">{{$personal->pers_num_celular}}</a>
                                @else
                                    <a class="float-right">N/A</a>
                                @endif
                            </li>
                            <li class="list-group-item">
                                <b>Barrio:</b> 
                                @if($personal->pers_barrio)
                                    <a class="float-right">{{$personal->pers_barrio}}</a>
                                @else
                                    <a class="float-right">N/A</a>
                                @endif
                            </li>
                            <li class="list-group-item">
                                <b>Direccion:</b> 
                                <a class="float-right">{{$personal->pers_direccion}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Nacionalidad:</b> 
                                <a class="float-right">{{$personal->pers_nacionalidad}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Genero:</b> 
                                <a class="float-right">{{$personal->pers_genero}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Etnia:</b> 
                                <a class="float-right">{{$personal->pers_etnia}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Correo Institucional:</b> 
                                @if($personal->pers_email_inst)
                                    <a class="float-right">{{$personal->pers_email_inst}}</a>
                                @else
                                    <a class="float-right">N/A</a>
                                @endif                   
                            </li>
                            <li class="list-group-item">
                                <b>Tipo de Sangre:</b> 
                                @if($personal->pers_tip_sangre)
                                    <a class="float-right">{{$personal->pers_tip_sangre}}</a>
                                @else
                                    <a class="float-right">N/A</a>
                                @endif                   
                            </li>
                            <li class="list-group-item">
                                <b>Tipo de Discapacidad:</b> 
                                @if($personal->pers_dis_tipo)
                                    <a class="float-right">{{$personal->pers_dis_tipo}}</a>
                                @else
                                    <a class="float-right">N/A</a>
                                @endif                   
                            </li>
                            <li class="list-group-item">
                                <b>% Porcentaje de Discapacidad:</b> 
                                @if($personal->pers_dis_porcentaje)
                                    <a class="float-right">{{$personal->pers_dis_porcentaje}}</a>
                                @else
                                    <a class="float-right">N/A</a>
                                @endif                   
                            </li>
                            <li class="list-group-item">
                                <b>N ° Conadis:</b> 
                                @if($personal->pers_num_car_conadis)
                                    <a class="float-right">{{$personal->pers_num_car_conadis}}</a>
                                @else
                                    <a class="float-right">N/A</a>
                                @endif                   
                            </li>
                            <li class="list-group-item">
                                <b>Estado Civil:</b> 
                                <a class="float-right">{{$personal->pers_est_civil}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Nivel:</b> 
                                <a class="float-right">{{$personal->pers_nivel}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Estado:</b> 
                                @if($personal->pers_estado == 1)
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
                  <a href="/secretario/personal/index">
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