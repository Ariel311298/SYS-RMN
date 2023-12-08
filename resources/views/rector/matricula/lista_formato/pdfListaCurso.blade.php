<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
    p{
        font-family: arial, sans-serif; 
        font-size: 9;
    }       
        
    .bold{
        font-weight: bold;
    }
        
    .table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
    }

    .table-count {
        font-family: arial, sans-serif;
        counter-reset: serial-number; 
    }

    .table-count td:first-child:before {
        counter-increment: serial-number;  /* Increment the serial number counter */
        content: counter(serial-number);  /* Display the counter */
    }

    td, th {
        border: 1px solid black;
        text-align: center;
        padding: 8px;
        left: 50%;
        font-size: 9;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
        
    .table-header-rotated {
        border-collapse: collapse;
        font-family: arial, sans-serif;
        width: 500px;
        .csstransforms & td {
            width: 80px;
        }

        .no-csstransforms & th {
            padding: 5px 10px;
        }
    
        td {
            text-align: center;
            padding: 10px 5px;
            border: 1px solid black;
            font-size: 9;
        }
    
        .csstransforms & th.rotate {
            height: 140px;
            white-space: nowrap;
            > div {
            transform: 
                translate(25px, 51px)
                rotate(315deg);
            width: 30px;
            }
            > div > span {
            border-bottom: 1px solid black;
            padding: 5px 10px;
            }
        }

        th.row-header {
            padding: 8px;
            border: 1px solid black;
            font-size: 9;
        }
    }
</style>
<title>Lista de Curso - Periodo: {{$oferta->periodo->per_nombre}} / Seccion: {{$oferta->curso->seccion->sec_nombre}} / Curso: {{$oferta->curso->cur_nombre}} {{$oferta->curso->cur_paralelo}} / Tutor de Curso: {{$oferta->personal->pers_nombres}} {{$oferta->personal->pers_apellidos}}</title>
</head>
<body>
    <p style="text-align: center;" class="bold">NOMINA DE ESTUDIANTES</p>

    <br>

    <table class="table table-header-rotated">
        <tr>
            <th class="row-header">Periodo</th>
            <td>{{$oferta->periodo->per_nombre}}</td> 
        </tr>
        <tr>
            <th class="row-header">Seccion</th>
            <td>{{$oferta->curso->seccion->sec_nombre}}</td>
        </tr>
        <tr>
            <th class="row-header">Curso</th>
            <td>{{$oferta->curso->cur_nombre}}</td>
        </tr>
        <tr>
            <th class="row-header">Paralelo</th>
            <td>{{$oferta->curso->cur_paralelo}}</td>
        </tr>
        <tr>
            <th class="row-header">Tutor de Curso</th>
            <td>{{$oferta->personal->pers_nombres}} {{$oferta->personal->pers_apellidos}}</td>
        </tr>                                                                                                        
    </table>
    
    <br>
    <br>
      
    <table class="table table table-count" style="position: relative; left: 210px;">
        <thead style="color: black;">
            <tr>         
                <th>N°</th>
                <th>NOMBRES Y APELLIDOS</th>
            </tr>
        </thead>
        <tbody>   
            @foreach($alumnos as $matricula) 
                @if($matricula->mat_estado == 1)           
                    <tr>
                        <td>&nbsp;</td>
                        <td>{{$matricula->alumno->alum_nombres}} {{$matricula->alumno->alum_apellidos}}</td> 
                    </tr>
                @endif
            @endforeach
        </tbody>                            
    </table>                                                      
</body>
</html>