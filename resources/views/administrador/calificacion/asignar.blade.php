@extends('backend.app')

@section('title')
Modulo Administrador - Gestionar Asignaciones - Asignar Asignaturas (Calificaciones)
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) - Modulo Administrador/a - Gestionar Asignaciones - Asignar Asignaturas (Calificaciones) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Modulo Administrador/a - Gestionar Asignaciones - Asignar Asignaturas (Calificaciones)</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Modulo Administrador/a - Gestionar Asignaciones - Asignar Asignaturas (Calificaciones) -->

    <!-- Main content -->
    <section class="content">
        <div class="card">  
            <div class="card-header">
                <h3 class="card-title">Asignar Asignaturas - Periodo: {{$oferta->periodo->per_nombre}} - Seccion: {{$oferta->curso->seccion->sec_nombre}} - Curso: {{$oferta->curso->cur_nombre}} {{$oferta->curso->cur_paralelo}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="overflow:scroll;">
                <form method="POST" action="{{url('administrador/calificacion/store')}}" enctype="multipart/form-data">
                    @csrf  
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr align="center">
                                <th>Periodo - Seccion - Curso - Paralelo - Area - Asignatura</th>
                                <th>Nombres y Apellidos</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($estudiantes as $estudiante) 
                                @if($estudiante->mat_estado == 1)
                                    <tr align="center">
                                        <td>
                                            <select name="mal_id[]" class="form-control @error('mal_id') is-invalid @enderror" id="mal_id" value="{{ old('mal_id') }}" required autocomplete="mal_id">
                                            @foreach($materias as $materia)
                                                @if($materia->mal_estado == 1)
                                                    <option value="{{$materia->mal_id}}" {{ old('mal_id') == '$materia->mal_id' ? 'selected':''}}>{{$materia->oferta->periodo->per_nombre}} - {{$materia->oferta->curso->seccion->sec_nombre}} - {{$materia->oferta->curso->cur_nombre}} {{$materia->oferta->curso->cur_paralelo}} - {{$materia->asignatura->area->area_nombre}} - {{$materia->asignatura->asig_nom}}</option>
                                                @endif
                                            @endforeach
                                            </select>    
                                        </td>
                                        <td>
                                            <input type="hidden" class="form-control @error('mat_id') is-invalid @enderror" readonly="readonly" value="{{$estudiante->mat_id}}" name="mat_id[]" required autocomplete="mat_id">{{$estudiante->alumno->alum_nombres}} {{$estudiante->alumno->alum_apellidos}}      
                                        </td>
                                        <td>
                                            <select name="cal_estado[]" class="form-control @error('cal_estado') is-invalid @enderror" id="cal_estado" value="{{ old('cal_estado') }}" required autocomplete="cal_estado">
                                                <option value="1" {{ old('cal_estado') == '1' ? 'selected':''}}>Activo</option>
                                                <option value="0" {{ old('cal_estado') == '0' ? 'selected':''}}>Inactivo</option>
                                            </select>                                                 
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-danger remove"><i class="fas fa-trash-alt"></i>
                                            </a>                    
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        Guardar
                        <i class="fas fa-save"></i>
                    </button>
                    <a href="/administrador/calificacion/index">
                        <button type="button" class="btn btn-danger center-block">
                        Regresar
                        <i class="fas fa-arrow-left"></i>
                        </button>
                    </a>
                </div>
            </form>
            <!-- /.form POST-->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('js')
<script>
    $('.remove').live('click',function(){
        var last=$('tbody tr').length;
        if(last==1){
            alert("No puede remover la ultima fila");
        }
        else{
            $(this).parent().parent().remove();
        }
    });
</script> 
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