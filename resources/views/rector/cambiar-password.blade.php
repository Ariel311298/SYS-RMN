@extends('backend.app')

@section('title')
Modulo Rector - Cambiar Contraseña
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) - Rector - Cambiar Contraseña -->
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Modulo Rector - Cambiar Contraseña</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Rector - Cambiar Contraseña -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Cambiar Contraseña</h3>
              </div>
              <!-- /.card-header -->
              
              <!-- form start -->
                <div class="card-body">
                <form method="POST" action="{{url('rector/cambiar-password/update-password')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="rol_nombre">Rol Actual:</label>
                    <p>{{$user->rol->rol_nombre}}</p>
                  </div>
                  <div class="form-group">
                    <input name ="id" type="hidden" value ="{{old('id', $user->id)}}">
                    <label>Nombres y Apellidos: *</label>
                        <input name ="pers_id" type="hidden" class="form-control
                        @error('pers_id') is-invalid @enderror"
                        autocomplete="pers_id" value="{{$user->pers_id}}" 
                        id="pers_id" autofocus>
                        <h3 class="profile-username text-left">{{$user->personal->pers_nombres}} {{$user->personal->pers_apellidos}}</h3>
                  </div>
                  <div class="form-group">
                    <input name ="id" type="hidden" value ="{{old('id', $user->id)}}">
                    <label for="password">Contraseña: *</label>
                    <input type="password" name="password" class="form-control
                    @error('password') is-invalid @enderror"
                    required autocomplete="new-password"  
                    id="password" autofocus>
                    @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>Debe ingresar minimo 5 caracteres y el maximo es de 255 caracteres.</strong>
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
                  <a href="/rector/dashboard">
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