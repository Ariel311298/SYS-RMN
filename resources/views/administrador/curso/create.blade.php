@extends('backend.app')

@section('title')
Modulo Administrador - Crear Curso
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) - Administrador/a - Crear Curso -->
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Modulo Administrador/a - Crear Curso</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Administrador/a - Crear Curso -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Crear Curso</h3>
              </div>
              <!-- /.card-header -->
              
              <!-- form start -->
                <div class="card-body">
                <form method="POST" action="{{url('administrador/curso/store')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="sec_id">Seccion: *</label>
                    <select name="sec_id" id="sec_id" type='text' class="form-control @error('sec_id') is-invalid @enderror" value="{{ old('sec_id') }}" required autocomplete="sec_id">
                      <option selected disabled>Seleccione una seccion</option>
                      @foreach($secciones as $seccion)
                        <option value="{{$seccion->sec_id}}" {{ old('sec_id') == '$seccion->sec_id' ? 'selected':''}}>{{$seccion->sec_nombre}}</option>
                      @endforeach
                    </select>
                    @error('sec_id')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe seleccionar una sección.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="cur_nivel">Nivel: *</label>
                    <select name="cur_nivel" id="cur_nivel" type='text' class="form-control @error('cur_nivel') is-invalid @enderror" value="{{ old('cur_nivel') }}" required autocomplete="cur_nivel" required>
                      <option selected disabled>Seleccione un nivel de cursos</option>
                      <option value="Educación General Básica Elemental" {{ old('cur_nivel') == 'Educación General Básica Elemental' ? 'selected':''}}>Educación General Básica Elemental</option>
                      <option value="Educación General Básica Media" {{ old('cur_nivel') == 'Educación General Básica Media' ? 'selected':''}}>Educación General Básica Media</option>
                      <option value="Educación General Básica Superior" {{ old('cur_nivel') == 'Educación General Básica Superior' ? 'selected':''}}>Educación General Básica Superior</option>
                      <option value="Bachillerato General Unificado" {{ old('cur_nivel') == 'Bachillerato General Unificado' ? 'selected':''}}>Bachillerato General Unificado</option>
                    </select>     
                    @error('cur_nivel')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe seleccionar un nivel de curso.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="cur_nombre">Curso: *</label>
                    <select name="cur_nombre" id="cur_nombre" type='text' class="form-control @error('cur_nombre') is-invalid @enderror" value="{{ old('cur_nombre') }}" required autocomplete="cur_nombre" required>
                      <option selected disabled>Seleccione un curso</option>
                      <option value="1°EGB" {{ old('cur_nombre') == '1°EGB' ? 'selected':''}}>1°EGB</option>
                      <option value="2°EGB" {{ old('cur_nombre') == '2°EGB' ? 'selected':''}}>2°EGB</option>
                      <option value="3°EGB" {{ old('cur_nombre') == '3°EGB' ? 'selected':''}}>3°EGB</option>
                      <option value="4°EGB" {{ old('cur_nombre') == '4°EGB' ? 'selected':''}}>4°EGB</option>
                      <option value="5°EGB" {{ old('cur_nombre') == '5°EGB' ? 'selected':''}}>5°EGB</option>
                      <option value="6°EGB" {{ old('cur_nombre') == '6°EGB' ? 'selected':''}}>6°EGB</option>
                      <option value="7°EGB" {{ old('cur_nombre') == '7°EGB' ? 'selected':''}}>7°EGB</option>
                      <option value="8°EGB" {{ old('cur_nombre') == '8°EGB' ? 'selected':''}}>8°EGB</option>
                      <option value="9°EGB" {{ old('cur_nombre') == '9°EGB' ? 'selected':''}}>9°EGB</option>
                      <option value="10°EGB" {{ old('cur_nombre') == '10°EGB' ? 'selected':''}}>10°EGB</option>
                      <option value="1°BGU" {{ old('cur_nombre') == '1°BGU' ? 'selected':''}}>1°BGU</option>
                      <option value="2°BGU" {{ old('cur_nombre') == '2°BGU' ? 'selected':''}}>2°BGU</option>
                      <option value="3°BGU" {{ old('cur_nombre') == '3°BGU' ? 'selected':''}}>3°BGU</option>
                    </select>
                    @error('cur_nombre')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe seleccionar un curso.</strong>
                      </span>
                    @enderror                       
                  </div>
                  <div class="form-group">
                    <label for="cur_paralelo">Paralelo: *</label>
                    <select name="cur_paralelo" id="cur_paralelo" type='text' class="form-control @error('cur_paralelo') is-invalid @enderror" value="{{ old('cur_paralelo') }}" required autocomplete="cur_paralelo" required>
                      <option selected disabled>Seleccione un paralelo</option>
                      <option value="A" {{ old('cur_paralelo') == 'A' ? 'selected':''}}>A</option>
                      <option value="B" {{ old('cur_paralelo') == 'B' ? 'selected':''}}>B</option>
                      <option value="C" {{ old('cur_paralelo') == 'C' ? 'selected':''}}>C</option>
                      <option value="D" {{ old('cur_paralelo') == 'D' ? 'selected':''}}>D</option>
                      <option value="E" {{ old('cur_paralelo') == 'E' ? 'selected':''}}>E</option> 
                    </select>
                    @error('cur_paralelo')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe seleccionar un paralelo.</strong>
                      </span>
                    @enderror   
                  </div>
                  <div class="form-group">
                    <label for="cur_estado">Estado: *</label>
                    <select name="cur_estado" id="cur_estado" type='text' class="form-control @error('cur_estado') is-invalid @enderror" value="{{ old('cur_estado') }}" required autocomplete="cur_estado" required>
                      <option selected disabled>Seleccione un estado</option>
                      <option value="1" {{ old('cur_estado') == '1' ? 'selected':''}}>Activo</option>
                      <option value="0" {{ old('cur_estado') == '0' ? 'selected':''}}>Inactivo</option>
                    </select>
                    @error('cur_estado')
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
                  <a href="/administrador/curso/index">
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