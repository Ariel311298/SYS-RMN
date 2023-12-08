@extends('backend.app')

@section('title')
Modulo Secretario - Crear Matricula
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) - Secretario/a - Crear Matricula -->
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Modulo Secretario/a - Crear Matricula</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Secretario/a - Crear Matricula -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Crear Matricula</h3>
              </div>
              <!-- /.card-header -->
              
              <!-- form start -->
                <div class="card-body">
                <form method="POST" action="{{url('secretario/matricula/store')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="ofer_id">Curso: *</label>
                    <select name="ofer_id" id="ofer_id" type='text' class="form-control @error('ofer_id') is-invalid @enderror" value="{{ old('ofer_id') }}" required autocomplete="ofer_id">
                      @foreach($ofertas as $oferta)
                        @if($oferta->ofer_estado == 1)
                          <option value="{{$oferta->ofer_id}}" {{ old('ofer_id') == '$oferta->ofer_id' ? 'selected':''}}>{{$oferta->periodo->per_nombre}} - {{$oferta->curso->seccion->sec_nombre}} - {{$oferta->curso->cur_nombre}} - {{$oferta->curso->cur_paralelo}} - {{$oferta->personal->pers_nombres}} - {{$oferta->personal->pers_apellidos}}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="alum_id">Nombres y Apellidos: *</label>
                    <input type="hidden" 
                    name="alum_id" class="form-control 
                    @error('alum_id') is-invalid @enderror" 
                    value="{{ $alumno->alum_id }}"  
                    required autocomplete="alum_id" 
                    id="alum_id" 
                    placeholder="Ingrese el número de cedula o solo los nombres o solo los apellidos para encontrar al alumno" autofocus>
                    <p>{{$alumno->alum_nombres}} {{$alumno->alum_apellidos}}</p>
                  </div>
                  <div class="form-group">
                    <label for="mat_estado">Estado: *</label>
                    <select name="mat_estado" id="mat_estado" type='text' class="form-control @error('mat_estado') is-invalid @enderror" value="{{ old('mat_estado') }}" required autocomplete="mat_estado" required>
                      <option value="1"  {{ old('mat_estado') == '1' ? 'selected':''}}>Activo</option>
                      <option value="0"  {{ old('mat_estado') == '0' ? 'selected':''}}>Inactivo</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">
                    Guardar
                    <i class="fas fa-save"></i>
                  </button>
                  <a href="/secretario/matricula/index">
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

@section('script')

@endsection