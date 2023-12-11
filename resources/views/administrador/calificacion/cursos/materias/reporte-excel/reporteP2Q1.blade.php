<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        p{
            font-family: Cambria; 
            font-size: 7;
        }       

        img{
            left: 50px;          
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

            .trr {
                background-color: #0099FF;
                color: #ffffff;
                align: center;
                padding: 10px;
                height: 20px;
            } 

            td {
                text-align: center;
                padding: 10px 5px;
                font-size: 8;
                border: 1px solid #040404;
            }

            tr.odd > td {
                background-color: #E3F2FD;
            }

            tr.even > td {
                background-color: #BBDEFB;
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
</head>
<body>   
    <table align="center" style="margin-top: -40px;">
        <thead style="color: black;">
            <tr>
                <th style="border-style: none;" colspan="8" align="center">
                    <img src="../public/backend/dist/img/logo_institucion_educativa.png" alt="Escudo_Unidad_Educativa_Enrique_Malo_Andrade" width="600" height="100"/>
                    <strong>
                        UNIDAD EDUCATIVA ENRIQUE MALO ANDRADE
                    </strong>  
                </th>  
            </tr>
        </thead>
        <tbody> 
        <tr>
            <td>
            </td>
        </tr>    
        <tr>  
            <td style="border-style: none;" colspan="8" align="center">
                <strong>
                    CUADRO DE RESUMEN SEGUNDO PARCIAL/PRIMER QUIMESTRE
                </strong> 
            </td>          
        </tr>
        </tbody>          
    </table>
    <table class="table table-header-rotated">           
        <tr>
            <th class="row-header"><strong>Periodo:</strong></th>                 
            <td>{{$malla_p2q1->oferta->periodo->per_nombre}}</td>

            <th class="custom-table">
            </th>
            
            <th class="row-header"><strong>Docente:</strong></th>
            <td colspan="4">{{$malla_p2q1->personal->pers_nombres}} {{$malla_p2q1->personal->pers_apellidos}}</td>
        </tr>
        <tr>
            <th class="row-header"><strong>Seccion:</strong></th>
            <td>{{$malla_p2q1->oferta->curso->seccion->sec_nombre}}</td>
                        
            <th class="custom-table">
            </th>
            
            <th class="row-header"><strong>Asignatura:</strong></th>
            <td colspan="4">{{$malla_p2q1->asignatura->asig_nom}}</td>
        </tr>
        <tr>
            <th class="row-header">
                <strong>
                    Parcial:
                </strong>
            </th>
            <td align="left">2</td>
                  
            <th class="custom-table">
            </th>
                        
            <th class="row-header"><strong>Area:</strong></th>
            <td colspan="4">{{$malla_p2q1->asignatura->area->area_nombre}}</td>
            
            <th class="custom-table">
            </th>
                        
            <td class="custom-table"></td>
            <th class="row-header header-cell"></th>
            <td class="header-cell-td"></td>
        </tr>
        <tr>
            <th class="row-header">
                <strong>
                    Curso:
                </strong>
            </th>
            <td>{{$malla_p2q1->oferta->curso->cur_nombre}}</td>
                  
            <th class="custom-table">
            </th>
                        
            <th class="row-header"><strong>Paralelo:</strong></th>
            <td colspan="4">{{$malla_p2q1->oferta->curso->cur_paralelo}}</td>   
            
            <th class="custom-table">
            </th>
                        
            <td class="custom-table"></td>
            <th class="row-header header-cell"></th>
            <td class="header-cell-td"></td>
        </tr>
    </table>
              
    <table class="table table-count" style="position: relative;" align="center">
        <thead style="color: black;">
            <tr>         
                <th align="center"><strong>N°</strong></th>
                <th align="center"><strong>Nomina</strong></th>
                <th align="center"><strong>Deb.</strong></th>
                <th align="center"><strong>Act. Ind.</strong></th>
                <th align="center"><strong>Act. Grup.</strong></th>
                <th align="center"><strong>Lec.</strong></th>
                <th align="center"><strong>Pru.</strong></th>
                <th align="center" bgcolor="#30d150"><strong>Prom.</strong></th>
            </tr>            
        </thead>
        <tbody>   
            @if(!empty($calificaciones_p2q1))
                <?php $count = 0; ?>
                @foreach ($calificaciones_p2q1 as $calificacion) 
                    @if($calificacion->cal_estado == 1)   
                        <?php $count = $count+1; ?>        
                        <tr class="{{$count % 2 == 0? "even": "odd"}}">
                            <td align="center">{{ $count }}</td>
                            <td align="left">{{$calificacion->matricula->alumno->alum_nombres}} {{$calificacion->matricula->alumno->alum_apellidos}}</td>  
                            <td align="center">
                                @if($calificacion->cal_deberP2Q1)
                                    {{$calificacion->cal_deberP2Q1}}
                                @else
                                    0.00
                                @endif
                            </td>  
                            <td align="center">
                                @if($calificacion->cal_actindP2Q1)    
                                    {{$calificacion->cal_actindP2Q1}}
                                @else
                                    0.00
                                @endif    
                            </td>  
                            <td align="center">
                                @if($calificacion->cal_actgruP2Q1)
                                    {{$calificacion->cal_actgruP2Q1}}
                                @else
                                    0.00
                                @endif    
                            </td> 
                            <td align="center">
                                @if($calificacion->cal_lecP2Q1)
                                    {{$calificacion->cal_lecP2Q1}}
                                @else
                                    0.00
                                @endif    
                            </td>
                            <td align="center">
                                @if($calificacion->cal_pruP2Q1)
                                    {{$calificacion->cal_pruP2Q1}}
                                @else
                                    0.00
                                @endif  
                            </td> 
                            <td align="center" bgcolor="#30d150">
                                @if($calificacion->cal_promP2Q1)
                                    {{$calificacion->cal_promP2Q1}}
                                @else
                                    0.00
                                @endif
                            </td> 
                        </tr>
                    @endif
                @endforeach
            @endif
        </tbody>                             
    </table>          
                             
    <table style="position: relative; margin-top: 50px;" align="center">
        <thead style="color: black;">
            <tr>         
                <th class="custom-table"></th>           
            </tr>    
        </thead>
        <tbody>    
            <tr>            
                <td></td>   
            </tr>        
            <tr>            
                <td></td>   
            </tr>   
            <tr>            
                <td></td>   
            </tr>   
            <tr>            
                <td></td>   
            </tr>   
            <tr>            
                <td></td>   
            </tr>   
            <tr>            
                <td></td>   
            </tr>   
            <tr>            
                <td></td>   
            </tr>   
            <tr>            
                <td></td>   
            </tr>   
            <tr>            
                <td></td>   
            </tr>   
            <tr>            
                <td></td>   
            </tr>   
            <tr>            
                <td></td>   
            </tr>   
            <tr>            
                <td></td>   
            </tr>   
            <tr>            
                <td></td>   
            </tr>   
            <tr>            
                <td></td>   
            </tr>   
            <tr>            
                <td></td>   
            </tr>   
            <tr>            
                <td></td>   
            </tr>   
            <tr>            
                <td></td>   
            </tr>   
            <tr>            
                <td></td>   
            </tr>   
            <tr>            
                <td></td>   
            </tr>   
            <tr>            
                <td></td>   
            </tr>   
            <tr>            
                <td></td>   
            </tr>   
            <tr>            
                <td></td>   
            </tr>   
            <tr>            
                <td></td>   
            </tr>   
            <tr>            
                <td></td>   
            </tr>   
            <tr>            
                <td></td>   
            </tr>   
            <tr>            
                <td></td>   
            </tr>   
            <tr>            
                <td></td>   
            </tr>   
            <tr>            
                <td></td>   
            </tr>   
            <tr>            
                <td></td>   
            </tr>   
            <tr>            
                <td></td>   
            </tr>   
            <tr>            
                <td></td>   
            </tr>              
            <tr>            
                <td class="custom-sign" colspan="8" align="center">{{ $abreviatura }} {{ $nom_ape_docente }}</td>   
            </tr>
            <tr>            
                <td class="custom-second-sign" colspan="8" align="center"><strong>DOCENTE</strong></td>   
            </tr>             
        </tbody>                             
    </table>          
</body>
</html>