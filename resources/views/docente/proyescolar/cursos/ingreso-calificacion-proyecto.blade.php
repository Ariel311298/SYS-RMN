@extends('backend.app')

@section('title')
Modulo Docente - Ingreso de Calificaciones (Proyecto Escolar) - {{$tutproyecto->oferta->periodo->per_nombre}} - {{$tutproyecto->oferta->curso->seccion->sec_nombre}} - {{$tutproyecto->oferta->curso->cur_nombre}} {{$tutproyecto->oferta->curso->cur_paralelo}}
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) - Modulo Docente - Ingreso de Calificaciones (Proyecto Escolar) -->
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Ingreso de Calificaciones (Proyecto Escolar) </h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header - Modulo Docente - Ingreso de Calificaciones (Proyecto Escolar) -->

  <!-- Main content -->
  <section class="content">
    <div class="card">  
        <div class="card-header">
            <h3 class="card-title">Periodo: {{$tutproyecto->oferta->periodo->per_nombre}} / Seccion: {{$tutproyecto->oferta->curso->seccion->sec_nombre}} / Curso: {{$tutproyecto->oferta->curso->cur_nombre}} {{$tutproyecto->oferta->curso->cur_paralelo}}</h3> 
        </div>

        <!-- /.card-header -->
    
        <div class="card-body" style="overflow:scroll;">
            <form method="POST" action="{{url('docente/proyescolar/cursos/ingreso-calificacion-proyecto/save')}}" enctype="multipart/form-data">
            @csrf  
            <table id="example1" class="display table table-bordered table-striped">
                <thead>
                    <tr align="center">
                        <th scope="col">Curso</th>
                        <th scope="col">Nombres y Apellidos</th>
                        <th scope="col">Prom. Parc 1</th>
                        <th scope="col">Prom. Parc 2</th>
                        <th scope="col">Prom.Q1</th>
                        <th scope="col">Prom. Parc 1</th>
                        <th scope="col">Prom. Parc 2</th>
                        <th scope="col">Prom.Q2</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($proyescolares as $proyescolar)
                    @if($proyescolar->proy_estado == 1)                          
                    <tr align="center" class="multiCalc">
                        <td style="min-width: 100px;">
                            <input type="hidden" class="form-control @error('tutproy_id') is-invalid @enderror" name="proyescolares[{{ $proyescolar->proy_id }}][tutproy_id]" readonly="readonly" value="{{$proyescolar->tutproy_id}}" style="text-align:center;" required>
                            {{$proyescolar->tutorproyecto->oferta->curso->cur_nombre}} {{$proyescolar->tutorproyecto->oferta->curso->cur_paralelo}}                                                                                          
                        </td>
                        <td style="min-width: 200px;">
                            <input type="hidden" class="form-control @error('mat_id') is-invalid @enderror" name="proyescolares[{{ $proyescolar->proy_id }}][mat_id]" readonly="readonly" value="{{$proyescolar->mat_id}}" style="text-align:center;" required>

                            {{$proyescolar->matricula->alumno->alum_nombres}} {{$proyescolar->matricula->alumno->alum_apellidos}}
                        </td>
                        <td style="min-width: 100px;"> 
                            @if($proyescolar->proy_prom_parcialP1Q1)    
                                <input type="text" id="proy_prom_parcialP1Q1" class="proy_prom_parcialP1Q1 form-control @error('proy_prom_parcialP1Q1') is-invalid @enderror" name="proyescolares[{{ $proyescolar->proy_id }}][proy_prom_parcialP1Q1]" value="{{$proyescolar->proy_prom_parcialP1Q1}}" style="text-align:center;"> 
                            @else
                                <input type="text" id="proy_prom_parcialP1Q1" class="proy_prom_parcialP1Q1 form-control @error('proy_prom_parcialP1Q1') is-invalid @enderror" name="proyescolares[{{ $proyescolar->proy_id }}][proy_prom_parcialP1Q1]" value="R" style="text-align:center;">  
                            @endif
                        </td>
                        <td style="min-width: 100px;">   
                            @if($proyescolar->proy_prom_parcialP2Q1)    
                                <input type="text" id="proy_prom_parcialP2Q1" class="proy_prom_parcialP2Q1 form-control @error('proy_prom_parcialP2Q1') is-invalid @enderror" name="proyescolares[{{ $proyescolar->proy_id }}][proy_prom_parcialP2Q1]" value="{{$proyescolar->proy_prom_parcialP2Q1}}" style="text-align:center;"> 
                            @else
                                <input type="text" id="proy_prom_parcialP2Q1" class="proy_prom_parcialP2Q1 form-control @error('proy_prom_parcialP2Q1') is-invalid @enderror" name="proyescolares[{{ $proyescolar->proy_id }}][proy_prom_parcialP2Q1]" value="R" style="text-align:center;">  
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($proyescolar->proy_promTotalQ1)    
                                <input type="text" id="proy_promTotalQ1" readonly="readonly" class="proy_promTotalQ1 form-control @error('proy_promTotalQ1') is-invalid @enderror" name="proyescolares[{{ $proyescolar->proy_id }}][proy_promTotalQ1]" value="{{$proyescolar->proy_promTotalQ1}}" style="text-align:center;"> 
                            @else
                                <input type="text" id="proy_promTotalQ1" readonly="readonly" class="proy_promTotalQ1 form-control @error('proy_promTotalQ1') is-invalid @enderror" name="proyescolares[{{ $proyescolar->proy_id }}][proy_promTotalQ1]" value="R" style="text-align:center;">
                            @endif
                        </td>
                        <td style="min-width: 100px;"> 
                            @if($proyescolar->proy_prom_parcialP1Q2)    
                                <input type="text" id="proy_prom_parcialP1Q2" class="proy_prom_parcialP1Q2 form-control @error('proy_prom_parcialP1Q2') is-invalid @enderror" name="proyescolares[{{ $proyescolar->proy_id }}][proy_prom_parcialP1Q2]" value="{{$proyescolar->proy_prom_parcialP1Q2}}" style="text-align:center;"> 
                            @else
                                <input type="text" id="proy_prom_parcialP1Q2" class="proy_prom_parcialP1Q2 form-control @error('proy_prom_parcialP1Q2') is-invalid @enderror" name="proyescolares[{{ $proyescolar->proy_id }}][proy_prom_parcialP1Q2]" value="R" style="text-align:center;">  
                            @endif
                        </td>
                        <td style="min-width: 100px;"> 
                            @if($proyescolar->proy_prom_parcialP2Q2)    
                                <input type="text" id="proy_prom_parcialP2Q2" class="proy_prom_parcialP2Q2 form-control @error('proy_prom_parcialP2Q2') is-invalid @enderror" name="proyescolares[{{ $proyescolar->proy_id }}][proy_prom_parcialP2Q2]" value="{{$proyescolar->proy_prom_parcialP2Q2}}" style="text-align:center;"> 
                            @else
                                <input type="text" id="proy_prom_parcialP2Q2" class="proy_prom_parcialP2Q2 form-control @error('proy_prom_parcialP2Q2') is-invalid @enderror" name="proyescolares[{{ $proyescolar->proy_id }}][proy_prom_parcialP2Q2]" value="R" style="text-align:center;">  
                            @endif
                        </td>
                        <td style="min-width: 100px;">
                            @if($proyescolar->proy_promTotalQ2)    
                                <input type="text" id="proy_promTotalQ2" readonly="readonly" class="proy_promTotalQ2 form-control @error('proy_promTotalQ2') is-invalid @enderror" name="proyescolares[{{ $proyescolar->proy_id }}][proy_promTotalQ2]" value="{{$proyescolar->proy_promTotalQ2}}" style="text-align:center;"> 
                            @else
                                <input type="text" id="proy_promTotalQ2" readonly="readonly" class="proy_promTotalQ2 form-control @error('proy_promTotalQ2') is-invalid @enderror" name="proyescolares[{{ $proyescolar->proy_id }}][proy_promTotalQ2]" value="R" style="text-align:center;">
                            @endif
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
                <a href="{{url('docente/proyescolar/cursos', ['pers_id' => $tutproyecto->pers_id])}}">
                    <button type="button" class="btn btn-warning center-block">
                        Regresar
                        <i class="fas fa-arrow-left"></i>
                    </button>
                </a>
            </div>
        </form> 
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('js')
<!-- Page specific script -->
<script>
$(document).ready(function () {
    $(".multiCalc input").keyup(multInputs);
    function multInputs() {   
        $("tr.multiCalc").each(function () {   
            var proy_prom_parcialP1Q1 = $('.proy_prom_parcialP1Q1',this).val();
            var proy_prom_parcialP2Q1 = $('.proy_prom_parcialP2Q1',this).val();
            
            var valueproypromQ1; 

            if(proy_prom_parcialP1Q1 == "EX" && proy_prom_parcialP2Q1 == "EX"){
                valueproypromQ1 = "EX";
            }else if(proy_prom_parcialP1Q1 == "EX" && proy_prom_parcialP2Q1 == "MB"){
                valueproypromQ1 = "MB";
            }else if(proy_prom_parcialP1Q1 == "EX" && proy_prom_parcialP2Q1 == "B"){
                valueproypromQ1 = "MB";
            }else if(proy_prom_parcialP1Q1 == "EX" && proy_prom_parcialP2Q1 == "R"){
                valueproypromQ1 = "B";
            }else if(proy_prom_parcialP1Q1 == "MB" && proy_prom_parcialP2Q1 == "EX"){
                valueproypromQ1 = "MB";
            }else if(proy_prom_parcialP1Q1 == "MB" && proy_prom_parcialP2Q1 == "MB"){
                valueproypromQ1 = "MB";
            }else if(proy_prom_parcialP1Q1 == "MB" && proy_prom_parcialP2Q1 == "B"){
                valueproypromQ1 = "B";
            }else if(proy_prom_parcialP1Q1 == "MB" && proy_prom_parcialP2Q1 == "R"){
                valueproypromQ1 = "B";
            }else if(proy_prom_parcialP1Q1 == "B" && proy_prom_parcialP2Q1 == "EX"){
                valueproypromQ1 = "MB";
            }else if(proy_prom_parcialP1Q1 == "B" && proy_prom_parcialP2Q1 == "MB"){
                valueproypromQ1 = "B";
            }else if(proy_prom_parcialP1Q1 == "B" && proy_prom_parcialP2Q1 == "B"){
                valueproypromQ1 = "B";
            }else if(proy_prom_parcialP1Q1 == "B" && proy_prom_parcialP2Q1 == "R"){
                valueproypromQ1 = "R";
            }else if(proy_prom_parcialP1Q1 == "R" && proy_prom_parcialP2Q1 == "EX"){
                valueproypromQ1 = "B";
            }else if(proy_prom_parcialP1Q1 == "R" && proy_prom_parcialP2Q1 == "MB"){
                valueproypromQ1 = "B";
            }else if(proy_prom_parcialP1Q1 == "R" && proy_prom_parcialP2Q1 == "B"){
                valueproypromQ1 = "R";
            }else if(proy_prom_parcialP1Q1 == "R" && proy_prom_parcialP2Q1 == "R"){
                valueproypromQ1 = "R";
            }else{
                valueproypromQ1 = "Valor no valido";
            }

            $('.proy_promTotalQ1',this).val(valueproypromQ1);

            var proy_prom_parcialP1Q2 = $('.proy_prom_parcialP1Q2',this).val();
            var proy_prom_parcialP2Q2 = $('.proy_prom_parcialP2Q2',this).val();
            
            var valueproypromQ2;
            
            if(proy_prom_parcialP1Q2 == "EX" && proy_prom_parcialP2Q2 == "EX"){
                valueproypromQ2 = "EX";
            }else if(proy_prom_parcialP1Q2 == "EX" && proy_prom_parcialP2Q2 == "MB"){
                valueproypromQ2 = "MB";
            }else if(proy_prom_parcialP1Q2 == "EX" && proy_prom_parcialP2Q2 == "B"){
                valueproypromQ2 = "MB";
            }else if(proy_prom_parcialP1Q2 == "EX" && proy_prom_parcialP2Q2 == "R"){
                valueproypromQ2 = "B";
            }else if(proy_prom_parcialP1Q2 == "MB" && proy_prom_parcialP2Q2 == "EX"){
                valueproypromQ2 = "MB";
            }else if(proy_prom_parcialP1Q2 == "MB" && proy_prom_parcialP2Q2 == "MB"){
                valueproypromQ2 = "MB";
            }else if(proy_prom_parcialP1Q2 == "MB" && proy_prom_parcialP2Q2 == "B"){
                valueproypromQ2 = "B";
            }else if(proy_prom_parcialP1Q2 == "MB" && proy_prom_parcialP2Q2 == "R"){
                valueproypromQ2 = "B";
            }else if(proy_prom_parcialP1Q2 == "B" && proy_prom_parcialP2Q2 == "EX"){
                valueproypromQ2 = "MB";
            }else if(proy_prom_parcialP1Q2 == "B" && proy_prom_parcialP2Q2 == "MB"){
                valueproypromQ2 = "B";
            }else if(proy_prom_parcialP1Q2 == "B" && proy_prom_parcialP2Q2 == "B"){
                valueproypromQ2 = "B";
            }else if(proy_prom_parcialP1Q2 == "B" && proy_prom_parcialP2Q2 == "R"){
                valueproypromQ2 = "R";
            }else if(proy_prom_parcialP1Q2 == "R" && proy_prom_parcialP2Q2 == "EX"){
                valueproypromQ2 = "B";
            }else if(proy_prom_parcialP1Q2 == "R" && proy_prom_parcialP2Q2 == "MB"){
                valueproypromQ2 = "B";
            }else if(proy_prom_parcialP1Q2 == "R" && proy_prom_parcialP2Q2 == "B"){
                valueproypromQ2 = "R";
            }else if(proy_prom_parcialP1Q2 == "R" && proy_prom_parcialP2Q2 == "R"){
                valueproypromQ2 = "R";
            }else{
                valueproypromQ2 = "Valor no valido";
            }

            $('.proy_promTotalQ2',this).val(valueproypromQ2);
        });         
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
