@extends('backend.app')

@section('title')
Modulo Administrador - Editar Curso
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) - Administrador/a - Editar Curso -->
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Modulo Administrador/a - Editar Curso</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Administrador/a - Editar Curso -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Editar Curso</h3>
              </div>
              <!-- /.card-header -->
              
              <!-- form start -->
                <div class="card-body">
                <form method="POST" action="{{url('administrador/curso/update')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="sec_id">Seccion Actual:</label>
                    <p>{{$curso->seccion->sec_nombre}}</p>
                  </div>
                  <div class="form-group">
                  <input name ="cur_id" type="hidden" value ="{{old('cur_id', $curso->cur_id)}}">
                    <label for="sec_id">Seccion: *</label>
                    <select name="sec_id" id="sec_id" type='text' class="form-control @error('sec_id') is-invalid @enderror" value="{{$curso->sec_id}}" required autocomplete="sec_id">
                        @foreach($seccion as $sec)
                            <option value="{{$sec->sec_id}}" {{ $sec->sec_id == $curso->sec_id ? 'selected':''}}>{{$sec->sec_nombre}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <input name ="cur_id" type="hidden" value ="{{old('cur_id', $curso->cur_id)}}">
                    <label>Nivel: *</label>
                    <select name="cur_nivel" id="cur_nivel" type='text' class="form-control @error('cur_nivel') is-invalid @enderror" value="{{$curso->cur_nivel}}" required autocomplete="cur_nivel" required>
                      <option value="Educación General Básica Elemental" {{ $curso->cur_nivel == 'Educación General Básica Elemental' ? 'selected':''}}>Educación General Básica Elemental</option>
                      <option value="Educación General Básica Media" {{ $curso->cur_nivel == 'Educación General Básica Media' ? 'selected':''}}>Educación General Básica Media</option>
                      <option value="Educación General Básica Superior" {{ $curso->cur_nivel == 'Educación General Básica Superior' ? 'selected':''}}>Educación General Básica Superior</option>
                      <option value="Bachillerato General Unificado" {{ $curso->cur_nivel == 'Bachillerato General Unificado' ? 'selected':''}}>Bachillerato General Unificado</option>
                    </select>         
                  </div>
                  <div class="form-group">
                    <input name ="cur_id" type="hidden" value ="{{old('cur_id', $curso->cur_id)}}">
                    <label for="cur_nombre">Curso: *</label>
                    <select name="cur_nombre" id="cur_nombre" type='text' class="form-control @error('cur_nombre') is-invalid @enderror" value="{{$curso->cur_nombre}}" required autocomplete="cur_nombre" required>
                      <option value="1°EGB" {{ $curso->cur_nombre == '1°EGB' ? 'selected':''}}>1°EGB</option>
                      <option value="2°EGB" {{ $curso->cur_nombre == '2°EGB' ? 'selected':''}}>2°EGB</option>
                      <option value="3°EGB" {{ $curso->cur_nombre == '3°EGB' ? 'selected':''}}>3°EGB</option>
                      <option value="4°EGB" {{ $curso->cur_nombre == '4°EGB' ? 'selected':''}}>4°EGB</option>
                      <option value="5°EGB" {{ $curso->cur_nombre == '5°EGB' ? 'selected':''}}>5°EGB</option>
                      <option value="6°EGB" {{ $curso->cur_nombre == '6°EGB' ? 'selected':''}}>6°EGB</option>
                      <option value="7°EGB" {{ $curso->cur_nombre == '7°EGB' ? 'selected':''}}>7°EGB</option>
                      <option value="8°EGB" {{ $curso->cur_nombre == '8°EGB' ? 'selected':''}}>8°EGB</option>
                      <option value="9°EGB" {{ $curso->cur_nombre == '9°EGB' ? 'selected':''}}>9°EGB</option>
                      <option value="10°EGB" {{ $curso->cur_nombre == '10°EGB' ? 'selected':''}}>10°EGB</option>
                      <option value="1°BGU" {{ $curso->cur_nombre == '1°BGU' ? 'selected':''}}>1°BGU</option>
                      <option value="2°BGU" {{ $curso->cur_nombre == '2°BGU' ? 'selected':''}}>2°BGU</option>
                      <option value="3°BGU" {{ $curso->cur_nombre == '3°BGU' ? 'selected':''}}>3°BGU</option>
                    </select>     
                  </div>
                  <div class="form-group">
                    <input name ="cur_id" type="hidden" value ="{{old('cur_id', $curso->cur_id)}}">
                    <label for="cur_paralelo">Paralelo: *</label>
                    <select name="cur_paralelo" id="cur_paralelo" type='text' class="form-control @error('cur_paralelo') is-invalid @enderror" value="{{$curso->cur_paralelo}}" required autocomplete="cur_paralelo" required>
                      <option value="A" {{ $curso->cur_paralelo == 'A' ? 'selected':''}}>A</option>
                      <option value="B" {{ $curso->cur_paralelo == 'B' ? 'selected':''}}>B</option>
                      <option value="C" {{ $curso->cur_paralelo == 'C' ? 'selected':''}}>C</option>
                      <option value="D" {{ $curso->cur_paralelo == 'D' ? 'selected':''}}>D</option>
                      <option value="E" {{ $curso->cur_paralelo == 'E' ? 'selected':''}}>E</option> 
                    </select>   
                  </div>                  
                  <div class="form-group">
                    <input name ="cur_id" type="hidden" value ="{{old('cur_id', $curso->cur_id)}}">
                    <label for="cur_estado">Estado: *</label>
                    <select name="cur_estado" id="cur_estado" type='text' class="form-control  @error('cur_estado') is-invalid @enderror" value="{{$curso->cur_estado}}" required autocomplete="cur_estado">
                      <option value="1" {{$curso->cur_estado == '1' ? 'selected':''}}>Activado</option>
                      <option value="0" {{$curso->cur_estado == '0' ? 'selected':''}}>Desactivado</option>
                    </select>
                  </div>
                  <p>Nota: Se debe seleccionar la misma seccion para mantener los datos almacenados relacionados a la seccion seleccionada.</p>  
                </div>    
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">
                    Guardar
                    <i class="fas fa-save"></i>
                  </button>
                  <a href="/administrador/curso/index">
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