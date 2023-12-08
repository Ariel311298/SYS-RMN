@extends('backend.app')

@section('title')
Modulo Alumno - Editar Datos Personales
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) - Alumno - Editar Datos Personales -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Modulo Alumno - Editar Datos Personales</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Alumno - Editar Datos Personales -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Editar Datos Personales - Alumno</h3>
              </div>
              <!-- /.card-header -->
              
              <!-- form start -->
                <div class="card-body">
                                  
                <form method="POST" action="{{url('alumno/editar-datos-personales/update')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <input name ="alum_id" type="hidden" value ="{{old('alum_id', $alumno->alum_id)}}">
                    <label for="alum_ncedula">N ° Cedula: (Opcional)</label>
                    <input type="text" 
                    name="alum_ncedula" class="form-control 
                    @error('alum_ncedula') is-invalid @enderror" 
                    value="{{$alumno->alum_ncedula}}"  
                    autocomplete="alum_ncedula" 
                    id="alum_ncedula"  placeholder="Ingrese el número de cedula" autofocus>
                    @error('alum_ncedula')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe ingresar minimo 9 números, el maximo es de 10 números, solo puede ingresar números.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <input name ="alum_id" type="hidden" value ="{{old('alum_id', $alumno->alum_id)}}">
                    <label for="alum_npasaporte">N ° Pasaporte: (Opcional)</label>
                    <input type="text" 
                    name="alum_npasaporte" class="form-control @error('alum_npasaporte') is-invalid @enderror"
                    value="{{$alumno->alum_npasaporte}}"  
                    id="alum_npasaporte" 
                    autocomplete="alum_npasaporte"
                    placeholder="Ingrese el número de pasaporte (Opcional)" autofocus>
                    @error('alum_npasaporte')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe ingresar minimo 9 números, el maximo es de 10 números, solo puede ingresar números.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <input name ="alum_id" type="hidden" value ="{{old('alum_id', $alumno->alum_id)}}">
                    <label for="alum_nombres">Nombres: *</label>
                    <input type="text" name="alum_nombres" class="form-control 
                    @error('alum_nombres') is-invalid @enderror" 
                    value="{{$alumno->alum_nombres}}"  
                    required autocomplete="alum_nombres" id="alum_nombres" 
                    placeholder="Ingrese los nombres" autofocus>
                    @error('alum_nombres')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe ingresar minimo 5 letras, el maximo es de 50 letras y solo puede ingresar letras.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <input name ="alum_id" type="hidden" value ="{{old('alum_id', $alumno->alum_id)}}">
                    <label for="alum_apellidos">Apellidos: *</label>
                    <input type="text" name="alum_apellidos" class="form-control
                    @error('alum_apellidos') is-invalid @enderror"
                    value="{{$alumno->alum_apellidos}}"  
                    required autocomplete="alum_apellidos" id="alum_apellidos" 
                    placeholder="Ingrese los apellidos" autofocus>
                    @error('alum_apellidos')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe ingresar minimo 5 letras, el maximo es de 50 letras y solo puede ingresar letras.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <input name ="alum_id" type="hidden" value ="{{old('alum_id', $alumno->alum_id)}}">
                    <label for="alum_fec_nac">Fecha de Nacimiento: *</label>
                    <input type="date" name="alum_fec_nac" class="form-control
                    @error('alum_fec_nac') is-invalid @enderror" 
                    value="{{$alumno->alum_fec_nac->toDateString()}}"  
                    required autocomplete="alum_fec_nac" id="alum_fec_nac" autofocus>
                    @error('alum_fec_nac')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe seleccionar una fecha anterior a hoy.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                  <input name ="alum_id" type="hidden" value ="{{old('alum_id', $alumno->alum_id)}}">
                    <label for="alum_barrio">Barrio: (Opcional)</label>
                    <input type="text" name="alum_barrio" class="form-control
                    @error('alum_barrio') is-invalid @enderror"
                    value="{{$alumno->alum_barrio}}"  
                    id="alum_barrio" autocomplete="alum_barrio" 
                    placeholder="Ingrese el barrio donde vive la alumno (Opcional)" autofocus>
                    @error('alum_barrio')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe ingresar minimo 5 caracteres, el maximo es de 50 caracteres.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <input name ="alum_id" type="hidden" value ="{{old('alum_id', $alumno->alum_id)}}">
                    <label for="alum_genero">Genero: *</label>
                    <select name="alum_genero" id="alum_genero" type='text' class="form-control  @error('alum_genero') is-invalid @enderror" value="{{$alumno->alum_genero}}" required autocomplete="alum_genero">
                      <option value="Masculino" {{$alumno->alum_genero == 'Masculino' ? 'selected':''}}>Masculino</option>
                      <option value="Femenino" {{$alumno->alum_genero == 'Femenino' ? 'selected':''}}>Femenino</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <input name ="alum_id" type="hidden" value ="{{old('alum_id', $alumno->alum_id)}}">
                    <label for="alum_nacionalidad">Nacionalidad: *</label>
                    <select name="alum_nacionalidad" id="alum_nacionalidad" type='text' class="form-control  @error('alum_nacionalidad') is-invalid @enderror" value="{{$alumno->alum_nacionalidad}}" required autocomplete="alum_nacionalidad">
                      <option value="Aleman/a" {{$alumno->alum_nacionalidad == 'Aleman/a' ? 'selected':''}}>Aleman/a</option>
                      <option value="Argentino/a" {{$alumno->alum_nacionalidad == 'Argentino/a' ? 'selected':''}}>Argentino/a</option>
                      <option value="Austriaco/a" {{$alumno->alum_nacionalidad == 'Austriaco/a' ? 'selected':''}}>Austriaco/a</option>
                      <option value="Belgo/a" {{$alumno->alum_nacionalidad == 'Belgo/a' ? 'selected':''}}>Belgo/a</option>
                      <option value="Brasileño/a" {{$alumno->alum_nacionalidad == 'Brasileño/a' ? 'selected':''}}>Brasileño/a</option>
                      <option value="Canadiense" {{$alumno->alum_nacionalidad == 'Canadiense' ? 'selected':''}}>Canadiense</option>
                      <option value="Chileno/a" {{$alumno->alum_nacionalidad == 'Chileno/a' ? 'selected':''}}>Chileno/a</option>
                      <option value="Chino/a" {{$alumno->alum_nacionalidad == 'Chino/a' ? 'selected':''}}>Chino/a</option>
                      <option value="Costaricense" {{$alumno->alum_nacionalidad == 'Costaricense' ? 'selected':''}}>Costaricense</option>
                      <option value="Cubano/a" {{$alumno->alum_nacionalidad == 'Cubano/a' ? 'selected':''}}>Cubano/a</option>
                      <option value="Ecuatoriano/a" {{$alumno->alum_nacionalidad == 'Ecuatoriano/a' ? 'selected':''}}>Ecuatoriano/a</option>
                      <option value="Español/a" {{$alumno->alum_nacionalidad == 'Español/a' ? 'selected':''}}>Español/a</option>
                      <option value="Frances/a" {{$alumno->alum_nacionalidad == 'Frances/a' ? 'selected':''}}>Frances/a</option>
                      <option value="Holandes/a" {{$alumno->alum_nacionalidad == 'Holandes/a' ? 'selected':''}}>Holandes/a</option>
                      <option value="Hondureño/a" {{$alumno->alum_nacionalidad == 'Hondureño/a' ? 'selected':''}}>Hondureño/a</option>
                      <option value="Ingles/a" {{$alumno->alum_nacionalidad == 'Ingles/a' ? 'selected':''}}>Ingles/a</option>
                      <option value="Italiano/a" {{$alumno->alum_nacionalidad == 'Italiano/a' ? 'selected':''}}>Italiano/a</option>
                      <option value="Israelita" {{$alumno->alum_nacionalidad == 'Israelita' ? 'selected':''}}>Israelita</option>
                      <option value="Luxemburguesa" {{$alumno->alum_nacionalidad == 'Luxemburguesa' ? 'selected':''}}>Luxemburguesa</option>
                      <option value="Marroquie" {{$alumno->alum_nacionalidad == 'Marroquie' ? 'selected':''}}>Marroquie</option>
                      <option value="Mexicano/a" {{$alumno->alum_nacionalidad == 'Mexicano/a' ? 'selected':''}}>Mexicano/a</option>
                      <option value="Panameño/a" {{$alumno->alum_nacionalidad == 'Panameño/a' ? 'selected':''}}>Panameño/a</option>
                      <option value="Peruano/a" {{$alumno->alum_nacionalidad == 'Peruano/a' ? 'selected':''}}>Peruano/a</option>
                      <option value="Polaco/a" {{$alumno->alum_nacionalidad == 'Polaco/a' ? 'selected':''}}>Polaco/a</option>
                      <option value="Portugues/a" {{$alumno->alum_nacionalidad == 'Portugues/a' ? 'selected':''}}>Portugues/a</option>
                      <option value="Puertoriqueño/a" {{$alumno->alum_nacionalidad == 'Puertoriqueño/a' ? 'selected':''}}>Puertoriqueño/a</option>
                      <option value="Dominicano/a" {{$alumno->alum_nacionalidad == 'Dominicano/a' ? 'selected':''}}>Dominicano/a</option>
                      <option value="Ruso/a" {{$alumno->alum_nacionalidad == 'Ruso/a' ? 'selected':''}}>Ruso/a</option>
                      <option value="Suizo/a" {{$alumno->alum_nacionalidad == 'Suizo/a' ? 'selected':''}}>Suizo/a</option>
                      <option value="Uruguayo/a" {{$alumno->alum_nacionalidad == 'Uruguayo/a' ? 'selected':''}}>Uruguayo/a</option>
                      <option value="Venezolano/a" {{$alumno->alum_nacionalidad == 'Venezolano/a' ? 'selected':''}}>Venezolano/a</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <input name ="alum_id" type="hidden" value ="{{old('alum_id', $alumno->alum_id)}}">
                    <label for="alum_etnia">Etnia: *</label>
                    <select name="alum_etnia" id="alum_etnia" type='text' class="form-control  @error('alum_etnia') is-invalid @enderror" value="{{$alumno->alum_etnia}}" required autocomplete="alum_etnia">
                      <option value="Blanco/a" {{$alumno->alum_etnia == 'Blanco/a' ? 'selected':''}}>Blanco/a</option>
                      <option value="Mestizo/a" {{$alumno->alum_etnia == 'Mestizo/a' ? 'selected':''}}>Mestizo/a</option>
                      <option value="Afroecuatoriano/a" {{$alumno->alum_etnia == 'Afroecuatoriano/a' ? 'selected':''}}>Afroecuatoriano/a</option>
                      <option value="Indigena" {{$alumno->alum_etnia == 'Indigena' ? 'selected':''}}>Indigena</option>
                      <option value="Montubio/a" {{$alumno->alum_etnia == 'Montubio/a' ? 'selected':''}}>Montubio/a</option>
                    </select>
                  </div>
                  <div class="form-group">
                  <input name ="alum_id" type="hidden" value ="{{old('alum_id', $alumno->alum_id)}}">
                    <label for="alum_dis_tipo">Tipo de Discapacidad: (Opcional)</label>
                    <select name="alum_dis_tipo" id="alum_dis_tipo" type='text' class="form-control  @error('alum_dis_tipo') is-invalid @enderror" value="{{$alumno->alum_dis_tipo}}" autocomplete="alum_dis_tipo">
                      <option value="Ninguna" {{$alumno->alum_dis_tipo == 'Ninguna' ? 'selected':''}}>Ninguna</option>
                      <option value="Fisica Motora" {{$alumno->alum_dis_tipo == 'Fisica Motora' ? 'selected':''}}>Fisica Motora</option>
                      <option value="Intelectual" {{$alumno->alum_dis_tipo == 'Intelectual' ? 'selected':''}}>Intelectual</option>
                      <option value="Lenguaje" {{$alumno->alum_dis_tipo == 'Lenguaje' ? 'selected':''}}>Lenguaje</option>
                      <option value="Mental Psicosocial" {{$alumno->alum_dis_tipo == 'Mental Psicosocial' ? 'selected':''}}>Mental Psicosocial</option>
                      <option value="Visual" {{$alumno->alum_dis_tipo == 'Visual' ? 'selected':''}}>Visual</option>
                      <option value="Auditiva" {{$alumno->alum_dis_tipo == 'Auditiva' ? 'selected':''}}>Auditiva</option>
                      <option value="Otro" {{$alumno->alum_dis_tipo == 'Otro' ? 'selected':''}}>Otro</option>
                    </select>
                  </div>
                  <div class="form-group">
                  <input name ="alum_id" type="hidden" value ="{{old('alum_id', $alumno->alum_id)}}">
                    <label for="alum_dis_porcentaje">% Porcentaje de Discapacidad: (Opcional)</label>
                    <input type="text" name="alum_dis_porcentaje" class="form-control
                    @error('alum_dis_porcentaje') is-invalid @enderror"
                    value="{{$alumno->alum_dis_porcentaje}}"  
                    autocomplete="alum_dis_porcentaje"
                    id="alum_dis_porcentaje" autofocus>
                    @error('alum_dis_porcentaje')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe ingresar minimo 1 número, el maximo es de 3 números y solo puede ingresar números.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <input name ="alum_id" type="hidden" value ="{{old('alum_id', $alumno->alum_id)}}">
                    <label for="alum_num_car_conadis">N ° Conadis: (Opcional)</label>
                    <input type="text" name="alum_num_car_conadis" class="form-control
                    @error('alum_num_car_conadis') is-invalid @enderror"
                    value="{{$alumno->alum_num_car_conadis}}"
                    autocomplete="alum_num_car_conadis"  
                    id="alum_num_car_conadis" autofocus>
                    @error('alum_num_car_conadis')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe ingresar minimo 9 numeros, el maximo es de 10 numeros, solo puede ingresar números.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <input name ="alum_id" type="hidden" value ="{{old('alum_id', $alumno->alum_id)}}">
                    <label for="alum_foto">Foto: (Opcional)</label>
                    <div class="input-group">                      
                      <div class="custom-file">  
                          <input type="file" name="alum_foto" id="alum_foto" style="visibility:visible" class="form-control">
                          <img src="{{ asset('uploads/saved/alumno/'.$alumno->alum_foto) }}" width="70" height="70"/>  
                          <input type="hidden" name="hidden_image" value="{{$alumno->alum_foto}}">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">
                    Actualizar
                    <i class="fas fa-edit"></i>
                  </button>
                  <a href="/alumno/dashboard">
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

@section('js')
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