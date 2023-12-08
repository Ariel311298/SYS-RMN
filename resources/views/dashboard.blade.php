@extends('backend.error')

@section('title')
Error al ingreso del sistema - SYS-RMN
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) - Administrador/a -->
    @if(auth()->user()->rol_id == '1')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
           
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    @endif
    <!-- /.content-header - Administrador/a -->

    <!-- Content Header (Page header) - Secretario/a -->
    @if(auth()->user()->rol_id == '2')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    @endif
    <!-- /.content-header - Secretario/a -->

    <!-- Content Header (Page header) - Docente -->
    @if(auth()->user()->rol_id == '3')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    @endif
    <!-- /.content-header - Docente -->

    <!-- Content Header (Page header) - Rector/a -->
    @if(auth()->user()->rol_id == '4')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
           
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    @endif
    <!-- /.content-header - Rector/a -->

    <!-- Content Header (Page header) - Alumno/a -->
    @if(auth()->user()->rol_id == '5')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    @endif
    <!-- /.content-header - Alumno/a -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Error al ingresar al sistema</h5>

                <div class="card-tools">
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <p>Su cuenta ha sido desactivada. No podra utilizar el menu y opciones del sistema. Contactese con el administrador del sistema para rehabilitar el sistema.</p>  
                  </div>
                </div>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection