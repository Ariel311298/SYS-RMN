@extends('backend.app')

@section('title')
Modulo Administrador - Crear Padre o Apoderado
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) - Administrador/a - Crear Padre o Apoderado -->
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Modulo Administrador/a - Crear Padre o Apoderado</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Administrador/a - Crear Padre o Apoderado -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Crear Padre o Apoderado</h3>
              </div>
              <!-- /.card-header -->
              
              <!-- form start -->
                <div class="card-body">
                  
                <form method="POST" action="{{url('administrador/padreapoderado/store')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="alum_id">Nombres y Apellidos del Alumno: *</label>
                    <input type="hidden" 
                    name="alum_id" class="form-control 
                    @error('alum_id') is-invalid @enderror" 
                    value="{{ $alumno->alum_id }}"  
                    required autocomplete="alum_id" 
                    id="alum_id" 
                    placeholder="Seleccione un alumno que no tenga número de cedula para registrar al padre o madre o 
                    apoderado" autofocus>
                    <p>{{$alumno->alum_nombres}} {{$alumno->alum_apellidos}}</p>
                  </div>
                  <div class="form-group">
                    <label for="pad_ncedula">N ° Cedula: *</label>
                    <input type="text" 
                    name="pad_ncedula" class="form-control 
                    @error('pad_ncedula') is-invalid @enderror" 
                    value="{{ old('pad_ncedula') }}"  
                    autocomplete="pad_ncedula" 
                    id="pad_ncedula" 
                    placeholder="Ingrese el número de cedula del padre o la madre o la apoderado." autofocus>
                    @error('pad_ncedula')
                      <span class="invalid-feedback" role="alert">
                          <strong>Debe ingresar minimo 9 números, el maximo es de 10 números, solo puede ingresar números y no se puede ingresar el mismo u otro numero de cedula de un representante.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pad_npasaporte">N ° Pasaporte: (Opcional)</label>
                    <input type="text" 
                    name="pad_npasaporte" class="form-control @error('pad_npasaporte') is-invalid @enderror"
                    value="{{ old('pad_npasaporte') }}"  
                    id="pad_npasaporte" 
                    autocomplete="pad_npasaporte"
                    placeholder="Ingrese el número de pasaporte del padre o la madre o el apoderado. (Opcional)" autofocus>
                    @error('pad_npasaporte')
                      <span class="invalid-feedback" role="alert">
                          <strong>Debe ingresar minimo 9 números, el maximo es de 10 números, solo puede ingresar números y no se puede ingresar el mismo u otro numero de pasaporte de un representante.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pad_nombres">Nombres: *</label>
                    <input type="text" name="pad_nombres" class="form-control 
                    @error('pad_nombres') is-invalid @enderror" 
                    value="{{ old('pad_nombres') }}"  
                    required autocomplete="pad_nombres" id="pad_nombres" 
                    placeholder="Ingrese los nombres del padre o madre o el apoderado del alumno." autofocus>
                    @error('pad_nombres')
                      <span class="invalid-feedback" role="alert">
                          <strong>Debe ingresar minimo 5 letras, el maximo es de 50 letras y solo puede ingresar letras.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pad_apellidos">Apellidos: *</label>
                    <input type="text" name="pad_apellidos" class="form-control
                    @error('pad_apellidos') is-invalid @enderror"
                    value="{{ old('pad_apellidos') }}"  
                    required autocomplete="pad_apellidos" id="pad_apellidos" 
                    placeholder="Ingrese los apellidos del padre o madre o el apoderado del alumno." autofocus>
                    @error('pad_apellidos')
                      <span class="invalid-feedback" role="alert">
                          <strong>Debe ingresar minimo 5 letras, el maximo es de 50 letras y solo puede ingresar letras.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pad_nacionalidad">Nacionalidad: *</label>
                    <select name="pad_nacionalidad" id="pad_nacionalidad" type='text' class="form-control @error('pad_nacionalidad') is-invalid @enderror" value="{{ old('pad_nacionalidad') }}" required autocomplete="pad_nacionalidad">
                      <option selected disabled>Seleccione una nacionalidad</option>
                      <option value="Aleman/a" {{ old('pad_nacionalidad') == 'Aleman/a' ? 'selected':''}}>Aleman/a</option>
                      <option value="Argentino/a" {{ old('pad_nacionalidad') == 'Argentino/a' ? 'selected':''}}>Argentino/a</option>
                      <option value="Austriaco/a" {{ old('pad_nacionalidad') == 'Austriaco/a' ? 'selected':''}}>Austriaco/a</option>
                      <option value="Belgo/a" {{ old('pad_nacionalidad') == 'Belgo/a' ? 'selected':''}}>Belgo/a</option>
                      <option value="Brasileño/a" {{ old('pad_nacionalidad') == 'Brasileño/a' ? 'selected':''}}>Brasileño/a</option>
                      <option value="Canadiense" {{ old('pad_nacionalidad') == 'Canadiense' ? 'selected':''}}>Canadiense</option>
                      <option value="Chileno/a" {{ old('pad_nacionalidad') == 'Chileno/a' ? 'selected':''}}>Chileno/a</option>
                      <option value="Chino/a" {{ old('pad_nacionalidad') == 'Chino/a' ? 'selected':''}}>Chino/a</option>
                      <option value="Costaricense" {{ old('pad_nacionalidad') == 'Costaricense' ? 'selected':''}}>Costaricense</option>
                      <option value="Cubano/a" {{ old('pad_nacionalidad') == 'Cubano/a' ? 'selected':''}}>Cubano/a</option>
                      <option value="Ecuatoriano/a" {{ old('pad_nacionalidad') == 'Ecuatoriano/a' ? 'selected':''}}>Ecuatoriano/a</option>
                      <option value="Español/a" {{ old('pad_nacionalidad') == 'Español/a' ? 'selected':''}}>Español/a</option>
                      <option value="Frances/a" {{ old('pad_nacionalidad') == 'Frances/a' ? 'selected':''}}>Frances/a</option>
                      <option value="Holandes/a" {{ old('pad_nacionalidad') == 'Holandes/a' ? 'selected':''}}>Holandes/a</option>
                      <option value="Hondureño/a" {{ old('pad_nacionalidad') == 'Hondureño/a' ? 'selected':''}}>Hondureño/a</option>
                      <option value="Ingles/a" {{ old('pad_nacionalidad') == 'Ingles/a' ? 'selected':''}}>Ingles/a</option>
                      <option value="Italiano/a" {{ old('pad_nacionalidad') == 'Italiano/a' ? 'selected':''}}>Italiano/a</option>
                      <option value="Israelita" {{ old('pad_nacionalidad') == 'Israelita' ? 'selected':''}}>Israelita</option>
                      <option value="Luxemburguesa" {{ old('pad_nacionalidad') == 'Luxemburguesa' ? 'selected':''}}>Luxemburguesa</option>
                      <option value="Marroquie" {{ old('pad_nacionalidad') == 'Marroquie' ? 'selected':''}}>Marroquie</option>
                      <option value="Mexicano/a" {{ old('pad_nacionalidad') == 'Mexicano/a' ? 'selected':''}}>Mexicano/a</option>
                      <option value="Panameño/a" {{ old('pad_nacionalidad') == 'Panameño/a' ? 'selected':''}}>Panameño/a</option>
                      <option value="Peruano/a" {{ old('pad_nacionalidad') == 'Peruano/a' ? 'selected':''}}>Peruano/a</option>
                      <option value="Polaco/a" {{ old('pad_nacionalidad') == 'Polaco/a' ? 'selected':''}}>Polaco/a</option>
                      <option value="Portugues/a" {{ old('pad_nacionalidad') == 'Portugues/a' ? 'selected':''}}>Portugues/a</option>
                      <option value="Puertoriqueño/a" {{ old('pad_nacionalidad') == 'Puertoriqueño/a' ? 'selected':''}}>Puertoriqueño/a</option>
                      <option value="Dominicano/a" {{ old('pad_nacionalidad') == 'Dominicano/a' ? 'selected':''}}>Dominicano/a</option>
                      <option value="Ruso/a" {{ old('pad_nacionalidad') == 'Ruso/a' ? 'selected':''}}>Ruso/a</option>
                      <option value="Suizo/a" {{ old('pad_nacionalidad') == 'Suizo/a' ? 'selected':''}}>Suizo/a</option>
                      <option value="Uruguayo/a" {{ old('pad_nacionalidad') == 'Uruguayo/a' ? 'selected':''}}>Uruguayo/a</option>
                      <option value="Venezolano/a" {{ old('pad_nacionalidad') == 'Venezolano/a' ? 'selected':''}}>Venezolano/a</option>
                    </select>
                    @error('pad_nacionalidad')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe seleccionar una nacionalidad.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pad_email">Correo Electronico: (Opcional)</label>
                    <input type="text" name="pad_email" class="form-control
                    @error('pad_email') is-invalid @enderror"
                    value="{{ old('pad_email') }}"  
                    id="pad_email"
                    autocomplete="pad_email" 
                    placeholder="Ingrese el correo electronico (Opcional)" autofocus>
                    @error('pad_email')
                      <span class="invalid-feedback" role="alert">
                          <strong>Debe ingresar minimo 5 letras, el maximo es de 255 letras.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pad_ocupacion">Ocupacion: *</label>
                    <input type="text" name="pad_ocupacion" class="form-control
                    @error('pad_ocupacion') is-invalid @enderror"
                    value="{{ old('pad_ocupacion') }}"  
                    id="pad_ocupacion"
                    autocomplete="pad_ocupacion" 
                    placeholder="Ingrese la ocupación del padre o madre o el apoderado del alumno" autofocus>
                    @error('pad_ocupacion')
                      <span class="invalid-feedback" role="alert">
                          <strong>Debe ingresar minimo 5 letras, el maximo es de 50 letras y solo puede ingresar letras.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pad_nivel">Nivel de Instrucción: *</label>
                    <select name="pad_nivel" id="pad_nivel" type='text' class="form-control @error('pad_nivel') is-invalid @enderror" value="{{ old('pad_nivel') }}" required autocomplete="pad_nivel">
                      <option selected disabled>Selecciona un nivel de instrucción</option>
                      <option value="Primaria" {{ old('pad_nivel') == 'Primaria' ? 'selected':''}}>Primaria</option>
                      <option value="Secundaria" {{ old('pad_nivel') == 'Secundaria' ? 'selected':''}}>Secundaria</option>
                      <option value="Bachillerato" {{ old('pad_nivel') == 'Bachillerato' ? 'selected':''}}>Bachillerato</option>
                      <option value="Tercer Nivel" {{ old('pad_nivel') == 'Tercer Nivel' ? 'selected':''}}>Tercer Nivel</option>
                      <option value="Cuarto Nivel" {{ old('pers_nivel') == 'Cuarto Nivel' ? 'selected':''}}>Cuarto Nivel</option>
                    </select>
                    @error('pad_nivel')
                      <span class="invalid-feedback" role="alert">
                          <strong>Debe seleccionar un nivel de instrucción.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pad_direccion">Direccion: *</label>
                    <input type="text" name="pad_direccion" class="form-control
                    @error('pad_direccion') is-invalid @enderror"
                    value="{{ old('pad_direccion') }}"  
                    id="pad_direccion"
                    autocomplete="pad_direccion" 
                    placeholder="Ingrese la direccion del padre o madre o el apoderado donde vive." autofocus>
                    @error('pad_direccion')
                      <span class="invalid-feedback" role="alert">
                          <strong>Debe ingresar minimo 5 caracteres, el maximo es de 255 caracteres.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pad_telf_celular">N ° Telefono Celular: (Opcional)</label>
                    <input type="text" name="pad_telf_celular" class="form-control
                    @error('pad_telf_celular') is-invalid @enderror"
                    value="{{ old('pad_telf_celular') }}"  
                    id="pad_telf_celular"
                    autocomplete="pad_telf_celular" 
                    placeholder="Ingrese el número de telefono celular del padre o madre o apoderado. (Opcional) " autofocus>
                    @error('pad_telf_celular')
                      <span class="invalid-feedback" role="alert">
                          <strong>Debe ingresar minimo 9 números, el maximo es de 10 números y solo puede ingresar números.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pad_telf_convencional">N ° Telefono Convencional: (Opcional)</label>
                    <input type="text" name="pad_telf_convencional" class="form-control
                    @error('pad_telf_convencional') is-invalid @enderror"
                    value="{{ old('pad_telf_convencional') }}"  
                    id="pad_telf_convencional"
                    autocomplete="pad_telf_convencional" 
                    placeholder="Ingrese el número de telefono convencional del padre o madre o apoderado. (Opcional) " autofocus>
                    @error('pad_telf_convencional')
                      <span class="invalid-feedback" role="alert">
                          <strong>Debe ingresar minimo 8 números, el maximo es de 9 números y solo puede ingresar números.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pad_fec_nac">Fecha de Nacimiento: *</label>
                    <input type="date" name="pad_fec_nac" class="form-control
                    @error('pad_fec_nac') is-invalid @enderror" 
                    value="{{ old('pad_fec_nac') }}"  
                    required autocomplete="pad_fec_nac" id="pad_fec_nac" autofocus>
                    @error('pad_fec_nac')
                      <span class="invalid-feedback" role="alert">
                          <strong>Solo se puede seleccionar la fecha anterior al actual.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pad_parentesco">Parentesco: *</label>
                    <select name="pad_parentesco" id="pad_parentesco" type='text' class="form-control @error('pad_parentesco') is-invalid @enderror" value="{{ old('pad_parentesco') }}" required autocomplete="pad_parentesco">
                      <option selected disabled>Seleccione un parentesco</option>
                      <option value="Padre" {{ old('pad_parentesco') == 'Padre' ? 'selected':''}}>Padre</option>
                      <option value="Madre" {{ old('pad_parentesco') == 'Madre' ? 'selected':''}}>Madre</option>
                      <option value="Apoderado" {{ old('pad_parentesco') == 'Apoderado' ? 'selected':''}}>Apoderado</option>
                    </select>
                    @error('pad_parentesco')
                      <span class="invalid-feedback" role="alert">
                          <strong>Debe seleccionar un parentesco.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pad_estado">Estado: *</label>
                    <select name="pad_estado" id="pad_estado" type='text' class="form-control @error('pad_estado') is-invalid @enderror" value="{{ old('pad_estado') }}" required autocomplete="pad_estado">
                      <option selected disabled>Seleccione un estado</option>
                      <option value="1"  {{ old('pad_estado') == '1' ? 'selected':''}}>Activo</option>
                      <option value="0"  {{ old('pad_estado') == '0' ? 'selected':''}}>Inactivo</option>
                    </select>
                    @error('pad_estado')
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
@endsection