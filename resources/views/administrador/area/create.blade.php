@extends('backend.app')

@section('title')
Modulo Administrador - Crear Area
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) - Administrador/a - Crear Area -->
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Modulo Administrador/a - Crear Area</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Administrador/a - Crear Area -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Crear Area</h3>
              </div>
              <!-- /.card-header -->
              
              <!-- form start -->
                <div class="card-body">
                  
                <form method="POST" action="{{url('administrador/area/store')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="area_nombre">Area: *</label>
                    <input type="text" 
                    name="area_nombre" class="form-control 
                    @error('area_nombre') is-invalid @enderror" 
                    value="{{ old('area_nombre') }}"  
                    required autocomplete="area_nombre" 
                    id="area_nombre" 
                    placeholder="Ingrese el area de conocimiento" autofocus>
                    @error('area_nombre')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe ingresar minimo 5 letras, el maximo es de 100 letras y no puede crearse la misma area. Solo puede ingresar letras.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="area_estado">Estado: *</label>
                    <select name="area_estado" id="area_estado" type='text' class="form-control @error('area_estado') is-invalid @enderror" value="{{ old('area_estado') }}" required autocomplete="area_estado">
                      <option selected disabled>Seleccione un estado</option>
                      <option value="1" {{ old('area_estado') == '1' ? 'selected':''}}>Activo</option>
                      <option value="0" {{ old('area_estado') == '0' ? 'selected':''}}>Inactivo</option>
                    </select>
                    @error('area_estado')
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
                  <a href="/administrador/area/index">
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
