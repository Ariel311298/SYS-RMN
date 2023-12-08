@extends('backend.app')

@section('title')
Modulo Administrador - Editar Asignacion (Tutor de Proyecto Escolar)
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) - Administrador/a - Editar Asignacion (Tutor de Proyecto Escolar) -->
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Modulo Administrador/a - Editar Asignacion (Tutor de Proyecto Escolar)</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Administrador/a - Editar Asignacion (Tutor de Proyecto Escolar) -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <form action="{{ url('administrador/tutorproyecto/searchdocente') }}" method="POST">
                  @csrf
                    <div class="form-group">
                      <input name ="tutproy_id" type="hidden" value ="{{old('tutproy_id', $tutorproyecto->tutproy_id)}}">
                      <label for="pers_ncedula">Buscar: (Opcional)</label>
                        <div class="form-group">
                          <input id="pers_ncedula" class="form-control" name="pers_ncedula" type="text" value="{{ old('pers_ncedula') }}" placeholder="Ingrese el número de cedula o solo los nombres o solo los apellidos del docente.">
                        </div>
                      <input class="btn btn-info" type="submit" value="Buscar">
                      <br>
                    <br>
                    <p>Nota: Solo se debe ingresar el número de cedula del docente o solo los nombres del docente en caso de buscar con el nombre o solo con los apellidos en caso de buscar con el mismo para editar una asignacion a un docente que este dirigiendo como tutor de proyecto escolar de un curso seleccionado, en caso de no encontrar el docente.</p>
                    </div>
                  </div>
                </form>  
              </div>
              <!-- /.card-header -->
              
              <!-- form start -->
                <div class="card-body">
                <form method="POST" action="{{url('administrador/tutorproyecto/update')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <input name ="tutproy_id" type="hidden" value ="{{old('tutproy_id', $tutorproyecto->tutproy_id)}}">
                    <label for="pers_id">Nombres y Apellidos: *</label>
                    <select name="pers_id" id="pers_id" type='text' class="form-control @error('pers_id') is-invalid @enderror" value="{{$tutorproyecto->pers_id}}" required autocomplete="pers_id">
                        @foreach($personales as $personal)
                          @if($personal->pers_estado == 1)
                            <option value="{{$personal->pers_id}}" {{ $personal->pers_id == $tutorproyecto->pers_id ? 'selected':''}}>{{$personal->pers_nombres}} {{$personal->pers_apellidos}}</option>
                          @endif
                        @endforeach
                    </select> 
                  </div>
                  <div class="form-group">
                  <input name ="tutproy_id" type="hidden" value ="{{old('tutproy_id', $tutorproyecto->tutproy_id)}}">
                    <label for="ofer_id">Curso: *</label>
                    <select name="ofer_id" id="ofer_id" type='text' class="form-control @error('ofer_id') is-invalid @enderror" value="{{$tutorproyecto->ofer_id}}" required autocomplete="ofer_id">
                        @foreach($ofertas as $oferta)
                          @if($oferta->ofer_estado == 1) 
                            <option value="{{$oferta->ofer_id}}" {{ $oferta->ofer_id == $tutorproyecto->ofer_id ? 'selected':''}}>{{$oferta->periodo->per_nombre}} - {{$oferta->curso->seccion->sec_nombre}} - {{$oferta->curso->cur_nombre}} - {{$oferta->curso->cur_paralelo}} - {{$oferta->personal->pers_nombres}} {{$oferta->personal->pers_apellidos}}</option>
                          @endif
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <input name ="tutproy_id" type="hidden" value ="{{old('tutproy_id', $tutorproyecto->tutproy_id)}}">
                    <label for="tutproy_estado">Estado: *</label>
                    <select name="tutproy_estado" id="tutproy_estado" type='text' class="form-control @error('tutproy_estado') is-invalid @enderror" value="{{$tutorproyecto->tutproy_estado}}" required autocomplete="tutproy_estado">
                      <option value="1" {{$tutorproyecto->tutproy_estado == '1' ? 'selected':''}}>Activado</option>
                      <option value="0" {{$tutorproyecto->tutproy_estado == '0' ? 'selected':''}}>Desactivado</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">
                    Guardar
                    <i class="fas fa-save"></i>
                  </button>
                  <a href="/administrador/tutorproyecto/index">
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