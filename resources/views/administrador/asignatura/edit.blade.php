@extends('backend.app')

@section('title')
Modulo Administrador - Editar Asignatura
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) - Administrador/a - Editar Asignatura -->
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Modulo Administrador/a - Editar Asignatura</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Administrador/a - Editar Asignatura -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Editar Asignatura</h3>
              </div>
              <!-- /.card-header -->
              
              <!-- form start -->
                <div class="card-body">
                <form method="POST" action="{{url('administrador/asignatura/update')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                  <input name ="asig_id" type="hidden" value ="{{old('asig_id', $asignatura->asig_id)}}">
                    <label for="area_id">Area: *</label>
                    <select name="area_id" id="area_id" type='text' class="form-control @error('area_id') is-invalid @enderror" value="{{$asignatura->area_id}}" required autocomplete="area_id">
                      @foreach($area as $ar)
                        @if($ar->area_estado == 1)  
                          <option value="{{$ar->area_id}}" {{ $ar->area_id == $asignatura->area_id ? 'selected':''}}>{{$ar->area_nombre}}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <input name ="asig_id" type="hidden" value ="{{old('asig_id', $asignatura->asig_id)}}">
                    <label>Curso: *</label>
                    <select name="cur_id" id="cur_id" type='text' class="form-control @error('cur_id') is-invalid @enderror" value="{{$asignatura->cur_id}}" required autocomplete="cur_id">
                        @foreach($curso as $cur)
                          @if($cur->cur_estado == 1)  
                            <option value="{{$cur->cur_id}}" {{ $cur->cur_id == $asignatura->cur_id ? 'selected':''}}>{{$cur->cur_nombre}} - {{$cur->cur_paralelo}}</option>
                          @endif
                        @endforeach
                    </select>    
                  </div>
                  <div class="form-group">
                    <input name ="asig_id" type="hidden" value ="{{old('asig_id', $asignatura->asig_id)}}">
                    <label for="asig_nom">Asginatura: *</label>
                    <input type="text" 
                    name="asig_nom" class="form-control 
                    @error('asig_nom') is-invalid @enderror" 
                    value="{{$asignatura->asig_nom}}"  
                    required autocomplete="asig_nom" 
                    id="asig_nom" placeholder="Ingrese la asignatura" autofocus>
                    @error('asig_nom')
                      <span class="invalid-feedback" role="alert">
                          <strong>Debe ingresar minimo 5 caracteres, el maximo es de 150 caracteres. Solo pueden ingresar letras.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <input name ="asig_id" type="hidden" value ="{{old('asig_id', $asignatura->asig_id)}}">
                    <label for="asig_estado">Estado: *</label>
                    <select name="asig_estado" id="asig_estado" type='text' class="form-control @error('asig_estado') is-invalid @enderror" value="{{$asignatura->asig_estado}}" required autocomplete="asig_estado">
                      <option value="1" {{$asignatura->asig_estado == '1' ? 'selected':''}}>Activado</option>
                      <option value="0" {{$asignatura->asig_estado == '0' ? 'selected':''}}>Desactivado</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">
                    Guardar
                    <i class="fas fa-save"></i>
                  </button>
                  <a href="/administrador/asignatura/index">
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