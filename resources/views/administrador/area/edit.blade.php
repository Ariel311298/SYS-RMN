@extends('backend.app')

@section('title')
Modulo Administrador - Editar Area
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) - Administrador/a - Editar Area -->
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Modulo Administrador/a - Editar Area</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Administrador/a - Editar Area -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Editar Area</h3>
              </div>
              <!-- /.card-header -->
              
              <!-- form start -->
                <div class="card-body">
                                  
                <form method="POST" action="{{url('administrador/area/update')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <input name ="area_id" type="hidden" value ="{{old('area_id', $area->area_id)}}">
                    <label for="area_nombre">Area: *</label>
                    <input type="text" 
                    name="area_nombre" class="form-control 
                    @error('area_nombre') is-invalid @enderror" 
                    value="{{$area->area_nombre}}"  
                    required autocomplete="area_nombre" 
                    id="area_nombre" placeholder="Ingrese el área de conocmiento" autofocus>
                    @error('area_nombre')
                      <span class="invalid-feedback" role="alert">
                          <strong>Debe ingresar minimo 5 caracteres, el maximo es de 100 caracteres. Solo puede ingresar letras.</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <input name ="area_id" type="hidden" value ="{{old('area_id', $area->area_id)}}">
                    <label for="area_estado">Estado: *</label>
                    <select name="area_estado" id="area_estado" type='text' class="form-control @error('area_estado') is-invalid @enderror" value="{{$area->area_estado}}" required autocomplete="area_estado">
                      <option value="1" {{$area->area_estado == '1' ? 'selected':''}}>Activado</option>
                      <option value="0" {{$area->area_estado == '0' ? 'selected':''}}>Desactivado</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">
                    Actualizar
                    <i class="fas fa-edit"></i>
                  </button>
                  <a href="/administrador/area/index">
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