@extends('backend.app')

@section('title')
Modulo Administrador - Crear Docente
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) - Administrador/a - Crear Docente -->
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Modulo Administrador/a - Crear Docente</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Administrador/a - Crear Docente -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Crear Docente</h3>
              </div>
              <!-- /.card-header -->
              
              <!-- form start -->
                <div class="card-body">
                  
                <form method="POST" action="{{url('administrador/personal/store')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="pers_ncedula">N ° Cedula: *</label>
                    <input type="text" 
                    name="pers_ncedula" class="form-control 
                    @error('pers_ncedula') is-invalid @enderror" 
                    value="{{ old('pers_ncedula') }}"  
                    required autocomplete="pers_ncedula" 
                    id="pers_ncedula" 
                    placeholder="Ingrese el número de cedula" autofocus>
                    @error('pers_ncedula')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe ingresar minimo 9 números, el maximo es de 10 números, solo puede ingresar números y no se puede ingresar el mismo u otro numero de cedula de otro docente.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pers_npasaporte">N ° Pasaporte: (Opcional)</label>
                    <input type="text" 
                    name="pers_npasaporte" class="form-control @error('pers_npasaporte') is-invalid @enderror"
                    value="{{ old('pers_npasaporte') }}"  
                    id="pers_npasaporte" 
                    autocomplete="pers_npasaporte"
                    placeholder="Ingrese el número de pasaporte (Opcional)" autofocus>
                    @error('pers_npasaporte')
                      <span class="invalid-feedback" role="alert">
                          <strong>Debe ingresar minimo 9 números, el maximo es de 10 números, solo puede ingresar números y no se puede ingresar el mismo u otro numero de pasaporte de otro docente.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pers_nombres">Nombres: *</label>
                    <input type="text" name="pers_nombres" class="form-control 
                    @error('pers_nombres') is-invalid @enderror" 
                    value="{{ old('pers_nombres') }}"  
                    required autocomplete="pers_nombres" id="pers_nombres" 
                    placeholder="Ingrese los nombres" autofocus>
                    @error('pers_nombres')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe ingresar minimo 3 letras, el maximo es de 50 letras y solo puede ingresar letras.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pers_apellidos">Apellidos: *</label>
                    <input type="text" name="pers_apellidos" class="form-control
                    @error('pers_apellidos') is-invalid @enderror"
                    value="{{ old('pers_apellidos') }}"  
                    required autocomplete="pers_apellidos" id="pers_apellidos" 
                    placeholder="Ingrese los apellidos" autofocus>
                    @error('pers_apellidos')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe ingresar minimo 3 letras, el maximo es de 50 letras y solo puede ingresar letras.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pers_fec_nac">Fecha de Nacimiento: *</label>
                    <input type="date" name="pers_fec_nac" class="form-control
                    @error('pers_fec_nac') is-invalid @enderror" 
                    value="{{ old('pers_fec_nac') }}"  
                    required autocomplete="pers_fec_nac" id="pers_fec_nac" autofocus>
                    @error('pers_fec_nac')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe seleccionar una fecha anterior a hoy.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pers_telf_convencional">N° de Telefono Convencional: (Opcional)</label>
                    <input type="text" name="pers_telf_convencional" class="form-control
                    @error('pers_telf_convencional') is-invalid @enderror"
                    value="{{ old('pers_telf_convencional') }}"  
                    id="pers_telf_convencional" 
                    autocomplete="pers_telf_convencional"
                    placeholder="Ingrese el número de telefono fijo (Opcional)" autofocus>
                    @error('pers_telf_convencional')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe ingresar minimo 8 números, el maximo es de 9 números y solo puede ingresar números.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pers_num_celular">N° de Telefono Celular: (Opcional)</label>
                    <input type="text" name="pers_num_celular" class="form-control
                    @error('pers_num_celular') is-invalid @enderror"
                    value="{{ old('pers_num_celular') }}"  
                    id="pers_num_celular" 
                    autocomplete="pers_num_celular"
                    placeholder="Ingrese el número de telefono celular (Opcional)" autofocus>
                    @error('pers_num_celular')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe ingresar minimo 9 números, el maximo es de 10 números y solo puede ingresar números.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pers_barrio">Barrio: (Opcional)</label>
                    <input type="text" name="pers_barrio" class="form-control
                    @error('pers_barrio') is-invalid @enderror"
                    value="{{ old('pers_barrio') }}"  
                    id="pers_barrio" autocomplete="pers_barrio" 
                    placeholder="Ingrese el barrio donde vive la persona (Opcional)" autofocus>
                    @error('pers_barrio')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe ingresar minimo 5 caracteres, el maximo es de 50 caracteres.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pers_direccion">Direccion: *</label>
                    <input type="text" name="pers_direccion" class="form-control
                    @error('pers_direccion') is-invalid @enderror"
                    value="{{ old('pers_direccion') }}"  
                    required autocomplete="pers_direccion" id="pers_direccion" 
                    placeholder="Ingrese la direccion donde vive la persona" autofocus>
                    @error('pers_direccion')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe ingresar minimo 5 caracteres, el maximo es de 255 caracteres.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pers_nacionalidad">Nacionalidad: *</label>
                    <select name="pers_nacionalidad" id="pers_nacionalidad" type='text' class="form-control  @error('pers_nacionalidad') is-invalid @enderror" value="{{ old('pers_nacionalidad') }}" required autocomplete="pers_nacionalidad">
                      <option selected disabled>Seleccione una nacionalidad</option>
                      <option value="Aleman/a" {{ old('pers_nacionalidad') == 'Aleman/a' ? 'selected':''}}>Aleman/a</option>
                      <option value="Argentino/a" {{ old('pers_nacionalidad') == 'Argentino/a' ? 'selected':''}}>Argentino/a</option>
                      <option value="Austriaco/a" {{ old('pers_nacionalidad') == 'Austriaco/a' ? 'selected':''}}>Austriaco/a</option>
                      <option value="Belgo/a" {{ old('pers_nacionalidad') == 'Belgo/a' ? 'selected':''}}>Belgo/a</option>
                      <option value="Brasileño/a" {{ old('pers_nacionalidad') == 'Brasileño/a' ? 'selected':''}}>Brasileño/a</option>
                      <option value="Canadiense" {{ old('pers_nacionalidad') == 'Canadiense' ? 'selected':''}}>Canadiense</option>
                      <option value="Chileno/a" {{ old('pers_nacionalidad') == 'Chileno/a' ? 'selected':''}}>Chileno/a</option>
                      <option value="Chino/a" {{ old('pers_nacionalidad') == 'Chino/a' ? 'selected':''}}>Chino/a</option>
                      <option value="Costaricense" {{ old('pers_nacionalidad') == 'Costaricense' ? 'selected':''}}>Costaricense</option>
                      <option value="Cubano/a" {{ old('pers_nacionalidad') == 'Cubano/a' ? 'selected':''}}>Cubano/a</option>
                      <option value="Ecuatoriano/a" {{ old('pers_nacionalidad') == 'Ecuatoriano/a' ? 'selected':''}}>Ecuatoriano/a</option>
                      <option value="Español/a" {{ old('pers_nacionalidad') == 'Español/a' ? 'selected':''}}>Español/a</option>
                      <option value="Frances/a" {{ old('pers_nacionalidad') == 'Frances/a' ? 'selected':''}}>Frances/a</option>
                      <option value="Holandes/a" {{ old('pers_nacionalidad') == 'Holandes/a' ? 'selected':''}}>Holandes/a</option>
                      <option value="Hondureño/a" {{ old('pers_nacionalidad') == 'Hondureño/a' ? 'selected':''}}>Hondureño/a</option>
                      <option value="Ingles/a" {{ old('pers_nacionalidad') == 'Ingles/a' ? 'selected':''}}>Ingles/a</option>
                      <option value="Italiano/a" {{ old('pers_nacionalidad') == 'Italiano/a' ? 'selected':''}}>Italiano/a</option>
                      <option value="Israelita" {{ old('pers_nacionalidad') == 'Israelita' ? 'selected':''}}>Israelita</option>
                      <option value="Luxemburguesa" {{ old('pers_nacionalidad') == 'Luxemburguesa' ? 'selected':''}}>Luxemburguesa</option>
                      <option value="Marroquie" {{ old('pers_nacionalidad') == 'Marroquie' ? 'selected':''}}>Marroquie</option>
                      <option value="Mexicano/a" {{ old('pers_nacionalidad') == 'Mexicano/a' ? 'selected':''}}>Mexicano/a</option>
                      <option value="Panameño/a" {{ old('pers_nacionalidad') == 'Panameño/a' ? 'selected':''}}>Panameño/a</option>
                      <option value="Peruano/a" {{ old('pers_nacionalidad') == 'Peruano/a' ? 'selected':''}}>Peruano/a</option>
                      <option value="Polaco/a" {{ old('pers_nacionalidad') == 'Polaco/a' ? 'selected':''}}>Polaco/a</option>
                      <option value="Portugues/a" {{ old('pers_nacionalidad') == 'Portugues/a' ? 'selected':''}}>Portugues/a</option>
                      <option value="Puertoriqueño/a" {{ old('pers_nacionalidad') == 'Puertoriqueño/a' ? 'selected':''}}>Puertoriqueño/a</option>
                      <option value="Dominicano/a" {{ old('pers_nacionalidad') == 'Dominicano/a' ? 'selected':''}}>Dominicano/a</option>
                      <option value="Ruso/a" {{ old('pers_nacionalidad') == 'Ruso/a' ? 'selected':''}}>Ruso/a</option>
                      <option value="Suizo/a" {{ old('pers_nacionalidad') == 'Suizo/a' ? 'selected':''}}>Suizo/a</option>
                      <option value="Uruguayo/a" {{ old('pers_nacionalidad') == 'Uruguayo/a' ? 'selected':''}}>Uruguayo/a</option>
                      <option value="Venezolano/a" {{ old('pers_nacionalidad') == 'Venezolano/a' ? 'selected':''}}>Venezolano/a</option>
                    </select>
                    @error('pers_nacionalidad')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe seleccinnar una nacionalidad.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pers_genero">Genero: *</label>
                    <select name="pers_genero" id="pers_genero" type='text' class="form-control  @error('pers_genero') is-invalid @enderror" value="{{ old('pers_genero') }}" required autocomplete="pers_genero">
                      <option selected disabled>Seleccione un genero</option>
                      <option value="Masculino" {{ old('pers_genero') == 'Masculino' ? 'selected':''}}>Masculino</option>
                      <option value="Femenino" {{ old('pers_genero') == 'Femenino' ? 'selected':''}}>Femenino</option>
                    </select>
                    @error('pers_genero')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe seleccinnar un genero.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pers_etnia">Etnia: *</label>
                    <select name="pers_etnia" id="pers_etnia" type='text' class="form-control  @error('pers_etnia') is-invalid @enderror" value="{{ old('pers_etnia') }}" required autocomplete="pers_etnia">
                      <option selected disabled>Seleccione una etnia</option>
                      <option value="Blanco/a" {{ old('pers_etnia') == 'Blanco/a' ? 'selected':''}}>Blanco/a</option>
                      <option value="Mestizo/a" {{ old('pers_etnia') == 'Mestizo/a' ? 'selected':''}}>Mestizo/a</option>
                      <option value="Afroecuatoriano/a" {{ old('pers_etnia') == 'Afroecuatoriano/a' ? 'selected':''}}>Afroecuatoriano/a</option>
                      <option value="Indigena" {{ old('pers_etnia') == 'Indigena' ? 'selected':''}}>Indigena</option>
                      <option value="Montubio/a" {{ old('pers_etnia') == 'Montubio/a' ? 'selected':''}}>Montubio/a</option>
                    </select>
                    @error('pers_etnia')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe seleccinnar una etnia.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pers_email_inst">Correo Institucional: (Opcional)</label>
                    <input type="text" name="pers_email_inst" class="form-control
                    @error('pers_email_inst') is-invalid @enderror"
                    value="{{ old('pers_email_inst') }}"  
                    id="pers_email_inst"
                    autocomplete="pers_email_inst" 
                    placeholder="Ingrese el correo institucional (Opcional)" autofocus>
                    @error('pers_email_inst')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe ingresar minimo 5 caracteres, el maximo es de 255 caracteres, también se debe incluir el @ en el ingreso de direccion de correo electronico.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pers_tip_sangre">Tipo de Sangre: (Opcional)</label>
                    <input type="text" name="pers_tip_sangre" class="form-control
                    @error('pers_tip_sangre') is-invalid @enderror"
                    value="{{ old('pers_tip_sangre') }}"  
                    id="pers_tip_sangre"
                    autocomplete="pers_tip_sangre" 
                    placeholder="Ingrese el tipo de sangre (Opcional)" autofocus>
                    @error('pers_tip_sangre')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe ingresar minimo 3 caracteres y el maximo es de 5 caracteres. No puede ingresar números.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pers_dis_tipo">Tipo de Discapacidad: (Opcional)</label>
                    <select name="pers_dis_tipo" id="pers_dis_tipo" type='text' class="form-control  @error('pers_dis_tipo') is-invalid @enderror" value="{{ old('pers_dis_tipo') }}" autocomplete="pers_dis_tipo">
                      <option selected disabled>Seleccione un tipo de discapacidad</option>
                      <option value="Ninguna" {{ old('pers_dis_tipo') == 'Ninguna' ? 'selected':''}}>Ninguna</option>
                      <option value="Fisica Motora" {{ old('pers_dis_tipo') == 'Fisica Motora' ? 'selected':''}}>Fisica Motora</option>
                      <option value="Intelectual" {{ old('pers_dis_tipo') == 'Intelectual' ? 'selected':''}}>Intelectual</option>
                      <option value="Lenguaje" {{ old('pers_dis_tipo') == 'Lenguaje' ? 'selected':''}}>Lenguaje</option>
                      <option value="Mental Psicosocial" {{ old('pers_dis_tipo') == 'Mental Psicosocial' ? 'selected':''}}>Mental Psicosocial</option>
                      <option value="Visual" {{ old('pers_dis_tipo') == 'Visual' ? 'selected':''}}>Visual</option>
                      <option value="Auditiva" {{ old('pers_dis_tipo') == 'Auditiva' ? 'selected':''}}>Auditiva</option>
                      <option value="Otro" {{ old('pers_dis_tipo') == 'Otro' ? 'selected':''}}>Otro</option>
                    </select>
                    @error('pers_dis_tipo')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe seleccionar un tipo de discapacidad.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pers_dis_porcentaje">% Porcentaje de Discapacidad: (Opcional)</label>
                    <input type="text" name="pers_dis_porcentaje" class="form-control
                    @error('pers_dis_porcentaje') is-invalid @enderror"
                    value="{{ old('pers_dis_porcentaje') }}"  
                    autocomplete="pers_dis_porcentaje"
                    id="pers_dis_porcentaje" autofocus>
                    @error('pers_dis_porcentaje')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe ingresar minimo 1 número y el maximo es de 3 números. Solo puede ingresar números.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pers_num_car_conadis">N ° Carnet de Conadis: (Opcional)</label>
                    <input type="text" name="pers_num_car_conadis" class="form-control
                    @error('pers_num_car_conadis') is-invalid @enderror"
                    value="{{ old('pers_num_car_conadis') }}"
                    autocomplete="pers_num_car_conadis"  
                    id="pers_num_car_conadis" autofocus>
                    @error('pers_num_car_conadis')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe ingresar minimo 9 números y el maximo es de 10 números.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pers_est_civil">Estado Civil: *</label>
                    <select name="pers_est_civil" id="pers_est_civil" type='text' class="form-control @error('pers_est_civil') is-invalid @enderror" value="{{ old('pers_est_civil') }}" required autocomplete="pers_est_civil">
                      <option selected disabled>Seleccione un estado civil</option>
                      <option value="Soltero/a" {{ old('pers_est_civil') == 'Soltero/a' ? 'selected':''}}>Soltero/a</option>
                      <option value="Casado/a" {{ old('pers_est_civil') == 'Casado/a' ? 'selected':''}}>Casado/a</option>
                      <option value="Divorciado/a" {{ old('pers_est_civil') == 'Divorciado/a' ? 'selected':''}}>Divorciado/a</option>
                      <option value="Vuido/a" {{ old('pers_est_civil') == 'Vuido/a' ? 'selected':''}}>Vuido/a</option>
                      <option value="Union Libre" {{ old('pers_est_civil') == 'Union Libre' ? 'selected':''}}>Union Libre</option>
                    </select>
                    @error('pers_est_civil')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe seleccionar un estado civil.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pers_nivel">Nivel de Instrucción: *</label>
                    <select name="pers_nivel" id="pers_nivel" type='text' class="form-control  @error('pers_nivel') is-invalid @enderror" value="{{ old('pers_nivel') }}" required autocomplete="pers_nivel">
                      <option selected disabled>Seleccione el nivel de instrucción</option>
                      <option value="Primaria" {{ old('pers_nivel') == 'Primaria' ? 'selected':''}}>Primaria</option>
                      <option value="Secundaria" {{ old('pers_nivel') == 'Secundaria' ? 'selected':''}}>Secundaria</option>
                      <option value="Bachillerato" {{ old('pers_nivel') == 'Bachillerato' ? 'selected':''}}>Bachillerato</option>
                      <option value="Tercer Nivel" {{ old('pers_nivel') == 'Tercer Nivel' ? 'selected':''}}>Tercer Nivel</option>
                      <option value="Cuarto Nivel" {{ old('pers_nivel') == 'Cuarto Nivel' ? 'selected':''}}>Cuarto Nivel</option>
                    </select>
                    @error('pers_nivel')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe seleccionar un nivel de instrucción.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pers_foto">Foto: (Opcional)</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="pers_foto" id="pers_foto" style="visibility:visible" class="form-control">
                        <input type="hidden" name="hidden_image">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="pers_estado">Estado: *</label>
                    <select name="pers_estado" id="pers_estado" type='text' class="form-control @error('pers_estado') is-invalid @enderror" value="{{ old('pers_estado') }}" required autocomplete="pers_estado">
                      <option selected disabled>Seleccione un estado</option>
                      <option value="1" {{ old('pers_estado') == '1' ? 'selected':''}}>Activo</option>
                      <option value="0" {{ old('pers_estado') == '0' ? 'selected':''}}>Inactivo</option>
                    </select>
                    @error('pers_estado')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe seleccionar un estado.</strong>
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
                  <a href="/administrador/personal/index">
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
