@extends('backend.app')

@section('title')
Modulo Secretario - Gestionar Asignaciones - Asignar a la Lista de Calificaciones del Comportamiento
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) - Modulo Secretario/a - Gestionar Asignaciones - Asignar a la Lista de Calificaciones del Comportamiento -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Modulo Secretario/a - Gestionar Asignaciones - Asignar a la Lista de Calificaciones del Comportamiento</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Modulo Secretario/a - Gestionar Asignaciones - Asignar a la Lista de Calificaciones del Comportamiento -->

    <!-- Main content -->
    <section class="content">
        <div class="card">  
            <div class="card-header">
                <h3 class="card-title">Asignar a la Lista de Calificaciones del Comportamiento - Periodo: {{$ofertas->periodo->per_nombre}} - Seccion: {{$ofertas->curso->seccion->sec_nombre}} - Curso: {{$ofertas->curso->cur_nombre}} {{$ofertas->curso->cur_paralelo}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="overflow:scroll;">
                <form method="POST" action="{{url('secretario/comportamiento/store')}}" enctype="multipart/form-data">
                    @csrf  
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr align="center">
                                <th>Periodo - Seccion - Curso - Paralelo</th>
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
                                        <input type="hidden" class="form-control @error('ofer_id') is-invalid @enderror" readonly="readonly" value="{{$ofertas->ofer_id}}" name="ofer_id[]" required autocomplete="ofer_id">{{$ofertas->periodo->per_nombre}} - {{$ofertas->curso->seccion->sec_nombre}} - {{$ofertas->curso->cur_nombre}} {{$ofertas->curso->cur_paralelo}}
                                    </td>
                                    <td>
                                        <input type="hidden" class="form-control @error('mat_id') is-invalid @enderror" readonly="readonly" value="{{$estudiante->mat_id}}" name="mat_id[]" required autocomplete="mat_id">{{$estudiante->alumno->alum_nombres}} {{$estudiante->alumno->alum_apellidos}}
                                    </td>
                                    <td>
                                        <select name="cond_estado[]" class="form-control @error('cond_estado') is-invalid @enderror" id="cond_estado" value="{{ old('cond_estado') }}" required autocomplete="cond_estado">
                                            <option value="1" {{ old('cond_estado') == '1' ? 'selected':''}}>Activo</option>
                                            <option value="0" {{ old('cond_estado') == '0' ? 'selected':''}}>Inactivo</option>
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
                    <a href="/secretario/comportamiento/index">
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