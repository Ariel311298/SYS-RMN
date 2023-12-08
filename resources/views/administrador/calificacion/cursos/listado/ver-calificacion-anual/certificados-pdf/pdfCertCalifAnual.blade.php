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
            left: 0px;          
        }
        
        .bold{
            font-weight: bold;
        }
        
        .table {
            font-family: Cambria;
            border-collapse: collapse;
        }
        td, th {
            border: 1px solid black;
           
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
<title>CERTIFICADO DE PROMOCIÓN - Periodo: {{$matricula->oferta->periodo->per_nombre}} / Seccion: {{$matricula->oferta->curso->seccion->sec_nombre}} / Curso: {{$matricula->oferta->curso->cur_nombre}} {{$matricula->oferta->curso->cur_paralelo}} / Estudiante: {{$matricula->alumno->alum_nombres}} {{$matricula->alumno->alum_apellidos}}</title>
</head>
<body>    
<table align="center" style="margin-top: -40px;">
    <thead style="color: black;">
        <tr>
            <th style="border-style: none;">
                
            </th>
            <th style="border-style: none;">
              
            </th> 
            <th style="border-style: none;">
                <br>
                <br>
                <img src="../public/backend/dist/img/logo-ministerio-de-educacion-del-ecuador.png" alt="Logo_del_Ministerio_del_Ecuador" height="100"/>
                <br>
                <br>
                UNIDAD EDUCATIVA  "ENRIQUE MALO ANDRADE"
                <br>
                <br>
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
                    CERTIFICADO DE PROMOCIÓN 
                    <br>
                    <br>
                    AÑO LECTIVO {{ $periodo }}
                    <br>
                    <br>
                    JORNADA MATUTINA - VESPERTINA
                </strong> 
            </td>   
        </tr>
        <tr>   
            <td style="border-style: none;" align="left" colspan="5">
                De conformidad con lo prescrito en el Art. 197 del Reglamento General a la Ley Orgánica de Educación Intercultural y demás normativas vigentes, certifica que el /la estudiante: <strong>{{$matricula->alumno->alum_apellidos}} {{$matricula->alumno->alum_nombres}}</strong> del: <strong>{{$curso}},</strong>
                obtuvo las siguientes calificaciones durante el presente año lectivo.
            </td>   
        </tr>
    </tbody>          
    </table>

    <table class="table table table-count" style="position: relative; text-align: center;" align="center">
        <thead style="color: black;">
            <tr>         
                <th>ASIGNATURAS</th>
                <th>ESCALA CUANTITATIVA</th>
                <th>ESCALA CUALITATIVA</th>
            </tr>            
        </thead>
        <tbody>   
            @foreach ($calificaciones as $calificacion)  
            @if($calificacion->cal_estado == 1)         
            <tr>
                <td>{{$calificacion->malla->asignatura->asig_nom}}</td>
                <td>
                @if($calificacion->cal_promAnual)
                    {{$calificacion->cal_promAnual}}
                @else
                    0.00
                @endif   
                </td>  
                <td> 
                @if($calificacion->cal_escalaAnual)
                    {{$calificacion->cal_escalaAnual}}
                @else
                    N/A
                @endif           
                </td>
            </tr>
            @endif
            @endforeach
            <tr>
                <td>
                    <strong>
                        PROMEDIO GENERAL
                    </strong>
                </td>
                <td>
                    {{ $promedio_anual }}
                </td>  
                <td>
                    {{ $escala_prom_anual }}
                </td>
            </tr>
            @foreach ($comportamientos as $comportamiento)          
            @if($comportamiento->cond_estado == 1)  
            <tr>
                <td>
                    <strong>
                        EVALUACIÓN DEL COMPORTAMIENTO
                    </strong>
                </td>  
                <td>
                @if($comportamiento->cond_notaAnual)
                    {{$comportamiento->cond_notaAnual}}
                @else
                    N/A
                @endif   
                </td>  
                <td>
                @if($comportamiento->cond_escalaAnual)
                    {{$comportamiento->cond_escalaAnual}}
                @else
                    N/A
                @endif   
                </td>  
            </tr>
            @endif
            @endforeach
        </tbody>                             
    </table>         
    
    <br>
    <br>
    <br>

    <table align="left" style="margin-top: -40px;">
    <thead style="color: black;">
    </thead>
    <tbody> 
        <tr>
            <td style="border-style: none;" align="left">
                {{ $observacion }}
            </td>       
        </tr>
    </tbody>          
    </table>

    <table style="position: relative; text-align: center; margin-top: 50px;" align="center">
        <thead style="color: black;">
            <tr>         
                <th class="custom-table"></th>
                <th class="custom-table"></th>   
                <th class="custom-table"></th>   
                <th class="custom-table"></th>   
                <th class="custom-table"></th>
                <th class="custom-table"></th>   
                <th class="custom-table"></th>   
                <th class="custom-table"></th>           
            </tr>    
        </thead>
        <tbody>                 
            <tr>            
                <td class="custom-sign">{{ $abreviatura_rector }} {{ $nom_ape_rector }}</td>  
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-sign">{{ $abreviatura }} {{ $nom_ape_tutor }}</td>     
            </tr>
            <tr>            
                <td class="custom-second-sign"><strong>RECTOR/A</strong></td>  
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-second-sign"><strong>TUTOR</strong></td>    
            </tr>             
        </tbody>                             
    </table>          
</body>
</html>