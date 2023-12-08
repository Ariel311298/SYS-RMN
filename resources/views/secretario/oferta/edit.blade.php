@extends('backend.app')

@section('title')
Modulo Secretario - Editar Oferta
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) - Secretario/a - Editar Oferta -->
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Modulo Secretario/a - Editar Oferta</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Secretario/a - Editar Oferta -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Editar Oferta</h3>
              </div>
              <!-- /.card-header -->
              
              <!-- form start -->
                <div class="card-body">
                <form method="POST" action="{{url('secretario/oferta/update')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                  <input name ="ofer_id" type="hidden" value ="{{old('ofer_id', $oferta->ofer_id)}}">
                    <label for="per_id">Periodo: *</label>
                    <select name="per_id" id="per_id" type='text' class="form-control @error('per_id') is-invalid @enderror" value="{{$oferta->per_id}}" required autocomplete="per_id">
                        @foreach($periodos as $periodo)
                          @if($periodo->per_estado == 1)     
                            <option value="{{$periodo->per_id}}" {{ $periodo->per_id == $oferta->per_id ? 'selected':''}}>{{$periodo->per_nombre}}</option>
                          @endif    
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <input name ="ofer_id" type="hidden" value ="{{old('ofer_id', $oferta->ofer_id)}}">
                    <label>Curso: *</label>
                    <select name="cur_id" id="cur_id" type='text' class="form-control @error('cur_id') is-invalid @enderror" value="{{$oferta->cur_id}}" required autocomplete="cur_id">
                        @foreach($cursos as $curso)
                          @if($curso->cur_estado == 1)
                            <option value="{{$curso->cur_id}}" {{ $curso->cur_id == $oferta->cur_id ? 'selected':''}}>{{$curso->cur_nombre}} - {{$curso->cur_paralelo}}</option>
                          @endif 
                        @endforeach
                    </select>    
                  </div>
                  <div class="form-group">
                    <input name ="ofer_id" type="hidden" value ="{{old('ofer_id', $oferta->ofer_id)}}">
                    <label for="pers_id">Personal: *</label>
                    <select name="pers_id" id="pers_id" type='text' class="form-control @error('pers_id') is-invalid @enderror" value="{{$oferta->pers_id}}" required autocomplete="pers_id">
                        @foreach($personales as $personal)
                          @if($personal->pers_estado == 1)
                            <option value="{{$personal->pers_id}}" {{ $personal->pers_id == $oferta->pers_id ? 'selected':''}}>{{$personal->pers_nombres}} {{$personal->pers_apellidos}}</option>
                          @endif
                        @endforeach
                    </select> 
                  </div>
                  <div class="form-group">
                    <input name ="ofer_id" type="hidden" value ="{{old('ofer_id', $oferta->ofer_id)}}">
                    <label for="ofer_estado">Estado: *</label>
                    <select name="ofer_estado" id="ofer_estado" type='text' class="form-control @error('ofer_estado') is-invalid @enderror" value="{{$oferta->ofer_estado}}" required autocomplete="ofer_estado">
                      <option value="1" {{$oferta->ofer_estado == '1' ? 'selected':''}}>Activado</option>
                      <option value="0" {{$oferta->ofer_estado == '0' ? 'selected':''}}>Desactivado</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">
                    Guardar
                    <i class="fas fa-save"></i>
                  </button>
                  <a href="/secretario/oferta/index">
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