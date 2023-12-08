@extends('backend.app')

@section('title')
Modulo Administrador - Crear Asignatura
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) - Administrador/a - Crear Asignatura -->
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Modulo Administrador/a - Crear Asignatura</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Administrador/a - Crear Asignatura -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Crear Asignatura</h3>
              </div>
              <!-- /.card-header -->
              
              <!-- form start -->
                <div class="card-body">
                <form method="POST" action="{{url('administrador/asignatura/store')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="area_id">Area: *</label>
                    <select name="area_id" id="area_id" type='text' class="form-control @error('area_id') is-invalid @enderror" value="{{ old('area_id') }}" required autocomplete="area_id">
                      <option selected disabled>Seleccione una area</option>
                      @foreach($areas as $area)
                        @if($area->area_estado == 1)  
                          <option value="{{$area->area_id}}" {{ old('area_id') == '$area->area_id' ? 'selected':''}}>{{$area->area_nombre}}</option>
                        @endif
                      @endforeach
                    </select>
                    @error('area_id')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe seleccionar una área.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="cur_id">Curso: *</label>
                    <select name="cur_id" id="cur_id" type='text' class="form-control @error('cur_id') is-invalid @enderror" value="{{ old('cur_id') }}" required autocomplete="cur_id">
                      <option selected disabled>Seleccione un curso</option>
                      @foreach($cursos as $curso)
                          @if($curso->cur_estado == 1) 
                            <option value="{{$curso->cur_id}}" {{ old('cur_id') == '$curso->cur_id' ? 'selected':''}}>{{$curso->cur_nombre}} - {{$curso->cur_paralelo}}</option>
                          @endif  
                      @endforeach
                    </select>
                    @error('cur_id')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe seleccionar un curso.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="asig_nom">Asignatura: *</label>
                    <input type="text" 
                    name="asig_nom" class="form-control 
                    @error('asig_nom') is-invalid @enderror" 
                    value="{{ old('asig_nom') }}"  
                    required autocomplete="asig_nom" 
                    id="asig_nom" 
                    placeholder="Ingrese la asignatura" autofocus>  
                    @error('asig_nom')
                      <span class="invalid-feedback" role="alert">
                          <strong>Debe ingresar minimo 5 caracteres, el maximo es de 150 caracteres. Solo pueden ingresar letras.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="asig_estado">Estado: *</label>
                    <select name="asig_estado" id="asig_estado" type='text' class="form-control @error('asig_estado') is-invalid @enderror" value="{{ old('asig_estado') }}" required autocomplete="asig_estado" required>
                      <option selected disabled>Seleccione un estado</option>
                      <option value="1"  {{ old('asig_estado') == '1' ? 'selected':''}}>Activo</option>
                      <option value="0"  {{ old('asig_estado') == '0' ? 'selected':''}}>Inactivo</option>
                    </select>
                    @error('asig_estado')
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
                  <a href="/administrador/asignatura/index">
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