@extends('backend.app')

@section('title')
Modulo Administrador - Reemplazar Asignacion (Calificaciones)
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Content Header (Page header) - Administrador/a - Reemplazar Asignacion (Calificaciones) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Modulo Administrador/a - Reemplazar Asignacion (Calificacion)</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header - Administrador/a - Reemplazar Asignacion (Calificacion) -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title"> Reemplazar Asignacion (Calificacion)</h3> 
            </div>
            <!-- /.card-header -->
            
            <!-- form start -->
              <div class="card-body">
              <form method="POST" action="{{url('administrador/calificacion/asignaturas/controlasignacion/update')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input name ="cal_id" type="hidden" value ="{{old('cal_id', $calificacion->cal_id)}}">
                    <label>Asignatura Asignada Actual:</label>
                    {{$calificacion->malla->oferta->periodo->per_nombre}} - {{$calificacion->malla->oferta->curso->seccion->sec_nombre}} - {{$calificacion->malla->oferta->curso->cur_nombre}} {{$calificacion->malla->oferta->curso->cur_paralelo}} - {{$calificacion->malla->asignatura->asig_nom}} - {{$calificacion->malla->personal->pers_nombres}} {{$calificacion->malla->personal->pers_apellidos}}    
                </div>
                <div class="form-group">
                <input name ="cal_id" type="hidden" value ="{{old('cal_id', $calificacion->cal_id)}}">
                  <label for="mal_id">Periodo - Seccion - Curso - Asignatura: *</label>
                  <select name="mal_id" id="mal_id" type='text' class="form-control @error('mal_id') is-invalid @enderror" value="{{$calificacion->mal_id}}" required autocomplete="mal_id">
                      @foreach($mallas as $malla)
                        @if($malla->mal_estado == 1)  
                          <option value="{{$malla->mal_id}}" {{ $malla->mal_id == $calificacion->mal_id ? 'selected':''}}>{{$malla->oferta->periodo->per_nombre}} - {{$malla->oferta->curso->seccion->sec_nombre}} - {{$malla->oferta->curso->cur_nombre}} {{$malla->oferta->curso->cur_paralelo}} - {{$malla->asignatura->asig_nom}} - {{$malla->personal->pers_nombres}} {{$malla->personal->pers_apellidos}}</option>
                        @endif
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <input name ="cal_id" type="hidden" value ="{{old('cal_id', $calificacion->cal_id)}}">
                  <label>Periodo - Seccion - Curso - Alumno: *</label>
                  <select name="mat_id" id="mat_id" type='text' class="form-control @error('mat_id') is-invalid @enderror" value="{{$calificacion->mat_id}}" required autocomplete="mat_id">
                      @foreach($matriculas as $matricula)
                        @if($matricula->mat_estado == 1) 
                          <option value="{{$matricula->mat_id}}" {{ $matricula->mat_id == $calificacion->mat_id ? 'selected':''}}>{{$matricula->oferta->periodo->per_nombre}} - {{$matricula->oferta->curso->seccion->sec_nombre}} - {{$matricula->oferta->curso->cur_nombre}} {{$matricula->oferta->curso->cur_paralelo}} - {{$matricula->alumno->alum_nombres}} {{$matricula->alumno->alum_apellidos}}</option>
                        @endif
                      @endforeach
                  </select>    
                </div>
                <div class="form-group">
                  <input name ="cal_id" type="hidden" value ="{{old('cal_id', $calificacion->cal_id)}}">
                  <label for="cal_estado">Estado: *</label>
                  <select name="cal_estado" id="cal_estado" type='text' class="form-control @error('cal_estado') is-invalid @enderror" value="{{$calificacion->cal_estado}}" required autocomplete="cal_estado">
                    <option value="1" {{$calificacion->cal_estado == '1' ? 'selected':''}}>Activado</option>
                    <option value="0" {{$calificacion->cal_estado == '0' ? 'selected':''}}>Desactivado</option>
                  </select>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                  Guardar
                  <i class="fas fa-save"></i>
                </button>
                <a href="{{url('administrador/calificacion/asignaturas/controlasignacion', ['mal_id' => $calificacion->malla->mal_id])}}">
                  <button type="button" class="btn btn-warning center-block">
                    Regresar
                    <i class="fas fa-arrow-left"></i>
                  </button>
                </a>
                <a href="{{url('administrador/calificacion/asignaturas', ['ofer_id' => $calificacion->malla->oferta->ofer_id])}}">
                  <button type="button" class="btn btn-success center-block">
                    Volver al menu de asignaturas
                    <i class="fas fa-book"></i>
                  </button>
                </a>
                <a href="{{url('administrador/calificacion/index')}}">
                  <button type="button" class="btn btn-danger center-block">
                    Volver al menu de cursos
                    <i class="fas fa-home"></i>
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