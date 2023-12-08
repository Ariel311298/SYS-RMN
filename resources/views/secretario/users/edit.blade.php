@extends('backend.app')

@section('title')
Modulo Secretario - Editar Usuario
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) - Secretario/a - Editar Usuario -->
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Modulo Secretario/a - Editar Usuario</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Secretario/a - Editar Usuario -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Crear Usuario (Personal)</h3>
              </div>
              <!-- /.card-header -->
              
              <!-- form start -->
                <div class="card-body">
                <form method="POST" action="{{url('secretario/users/update')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="rol_nombre">Rol Actual:</label>
                    <p>{{$user->rol->rol_nombre}}</p>
                  </div>
                  <div class="form-group">
                  <input name ="id" type="hidden" value ="{{old('id', $user->id)}}">
                    <label for="rol_id">Rol: *</label>
                    <select name="rol_id" id="rol_id" type='text' class="form-control @error('rol_id') is-invalid @enderror" value="{{$user->rol_id}}" required autocomplete="rol_id">
                        @foreach($roles as $rol)
                            <option value="{{$rol->rol_id}}" {{ $rol->rol_id == $user->rol_id ? 'selected':''}}>{{$rol->rol_nombre}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <input name ="id" type="hidden" value ="{{old('id', $user->id)}}">
                    <label>Nombres y Apellidos: *</label>
                    @switch($user->rol_id)
                    @case(1)
                      <input name ="pers_id" type="hidden" class="form-control
                      @error('pers_id') is-invalid @enderror"
                      autocomplete="pers_id" value="{{$user->pers_id}}" 
                      id="pers_id" autofocus>
                      <h3 class="profile-username text-left">{{$user->personal->pers_nombres}} {{$user->personal->pers_apellidos}}</h3>
                    @break
                    @case(2)
                      <input name ="pers_id" type="hidden" class="form-control
                      @error('pers_id') is-invalid @enderror"
                      autocomplete="pers_id" value="{{$user->pers_id}}" 
                      id="pers_id" autofocus>
                      <h3 class="profile-username text-left">{{$user->personal->pers_nombres}} {{$user->personal->pers_apellidos}}</h3>
                    @break
                    @case(3)
                      <input name ="pers_id" type="hidden" class="form-control
                      @error('pers_id') is-invalid @enderror"
                      autocomplete="pers_id" value="{{$user->pers_id}}" 
                      id="pers_id" autofocus>
                      <h3 class="profile-username text-left">{{$user->personal->pers_nombres}} {{$user->personal->pers_apellidos}}</h3>
                    @break
                    @case(4)
                      <input name ="pers_id" type="hidden" class="form-control
                      @error('pers_id') is-invalid @enderror"
                      autocomplete="pers_id" value="{{$user->pers_id}}" 
                      id="pers_id" autofocus>
                      <h3 class="profile-username text-left">{{$user->personal->pers_nombres}} {{$user->personal->pers_apellidos}}</h3>
                    @break
                    @case(5)
                      <input name ="alum_id" type="hidden" class="form-control
                      @error('alum_id') is-invalid @enderror"
                      autocomplete="alum_id" value="{{$user->alum_id}}" 
                      id="alum_id" autofocus>
                      <h3 class="profile-username text-left">{{$user->alumno->alum_nombres}} {{$user->alumno->alum_apellidos}}</h3> 
                    @break
                    @default
                      <p>No se encuentra el usuario registrado</p>
                    @endswitch      
                  </div>
                  <div class="form-group">
                    <input name ="id" type="hidden" value ="{{old('id', $user->id)}}">
                    <label for="name">Nombre de Usuario: *</label>
                    <input type="text" name="name" class="form-control
                    @error('name') is-invalid @enderror"
                    value="{{$user->name}}"
                    required autocomplete="name"  
                    id="name" autofocus>
                    @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>Debe ingresar minimo 5 caracteres, el maximo es de 255 caracteres.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <input name ="id" type="hidden" value ="{{old('id', $user->id)}}">
                    <label for="email">Email: *</label>
                    <input type="email" name="email" class="form-control
                    @error('email') is-invalid @enderror"
                    value="{{$user->email}}"
                    required autocomplete="email"  
                    id="email" autofocus>
                    @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>Debe ingresar minimo 5 caracteres, el maximo es de 255 caracteres.</strong>
                      </span>
                    @enderror
                  </div>
                  <p>Nota: Se debe seleccionar el mismo rol para acceder al sistema en caso de modificar los datos del usuario seleccionado.</p>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">
                    Guardar
                    <i class="fas fa-save"></i>
                  </button>
                  <a href="/secretario/users/index">
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