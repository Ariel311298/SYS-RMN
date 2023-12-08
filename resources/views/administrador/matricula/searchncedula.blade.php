@extends('backend.app')

@section('title')
Modulo Administrador - Buscar Alumno
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) - Administrador/a - Buscar Alumno -->
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Modulo Administrador/a - Buscar Alumno</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Administrador/a - Buscar Alumno -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Buscar Alumno</h3>
              </div>
              <!-- /.card-header -->
              
              <!-- form start -->
                <div class="card-body">
                <form action="{{ url('administrador/matricula/searchcedula') }}" method="POST">
                  @csrf
                  <div class="form-group">
                    <label for="alum_ncedula">Buscar: *</label>
                      <div class="form-group">
                        <input id="alum_ncedula" class="form-control" name="alum_ncedula" type="text" value="{{ old('alum_ncedula') }}" placeholder="Ingrese el número de cedula o solo los nombres o solo los apellidos del alumno.">
                      </div>
                    <input class="btn btn-info" type="submit" value="Buscar">
                    <br>
                    <br>
                    <p>Nota: Solo se debe ingresar el número de cedula del alumno o solo los nombres del alumno en caso de buscar con el nombre o solo con los apellidos en caso de buscar con el mismo para acceder al formulario de la matricula.</p>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <a href="/administrador/matricula/index">
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