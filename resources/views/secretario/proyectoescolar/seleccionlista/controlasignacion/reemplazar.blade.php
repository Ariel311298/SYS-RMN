@extends('backend.app')

@section('title')
Modulo Secretario - Reemplazar Asignacion (Proyectos Escolares)
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Content Header (Page header) - Secretario/a - Reemplazar Asignacion (Proyectos Escolares) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Modulo Secretario/a - Reemplazar Asignacion (Proyectos Escolares)</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header - Secretario/a - Reemplazar Asignacion (Proyectos Escolares) -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title"> Reemplazar Asignacion (Proyectos Escolares)</h3> 
            </div>
            <!-- /.card-header -->
            
            <!-- form start -->
              <div class="card-body">
              <form method="POST" action="{{url('secretario/proyectoescolar/seleccionlista/controlasignacion/update')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input name ="proy_id" type="hidden" value ="{{old('proy_id', $proyescolar->proy_id)}}">
                    <label>Curso Asignado Actual:</label>
                    {{$proyescolar->tutorproyecto->oferta->periodo->per_nombre}} - {{$proyescolar->tutorproyecto->oferta->curso->seccion->sec_nombre}} - {{$proyescolar->tutorproyecto->oferta->curso->cur_nombre}} {{$proyescolar->tutorproyecto->oferta->curso->cur_paralelo}}                                        
                </div>
                <div class="form-group">
                <input name ="proy_id" type="hidden" value ="{{old('proy_id', $proyescolar->proy_id)}}">
                  <label for="tutproy_id">Periodo - Seccion - Curso - Tutor de Proyecto Escolar: *</label>
                  <select name="tutproy_id" id="tutproy_id" type='text' class="form-control @error('tutproy_id') is-invalid @enderror" value="{{$proyescolar->tutproy_id}}" required autocomplete="tutproy_id">
                      @foreach($tutorproyectos as $tutorproyecto)
                        @if($tutorproyecto->tutproy_estado == 1)
                          <option value="{{$tutorproyecto->tutproy_id}}" {{ $tutorproyecto->tutproy_id == $proyescolar->tutproy_id ? 'selected':''}}>{{$tutorproyecto->oferta->periodo->per_nombre}} - {{$tutorproyecto->oferta->curso->seccion->sec_nombre}} - {{$tutorproyecto->oferta->curso->cur_nombre}} {{$tutorproyecto->oferta->curso->cur_paralelo}} - {{$tutorproyecto->personal->pers_nombres}} {{$tutorproyecto->personal->pers_apellidos}}</option>
                        @endif
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                <input name ="proy_id" type="hidden" value ="{{old('proy_id', $proyescolar->proy_id)}}">
                  <label>Periodo - Seccion - Curso - Alumno: *</label>
                  <select name="mat_id" id="mat_id" type='text' class="form-control @error('mat_id') is-invalid @enderror" value="{{$proyescolar->mat_id}}" required autocomplete="mat_id">
                      @foreach($matriculas as $matricula)
                        @if($matricula->mat_estado == 1)
                          <option value="{{$matricula->mat_id}}" {{ $matricula->mat_id == $proyescolar->mat_id ? 'selected':''}}>{{$matricula->oferta->periodo->per_nombre}} - {{$matricula->oferta->curso->seccion->sec_nombre}} - {{$matricula->oferta->curso->cur_nombre}} {{$matricula->oferta->curso->cur_paralelo}} - {{$matricula->alumno->alum_nombres}} {{$matricula->alumno->alum_apellidos}}</option>
                        @endif
                      @endforeach
                  </select>    
                </div>
                <div class="form-group">
                  <input name ="proy_id" type="hidden" value ="{{old('proy_id', $proyescolar->proy_id)}}">
                  <label for="proy_estado">Estado: *</label>
                  <select name="proy_estado" id="proy_estado" type='text' class="form-control @error('proy_estado') is-invalid @enderror" value="{{$proyescolar->proy_estado}}" required autocomplete="proy_estado">
                    <option value="1" {{$proyescolar->proy_estado == '1' ? 'selected':''}}>Activado</option>
                    <option value="0" {{$proyescolar->proy_estado == '0' ? 'selected':''}}>Desactivado</option>
                  </select>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                  Guardar
                  <i class="fas fa-save"></i>
                </button>
                <a href="{{url('secretario/proyectoescolar/seleccionlista/controlasignacion', ['tutproy_id' => $proyescolar->tutorproyecto->tutproy_id])}}">
                  <button type="button" class="btn btn-warning center-block">
                    Regresar
                    <i class="fas fa-arrow-left"></i>
                  </button>
                </a>
                <a href="{{url('secretario/proyectoescolar/seleccionlista', ['ofer_id' => $proyescolar->tutorproyecto->oferta->ofer_id])}}">
                  <button type="button" class="btn btn-success center-block">
                    Volver al menu de seleccion de lista
                    <i class="fas fa-list"></i>
                  </button>
                </a>
                <a href="{{url('secretario/proyectoescolar/index')}}">
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