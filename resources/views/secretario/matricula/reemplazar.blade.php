@extends('backend.app')

@section('title')
Modulo Secretario - Reemplazar Matricula
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) - Secretario/a - Reemplazar Matricula -->
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Modulo Secretario/a - Reemplazar Matricula</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Secretario/a - Reemplazar Matricula -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <form action="{{ url('secretario/matricula/searchalumnoreemplazar') }}" method="POST">
                    @csrf
                    <div class="form-group">
                      <input name ="mat_id" type="hidden" value ="{{old('mat_id', $matricula->mat_id)}}">
                      <label for="alum_ncedula">Buscar: (Opcional)</label>
                        <div class="form-group">
                          <input id="alum_ncedula" class="form-control" name="alum_ncedula" type="text" value="{{ old('alum_ncedula') }}" placeholder="Ingrese el número de cedula o solo los nombres o solo los apellidos del alumno.">
                        </div>
                      <input class="btn btn-info" type="submit" value="Buscar">
                      <br>
                    <br>
                    <p>Nota: Solo se debe ingresar el número de cedula del alumno o solo los nombres del alumno en caso de buscar con el nombre o solo con los apellidos en caso de buscar con el mismo para reemplazar la matricula de un alumno, en caso de no encontrar al alumno.</p>
                    </div>
                  </div>
                </form>  
              </div>
              <!-- /.card-header -->
              
              <!-- form start -->
                <div class="card-body">
                
                <form method="POST" action="{{url('secretario/matricula/replace')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <input name ="mat_id" type="hidden" value ="{{old('mat_id', $matricula->mat_id)}}">
                    <label for="mat_id">Curso: *</label>
                    <select name="ofer_id" id="ofer_id" type='text' class="form-control @error('ofer_id') is-invalid @enderror" value="{{$matricula->ofer_id}}" required autocomplete="ofer_id">
                        @foreach($ofertas as $oferta)
                          @if($oferta->ofer_estado == 1)
                            <option value="{{$oferta->ofer_id}}" {{ $oferta->ofer_id == $matricula->ofer_id ? 'selected':''}}>{{$oferta->periodo->per_nombre}} - {{$oferta->curso->seccion->sec_nombre}} - {{$oferta->curso->cur_nombre}} - {{$oferta->curso->cur_paralelo}} - {{$oferta->personal->pers_nombres}} {{$oferta->personal->pers_apellidos}}</option>
                          @endif
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                  <input name ="mat_id" type="hidden" value ="{{old('mat_id', $matricula->mat_id)}}">
                    <label for="alum_id">Alumno: *</label>
                    <select name="alum_id" id="alum_id" type='text' class="form-control @error('alum_id') is-invalid @enderror" value="{{$matricula->alum_id}}" required autocomplete="alum_id">
                        @foreach($alumnos as $alumno)
                          @if($alumno->alum_estado == 1)
                            <option value="{{$alumno->alum_id}}" {{ $alumno->alum_id == $matricula->alum_id ? 'selected':''}}>{{$alumno->alum_nombres}} {{$alumno->alum_apellidos}}</option>
                          @endif
                        @endforeach
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">
                    Actualizar
                    <i class="fas fa-edit"></i>
                  </button>
                  <a href="/secretario/matricula/table">
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