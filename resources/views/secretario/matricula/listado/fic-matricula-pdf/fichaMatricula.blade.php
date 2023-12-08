<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        p{
            font-family: Cambria; 
            font-size: 11;
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
            left: 30%;
            font-family: Cambria;
            background-color: white; 
            font-size: 11;
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
                font-size: 11;
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
            font-size: 11;
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
    <title>UNIDAD EDUCATIVA ENRIQUE MALO ANDRADE - FICHA DE MATRICULA - {{$matricula->alumno->alum_apellidos}} {{$matricula->alumno->alum_nombres}}</title>
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
                    <br>
                    <br>
                    UNIDAD EDUCATIVA ENRIQUE MALO ANDRADE
                    <br>
                    <br>
                    FICHA DE MATRICULA
                </th> 
                <th style="border-style: none;">
                
                </th>    
                <th style="border-style: none;">
                    @if($matricula->alumno->alum_foto)
                        <img src="{{ public_path('uploads/saved/alumno/'.$matricula->alumno->alum_foto) }}" alt="Logo_Foto" height="100"/>
                    @else
                        <img src="../public/backend/dist/img/logo_foto_vacio.png" alt="Logo_Foto_Vacio" height="100"/>
                    @endif    
                </th>    
            </tr>
        </thead>        
    </table>

    <br>

    <table style="position: relative; border-style: none; text-align: left;" align="left">
        <tbody>   
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Año de Basica:
                    </strong>
                </td>
                <td style="border-style: none;">
                    {{ $curso_mat }} {{ $paralelo_mat }}
                </td>  
                <td style="border-style: none;">
                    <strong>
                        Año Lectivo:
                    </strong>
                </td>
                <td style="border-style: none;">
                    {{ $periodo }}       
                </td>
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Fecha de Ingreso:
                    </strong>
                </td>
                <td style="border-style: none;">
                    {{ $fecha_ingreso }}
                </td> 
                <td style="border-style: none;">
                    <strong>
                        N° de Matricula:
                    </strong>
                </td>
                <td style="border-style: none;">
                    {{ $n_matricula }}
                </td>  
            </tr>
            <tr>
                <td style="border-style: none;">
                </td>
            </tr>
            <tr>
                <td style="border-style: none;" colspan="2">
                    <strong>
                        DATOS DEL/O LA ESTUDIANTE
                    </strong>
                </td> 
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        N ° Cedula
                    </strong>
                </td> 
                <td style="border-style: none;">
                    @if($matricula->alumno->alum_ncedula)  
                        {{$matricula->alumno->alum_ncedula}}
                    @else
                        _________________________
                    @endif
                </td> 
                <td style="border-style: none;">
                    <strong>
                        N ° Pasaporte
                    </strong>
                </td> 
                <td style="border-style: none;">
                    @if($matricula->alumno->alum_npasaporte)  
                        {{$matricula->alumno->alum_npasaporte}}
                    @else
                        _________________________
                    @endif
                </td> 
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Nombres:
                    </strong>
                </td> 
                <td style="border-style: none;" colspan="2">
                    {{$matricula->alumno->alum_nombres}} {{$matricula->alumno->alum_apellidos}}    
                </td>
                <td style="border-style: none;">
                </td> 
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Fecha de Nacimiento:
                    </strong>
                </td> 
                <td style="border-style: none;">
                    {{$matricula->alumno->alum_fec_nac->format('d/m/Y')}}    
                </td> 
                <td style="border-style: none;">
                    <strong>
                        Nacionalidad:
                    </strong>
                </td> 
                <td style="border-style: none;">
                    {{$matricula->alumno->alum_nacionalidad}}    
                </td> 
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Barrio:
                    </strong>
                </td> 
                <td style="border-style: none;">
                    @if($matricula->alumno->alum_barrio)
                        {{$matricula->alumno->alum_barrio}}
                    @else
                        ______________________
                    @endif
                </td> 
                <td style="border-style: none;">
                    <strong>
                        Edad:
                    </strong>
                </td> 
                <td style="border-style: none;">
                    {{$matricula->alumno->alum_fec_nac->age}}  
                </td> 
            </tr>          
            <tr>
                <td style="border-style: none;">
                    <strong>
                        En caso de emergencia avisar a:
                    </strong>
                </td>  
                <td style="border-style: none;">
                    ___________________________
                </td> 
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Promedio General con el que ingresa:
                    </strong>
                </td> 
                <td style="border-style: none;">
                    @if($promedio_general)
                        {{ $promedio_general }}
                    @else
                        _____________
                    @endif
                </td>
                <td style="border-style: none;">
                    <strong>
                       Etnia:
                    </strong>
                </td> 
                <td style="border-style: none;">
                    {{ $matricula->alumno->alum_etnia }}
                </td>  
            </tr>
            <tr>
                <td style="border-style: none;">
                </td>
            </tr>
            <tr>
                <td style="border-style: none;" colspan="2">
                    <strong>
                        DOCUMENTACIÓN QUE PRESENTA:
                    </strong>
                </td> 
                <td style="border-style: none;">
                    
                </td> 
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Certificado de nacimiento o cedula: 
                    </strong>
                </td> 
                <td style="border-style: none;">
                    {{ $doc_identidad }}
                </td> 
                <td style="border-style: none;">
                    <strong>
                        Certificado de promoción "enumere los años que presenta":
                    </strong>
                </td> 
                <td style="border-style: none;">
                    @if($promedio_general)
                        {{ $promedio_general }}
                    @else
                        ______________
                    @endif
                </td> 
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Informe Médico en caso de discapacidad:
                    </strong>
                </td> 
                <td style="border-style: none;">
                    {{ $informe_medico }}
                </td> 
                <td style="border-style: none;">
                    <strong>
                        Certificado de vacunas
                    </strong>
                </td> 
                <td style="border-style: none;">
                    {{ $cert_vacunas }}
                </td> 
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Informe de estudiante con NEE:
                    </strong>
                </td> 
                <td style="border-style: none;">
                    {{ $informe_nee }}
                </td> 
                <td style="border-style: none;">
                    <strong>
                        Tipo de Discapacidad:
                    </strong>
                </td> 
                <td style="border-style: none;">
                    @if($matricula->alumno->alum_dis_tipo)
                        {{$matricula->alumno->alum_dis_tipo}}
                    @else
                        _____________________________________
                    @endif
                </td> 
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        % Porcentaje de Discapacidad:
                    </strong>
                </td> 
                <td style="border-style: none;">
                    @if($matricula->alumno->alum_dis_porcentaje)
                        {{$matricula->alumno->alum_dis_porcentaje}}
                    @else
                        __________
                    @endif
                </td> 
                <td style="border-style: none;">
                    <strong>
                        N° de Carnet de Conadis:
                    </strong>
                </td> 
                <td style="border-style: none;">
                    @if($matricula->alumno->alum_num_car_conadis)
                        {{$matricula->alumno->alum_num_car_conadis}}
                    @else
                        _____________________
                    @endif
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
                <td class="custom-sign"><strong>RECTOR/A</strong></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-sign"><strong>DOCENTE</strong></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-sign"><strong>REPRESENTANTE</strong></td>      
            </tr>             
        </tbody>                             
    </table>
    
    <br>

    <table style="position: relative; text-align: left;" align="left">
        <tbody>   
            <tr>
                <td style="border-style: none;">
                    <strong>
                        PADRE
                    </strong>
                </td>
            </tr>
            <tr>
                <td style="border-style: none;" >
                    <strong>
                        Nombres y Apellidos:
                    </strong>
                </td>
                <td style="border-style: none;"> 
                    @if($padr_nom_ape && $padr_ape)
                        {{ $padr_nom_ape }} {{$padr_ape}}
                    @else
                        _________________________________
                    @endif
                </td> 
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Nacionalidad:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($padr_nacionalidad)
                        {{ $padr_nacionalidad }}
                    @else
                        ____________________
                    @endif
                </td> 
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Email:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($padr_email)
                        {{ $padr_email }}
                    @else
                        _____________________________________
                    @endif
                </td>
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Nivel de Instrucción:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($padr_nivel_instruccion) 
                        {{ $padr_nivel_instruccion }}
                    @else
                        ______________________________
                    @endif
                </td>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Ocupación:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($padr_ocupacion)
                        {{ $padr_ocupacion }}
                    @else
                        _________________________________
                    @endif
                </td> 
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Direccion:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($padr_direccion)
                        {{ $padr_direccion }}
                    @else
                        _______________________________________________
                    @endif
                </td> 
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        N ° Cedula:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($padr_n_cedula)
                        {{ $padr_n_cedula }}
                    @else
                        _______________________
                    @endif
                </td> 
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        N ° Pasaporte:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($padr_n_pasaporte)
                        {{ $padr_n_pasaporte }}
                    @else
                        _______________________
                    @endif
                </td>
            </tr> 
            <tr>
                <td style="border-style: none;">
                    <strong>
                        N ° Telefono Convencional:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($padr_telf_convencional)
                        {{ $padr_telf_convencional }}
                    @else
                        _______________________
                    @endif
                </td> 
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        N ° Telefono Celular:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($padr_telf_celular)
                        {{ $padr_telf_celular }}
                    @else
                        ________________________
                    @endif
                </td> 
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Fecha de Nacimiento:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($padr_fec_nacimiento)
                        {{ $padr_fec_nacimiento }}
                    @else
                        ________________________
                    @endif
                </td> 
            </tr>
            <tr>
                <td style="border-style: none;">
                </td>
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        MADRE
                    </strong>
                </td>
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Nombres y Apellidos:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($mad_nom_ape && $mad_ape)
                        {{ $mad_nom_ape }} {{$mad_ape}}
                    @else
                        _____________________________________________        
                    @endif
                </td> 
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Nacionalidad:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($mad_nacionalidad)
                        {{ $mad_nacionalidad }}
                    @else
                        _______________________________
                    @endif
                </td>
            </tr>
            <tr> 
                <td style="border-style: none;">
                    <strong>
                        Email:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($mad_email)
                        {{ $mad_email }}
                    @else
                        _____________________________________
                    @endif
                </td>
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Ocupación:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($mad_ocupacion)
                        {{ $mad_ocupacion }}
                    @else
                        _________________________________
                    @endif
                </td>
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Nivel de Instrucción:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($mad_nivel_instruccion)
                        {{ $mad_nivel_instruccion }}
                    @else
                        _____________________________________
                    @endif
                </td> 
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Direccion:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($mad_direccion)
                        {{ $mad_direccion }}
                    @else
                        _______________________________________________
                    @endif
                </td> 
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        N ° Cedula:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($mad_n_cedula)
                        {{ $mad_n_cedula }}
                    @else
                        _______________________
                    @endif
                </td>
            </tr>
            <tr> 
                <td style="border-style: none;">
                    <strong>
                        N ° Pasaporte:
                    </strong>
                </td>
                <td style="border-style: none;">
                @if($mad_n_pasaporte)
                    {{ $mad_n_pasaporte }}
                @else
                    __________________________
                @endif
                </td>
            </tr>
            <tr> 
                <td style="border-style: none;">
                    <strong>
                        N ° Telefono Convencional:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($mad_telf_convencional)
                        {{ $mad_telf_convencional }}
                    @else
                        __________________________
                    @endif    
                </td> 
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        N ° Telefono Celular:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($mad_telf_celular)
                        {{ $mad_telf_celular }}
                    @else
                        __________________________
                    @endif
                </td>
            </tr>
            <tr> 
                <td style="border-style: none;">
                    <strong>
                        Fecha de Nacimiento:
                    </strong>
                </td>
                <td style="border-style: none;"> 
                    @if($mad_fec_nacimiento)
                        {{ $mad_fec_nacimiento }}
                    @else
                        __________________________
                    @endif
                </td> 
            </tr>
            <tr>
                <td style="border-style: none;">
                </td>
            </tr>
            <tr>
                <td style="border-style: none;">
                </td>
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        REPRESENTANTE
                    </strong>
                </td style="border-style: none;">
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Nombres y Apellidos:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($rep_nom_ape && $rep_ape)
                        {{ $rep_nom_ape }} {{$rep_ape}}
                    @else
                        _____________________________________________
                    @endif
                </td> 
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Nacionalidad:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($rep_nacionalidad)
                        {{ $rep_nacionalidad }}
                    @else
                        _______________________________
                    @endif
                </td> 
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Email:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($rep_email)
                        {{ $rep_email }}
                    @else
                        _____________________________________
                    @endif
                </td>
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Ocupación:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($rep_ocupacion)
                        {{ $rep_ocupacion }}
                    @else
                        _________________________________
                    @endif
                </td>
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Nivel de Instrucción:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($rep_nivel_instruccion)
                        {{ $rep_nivel_instruccion }}
                    @else
                        _______________________________________________
                    @endif
                </td> 
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Direccion:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($rep_direccion)
                        {{ $rep_direccion }}
                    @else
                        _______________________________________________
                    @endif
                </td> 
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        N ° Cedula:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($rep_n_cedula)    
                        {{ $rep_n_cedula }}
                    @else
                        __________________________
                    @endif
                </td>
            </tr>
            <tr> 
                <td style="border-style: none;">
                    <strong>
                        N ° Pasaporte:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($rep_n_pasaporte)
                        {{ $rep_n_pasaporte }}
                    @else
                        __________________________
                    @endif
                </td>
            </tr>
            <tr> 
                <td style="border-style: none;">
                    <strong>
                        N ° Telefono Convencional:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($rep_telf_convencional)
                        {{ $rep_telf_convencional }}
                    @else
                        __________________________
                    @endif
                </td> 
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        N ° Telefono Celular:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($rep_telf_celular)
                        {{ $rep_telf_celular }}
                    @else
                        __________________________
                    @endif
                </td> 
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Fecha de Nacimiento:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($rep_fec_nacimiento)
                        {{ $rep_fec_nacimiento }}
                    @else
                        ______________________
                    @endif
                </td> 
            </tr>
        </tbody>                             
    </table>

    <br>

    <table style="position: relative; text-align: left;" align="left">
        <tbody>   
            <tr>
                <td style="border-style: none;" colspan="3">
                    <strong>
                        ANTECEDENTES ACADÉMICOS DEL ESTUDIANTE
                    </strong>
                </td>
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Institución de procedencia:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($inst_procedencia)
                        {{ $inst_procedencia }}
                    @else
                        _____________________________________________
                    @endif
                </td> 
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Motivo de Cambio:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($mot_cambio)
                        {{ $mot_cambio }}
                    @else
                        _____________________________________________
                    @endif
                </td>
            </tr>
            <tr> 
                <td style="border-style: none;">
                    <strong>
                        Cursos Repetidos:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($curs_repetidos)
                        {{ $curs_repetidos }}
                    @else
                        _____________
                    @endif
                </td>
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Promedio General con el que ingresa:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($prom_general_acad)
                        {{ $prom_general_acad }}
                    @else
                        __________________
                    @endif
                </td>
            </tr>
        </tbody>                             
    </table>
    <br>
    <table style="position: relative; text-align: left;" align="left">
        <tbody>   
            <tr>
                <td style="border-style: none;" colspan="3">
                    <strong>
                        ANTECEDENTES DE SALUD DEL ESTUDIANTE
                    </strong>
                </td>
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Enfermedades a considerar
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($enfermedades)
                        {{ $enfermedades }}
                    @else
                        ___________________________________________________________________________
                        ___________________________________________________________________________
                    @endif
                </td> 
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Medicamentos a considerar:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($medic_frecuente)
                        {{ $medic_frecuente }}
                    @else
                        ___________________________________________________________________________
                        ___________________________________________________________________________
                    @endif
                </td>
            </tr>
            <tr> 
                <td style="border-style: none;">
                    <strong>
                        Alérgico a:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($alergias)
                        {{ $alergias }}
                    @else
                        ___________________________________________________________________________
                        ___________________________________________________________________________
                    @endif
                </td>
            </tr>
            <tr>
                <td style="border-style: none;">
                    <strong>
                        Observaciones:
                    </strong>
                </td>
                <td style="border-style: none;">
                    @if($observaciones)
                        {{ $observaciones }}
                    @else
                        ___________________________________________________________________________
                        ___________________________________________________________________________
                    @endif
                </td>
            </tr>
        </tbody>                             
    </table>
    <br>
    <table class="table table table-count" style="position: relative; text-align: center;" align="center">
        <tbody>
            <tr>
                <td style="border-style: none;" align="justify">
                    El/la representante declara conocer y aceptar el Código de Convivencia, Reglamento de Evaluación, Proyecto Educativo de la Institución, y se compromete a cumplir con el Acta
                    Compromiso que firma libre y voluntariamente, también colaborar en el proceso de enseñanza aprendizaje y comportamental de su hijo/a y al mantenimiento de la infraestructura escolar.
                </td>
            </tr>   
            <tr>
                <td style="border-style: none;" align="right">
                    Fecha:___/____/____
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
                <td class="custom-sign"><strong>Nombre Representante</strong></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-sign"><strong>Cédula</strong></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-sign"><strong>Firma Representante</strong></td>      
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
                <td class="custom-sign"><strong>Nombre del funcionario que matricula</strong></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-sign"><strong>Firma del funcionario que matricula</strong></td>
            </tr>             
        </tbody>                             
    </table>
    <br>
    <table class="table table table-count" style="position: relative; text-align: left;" align="left">
        <tbody>
            <tr>
                <td style="border-style: none;" colspan="4">
                    <strong>
                        ANTECEDENTES DE RETIRO DE LA INSTITUCIÓN
                    </strong>
                </td>
            </tr> 
            <tr>
                <td style="border-style: none;" colspan="4">
                    Mótivo del retiro:
                </td>
            </tr> 
            <tr>
                <td style="border-style: none;">
                    _____________________________________________________________________________________________
                    _____________________________________________________________________________________________
                    _____________________________________________________________________________________________
                </td>
            </tr> 
            <tr>
                <td style="border-style: none;">
                   
                </td>
            </tr> 
            <tr>
                <td style="border-style: none;" colspan="4">
                    Documentos entregados en el desglose:
                </td>
            </tr> 
            <tr>
                <td style="border-style: none;">
                    _____________________________________________________________________________________________
                    _____________________________________________________________________________________________
                    _____________________________________________________________________________________________
                </td>
            </tr> 
            <tr>
                <td style="border-style: none;" align="right">
                    Fecha de retiro:___/____/____
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
                <td class="custom-sign"><strong>FIRMA DEL RECTOR/A DE LA U. E</strong></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-table"></td>
                <td class="custom-sign"><strong>FIRMA REPRESENTANTE</strong></td>    
            </tr>             
        </tbody>                             
    </table>
    <br>
    <table style="position: relative; text-align: center; margin-top: 50px;" align="center">
        <thead style="color: black;">
            <tr>         
                <th class="custom-table"></th>
          
            </tr>    
        </thead>
        <tbody>                 
            <tr>            
                <td class="custom-sign"><strong>FIRMA DEL DOCENTE</strong></td>
            </tr>             
        </tbody>                             
    </table>
</body>
</html>