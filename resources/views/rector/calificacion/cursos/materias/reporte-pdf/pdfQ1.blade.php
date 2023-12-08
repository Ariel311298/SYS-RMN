<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        p{
            font-family: Cambria; 
            font-size: 7;
        }       

        @page {
            size: a4 landscape;
        }

        img{
            left: 0px;          
        }
        
        .bold{
            font-weight: bold;
        }
        
        .table {
            font-family: Cambria;
            border-collapse: collapse;
        }

        .table-count {
            font-family: Cambria;
            counter-reset: serial-number; 
        }

        .table-count td:first-child:before {
            counter-increment: serial-number;  /* Incrementa el contador de números de serie */
            content: counter(serial-number);  /* Muestra el número en cada fila */
        }

        td, th {
            border: 1px solid black;
            text-align: center;
            padding: 8px;
            left: 50%;
            font-family: Cambria;
            background-color: white; 
            font-size: 8;
        }

        tr:nth-child(even) {
            background-color: black;
        }
        
        .table-header-rotated {
            border-collapse: collapse;
            font-family: Cambria;

            .csstransforms & td {
                width: 30px;
            }

            .no-csstransforms & th {
                padding: 5px 10px;
            }

            td {
                text-align: center;
                padding: 10px 5px;
                font-size: 8;
                border: 1px solid black;
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
        }
  
        th.row-header {
            padding: 8px;
            font-size: 8;
            border: 1px solid black;
            background-color:white;
        }
  
        th.header-cell {
            border-bottom: none;
            border-left: none;
            border-right: none;
        }
  
        td.header-cell-td {
            border-bottom: none;
            border-left: none;
            border-right: none;
        }
  
        th.custom-table {
            border-style: none;
            background-color:white;
        }
  
        td.custom-table {
            border-style: none;
            background-color:white;
        }
  
        td.custom-sign {
            border-bottom: none;
            border-left: none; 
            border-right: none;
            background-color:white;
        }
  
        td.custom-second-sign {
            border-style: none; 
            background-color:white;
        }
    </style>
    <title>CUADRO DE RESUMEN - Periodo: {{$malla->oferta->periodo->per_nombre}} / Seccion: {{$malla->oferta->curso->seccion->sec_nombre}} / Curso: {{$malla->oferta->curso->cur_nombre}} {{$malla->oferta->curso->cur_paralelo}} / Docente Encargado: {{$malla->personal->pers_nombres}} {{$malla->personal->pers_apellidos}} / Asignatura: {{$malla->asignatura->asig_nom}} / Quimestre: 1</title>
</head>
<body>    
<table align="center" style="margin-top: -40px;">
    <thead style="color: black;">
        <tr>
            <th style="border-style: none;">
                <img src="../public/backend/dist/img/logo_institucion_educativa.png" alt="Escudo_Unidad_Educativa_Enrique_Malo_Andrade" height="100"/>
            </th>
            <th style="border-style: none;">
              
            </th> 
            <th style="border-style: none;">
                UNIDAD EDUCATIVA ENRIQUE MALO ANDRADE  
            </th> 
            <th style="border-style: none;">
             
            </th>    
            <th style="border-style: none;">
               
            </th>    
        </tr>
    </thead>
    <tbody> 
        <tr>
            <td style="border-style: none;" align="center" colspan="5">
            <strong>
                CUADRO DE RESUMEN - PRIMER QUIMESTRE
            </strong> 
            </td>          
        </tr>
    </tbody>          
    </table>
    <table class="table table-header-rotated">           
        <tr>
            <th class="row-header">Periodo</th>                 
            <td>{{$malla->oferta->periodo->per_nombre}}</td>

            <th class="custom-table">
            </th>
            
            <td class="custom-table"></td>
            <th class="row-header">Docente</th>
            <td>{{$malla->personal->pers_nombres}} {{$malla->personal->pers_apellidos}}</td>
            
            <th class="custom-table">
            </th>
            
            <td class="custom-table"></td>
            <th class="row-header">Curso</th>
            <td>{{$malla->oferta->curso->cur_nombre}}</td>
        </tr>
        <tr>
            <th class="row-header">Seccion</th>
            <td>{{$malla->oferta->curso->seccion->sec_nombre}}</td>
                        
            <th class="custom-table">
            </th>
            
            <td class="custom-table"></td>
            <th class="row-header">Asignatura</th>
            <td>{{$malla->asignatura->asig_nom}}</td>
        
            <th class="custom-table">
            </th>
                        
            <td class="custom-table"></td>
            <th class="row-header">Paralelo</th>
            <td>{{$malla->oferta->curso->cur_paralelo}}</td>                    
        </tr>
        <tr>
            <th class="row-header">
                Quimestre
            </th>
            <td>1</td>
                              
            <th class="custom-table">
            </th>
                        
            <td class="custom-table"></td>
            <th class="row-header">Area</th>
            <td>{{$malla->asignatura->area->area_nombre}}</td>
            
            <th class="custom-table">
            </th>
                        
            <td class="custom-table"></td>
            <th class="row-header header-cell"></th>
            <td class="header-cell-td"></td>
        </tr>
    </table>
        
    <br>
    <br>
      
    <table class="table table table-count" style="position: relative;" align="center">
        <thead style="color: black;">
            <tr>         
                <th>N°</th>
                <th>Nomina</th>
                <th>Deb.</th>
                <th>Act. Ind.</th>
                <th>Act. Grup.</th>
                <th>Lec.</th>
                <th>Pru.</th>
                <th>P1</th>
                <th>Deb.</th>
                <th>Act. Ind.</th>
                <th>Act. Grup.</th>
                <th>Lec.</th>
                <th>Pru.</th>
                <th>P2</th>
                <th>P.Parcial</th>
                <th>P/80%</th>
                <th>Examen</th>
                <th>E/20%</th>
                <th>Prom.Q1</th>
                <th>Escala</th>
            </tr>            
        </thead>
        <tbody>   
            @foreach ($calificaciones as $calificacion)  
                @if($calificacion->cal_estado == 1)           
                <tr>
                    <td>&nbsp;</td>
                    <td>{{$calificacion->matricula->alumno->alum_nombres}} {{$calificacion->matricula->alumno->alum_apellidos}}</td>  
                    <td>
                    @if($calificacion->cal_deberP1Q1)
                        {{$calificacion->cal_deberP1Q1}}
                    @else
                        0.00
                    @endif
                    </td>  
                    <td>
                    @if($calificacion->cal_actindP1Q1)    
                        {{$calificacion->cal_actindP1Q1}}
                    @else
                        0.00
                    @endif    
                    </td>  
                    <td>
                    @if($calificacion->cal_actgruP1Q1)
                        {{$calificacion->cal_actgruP1Q1}}
                    @else
                        0.00
                    @endif    
                    </td> 
                    <td>
                    @if($calificacion->cal_lecP1Q1)
                        {{$calificacion->cal_lecP1Q1}}
                    @else
                        0.00
                    @endif    
                    </td>
                    <td>
                    @if($calificacion->cal_pruP1Q1)
                        {{$calificacion->cal_pruP1Q1}}
                    @else
                        0.00
                    @endif  
                    </td> 
                    <td>
                    @if($calificacion->cal_promP1Q1)
                        {{$calificacion->cal_promP1Q1}}
                    @else
                        0.00
                    @endif
                    </td> 
                    <td>
                    @if($calificacion->cal_deberP2Q1)
                        {{$calificacion->cal_deberP2Q1}}
                    @else
                        0.00
                    @endif
                    </td>  
                    <td>
                    @if($calificacion->cal_actindP2Q1)    
                        {{$calificacion->cal_actindP2Q1}}
                    @else
                        0.00
                    @endif    
                    </td>  
                    <td>
                    @if($calificacion->cal_actgruP2Q1)
                        {{$calificacion->cal_actgruP2Q1}}
                    @else
                        0.00
                    @endif    
                    </td> 
                    <td>
                    @if($calificacion->cal_lecP2Q1)
                        {{$calificacion->cal_lecP2Q1}}
                    @else
                        0.00
                    @endif    
                    </td>
                    <td>
                    @if($calificacion->cal_pruP2Q1)
                        {{$calificacion->cal_pruP2Q1}}
                    @else
                        0.00
                    @endif  
                    </td> 
                    <td>
                    @if($calificacion->cal_promP2Q1)
                        {{$calificacion->cal_promP2Q1}}
                    @else
                        0.00
                    @endif
                    </td>    
                    <td>
                    @if($calificacion->cal_promParQ1)    
                        {{$calificacion->cal_promParQ1}}
                    @else
                        0.00
                    @endif
                    </td> 
                    <td>
                    @if($calificacion->cal_promQ1_80)    
                        {{$calificacion->cal_promQ1_80}}
                    @else
                        0.00
                    @endif
                    </td>
                    <td>
                    @if($calificacion->cal_examQ1_10) 
                        {{$calificacion->cal_examQ1_10}}
                    @else
                        0.00
                    @endif
                    </td> 
                    <td>
                    @if($calificacion->cal_examQ1_20) 
                        {{$calificacion->cal_examQ1_20}}
                    @else
                        0.00
                    @endif
                    </td>
                    <td>
                    @if($calificacion->cal_promTotalQ1) 
                        {{$calificacion->cal_promTotalQ1}}
                    @else
                        0.00
                    @endif
                    </td> 
                    <td>
                    @if($calificacion->cal_escalaQ1) 
                        {{$calificacion->cal_escalaQ1}}
                    @else
                        NAAR
                    @endif
                    </td> 
                </tr>
                @endif
            @endforeach
        </tbody>                             
    </table>          
                             
    <table style="position: relative;  margin-top: 50px;" align="center">
        <thead style="color: black;">
            <tr>         
                <th class="custom-table"></th>            
            </tr>    
        </thead>
        <tbody>                 
            <tr>            
                <td class="custom-sign">{{ $abreviatura }} {{ $nom_ape_docente }}</td>   
            </tr>
            <tr>            
                <td class="custom-second-sign"><strong>DOCENTE</strong></td>   
            </tr>             
        </tbody>                             
    </table>          
</body>
</html>