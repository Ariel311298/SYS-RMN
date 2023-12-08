@extends('backend.app')

@section('title')
Modulo Administrador - Editar Periodo
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) - Administrador/a - Editar Periodo -->
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Modulo Administrador/a - Editar Periodo</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Administrador/a - Editar Periodo -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Editar Periodo</h3>
              </div>
              <!-- /.card-header -->
              
              <!-- form start -->
                <div class="card-body">
                                  
                <form method="POST" action="{{url('administrador/periodo/update')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <input name ="per_id" type="hidden" value ="{{old('per_id', $periodo->per_id)}}">
                    <label for="per_nombre">Periodo: *</label>
                    <input type="text" 
                    name="per_nombre" class="form-control 
                    @error('per_nombre') is-invalid @enderror" 
                    value="{{$periodo->per_nombre}}"  
                    required autocomplete="per_nombre" 
                    id="per_nombre"  placeholder="Ingrese el periodo" autofocus>
                    @error('per_nombre')
                      <span class="invalid-feedback" role="alert">
                          <strong>El periodo escrito esta invalido. El formato es el siguiente: XXXX - XXXX.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <input name ="per_id" type="hidden" value ="{{old('per_id', $periodo->per_id)}}">
                    <label for="per_fec_inicio">Fecha de Inicio: *</label>
                    <input type="date" name="per_fec_inicio" class="form-control
                    @error('per_fec_inicio') is-invalid @enderror" 
                    value="{{$periodo->per_fec_inicio->toDateString()}}"  
                    required autocomplete="per_fec_inicio" id="per_fec_inicio" autofocus>
                    @error('per_fec_inicio')
                      <span class="invalid-feedback" role="alert">
                        <strong>La fecha debe ser posterior a hoy.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <input name ="per_id" type="hidden" value ="{{old('per_id', $periodo->per_id)}}">
                    <label for="per_fec_fin">Fecha de Fin: *</label>
                    <input type="date" name="per_fec_fin" class="form-control
                    @error('per_fec_fin') is-invalid @enderror" 
                    value="{{$periodo->per_fec_fin->toDateString()}}"  
                    required autocomplete="per_fec_fin" id="per_fec_fin" autofocus>
                    @error('per_fec_fin')
                      <span class="invalid-feedback" role="alert">
                        <strong>La fecha debe ser posterior a hoy.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <input name ="per_id" type="hidden" value ="{{old('per_id', $periodo->per_id)}}">
                    <label for="pad_nivel">Estado: *</label>
                    <select name="per_estado" id="per_estado" type='text' class="form-control  @error('per_estado') is-invalid @enderror" value="{{$periodo->per_estado}}" required autocomplete="pad_nivel">
                      <option value="1" {{$periodo->per_estado == '1' ? 'selected':''}}>Activado</option>
                      <option value="0" {{$periodo->per_estado == '0' ? 'selected':''}}>Desactivado</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">
                    Actualizar
                    <i class="fas fa-edit"></i>
                  </button>
                  <a href="/administrador/periodo/index">
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