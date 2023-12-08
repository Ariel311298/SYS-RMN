@extends('backend.app')

@section('title')
Modulo Administrador - Reemplazar Asignacion (Comportamiento)
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Content Header (Page header) - Administrador/a - Reemplazar Asignacion (Comportamiento) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Modulo Administrador/a - Reemplazar Asignacion (Comportamiento)</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header - Administrador/a - Reemplazar Asignacion (Comportamiento) -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title"> Reemplazar Asignacion (Comportamiento)</h3> 
            </div>
            <!-- /.card-header -->
            
            <!-- form start -->
              <div class="card-body">
              <form method="POST" action="{{url('administrador/comportamiento/controlasignacion/update')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input name ="cond_id" type="hidden" value ="{{old('cond_id', $comportamiento->cond_id)}}">
                    <label>Curso Asignado Actual:</label>
                    {{$comportamiento->oferta->periodo->per_nombre}} - {{$comportamiento->oferta->curso->seccion->sec_nombre}} - {{$comportamiento->oferta->curso->cur_nombre}} {{$comportamiento->oferta->curso->cur_paralelo}} - {{$comportamiento->oferta->personal->pers_nombres}} {{$comportamiento->oferta->personal->pers_apellidos}}
                </div>
                <div class="form-group">
                <input name ="cond_id" type="hidden" value ="{{old('cond_id', $comportamiento->cond_id)}}">
                  <label for="ofer_id">Periodo - Seccion - Curso: *</label>
                  <select name="ofer_id" id="ofer_id" type='text' class="form-control @error('ofer_id') is-invalid @enderror" value="{{$comportamiento->ofer_id}}" required autocomplete="ofer_id">
                      @foreach($ofertas as $oferta)
                        @if($oferta->ofer_estado == 1)  
                          <option value="{{$oferta->ofer_id}}" {{ $oferta->ofer_id == $comportamiento->ofer_id ? 'selected':''}}>{{$oferta->periodo->per_nombre}} - {{$oferta->curso->seccion->sec_nombre}} - {{$oferta->curso->cur_nombre}} {{$oferta->curso->cur_paralelo}} - {{$oferta->personal->pers_nombres}} {{$oferta->personal->pers_apellidos}}</option>
                        @endif
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <input name ="cond_id" type="hidden" value ="{{old('cond_id', $comportamiento->cond_id)}}">
                  <label>Periodo - Seccion - Curso - Alumno: *</label>
                  <select name="mat_id" id="mat_id" type='text' class="form-control @error('mat_id') is-invalid @enderror" value="{{$comportamiento->mat_id}}" required autocomplete="mat_id">
                      @foreach($matriculas as $matricula)
                        @if($matricula->mat_estado == 1) 
                          <option value="{{$matricula->mat_id}}" {{ $matricula->mat_id == $comportamiento->mat_id ? 'selected':''}}>{{$matricula->oferta->periodo->per_nombre}} - {{$matricula->oferta->curso->seccion->sec_nombre}} - {{$matricula->oferta->curso->cur_nombre}} {{$matricula->oferta->curso->cur_paralelo}} - {{$matricula->alumno->alum_nombres}} {{$matricula->alumno->alum_apellidos}}</option>
                        @endif
                      @endforeach
                  </select>    
                </div>
                <div class="form-group">
                  <input name ="cond_id" type="hidden" value ="{{old('cond_id', $comportamiento->cond_id)}}">
                  <label for="cond_estado">Estado: *</label>
                  <select name="cond_estado" id="cond_estado" type='text' class="form-control @error('cond_estado') is-invalid @enderror" value="{{$comportamiento->cond_estado}}" required autocomplete="cond_estado">
                    <option value="1" {{$comportamiento->cond_estado == '1' ? 'selected':''}}>Activado</option>
                    <option value="0" {{$comportamiento->cond_estado == '0' ? 'selected':''}}>Desactivado</option>
                  </select>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                  Guardar
                  <i class="fas fa-save"></i>
                </button>
                <a href="{{url('administrador/comportamiento/controlasignacion', ['ofer_id' => $comportamiento->oferta->ofer_id])}}">
                  <button type="button" class="btn btn-warning center-block">
                    Regresar
                    <i class="fas fa-arrow-left"></i>
                  </button>
                </a>
                <a href="{{url('administrador/comportamiento/index')}}">
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