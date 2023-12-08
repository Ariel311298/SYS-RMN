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
    <title>CUADRO DE RESUMEN DE CALIFICACIONES DEL PROYECTO ESCOLAR ANUAL - Periodo: {{$tutorproyecto->oferta->periodo->per_nombre}} / Seccion: {{$tutorproyecto->oferta->curso->seccion->sec_nombre}} / Curso: {{$tutorproyecto->oferta->curso->cur_nombre}} {{$tutorproyecto->oferta->curso->cur_paralelo}} / Tutor de Proy. Escolar: {{$tutorproyecto->personal->pers_nombres}} {{$tutorproyecto->personal->pers_apellidos}}</title>
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
                CUADRO DE RESUMEN DE CALIFICACIONES DEL PROYECTO ESCOLAR ANUAL
            </strong> 
            </td>          
        </tr>
    </tbody>          
    </table>
    <table class="table table-header-rotated">           
        <tr>
            <th class="row-header">Periodo</th>                 
            <td>{{$tutorproyecto->oferta->periodo->per_nombre}}</td>

            <th class="custom-table">
            </th>
            
            <td class="custom-table"></td>
            <th class="row-header">Docente</th>
            <td>{{$tutorproyecto->personal->pers_nombres}} {{$tutorproyecto->personal->pers_apellidos}}</td>
            
            <th class="custom-table">
            </th>
            
            <td class="custom-table"></td>
            <th class="row-header">Curso</th>
            <td>{{$tutorproyecto->oferta->curso->cur_nombre}}</td>
        </tr>
        <tr>
            <th class="row-header">Seccion</th>
            <td>{{$tutorproyecto->oferta->curso->seccion->sec_nombre}}</td>
                        
            <th class="custom-table">
            </th>
            
            <td class="custom-table"></td>
            <th class="row-header">
                Quimestre
            </th>
            <td>1 y 2</td>
        
            <th class="custom-table">
            </th>
                        
            <td class="custom-table"></td>
            <th class="row-header">Paralelo</th>
            <td>{{$tutorproyecto->oferta->curso->cur_paralelo}}</td>                    
        </tr>
    </table>
        
    <br>
    <br>
      
    <table class="table table table-count" style="position: relative;" align="center">
        <thead style="color: black;">
            <tr>         
                <th>N°</th>
                <th>Nomina</th>
                <th>P1</th>
                <th>P2</th>
                <th>Prom.Q1</th>
                <th>P1</th>
                <th>P2</th>
                <th>Prom.Q2</th>
            </tr>            
        </thead>
        <tbody>   
            @foreach($proyescolares as $proyescolar)      
                @if($proyescolar->proy_estado == 1)          
                <tr>
                    <td>&nbsp;</td>
                    <td>{{$proyescolar->matricula->alumno->alum_nombres}} {{$proyescolar->matricula->alumno->alum_apellidos}}</td>  
                    <td>
                        @if($proyescolar->proy_prom_parcialP1Q1)
                            {{$proyescolar->proy_prom_parcialP1Q1}}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if($proyescolar->proy_prom_parcialP2Q1)
                            {{$proyescolar->proy_prom_parcialP2Q1}}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if($proyescolar->proy_promTotalQ1)
                            {{$proyescolar->proy_promTotalQ1}}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if($proyescolar->proy_prom_parcialP1Q2)
                            {{$proyescolar->proy_prom_parcialP1Q2}}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if($proyescolar->proy_prom_parcialP2Q2)
                            {{$proyescolar->proy_prom_parcialP2Q2}}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
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
                             
    <table style="position: relative; margin-top: 50px;" align="center">
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
                <td class="custom-sign">{{ $abreviatura }} {{ $nom_ape_tutor_proy }}</td>
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
                <td class="custom-second-sign"><strong>TUTOR DE PROY. ESCOLAR</strong></td>
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