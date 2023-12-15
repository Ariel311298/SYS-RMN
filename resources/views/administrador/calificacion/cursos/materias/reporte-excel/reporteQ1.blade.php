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
                <th style="border-style: none;" colspan="20" align="center">
                    <img src="../public/backend/dist/img/logo_institucion_educativa.png" alt="Escudo_Unidad_Educativa_Enrique_Malo_Andrade" width="600" height="100"/>
                    <strong>
                        UNIDAD EDUCATIVA ENRIQUE MALO ANDRADE
                    </strong>  
                </th>  
            </tr>
        </thead>
        <tbody> 
        <tr>
            <td style="border-style: none;" colspan="20" align="center">
                <strong>
                    AÑO LECTIVO {{$malla_q1->oferta->periodo->per_nombre}} 
                </strong> 
            </td>       
        </tr>    
        <tr>  
            <td style="border-style: none;" colspan="20" align="center">
                <strong>
                    CUADRO DE RESUMEN POR QUIMESTRE
                </strong> 
            </td>          
        </tr>
        </tbody>          
    </table>
    <table class="table table-header-rotated">           
        <tr>

            <th class="custom-table">
            </th>

            <th class="row-header"><strong>Quimestre:</strong></th>                 
            <td colspan="4">Primero</td>

            <th class="custom-table">
            </th>
            
            <th class="row-header"><strong>Jornada:</strong></th>
            <td colspan="4">{{$malla_q1->oferta->curso->seccion->sec_nombre}}</td>

            <th class="custom-table">
            </th>
            
            <th class="row-header"><strong>Curso:</strong></th>
            <td colspan="4">{{$malla_q1->oferta->curso->cur_nombre}} {{$malla_q1->oferta->curso->cur_paralelo}}</td>
    </table>
              
    <table class="table table-count" style="position: relative;" align="center">
        <thead style="color: black;">
            <tr>         
                <th align="center" rowspan="3"><strong>N°</strong></th>
                <th align="center" rowspan="3"><strong>NOMINA</strong></th>
                <th align="center" colspan="6"><strong>PRIMER PARCIAL</strong></th>
                <th align="center" colspan="6"><strong>SEGUNDO PARCIAL</strong></th>
                <th align="center" rowspan="3"><strong>
                    PROMEDIO
                <br>
                    DOS 
                <br>
                    PARCIALES</strong></th>
                <th align="center" rowspan="3"><strong>
                    PROMEDIO
                    <br> 
                    80%</strong></th>
                <th align="center" rowspan="3"><strong>EXAMEN</strong></th>
                <th align="center" rowspan="3"><strong>
                    EXAMEN
                    <br> 
                    (20%)</strong></th>
                <th align="center" rowspan="3" bgcolor="#ffff00"><strong>NOTA
                    <br> 
                    QUIMESTRAL</strong></th>
                <th align="center" rowspan="3"><strong>E.
                    <br> 
                    CUALITATIVA</strong></th>
            </tr>    
            <tr>         
                <th align="center" colspan="5"><strong>EVALUACIÓN FORMATIVA</strong></th>
                <th align="center" rowspan="2" bgcolor="#ffff00"><strong>PROMEDIO</strong></th>
                <th align="center" colspan="5"><strong>EVALUACIÓN FORMATIVA</strong></th>
                <th align="center" rowspan="2" bgcolor="#ffff00"><strong>PROMEDIO</strong></th>
            </tr>              
            <tr>         
                <th align="center"><strong>DEB.</strong></th>
                <th align="center"><strong>TAI.</strong></th>
                <th align="center"><strong>TAG.</strong></th>
                <th align="center"><strong>LEC.</strong></th>
                <th align="center"><strong>PRU.</strong></th>
                <th align="center"><strong>DEB.</strong></th>
                <th align="center"><strong>TAI.</strong></th>
                <th align="center"><strong>TAG.</strong></th>
                <th align="center"><strong>LEC.</strong></th>
                <th align="center"><strong>PRU.</strong></th>
            </tr>        
        </thead>
        <tbody>   
            @if(!empty($calificaciones_q1))
                <?php $count = 0; ?>
                @foreach ($calificaciones_q1 as $calificacion) 
                    @if($calificacion->cal_estado == 1)   
                        <?php $count = $count+1; ?>        
                        <tr class="{{$count % 2 == 0? "even": "odd"}}">
                            <td align="center">{{ $count }}</td>
                            <td align="left">{{$calificacion->matricula->alumno->alum_nombres}} {{$calificacion->matricula->alumno->alum_apellidos}}</td>  
                            <td align="center">
                                @if($calificacion->cal_deberP1Q1)
                                    {{$calificacion->cal_deberP1Q1}}
                                @else
                                    0.00
                                @endif
                            </td>  
                            <td align="center">
                                @if($calificacion->cal_actindP1Q1)    
                                    {{$calificacion->cal_actindP1Q1}}
                                @else
                                    0.00
                                @endif    
                            </td>  
                            <td align="center">
                                @if($calificacion->cal_actgruP1Q1)
                                    {{$calificacion->cal_actgruP1Q1}}
                                @else
                                    0.00
                                @endif    
                            </td> 
                            <td align="center">
                                @if($calificacion->cal_lecP1Q1)
                                    {{$calificacion->cal_lecP1Q1}}
                                @else
                                    0.00
                                @endif    
                            </td>
                            <td align="center">
                                @if($calificacion->cal_pruP1Q1)
                                    {{$calificacion->cal_pruP1Q1}}
                                @else
                                    0.00
                                @endif  
                            </td> 
                            @if($calificacion->cal_promP1Q1 >= 7.00)
                                <td align="center" bgcolor="#ffff00">
                                    @if($calificacion->cal_promP1Q1)
                                        {{$calificacion->cal_promP1Q1}}
                                    @else
                                        0.00
                                    @endif
                                </td>
                            @elseif($calificacion->cal_promP1Q1 < 7.00)
                                <td align="center" bgcolor="#ff0000">
                                    @if($calificacion->cal_promP1Q1)
                                        {{$calificacion->cal_promP1Q1}}
                                    @else
                                        0.00
                                    @endif
                                </td>
                            @endif
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
                            @if($calificacion->cal_promP2Q1 >= 7.00)
                                <td align="center" bgcolor="#ffff00">
                                    @if($calificacion->cal_promP2Q1)
                                        {{$calificacion->cal_promP2Q1}}
                                    @else
                                        0.00
                                    @endif
                                </td> 
                            @elseif($calificacion->cal_promP2Q1 < 7.00)
                                <td align="center" bgcolor="#ff0000">
                                    @if($calificacion->cal_promP2Q1)
                                        {{$calificacion->cal_promP2Q1}}
                                    @else
                                        0.00
                                    @endif
                                </td>
                            @endif
                            <td align="center">
                                @if($calificacion->cal_promParQ1)    
                                    {{$calificacion->cal_promParQ1}}
                                @else
                                    0.00
                                @endif
                            </td> 
                            <td align="center">
                                @if($calificacion->cal_promQ1_80)    
                                    {{$calificacion->cal_promQ1_80}}
                                @else
                                    0.00
                                @endif
                            </td>
                            <td align="center" bgcolor="#87cefa">
                                @if($calificacion->cal_examQ1_10) 
                                    {{$calificacion->cal_examQ1_10}}
                                @else
                                    0.00
                                @endif
                            </td> 
                            <td align="center">
                                @if($calificacion->cal_examQ1_20) 
                                    {{$calificacion->cal_examQ1_20}}
                                @else
                                    0.00
                                @endif
                            </td>
                            @if($calificacion->cal_promTotalQ1 >= 7.00)
                                <td align="center" bgcolor="#ffff00">
                                    @if($calificacion->cal_promTotalQ1) 
                                        {{$calificacion->cal_promTotalQ1}}
                                    @else
                                        0.00
                                    @endif
                                </td>
                            @elseif($calificacion->cal_promTotalQ1 < 7.00)
                                <td align="center" bgcolor="#ff0000">
                                    @if($calificacion->cal_promTotalQ1)
                                        {{$calificacion->cal_promTotalQ1}}
                                    @else
                                        0.00
                                    @endif
                                </td>
                            @endif
                            <td align="center">
                                @if($calificacion->cal_escalaQ1) 
                                    {{$calificacion->cal_escalaQ1}}
                                @else
                                    NAAR
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
                <td></td> 
                <td></td>   
                <td></td> 
                <td></td>   
                <td></td> 
                <td></td>   
                <td></td>   
            </tr>             
            <tr>            
                <td></td>
                <td></td>   
                <td></td> 
                <td></td>   
                <td></td> 
                <td></td>   
                <td></td>
                <td></td>      
                <td class="custom-sign" colspan="5" align="center">{{ $abreviatura }} {{ $nom_ape_docente }}</td>   
            </tr>
            <tr> 
                <td></td>   
                <td></td>   
                <td></td> 
                <td></td>   
                <td></td> 
                <td></td>   
                <td></td>
                <td></td>              
                <td class="custom-second-sign" colspan="5" align="center"><strong>DOCENTE</strong></td>   
            </tr>             
        </tbody>                             
    </table>          
</body>
</html>