<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SYS-RMN</title>
  <link rel="icon" href="{!! asset('backend/dist/img/logo_institucion_educativa.png') !!}"/>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
<div class="card-header" style="position: top-end;">                  
    {{-- Error Alert --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="position: top-end;">
            {{session('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
</div>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
        
    <div class="card-header text-center">
      <img class="img-circle elevation-2" src="{{asset('backend/dist/img/logo_institucion_educativa.png')}}" alt="Escudo_Unidad_Educativa_Enrique_Malo_Andrade" height="60" width="60">  
    </div>

    <div class="card-header text-center">
      <a href="#" class="h1"><b>SYS-RMN</b></a>
    </div>

    <div class="card-body">
      <p class="login-box-msg">Unidad Educativa Enrique Malo Andrade</p>

      <form method="POST" action="{{ route('login') }}">
            @csrf
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Nombre de Usuario o Dirección de Correo Electronico" required autocomplete="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror @error('name') is-invalid @enderror" autofocus>
            
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Contraseña">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="form-control-lg">
            <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
          </div>
          <!-- /.col -->
        </div>
        <div class="col-8">
            <div class="icheck-primary">
              <a href="{{ route('password.request') }}">Cambiar Contraseña</a>
            </div>
          </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('backend/dist/js/adminlte.min.js')}}"></script>
</body>
</html>
