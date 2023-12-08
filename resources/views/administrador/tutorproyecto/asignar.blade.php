@extends('backend.app')

@section('title')
Modulo Administrador - Asignar Tutor de Proyecto Escolar 
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) - Administrador/a - Asignar Tutor de Proyecto Escolar -->
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Modulo Administrador/a - Asignar Tutor de Proyecto Escolar</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Administrador/a - Asignar Tutor de Proyecto Escolar -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Asignacion de Tutor de Proyecto Escolar</h3>
              </div>
              <!-- /.card-header -->
              
              <!-- form start -->
                <div class="card-body">
                <form method="POST" action="{{url('administrador/tutorproyecto/store')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="pers_id">Nombres y Apellidos: *</label>
                    <select name="pers_id" id="pers_id" type='text' class="form-control @error('pers_id') is-invalid @enderror" value="{{ old('pers_id')}}" required autocomplete="pers_id">
                      @foreach($docentes as $docente)
                        <option value="{{$docente->pers_id}}" {{ old('pers_id') == '$docente->pers_id' ? 'selected':''}}>{{$docente->pers_nombres}} {{$docente->pers_apellidos}}</option>
                      @endforeach
                    </select>
                    @error('pers_id')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe seleccionar un docente.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="ofer_id">Oferta: *</label>
                    <select name="ofer_id" id="ofer_id" type='text' class="form-control @error('ofer_id') is-invalid @enderror" value="{{ old('ofer_id') }}" required autocomplete="ofer_id">
                      <option selected disabled>Seleccione una oferta</option>  
                      @foreach($ofertas as $oferta)
                        @if($oferta->ofer_estado == 1) 
                          <option value="{{$oferta->ofer_id}}" {{ old('ofer_id') == '$oferta->ofer_id' ? 'selected':''}}>{{$oferta->periodo->per_nombre}} - {{$oferta->curso->seccion->sec_nombre}} - {{$oferta->curso->cur_nombre}} - {{$oferta->curso->cur_paralelo}} - {{$oferta->personal->pers_nombres}} - {{$oferta->personal->pers_apellidos}}</option>
                        @endif
                      @endforeach
                    </select>
                    @error('ofer_id')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe seleccionar una oferta.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="tutproy_estado">Estado: *</label>
                    <select name="tutproy_estado" id="tutproy_estado" type='text' class="form-control @error('tutproy_estado') is-invalid @enderror" value="{{ old('tutproy_estado') }}" required autocomplete="tutproy_estado" required>
                      <option selected disabled>Seleccione un estado</option>
                      <option value="1" {{ old('tutproy_estado') == '1' ? 'selected':''}}>Activo</option>
                      <option value="0" {{ old('tutproy_estado') == '0' ? 'selected':''}}>Inactivo</option>
                    </select>
                    @error('tutproy_estado')
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
                  <a href="/administrador/tutorproyecto/create">
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