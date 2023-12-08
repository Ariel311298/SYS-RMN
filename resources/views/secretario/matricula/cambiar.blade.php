@extends('backend.app')

@section('title')
Modulo Secretario - Cambiar Paralelo
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) - Secretario/a - Cambiar Paralelo -->
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Modulo Secretario/a - Cambiar Paralelo</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Secretario/a - Cambiar Paralelo -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Cambiar Paralelo</h3>
              </div>
              <!-- /.card-header -->
              
              <!-- form start -->
                <div class="card-body">
                <form method="POST" action="{{url('secretario/matricula/change')}}" enctype="multipart/form-data">
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
                    <label>Alumno: *</label>
                    <input type="hidden" 
                    name="alum_id" class="form-control 
                    @error('alum_id') is-invalid @enderror" 
                    value="{{$matricula->alum_id}}"  
                    required autocomplete="alum_id" 
                    id="alum_id" placeholder="Registre el alumno para cambiar de curso" autofocus>
                    <p>{{$matricula->alumno->alum_nombres}} {{$matricula->alumno->alum_apellidos}}</p>
                  </div>
                  <div class="form-group">
                    <input name ="mat_id" type="hidden" value ="{{old('mat_id', $matricula->mat_id)}}">
                    <label for="mat_estado">Estado: *</label>
                    <select name="mat_estado" id="mat_estado" type='text' class="form-control @error('mat_estado') is-invalid @enderror" value="{{$matricula->mat_estado}}" required autocomplete="mat_estado">
                      <option value="1" {{$matricula->mat_estado == '1' ? 'selected':''}}>Activado</option>
                      <option value="0" {{$matricula->mat_estado == '0' ? 'selected':''}}>Desactivado</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">
                    Guardar
                    <i class="fas fa-save"></i>
                  </button>
                  <a href="/secretario/matricula/table">
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

@section('script')

@endsection