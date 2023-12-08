@extends('backend.app')

@section('title')
Modulo Administrador - Registrar Alumno
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) - Administrador/a - Registrar Alumno -->
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Modulo Administrador/a - Registrar Alumno</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Administrador/a - Registrar Alumno -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Crear Alumno</h3>
              </div>
              <!-- /.card-header -->
              
              <!-- form start -->
                <div class="card-body">
                  
                <form method="POST" action="{{url('administrador/alumno/store')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="alum_ncedula">N ° Cedula: (Opcional)</label>
                    <input type="text" 
                    name="alum_ncedula" class="form-control 
                    @error('alum_ncedula') is-invalid @enderror" 
                    value="{{ old('alum_ncedula') }}"  
                    autocomplete="alum_ncedula" 
                    id="alum_ncedula" 
                    placeholder="Ingrese el número de cedula" autofocus>
                    @error('alum_ncedula')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe ingresar minimo 9 números, el maximo es de 10 números, solo puede ingresar números y no se puede ingresar el mismo u otro numero de cedula de un alumno.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="alum_npasaporte">N ° Pasaporte: (Opcional)</label>
                    <input type="text" 
                    name="alum_npasaporte" class="form-control @error('alum_npasaporte') is-invalid @enderror"
                    value="{{ old('alum_npasaporte') }}"  
                    id="alum_npasaporte" 
                    autocomplete="alum_npasaporte"
                    placeholder="Ingrese el número de pasaporte (Opcional)" autofocus>
                    @error('alum_npasaporte')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe ingresar minimo 9 números, el maximo es de 10 números, solo puede ingresar números y no se puede ingresar el mismo u otro numero de pasaporte de un alumno.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="alum_nombres">Nombres: *</label>
                    <input type="text" name="alum_nombres" class="form-control 
                    @error('alum_nombres') is-invalid @enderror" 
                    value="{{ old('alum_nombres') }}"  
                    required autocomplete="alum_nombres" id="alum_nombres" 
                    placeholder="Ingrese los nombres" autofocus>
                    @error('alum_nombres')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe ingresar minimo 5 letras, el maximo es de 50 letras y solo puede ingresar letras.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="alum_apellidos">Apellidos: *</label>
                    <input type="text" name="alum_apellidos" class="form-control
                    @error('alum_apellidos') is-invalid @enderror"
                    value="{{ old('alum_apellidos') }}"  
                    required autocomplete="alum_apellidos" id="alum_apellidos" 
                    placeholder="Ingrese los apellidos" autofocus>
                    @error('alum_apellidos')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe ingresar minimo 5 letras, el maximo es de 50 letras y solo puede ingresar letras.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="alum_fec_nac">Fecha de Nacimiento: *</label>
                    <input type="date" name="alum_fec_nac" class="form-control
                    @error('alum_fec_nac') is-invalid @enderror" 
                    value="{{ old('alum_fec_nac') }}"  
                    required autocomplete="alum_fec_nac" id="alum_fec_nac" autofocus>
                    @error('alum_fec_nac')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe seleccionar una fecha anterior a hoy.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="alum_barrio">Barrio: (Opcional)</label>
                    <input type="text" name="alum_barrio" class="form-control
                    @error('alum_barrio') is-invalid @enderror"
                    value="{{ old('alum_barrio') }}"  
                    id="alum_barrio" autocomplete="alum_barrio" 
                    placeholder="Ingrese el barrio donde vive el alumno (Opcional)" autofocus>
                    @error('alum_barrio')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe ingresar minimo 5 caracteres, el maximo es de 50 caracteres.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="alum_genero">Genero: *</label>
                    <select name="alum_genero" id="alum_genero" type='text' class="form-control @error('alum_genero') is-invalid @enderror" value="{{ old('alum_genero') }}" required autocomplete="alum_genero">
                      <option selected disabled>Seleccione un genero</option>
                      <option value="Masculino" {{ old('alum_genero') == 'Masculino' ? 'selected':''}}>Masculino</option>
                      <option value="Femenino" {{ old('alum_genero') == 'Femenino' ? 'selected':''}}>Femenino</option>
                    </select>
                    @error('alum_genero')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe seleccionar un genero.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="alum_nacionalidad">Nacionalidad: *</label>
                    <select name="alum_nacionalidad" id="alum_nacionalidad" type='text' class="form-control @error('alum_nacionalidad') is-invalid @enderror" value="{{ old('alum_nacionalidad') }}" required autocomplete="alum_nacionalidad">
                      <option selected disabled>Selecciona una nacionalidad</option>
                      <option value="Aleman/a" {{ old('alum_nacionalidad') == 'Aleman/a' ? 'selected':''}}>Aleman/a</option>
                      <option value="Argentino/a" {{ old('alum_nacionalidad') == 'Argentino/a' ? 'selected':''}}>Argentino/a</option>
                      <option value="Austriaco/a" {{ old('alum_nacionalidad') == 'Austriaco/a' ? 'selected':''}}>Austriaco/a</option>
                      <option value="Belgo/a" {{ old('alum_nacionalidad') == 'Belgo/a' ? 'selected':''}}>Belgo/a</option>
                      <option value="Brasileño/a" {{ old('alum_nacionalidad') == 'Brasileño/a' ? 'selected':''}}>Brasileño/a</option>
                      <option value="Canadiense" {{ old('alum_nacionalidad') == 'Canadiense' ? 'selected':''}}>Canadiense</option>
                      <option value="Chileno/a" {{ old('alum_nacionalidad') == 'Chileno/a' ? 'selected':''}}>Chileno/a</option>
                      <option value="Chino/a" {{ old('alum_nacionalidad') == 'Chino/a' ? 'selected':''}}>Chino/a</option>
                      <option value="Costaricense" {{ old('alum_nacionalidad') == 'Costaricense' ? 'selected':''}}>Costaricense</option>
                      <option value="Cubano/a" {{ old('alum_nacionalidad') == 'Cubano/a' ? 'selected':''}}>Cubano/a</option>
                      <option value="Ecuatoriano/a" {{ old('alum_nacionalidad') == 'Ecuatoriano/a' ? 'selected':''}}>Ecuatoriano/a</option>
                      <option value="Español/a" {{ old('alum_nacionalidad') == 'Español/a' ? 'selected':''}}>Español/a</option>
                      <option value="Frances/a" {{ old('alum_nacionalidad') == 'Frances/a' ? 'selected':''}}>Frances/a</option>
                      <option value="Holandes/a" {{ old('alum_nacionalidad') == 'Holandes/a' ? 'selected':''}}>Holandes/a</option>
                      <option value="Hondureño/a" {{ old('alum_nacionalidad') == 'Hondureño/a' ? 'selected':''}}>Hondureño/a</option>
                      <option value="Ingles/a" {{ old('alum_nacionalidad') == 'Ingles/a' ? 'selected':''}}>Ingles/a</option>
                      <option value="Italiano/a" {{ old('alum_nacionalidad') == 'Italiano/a' ? 'selected':''}}>Italiano/a</option>
                      <option value="Israelita" {{ old('alum_nacionalidad') == 'Israelita' ? 'selected':''}}>Israelita</option>
                      <option value="Luxemburguesa" {{ old('alum_nacionalidad') == 'Luxemburguesa' ? 'selected':''}}>Luxemburguesa</option>
                      <option value="Marroquie" {{ old('alum_nacionalidad') == 'Marroquie' ? 'selected':''}}>Marroquie</option>
                      <option value="Mexicano/a" {{ old('alum_nacionalidad') == 'Mexicano/a' ? 'selected':''}}>Mexicano/a</option>
                      <option value="Panameño/a" {{ old('alum_nacionalidad') == 'Panameño/a' ? 'selected':''}}>Panameño/a</option>
                      <option value="Peruano/a" {{ old('alum_nacionalidad') == 'Peruano/a' ? 'selected':''}}>Peruano/a</option>
                      <option value="Polaco/a" {{ old('alum_nacionalidad') == 'Polaco/a' ? 'selected':''}}>Polaco/a</option>
                      <option value="Portugues/a" {{ old('alum_nacionalidad') == 'Portugues/a' ? 'selected':''}}>Portugues/a</option>
                      <option value="Puertoriqueño/a" {{ old('alum_nacionalidad') == 'Puertoriqueño/a' ? 'selected':''}}>Puertoriqueño/a</option>
                      <option value="Dominicano/a" {{ old('alum_nacionalidad') == 'Dominicano/a' ? 'selected':''}}>Dominicano/a</option>
                      <option value="Ruso/a" {{ old('alum_nacionalidad') == 'Ruso/a' ? 'selected':''}}>Ruso/a</option>
                      <option value="Suizo/a" {{ old('alum_nacionalidad') == 'Suizo/a' ? 'selected':''}}>Suizo/a</option>
                      <option value="Uruguayo/a" {{ old('alum_nacionalidad') == 'Uruguayo/a' ? 'selected':''}}>Uruguayo/a</option>
                      <option value="Venezolano/a" {{ old('alum_nacionalidad') == 'Venezolano/a' ? 'selected':''}}>Venezolano/a</option>
                    </select>
                    @error('alum_nacionalidad')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe seleccionar una nacionalidad.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="alum_etnia">Etnia: *</label>
                    <select name="alum_etnia" id="alum_etnia" type='text' class="form-control @error('alum_etnia') is-invalid @enderror" value="{{ old('alum_etnia') }}" required autocomplete="alum_etnia">
                      <option selected disabled>Selecciona una etnia</option>
                      <option value="Blanco/a" {{ old('alum_etnia') == 'Blanco/a' ? 'selected':''}}>Blanco/a</option>
                      <option value="Mestizo/a" {{ old('alum_etnia') == 'Mestizo/a' ? 'selected':''}}>Mestizo/a</option>
                      <option value="Afroecuatoriano/a" {{ old('alum_etnia') == 'Afroecuatoriano/a' ? 'selected':''}}>Afroecuatoriano/a</option>
                      <option value="Indigena" {{ old('alum_etnia') == 'Indigena' ? 'selected':''}}>Indigena</option>
                      <option value="Montubio/a" {{ old('alum_etnia') == 'Montubio/a' ? 'selected':''}}>Montubio/a</option>
                    </select>
                    @error('alum_etnia')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe seleccionar una etnia.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="alum_dis_tipo">Tipo de Discapacidad: (Opcional)</label>
                    <select name="alum_dis_tipo" id="alum_dis_tipo" type='text' class="form-control @error('alum_dis_tipo') is-invalid @enderror" value="{{ old('alum_dis_tipo') }}" autocomplete="alum_dis_tipo">  
                      <option selected disabled>Seleccione un tipo de discapacidad</option>
                      <option value="Ninguna" {{ old('alum_dis_tipo') == 'Ninguna' ? 'selected':''}}>Ninguna</option>
                      <option value="Fisica Motora" {{ old('alum_dis_tipo') == 'Fisica Motora' ? 'selected':''}}>Fisica Motora</option>
                      <option value="Intelectual" {{ old('alum_dis_tipo') == 'Intelectual' ? 'selected':''}}>Intelectual</option>
                      <option value="Lenguaje" {{ old('alum_dis_tipo') == 'Lenguaje' ? 'selected':''}}>Lenguaje</option>
                      <option value="Mental Psicosocial" {{ old('alum_dis_tipo') == 'Mental Psicosocial' ? 'selected':''}}>Mental Psicosocial</option>
                      <option value="Visual" {{ old('alum_dis_tipo') == 'Visual' ? 'selected':''}}>Visual</option>
                      <option value="Auditiva" {{ old('alum_dis_tipo') == 'Auditiva' ? 'selected':''}}>Auditiva</option>
                      <option value="Otro" {{ old('alum_dis_tipo') == 'Otro' ? 'selected':''}}>Otro</option>
                    </select>
                    @error('alum_dis_tipo')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe seleccionar un tipo de discapacidad.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="alum_dis_porcentaje">% Porcentaje de Discapacidad: (Opcional)</label>
                    <input type="text" name="alum_dis_porcentaje" class="form-control
                    @error('alum_dis_porcentaje') is-invalid @enderror"
                    value="{{ old('alum_dis_porcentaje') }}"  
                    autocomplete="alum_dis_porcentaje"
                    id="alum_dis_porcentaje" autofocus>
                    @error('alum_dis_porcentaje')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe ingresar minimo 1 número, el maximo es de 3 números y solo puede ingresar números.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="alum_num_car_conadis">N ° Conadis: (Opcional)</label>
                    <input type="text" name="alum_num_car_conadis" class="form-control
                    @error('alum_num_car_conadis') is-invalid @enderror"
                    value="{{ old('alum_num_car_conadis') }}"
                    autocomplete="alum_num_car_conadis"  
                    id="alum_num_car_conadis" autofocus>
                    @error('alum_num_car_conadis')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe ingresar minimo 9 numeros, el maximo es de 10 numeros y solo puede ingresar números.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="alum_foto">Foto: (Opcional)</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="alum_foto" id="alum_foto" style="visibility:visible" class="form-control">
                        <input type="hidden" name="hidden_image">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="alum_estado">Estado: *</label>
                    <select name="alum_estado" id="alum_estado" type='text' class="form-control @error('alum_estado') is-invalid @enderror" value="{{ old('alum_estado') }}" required autocomplete="alum_estado">
                      <option selected disabled>Seleccione un estado</option>
                      <option value="1"  {{ old('alum_estado') == '1' ? 'selected':''}}>Activo</option>
                      <option value="0"  {{ old('alum_estado') == '0' ? 'selected':''}}>Inactivo</option>
                    </select>
                    @error('alum_estado')
                      <span class="invalid-feedback" role="alert">
                          <strong>Debe seleccionar el estado.</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">
                    Guardar
                    <i class="fas fa-save"></i>
                  </button>
                  <a href="/administrador/alumno/index">
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
