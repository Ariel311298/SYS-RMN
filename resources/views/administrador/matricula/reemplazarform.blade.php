@extends('backend.app')

@section('title')
Modulo Administrador - Reemplazar Matricula
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) - Administrador/a - Reemplazar Matricula -->
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Modulo Administrador/a - Reemplazar Matricula</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Administrador/a - Reemplazar Matricula -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Reemplazar Matricula por Cedula</h3>
              </div>
              <!-- /.card-header -->
              
              <!-- form start -->
                <div class="card-body">
                
                <form method="POST" action="{{url('administrador/matricula/replace')}}" enctype="multipart/form-data">
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
                    <label for="alum_id">Nombre y Apellido del Alumno: *</label>
                    <select name="alum_id" id="alum_id" type='text' class="form-control @error('alum_id') is-invalid @enderror" value="{{ old('alum_id')}}" required autocomplete="alum_id">
                      @foreach($alumno as $alm)
                        <option value="{{$alm->alum_id}}" {{ old('alum_id') == '$alm->alum_id' ? 'selected':''}}>{{$alm->alum_nombres}} {{$alm->alum_apellidos}}</option>
                      @endforeach
                    </select>
                    @error('alum_id')
                      <span class="invalid-feedback" role="alert">
                        <strong>Debe seleccionar un alumno o intentar una nueva busqueda.</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">
                    Actualizar
                    <i class="fas fa-edit"></i>
                  </button>
                  <a href="/administrador/matricula/table">
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