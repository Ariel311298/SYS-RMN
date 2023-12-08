@extends('backend.app')

@section('title')
Modulo Administrador - Editar Asignacion 
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) - Administrador/a - Editar Asignacion -->
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Modulo Administrador/a - Editar Asignacion</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Administrador/a - Editar Asignacion -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <form action="{{ url('administrador/malla/searchdocente') }}" method="POST">
                  @csrf
                    <div class="form-group">
                    <input name ="mal_id" type="hidden" value ="{{old('mal_id', $malla->mal_id)}}">
                      <label for="pers_ncedula">Buscar: (Opcional)</label>
                        <div class="form-group">
                          <input id="pers_ncedula" class="form-control" name="pers_ncedula" type="text" value="{{ old('pers_ncedula') }}" placeholder="Ingrese el número de cedula o solo los nombres o solo los apellidos del docente.">
                        </div>
                      <input class="btn btn-info" type="submit" value="Buscar">
                      <br>
                    <br>
                    <p>Nota: Solo se debe ingresar el número de cedula del docente o solo los nombres del docente en caso de buscar con el nombre o solo con los apellidos en caso de buscar con el mismo para editar una asignacion a un docente que tenga una asignatura asignada, en caso de no encontrar el docente.</p>
                    </div>
                  </div>
                </form>  
              </div>
              <!-- /.card-header -->
              
              <!-- form start -->
                <div class="card-body">
                <form method="POST" action="{{url('administrador/malla/update')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                  <input name ="mal_id" type="hidden" value ="{{old('mal_id', $malla->mal_id)}}">
                    <label for="ofer_id">Curso: *</label>
                    <select name="ofer_id" id="ofer_id" type='text' class="form-control @error('ofer_id') is-invalid @enderror" value="{{$malla->ofer_id}}" required autocomplete="ofer_id">
                        @foreach($ofertas as $oferta)
                          @if($oferta->ofer_estado == 1)
                            <option value="{{$oferta->ofer_id}}" {{ $oferta->ofer_id == $malla->ofer_id ? 'selected':''}}>{{$oferta->periodo->per_nombre}} - {{$oferta->curso->seccion->sec_nombre}} - {{$oferta->curso->cur_nombre}} - {{$oferta->curso->cur_paralelo}} - {{$oferta->personal->pers_nombres}} {{$oferta->personal->pers_apellidos}}</option>
                          @endif
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <input name ="mal_id" type="hidden" value ="{{old('mal_id', $malla->mal_id)}}">
                    <label>Asignatura: *</label>
                    <select name="asig_id" id="asig_id" type='text' class="form-control @error('asig_id') is-invalid @enderror" value="{{$malla->asig_id}}" required autocomplete="asig_id">
                        @foreach($asignaturas as $asignatura)
                          @if($asignatura->asig_estado == 1)
                            <option value="{{$asignatura->asig_id}}" {{ $asignatura->asig_id == $malla->asig_id ? 'selected':''}}>{{$asignatura->curso->cur_nombre}} - {{$asignatura->curso->cur_paralelo}} - {{$asignatura->area->area_nombre}} - {{$asignatura->asig_nom}}</option>
                          @endif
                        @endforeach
                    </select>    
                  </div>
                  <div class="form-group">
                    <input name ="mal_id" type="hidden" value ="{{old('mal_id', $malla->mal_id)}}">
                    <label for="pers_id">Nombres y Apellidos: *</label>
                    <select name="pers_id" id="pers_id" type='text' class="form-control @error('pers_id') is-invalid @enderror" value="{{$malla->pers_id}}" required autocomplete="pers_id">
                        @foreach($personales as $personal)
                          @if($personal->pers_estado == 1)
                            <option value="{{$personal->pers_id}}" {{ $personal->pers_id == $malla->pers_id ? 'selected':''}}>{{$personal->pers_nombres}} {{$personal->pers_apellidos}}</option>
                          @endif 
                      @endforeach
                    </select> 
                  </div>
                  <div class="form-group">
                    <input name ="mal_id" type="hidden" value ="{{old('mal_id', $malla->mal_id)}}">
                    <label for="mal_estado">Estado: *</label>
                    <select name="mal_estado" id="mal_estado" type='text' class="form-control @error('mal_estado') is-invalid @enderror" value="{{$malla->mal_estado}}" required autocomplete="mal_estado">
                      <option value="1" {{$malla->mal_estado == '1' ? 'selected':''}}>Activado</option>
                      <option value="0" {{$malla->mal_estado == '0' ? 'selected':''}}>Desactivado</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">
                    Guardar
                    <i class="fas fa-save"></i>
                  </button>
                  <a href="{{url('administrador/malla/asignacion', ['ofer_id' => $malla->oferta->ofer_id])}}">
                    <button type="button" class="btn btn-warning center-block">
                      Regresar
                      <i class="fas fa-arrow-left"></i>
                    </button>
                  </a>
                  <a href="{{url('administrador/malla/index')}}">
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