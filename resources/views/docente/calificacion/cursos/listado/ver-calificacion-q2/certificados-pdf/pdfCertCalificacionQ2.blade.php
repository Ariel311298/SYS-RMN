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
<title>CERTIFICADO DE CALIFICACIONES DEL SEGUNDO QUIMESTRE - Periodo: {{$matricula->oferta->periodo->per_nombre}} / Seccion: {{$matricula->oferta->curso->seccion->sec_nombre}} / Curso: {{$matricula->oferta->curso->cur_nombre}} {{$matricula->oferta->curso->cur_paralelo}} / Estudiante: {{$matricula->alumno->alum_nombres}} {{$matricula->alumno->alum_apellidos}}</title>
</head>
<body>    
<table align="center" style="margin-top: -40px;">
    <thead style="color: black;">
        <tr>
            <th style="border-style: none;">
                <img src="../public/backend/dist/img/escudo_ecuador.png" alt="Escudo_del_Ecuador" height="100"/>
            </th>
            <th style="border-style: none;">
              
            </th> 
            <th style="border-style: none;">
                <br>
                <br>
                REPÚBLICA DEL ECUADOR
                <br>
                <br>
                MINISTERIO DE EDUCACIÓN
                <br>
                <br>
                Unidad Educativa “Enrique Malo Andrade”
                <br>
                <br>
                Capulispamba - Cuenca
            </th> 
            <th style="border-style: none;">
             
            </th>    
            <th style="border-style: none;">
                <img src="../public/backend/dist/img/logo_institucion_educativa.png" alt="Escudo_Unidad_Educativa_Enrique_Malo_Andrade" height="100"/>
            </th>    
        </tr>
    </thead>
    <tbody> 
        <tr>   
            <td style="border-style: none;" align="center" colspan="5">
                <strong>
                    CERTIFICADO DEL SEGUNDO QUIMESTRE
                    <br>
                    <br>
                    AÑO LECTIVO {{ $periodo }}
                </strong> 
            </td>   
        </tr>
        <tr>   
            <td style="border-style: none;" align="left" colspan="5">
                De conformidad con lo prescrito en la Ley Orgánica de Educación Intercultural y demás normativa vigente,
                certifica que el/la estudiante: <strong>{{$matricula->alumno->alum_apellidos}} {{$matricula->alumno->alum_nombres}}</strong> del <strong>{{$curso_seccion}}</strong>.
                Obtuvo las siguientes calificaciones. 
            </td>   
        </tr>
    </tbody>          
    </table>

    <table class="table table table-count" style="position: relative; text-align: center;" align="center">
        <thead style="color: black;">
            <tr>         
                <th>ASIGNATURAS</th>
                <th>Escala cuantitativa</th>
                <th>Escala cualitativa</th>
            </tr>            
        </thead>
        <tbody>   
            @foreach ($calificaciones as $calificacion) 
            @if($calificacion->cal_estado == 1)          
            <tr>
                <td>{{$calificacion->malla->asignatura->asig_nom}}</td>
                <td>
                @if($calificacion->cal_promTotalQ2)
                    {{$calificacion->cal_promTotalQ2}}
                @else
                    0.00
                @endif   
                </td>  
                <td>
                    @if($calificacion->cal_escalaQ2)
                        {{$calificacion->cal_escalaQ2}}
                    @else
                        NAAR
                    @endif    
                </td>
            </tr>
            @endif
            @endforeach
            <tr>
                <td>
                    <strong>
                    SUMA
                    </strong>
                </td>
                <td>
                    {{ $suma_q2 }}
                </td>  
                <td>
                
                </td>
            </tr>
            <tr>
                <td>
                    <strong>
                        PROMEDIO
                    </strong>
                </td>
                <td>
                    {{ $promedio_q2 }}
                </td>  
                <td>
                    {{ $escala_prom_q2 }}
                </td>
            </tr>
            @foreach ($comportamientos as $comportamiento)  
            @if($comportamiento->cond_estado == 1)         
            <tr>
                <td>
                    <strong>
                        EV. COMPORTAMIENTO
                    </strong>
                </td>  
                <td>
                @if($comportamiento->cond_notaQ2)
                    {{$comportamiento->cond_notaQ2}}
                @else
                    N/A
                @endif   
                </td>  
                <td>
                @if($comportamiento->cond_escalaQ2)
                    {{$comportamiento->cond_escalaQ2}}
                @else
                    N/A
                @endif   
                </td>  
            </tr>
            @endif
            @endforeach
            
            @foreach ($proyescolares as $proyescolar)          
            @if($proyescolar->proy_estado == 1) 
            <tr>
                <td>
                    <strong>
                        PROYECTO ESCOLAR
                    </strong>
                </td>  
                <td colspan="2">
                @if($proyescolar->proy_promTotalQ2)
                    {{$proyescolar->proy_promTotalQ2}}
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
        <tr>
            <th style="border-style: none;">
                RECOMENDACIONES:  
            </th>    
        </tr>
    </thead>
    <tbody> 
        <tr>
            <td style="border-style: none;" align="left">
                {{ $recomendaciones }}
            </td>       
        </tr>
        <tr>     
            <td style="border-style: none;" align="left">
                Cuenca, {{ $fecha_emision }}
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
                <td class="custom-sign">{{ $abreviatura }} {{ $nom_ape_tutor }}</td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-sign">{{ $abreviatura_rector }} {{ $nom_ape_rector }}</td>      
            </tr>
            <tr>            
                <td class="custom-second-sign"><strong>PROFESOR</strong></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-second-sign"><strong>RECTOR/A</strong></td>    
            </tr>             
        </tbody>                             
    </table>          
</body>
</html>