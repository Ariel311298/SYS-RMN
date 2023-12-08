@extends('backend.app')

@section('title')
Modulo Administrador - Crear Usuario (Alumno)
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) - Administrador/a - Crear Usuario (Alumno) -->
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Modulo Administrador/a - Crear Usuario (Alumno)</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Administrador/a - Crear Usuario (Alumno) -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Crear Usuario (Alumno)</h3>
              </div>
              <!-- /.card-header -->
              
              <!-- form start -->
                <div class="card-body">
                <form method="POST" action="{{url('administrador/users/store')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="rol_id">Rol: *</label>
                    <select name="rol_id" id="rol_id" type='text' class="form-control @error('rol_id') is-invalid @enderror" value="{{ old('rol_id') }}" required autocomplete="rol_id">
                      @foreach($roles as $rol)
                        <option value="{{$rol->rol_id}}" {{ old('rol_id') == '$rol->rol_id' ? 'selected':''}}>{{$rol->rol_nombre}}</option>
                      @endforeach
                    </select>
                    @error('rol_id')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe seleccionar un rol.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                      <label for="alum_id">Nombres y Apellidos: *</label>
                      <input name ="alum_id" type="hidden" class="form-control
                      @error('alum_id') is-invalid @enderror" value ="{{$alumno->alum_id}}"
                      autocomplete="alum_id"  
                      id="alum_id" autofocus>
                      <h3 class="profile-username text-left">{{$alumno->alum_nombres}} {{$alumno->alum_apellidos}}</h3>     
                  </div>
                  <div class="form-group">
                      <input name ="pers_id" type="hidden" class="form-control
                      @error('pers_id') is-invalid @enderror" value ="{{ old('pers_id') }}"
                      autocomplete="pers_id"  
                      id="pers_id" autofocus>  
                  </div>
                  <div class="form-group">
                    <label for="name">Nombre de Usuario: *</label>
                    <input type="text" name="name" class="form-control
                    @error('name') is-invalid @enderror"
                    value="{{ old('name') }}"
                    required autocomplete="name"  
                    id="name" autofocus>
                    @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>Debe ingresar minimo 5 caracteres, el maximo es de 255 caracteres y no puede registrar el mismo u otro nombre de usuario.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="email">Email: *</label>
                    <input type="email" name="email" class="form-control
                    @error('email') is-invalid @enderror"
                    value="{{ old('email') }}"
                    required autocomplete="email"  
                    id="email" autofocus>
                    @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>Debe ingresar minimo 5 caracteres, el maximo es de 255 caracteres y no puede registrar el mismo u otro correo electronico de otro usuario.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="password">Contraseña: *</label>
                    <input type="password" name="password" class="form-control
                    @error('password') is-invalid @enderror"
                    value="{{ old('password') }}"
                    required autocomplete="new-password"  
                    id="password" autofocus>
                    @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe ingresar minimo 5 caracteres, el maximo es de 255 caracteres y no puede registrar el mismo u otra contaseña de un usuario.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="usu_estado">Estado: *</label>
                    <select name="usu_estado" id="usu_estado" type='text' class="form-control @error('usu_estado') is-invalid @enderror" value="{{ old('usu_estado') }}" required autocomplete="usu_estado">
                      <option selected disabled>Seleccione un estado</option>
                      <option value="1"  {{ old('usu_estado') == '1' ? 'selected':''}}>Activo</option>
                      <option value="0"  {{ old('usu_estado') == '0' ? 'selected':''}}>Inactivo</option>
                    </select>
                    @error('usu_estado')
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