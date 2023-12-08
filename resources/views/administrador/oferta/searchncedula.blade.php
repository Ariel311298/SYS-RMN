@extends('backend.app')

@section('title')
Modulo Administrador - Buscar Docente
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) - Administrador/a - Buscar Docente -->
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Modulo Administrador/a - Buscar Docente</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Administrador/a - Buscar Docente -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- Buscar Docente -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Buscar Docente</h3>
              </div>
              <!-- /.card-header -->
              
              <!-- form start -->
              <div class="card-body">
                <form action="{{ url('administrador/oferta/searchcedula') }}" method="POST">
                  @csrf
                    <div class="form-group">
                      <label for="pers_id">Buscar por N ° Cedula: *</label>
                          <div class="form-group">
                            <input id="pers_ncedula" class="form-control" name="pers_ncedula" type="text" value="{{ old('pers_ncedula') }}" placeholder="Ingrese el número de cedula o solo los nombres o solo los apellidos del docente.">
                          </div>
                          <input class="btn btn-info" type="submit" value="Buscar">
                          <br>
                      <br>
                      <p>Nota: Solo se debe ingresar el número de cedula de la persona o solo los nombres del docente en caso de buscar con el nombre o solo con los apellidos en caso de buscar con el mismo para crear la oferta.</p>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </form>
                <!-- /.form POST-->
              </div>
              <!-- /.card-body -->
            </div>
                        
            <br>
            <br>

            <div class="col-md-6">
            <!-- Buscar Docente -->
              <!-- Crear Oferta --> 
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Crear Oferta</h3>
                </div>
                <!-- /.card-header -->
                
                <!-- form start -->
                <div class="card-body">
                  <form method="POST" action="{{url('administrador/oferta/store')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="per_id">Periodo: *</label>
                    <select name="per_id" id="per_id" type='text' class="form-control @error('per_id') is-invalid @enderror" value="{{ old('per_id') }}" required autocomplete="per_id">
                      <option selected disabled>Seleccione un periodo</option>
                      @foreach($periodos as $periodo)
                        @if($periodo->per_estado == 1)   
                          <option value="{{$periodo->per_id}}" {{ old('per_id') == '$periodo->per_id' ? 'selected':''}}>{{$periodo->per_nombre}}</option>
                        @endif
                      @endforeach
                    </select>
                    @error('per_id')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe seleccionar un periodo.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="cur_id">Curso: *</label>
                    <select name="cur_id" id="cur_id" type='text' class="form-control @error('cur_id') is-invalid @enderror" value="{{ old('cur_id') }}" required autocomplete="cur_id">
                      <option selected disabled>Seleccione un curso</option>
                      @foreach($cursos as $curso)
                        @if($curso->cur_estado == 1)   
                          <option value="{{$curso->cur_id}}" {{ old('cur_id') == '$curso->cur_id' ? 'selected':''}}>{{$curso->seccion->sec_nombre}} - {{$curso->cur_nombre}} - {{$curso->cur_paralelo}}</option>
                        @endif
                      @endforeach
                    </select>
                    @error('cur_id')
                      <span class="invalid-feedback" role="alert">
                        <strong>Seleccionar un curso.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pers_id">Docente: *</label>
                    <select name="pers_id" id="pers_id" type='text' class="form-control @error('pers_id') is-invalid @enderror" value="{{ old('pers_id') }}" required autocomplete="pers_id">
                      <option selected disabled>Seleccione un docente</option>
                      @foreach($docentes as $docente)
                        @if($docente->pers_estado == 1)   
                          <option value="{{$docente->pers_id}}" {{ old('pers_id') == '$docente->pers_id' ? 'selected':''}}>{{$docente->pers_nombres}} {{$docente->pers_apellidos}}</option>
                        @endif
                      @endforeach
                    </select>
                    @error('pers_id')
                      <span class="invalid-feedback" role="alert">
                          <strong>Seleccionar un docente.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="ofer_estado">Estado: *</label>
                    <select name="ofer_estado" id="ofer_estado" type='text' class="form-control @error('ofer_estado') is-invalid @enderror" value="{{ old('ofer_estado') }}" required autocomplete="ofer_estado" required>
                      <option selected disabled>Seleccione el estado</option>
                      <option value="1" {{ old('ofer_estado') == '1' ? 'selected':''}}>Activo</option>
                      <option value="0" {{ old('ofer_estado') == '0' ? 'selected':''}}>Inactivo</option>
                    </select>
                    @error('ofer_estado')
                      <span class="invalid-feedback" role="alert">
                          <strong>Seleccionar un estado.</strong>
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
                  <a href="/administrador/oferta/index">
                    <button type="button" class="btn btn-danger center-block">
                      Regresar
                      <i class="fas fa-arrow-left"></i>
                    </button>
                  </a>
                </div>
                <!-- /.card-footer -->
              </form>
              <!-- /.form POST-->
              </div>
              <!-- /.card-body -->
            </div> 
          </div>      
          <!-- /.form -->
        </div>
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