@extends('backend.app')

@section('title')
Modulo Docente - Ingreso de Calificaciones (Comportamiento) - {{$oferta->periodo->per_nombre}} - {{$oferta->curso->seccion->sec_nombre}} - {{$oferta->curso->cur_nombre}} {{$oferta->curso->cur_paralelo}}
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) - Modulo Docente - Ingreso de Calificaciones (Comportamiento) -->
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Ingreso de Calificaciones (Comportamiento) </h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header - Modulo Docente - Ingreso de Calificaciones (Comportamiento) -->

  <!-- Main content -->
  <section class="content">
    <div class="card">  
        <div class="card-header">
            <h3 class="card-title">Periodo: {{$oferta->periodo->per_nombre}} / Seccion: {{$oferta->curso->seccion->sec_nombre}} / Curso: {{$oferta->curso->cur_nombre}} {{$oferta->curso->cur_paralelo}}</h3> 
        </div>

        <!-- /.card-header -->
    
        <div class="card-body" style="overflow:scroll;">
            <form method="POST" action="{{url('docente/comportamiento/cursos/ingreso-comportamiento/save')}}" enctype="multipart/form-data">
            @csrf  
            <table id="example1" class="display table table-bordered table-striped">
                <thead>
                    <tr align="center">
                        <th scope="col">Curso</th>
                        <th scope="col">Nombres y Apellidos</th>
                        <th scope="col">Prom.Q1</th>
                        <th scope="col">Prom.Q2</th>
                        <th scope="col">Prom.Anual</th>
                        <th scope="col" style="min-width: 100px; display:none;"></th>
                        <th scope="col" style="min-width: 100px; display:none;"></th>
                        <th scope="col" style="min-width: 100px; display:none;"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($comportamientos as $comportamiento) 
                    @if($comportamiento->cond_estado == 1)    
                    <tr align="center" class="multiCalc">
                        <td style="min-width: 100px;">
                            <input type="hidden" class="form-control @error('ofer_id') is-invalid @enderror" name="comportamientos[{{ $comportamiento->cond_id }}][ofer_id]" readonly="readonly" value="{{$comportamiento->ofer_id}}" style="text-align:center;" required>
                            {{$comportamiento->oferta->curso->cur_nombre}} {{$comportamiento->oferta->curso->cur_paralelo}}                                                                                          
                        </td>
                        <td style="min-width: 200px;">
                            <input type="hidden" class="form-control @error('mat_id') is-invalid @enderror" name="comportamientos[{{ $comportamiento->cond_id }}][mat_id]" readonly="readonly" value="{{$comportamiento->mat_id}}" style="text-align:center;" required>
                            {{$comportamiento->matricula->alumno->alum_nombres}} {{$comportamiento->matricula->alumno->alum_apellidos}}
                        </td>
                        <td style="min-width: 100px;"> 
                        @if($comportamiento->cond_notaQ1)    
                            <input type="text" id="cond_notaQ1" class="cond_notaQ1 form-control @error('cond_notaQ1') is-invalid @enderror" name="comportamientos[{{ $comportamiento->cond_id }}][cond_notaQ1]" value="{{$comportamiento->cond_notaQ1}}" style="text-align:center;"> 
                        @else
                            <input type="text" id="cond_notaQ1" class="cond_notaQ1 form-control @error('cond_notaQ1') is-invalid @enderror" name="comportamientos[{{ $comportamiento->cond_id }}][cond_notaQ1]" value="D" style="text-align:center;"> 
                        @endif
                        </td>
                        <td style="min-width: 100px;">   
                        @if($comportamiento->cond_notaQ2)    
                            <input type="text" id="cond_notaQ2" class="cond_notaQ2 form-control @error('cond_notaQ2') is-invalid @enderror" name="comportamientos[{{ $comportamiento->cond_id }}][cond_notaQ2]" value="{{$comportamiento->cond_notaQ2}}" style="text-align:center;"> 
                        @else
                            <input type="text" id="cond_notaQ2" class="cond_notaQ2 form-control @error('cond_notaQ2') is-invalid @enderror" name="comportamientos[{{ $comportamiento->cond_id }}][cond_notaQ2]" value="D" style="text-align:center;"> 
                        @endif
                        </td>
                        <td style="min-width: 100px;">
                        @if($comportamiento->cond_notaAnual)    
                            <input type="text" id="cond_notaAnual" readonly="readonly" class="cond_notaAnual form-control @error('cond_notaAnual') is-invalid @enderror" name="comportamientos[{{ $comportamiento->cond_id }}][cond_notaAnual]" value="{{$comportamiento->cond_notaAnual}}" style="text-align:center;">
                        @else
                            <input type="text" id="cond_notaAnual" readonly="readonly" class="cond_notaAnual form-control @error('cond_notaAnual') is-invalid @enderror" name="comportamientos[{{ $comportamiento->cond_id }}][cond_notaAnual]" value="D" style="text-align:center;">
                        @endif
                        </td>
                        <td style="min-width: 100px; display:none;">
                            <input type="text" style="display:none;" id="cond_escalaQ1" class="cond_escalaQ1 form-control @error('cond_escalaQ1') is-invalid @enderror" name="comportamientos[{{ $comportamiento->cond_id }}][cond_escalaQ1]" value="{{$comportamiento->cond_escalaQ1}}" readonly="readonly" style="text-align:center;"> 
                        </td>
                        <td style="min-width: 100px; display:none;">
                            <input type="text" style="display:none;" id="cond_escalaQ2" readonly="readonly" class="cond_escalaQ2 form-control @error('cond_escalaQ2') is-invalid @enderror" name="comportamientos[{{ $comportamiento->cond_id }}][cond_escalaQ2]" value="{{$comportamiento->cond_escalaQ2}}" style="text-align:center;"> 
                        </td>
                        <td style="min-width: 100px; display:none;">
                            <input type="text" style="display:none;" id="cond_escalaAnual" readonly="readonly" class="cond_escalaAnual form-control @error('cond_escalaAnual') is-invalid @enderror" name="comportamientos[{{ $comportamiento->cond_id }}][cond_escalaAnual]" value="{{$comportamiento->cond_escalaAnual}}" style="text-align:center;">
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
                <a href="{{url('docente/comportamiento/cursos', ['pers_id' => $oferta->pers_id])}}">
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
    $(function () {
        $("#example1").DataTable({
            "responsive": false, "lengthChange": false, "autoWidth": false,
            "searching": false, "ordering": false, "paging": false, "info": false,
            "columnDefs": [
                {
                    target: 5,
                    visible: false,
                    searchable: false,
                },
                {
                    target: 6,
                    visible: false,
                },
            ],
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
});

$(document).ready(function () {
    $(".multiCalc input").keyup(multInputs);
    function multInputs() {   
        $("tr.multiCalc").each(function () {   
            var cond_notaQ1 = $('.cond_notaQ1',this).val();

            var valueescalaQ1; 

            if (cond_notaQ1 == "A")
            {
                valueescalaQ1 = "Lidera el cumplimiento de los compromisos establecidos para la sana convivencia social.";
            }
            else if (cond_notaQ1 == "B")
            {
                valueescalaQ1 = "Cumple con los compromisos establecidos para la sana convivencia social.";
            }
            else if (cond_notaQ1 == "C") 
            {
                valueescalaQ1 = "Falla ocasionalmente en el cumplimiento de los compromisos establecidos para la sana convivencia social.";
            }
            else if (cond_notaQ1 == "D") 
            {
                valueescalaQ1 = "Falta reiteradamente en el cumplimiento de los compromisos establecidos para la sana convivencia social.";
            }
            else 
            {
                valueescalaQ1 = "Valor no valido.";
            }

            $('.cond_escalaQ1',this).val(valueescalaQ1);
            
            var cond_notaQ2 = $('.cond_notaQ2',this).val();

            var valueescalaQ2; 

            if (cond_notaQ2 == "A")
            {
                valueescalaQ2 = "Lidera el cumplimiento de los compromisos establecidos para la sana convivencia social.";
            }
            else if (cond_notaQ2 == "B")
            {
                valueescalaQ2 = "Cumple con los compromisos establecidos para la sana convivencia social.";
            }
            else if (cond_notaQ2 == "C") 
            {
                valueescalaQ2 = "Falla ocasionalmente en el cumplimiento de los compromisos establecidos para la sana convivencia social.";
            }
            else if (cond_notaQ2 == "D") 
            {
                valueescalaQ2 = "Falta reiteradamente en el cumplimiento de los compromisos establecidos para la sana convivencia social.";
            }
            else 
            {
                valueescalaQ2 = "Valor no valido.";
            }

            $('.cond_escalaQ2',this).val(valueescalaQ2);

            var promcompAnual;
            var valueescalaAnual; 

            if(cond_notaQ1 == "A" && cond_notaQ2 == "A"){
                promcompAnual = "A";
                valueescalaAnual = "Lidera el cumplimiento de los compromisos establecidos para la sana convivencia social.";
            }else if(cond_notaQ1 == "A" && cond_notaQ2 == "B"){
                promcompAnual = "B";
                valueescalaAnual = "Cumple con los compromisos establecidos para la sana convivencia social.";
            }else if(cond_notaQ1 == "A" && cond_notaQ2 == "C"){
                promcompAnual = "B";
                valueescalaAnual = "Cumple con los compromisos establecidos para la sana convivencia social.";
            }else if(cond_notaQ1 == "A" && cond_notaQ2 == "D"){
                promcompAnual = "C";
                valueescalaAnual = "Falla ocasionalmente en el cumplimiento de los compromisos establecidos para la sana convivencia social.";
            }else if(cond_notaQ1 == "B" && cond_notaQ2 == "A"){
                promcompAnual = "B";
                valueescalaAnual = "Cumple con los compromisos establecidos para la sana convivencia social.";
            }else if(cond_notaQ1 == "B" && cond_notaQ2 == "B"){
                promcompAnual = "B";
                valueescalaAnual = "Cumple con los compromisos establecidos para la sana convivencia social.";
            }else if(cond_notaQ1 == "B" && cond_notaQ2 == "C"){
                promcompAnual = "C";
                valueescalaAnual = "Falla ocasionalmente en el cumplimiento de los compromisos establecidos para la sana convivencia social.";
            }else if(cond_notaQ1 == "B" && cond_notaQ2 == "D"){
                promcompAnual = "C";
                valueescalaAnual = "Falla ocasionalmente en el cumplimiento de los compromisos establecidos para la sana convivencia social.";
            }else if(cond_notaQ1 == "C" && cond_notaQ2 == "A"){
                promcompAnual = "B";
                valueescalaAnual = "Cumple con los compromisos establecidos para la sana convivencia social.";
            }else if(cond_notaQ1 == "C" && cond_notaQ2 == "B"){
                promcompAnual = "C";
                valueescalaAnual = "Falla ocasionalmente en el cumplimiento de los compromisos establecidos para la sana convivencia social.";
            }else if(cond_notaQ1 == "C" && cond_notaQ2 == "C"){
                promcompAnual = "C";
                valueescalaAnual = "Falla ocasionalmente en el cumplimiento de los compromisos establecidos para la sana convivencia social.";
            }else if(cond_notaQ1 == "C" && cond_notaQ2 == "D"){
                promcompAnual = "D";
                valueescalaAnual = "Falta reiteradamente en el cumplimiento de los compromisos establecidos para la sana convivencia social.";
            }else if(cond_notaQ1 == "D" && cond_notaQ2 == "A"){
                promcompAnual = "C";
                valueescalaAnual = "Falla ocasionalmente en el cumplimiento de los compromisos establecidos para la sana convivencia social.";
            }else if(cond_notaQ1 == "D" && cond_notaQ2 == "B"){
                promcompAnual = "C";
                valueescalaAnual = "Falla ocasionalmente en el cumplimiento de los compromisos establecidos para la sana convivencia social.";
            }else if(cond_notaQ1 == "D" && cond_notaQ2 == "C"){
                promcompAnual = "D";
                valueescalaAnual = "Falta reiteradamente en el cumplimiento de los compromisos establecidos para la sana convivencia social.";
            }else if(cond_notaQ1 == "D" && cond_notaQ2 == "D"){
                promcompAnual = "D";
                valueescalaAnual = "Falta reiteradamente en el cumplimiento de los compromisos establecidos para la sana convivencia social.";
            }else{
                promcompAnual = "Valor no valido";
                valueescalaAnual = "Valor no valido";
            }

            $('.cond_notaAnual',this).val(promcompAnual);
            $('.cond_escalaAnual',this).val(valueescalaAnual);
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
