@extends('backend.app')

@section('title')
Modulo Secretario - Consultar Datos Personales del Alumno
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) - Secretario/a - Elaboración de la Ficha de Matricula -->
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Modulo Secretario/a - Elaboración de la Ficha de Matricula</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header - Secretario/a - Elaboración de la Ficha de Matricula -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Elaboración de la Ficha de Matricula (Alumno)</h3>
              </div>
              <!-- /.card-header -->
              
              <!-- form start -->
                <div class="card-body">
                    <div class="form-group">
                      <div class="text-center">
                          @if($matricula->alumno->alum_foto)
                              <img src="{{ asset('uploads/saved/alumno/'.$matricula->alumno->alum_foto) }}" class="profile-user-img img-fluid img-circle" width="70" height="70" align="center">
                          @else
                              <img src="/uploads/logo/alumno.png" class="profile-user-img img-fluid img-circle" width="70" height="70" align="center">
                          @endif
                      </div>
                      <h3 class="profile-username text-center">{{$matricula->alumno->alum_nombres}} {{$matricula->alumno->alum_apellidos}}</h3>
                      <ul class="list-group list-group-unbordered mb-3">
                          <li class="list-group-item">
                              <b>N ° Cedula:</b><a class="float-right">
                                @if($matricula->alumno->alum_ncedula)  
                                  {{$matricula->alumno->alum_ncedula}}
                                @else
                                  N/A
                                @endif
                              </a>
                          </li>
                          <li class="list-group-item">
                              <b>N ° Pasaporte:</b> 
                              @if($matricula->alumno->alum_npasaporte)
                                  <a class="float-right">{{$matricula->alumno->alum_npasaporte}}</a>
                              @else
                                  <a class="float-right">N/A</a>
                              @endif
                          </li>
                          <li class="list-group-item">
                              <b>Fecha de Nacimiento:</b><a class="float-right">{{$matricula->alumno->alum_fec_nac->format('d/m/Y')}}</a>
                          </li>
                          <li class="list-group-item">
                              <b>Edad:</b> <a class="float-right">{{$matricula->alumno->alum_fec_nac->age}}</a>
                          </li>
                          <li class="list-group-item">
                              <b>Barrio:</b> 
                              @if($matricula->alumno->alum_barrio)
                                  <a class="float-right">{{$matricula->alumno->alum_barrio}}</a>
                              @else
                                  <a class="float-right">N/A</a>
                              @endif
                          </li>
                          <li class="list-group-item">
                              <b>Genero:</b> 
                              <a class="float-right">{{$matricula->alumno->alum_genero}}</a>
                          </li>
                          <li class="list-group-item">
                              <b>Nacionalidad:</b> 
                              <a class="float-right">{{$matricula->alumno->alum_nacionalidad}}</a>
                          </li>
                          <li class="list-group-item">
                              <b>Etnia:</b> 
                              <a class="float-right">{{$matricula->alumno->alum_etnia}}</a>
                          </li>
                          <li class="list-group-item">
                              <b>Tipo de Discapacidad:</b> 
                              @if($matricula->alumno->alum_dis_tipo)
                                  <a class="float-right">{{$matricula->alumno->alum_dis_tipo}}</a>
                              @else
                                  <a class="float-right">N/A</a>
                              @endif                   
                          </li>
                          <li class="list-group-item">
                              <b>% Porcentaje de Discapacidad:</b> 
                              @if($matricula->alumno->alum_dis_porcentaje)
                                  <a class="float-right">{{$matricula->alumno->alum_dis_porcentaje}}</a>
                              @else
                                  <a class="float-right">N/A</a>
                              @endif                   
                          </li>
                          <li class="list-group-item">
                              <b>N ° Conadis:</b> 
                              @if($matricula->alumno->alum_num_car_conadis)
                                  <a class="float-right">{{$matricula->alumno->alum_num_car_conadis}}</a>
                              @else
                                  <a class="float-right">N/A</a>
                              @endif                   
                          </li>
                          <li class="list-group-item">
                              <b>Estado:</b> 
                              @if($matricula->alumno->alum_estado == 1)
                                  <a class="float-right">Activo</a>
                              @else
                                  <a class="float-right">Desactivado</a>
                              @endif        
                          </li>
                      </ul>
                      <div class="list-group-item">                        
                        <div class="card-header">
                            <h3 class="profile-username text-center"><strong>Configuracion para generación de ficha de matricula</strong></h3>
                        </div>

                        <form action="{{action('App\Http\Controllers\Secretario\MatriculasController@generarFichaMatriculaPDF', ['mat_id' => $matricula->mat_id])}}" method="post">
                        {{csrf_field()}}
                        <h3 class="profile-username text-center"><i>Configuracion principal</i></h3>
                        <div class="card-body" style="overflow:scroll;">  
                           <strong><p>N° de Matricula *:</p></strong>
                          <input name ="mat_id" type="hidden" value ="{{old('mat_id', $matricula->mat_id)}}">
                          <input type="text" id="n_matricula" class="form-control" name="n_matricula" required autocomplete="n_matricula" value="{{$matricula->mat_id}}" autofocus>
                          <br>
                          <strong><p>Fecha de Ingreso *:</p></strong>
                          <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                          <input type="date" name="fecha_ingreso" class="form-control"   
                          required autocomplete="fecha_ingreso" id="fecha_ingreso" autofocus>
                          <br>
                          <strong><p>Periodo *:</p></strong>                                                   
                          <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                          <input type="text" id="periodo" class="form-control" name="periodo" value="{{$matricula->oferta->periodo->per_nombre}}" required autocomplete="periodo" autofocus>
                          <br>
                          <strong><p>Periodo - Seccion - Curso Actual:</p></strong>
                          {{$matricula->oferta->periodo->per_nombre}} - {{$matricula->oferta->curso->seccion->sec_nombre}} - {{$matricula->oferta->curso->cur_nombre}} {{$matricula->oferta->curso->cur_paralelo}}                                                
                          <br>
                          <br>
                          <strong><p>Año de Basica:</p></strong>                                                   
                          <p><i>Curso *:</i></p>
                          <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                          <select name="curso_mat" id="curso_mat" type='text' class="form-control" required autocomplete="curso_mat">
                            <option selected disabled>Seleccione un curso</option>
                            <option value="1°EGB">1°EGB</option>
                            <option value="2°EGB">2°EGB</option>
                            <option value="3°EGB">3°EGB</option>
                            <option value="4°EGB">4°EGB</option>
                            <option value="5°EGB">5°EGB</option>
                            <option value="6°EGB">6°EGB</option>
                            <option value="7°EGB">7°EGB</option>
                            <option value="8°EGB">8°EGB</option>
                            <option value="9°EGB">9°EGB</option>
                            <option value="10°EGB">10°EGB</option>
                            <option value="1°BGU">1°BGU</option>
                            <option value="2°BGU">2°BGU</option>
                            <option value="3°BGU">3°BGU</option>
                          </select>
                          <br>
                          <p><i>Paralelo *:</i></p>
                          <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                          <select name="paralelo_mat" id="paralelo_mat" type='text' class="form-control" required autocomplete="paralelo_mat">
                            <option selected disabled>Seleccione un paralelo</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option> 
                          </select>
                          <strong><i><p>Nota: Se debe seleccionar el curso y paralelo en la que se encuentra el estudiante matriculado en el curso y paralelo actual.</p></i></strong> 
                          <br>
                          <strong><p>Promedio General con el que ingresa: </p></strong>
                          <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                          <input type="text" id="promedio_general" class="form-control" name="promedio_general" autocomplete="promedio_general">
                          <br>
                          <strong><i><p>Nota: El promedio general debe ingresar para alumnos que requieran matricularse desde Tercer Año de Basica en adelante.</p></i></strong>
                        </div>
                        <br>
                        <h3 class="profile-username text-center"><i>Documentación que presenta:</i></h3>
                        <div class="card-body" style="overflow:scroll;">  
                          <strong><p>Certificado de nacimiento o cédula *:</p></strong>
                          <input name ="mat_id" type="hidden" value ="{{old('mat_id', $matricula->mat_id)}}">                          
                          <select name="doc_identidad" id="doc_identidad" type='text' class="form-control" required>
                            <option value="Certificado de Nacimiento">Certificado de Nacimiento</option>
                            <option value="Cedula">Cedula</option>
                            <option value="Ninguno">Ninguno</option>                          
                          </select>
                          <br>
                          <strong><p>Certificado de promoción "enumere los años que presenta" (Opcional):</p></strong>
                          <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                          <input type="text" id="certif_promocion" class="form-control" name="certif_promocion" autocomplete="certif_promocion" autofocus>
                          <br>
                          <strong><p>Informe Medico en caso de discapacidad (Opcional):</p></strong>
                          <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                          <select name="informe_medico" id="informe_medico" type='text' class="form-control" required>
                            <option value="Si">Si</option>
                            <option value="No">No</option>                          
                          </select>
                          <br>
                          <strong><p>Certificado de vacunas (Opcional):</p></strong>
                          <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                          <select name="cert_vacunas" id="cert_vacunas" type='text' class="form-control" required>
                            <option value="Si">Si</option>
                            <option value="No">No</option>                          
                          </select>
                          <br>
                          <strong><p>Informe de estudiante con NEE (Opcional):</p></strong>
                          <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                          <select name="informe_nee" id="informe_nee" type='text' class="form-control" required>
                            <option value="Si">Si</option>
                            <option value="No">No</option>                         
                          </select>
                          <br>
                          <strong><i><p>Nota: En caso de que el alumno a matricular tenga los tres ultimos datos disponibles debe seleccionar "No".</p></i></strong>
                        </div>
                        <br>
                        <h3 class="profile-username text-center"><i>Configuracion de Datos Personales de Padre/Madre/Apoderado:</i></h3>
                        <br>
                        <h4 class="profile-username text-left"><u>Datos Personales del Padre</u></h4>
                        <div class="card-body" style="overflow:scroll;">  
                          <table id="tabla-padres" class="table table-bordered table-striped tabla-padres">
                            <tbody id="tbl_padres_body">
                            @foreach($matricula->alumno->padresapoderados as $padreapoderado)
                              @if($padreapoderado->pad_estado == 1 && $padreapoderado->pad_parentesco == "Padre")   
                              <tr align ="left">
                                <th>Nombres *</th>
                                <td>
                                  <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                                  <input type="text" id="padr_nom_ape" class="form-control" name="padr_nom_ape" value="{{$padreapoderado->pad_nombres}}" autocomplete="padr_nom_ape" focus>
                                </td>
                              </tr>
                              <tr>
                                <th>Apellidos *</th>
                                <td>
                                  <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                                  <input type="text" id="padr_ape" class="form-control" name="padr_ape" value="{{$padreapoderado->pad_apellidos}}" autocomplete="padr_ape" focus>
                                </td>
                              </tr>
                              <tr>
                                <th>Nacionalidad *</th>
                                <td>
                                  <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                                  <input type="text" id="padr_nacionalidad" class="form-control" name="padr_nacionalidad" autocomplete="padr_nacionalidad" value="{{$padreapoderado->pad_nacionalidad}}" focus>
                                </td>
                              </tr>
                              <tr>
                                <th>Email (Opcional)</th>
                                <td>
                                  <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                                  <input type="text" id="padr_email" class="form-control" name="padr_email" autocomplete="padr_email" focus  value="{{$padreapoderado->pad_email}}"> 
                                </td>
                              </tr>
                              <tr>
                                <th>Ocupacion *</th>
                                <td><input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}"><input type="text" id="padr_ocupacion" class="form-control" name="padr_ocupacion"  value="{{$padreapoderado->pad_ocupacion}}" autocomplete="padr_ocupacion" focus></td>
                              </tr>
                              <tr>
                                <th>Nivel de Instrucción *</th>
                                <td>
                                  <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                                  <input type="text" id="padr_nivel_instruccion" class="form-control" name="padr_nivel_instruccion" autocomplete="padr_nivel_instruccion" value="{{$padreapoderado->pad_nivel}}" focus>
                                </td>
                              </tr>
                              <tr>
                                <th>Dirección *</th>
                                <td>
                                  <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                                  <input type="text" id="padr_direccion" class="form-control" name="padr_direccion" autocomplete="padr_direccion"  value="{{$padreapoderado->pad_direccion}}" focus>
                                </td>
                              </tr>
                              <tr>
                                <th>N ° Cedula *</th>
                                <td><input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}"><input type="text" id="padr_n_cedula" class="form-control"  value="{{$padreapoderado->pad_ncedula}}" name="padr_n_cedula" autocomplete="padr_n_cedula" focus></td>
                              </tr>
                              <tr>  
                                <th>N ° Pasaporte (Opcional)</th>
                                <td>
                                  <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                                  <input type="text" id="padr_n_pasaporte" class="form-control" name="padr_n_pasaporte" autocomplete="padr_n_pasaporte"  value="{{$padreapoderado->pad_npasaporte}}" focus>     
                                </td>
                              </tr>
                              <tr>
                                <th>N ° Telefono Convencional (Opcional)</th>
                                <td>
                                  <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                                  <input type="text" id="padr_telf_convencional" class="form-control" name="padr_telf_convencional" autocomplete="padr_telf_convencional" value="{{$padreapoderado->pad_telf_convencional}}" focus>
                                </td>
                              </tr>
                              <tr>
                                <th>N ° Telefono Celular (Opcional)</th> 
                                <td>
                                  <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                                  <input type="text" id="padr_telf_celular" class="form-control" name="padr_telf_celular" autocomplete="padr_telf_celular" value="{{$padreapoderado->pad_telf_celular}}" focus> 
                                </td>
                              </tr>
                              <tr>
                                <th>Fecha de Nacimiento *</th>
                                <td><input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}"><input type="text" id="padr_fec_nacimiento" class="form-control" name="padr_fec_nacimiento" value="{{$padreapoderado->pad_fec_nac->format('d/m/Y')}}" autocomplete="padr_fec_nacimiento" focus></td>
                              </tr>
                              @endif
                            @endforeach
                            </tbody>
                          </table>  
                        </div>
                        <br>
                        <h4 class="profile-username text-left"><u>Datos Personales de la Madre</u></h4>
                        <div class="card-body" style="overflow:scroll;">  
                          <table id="tabla-madres" class="table table-bordered table-striped tabla-madres">
                            <tbody id="tbl_madres_body">
                            @foreach($matricula->alumno->padresapoderados as $padreapoderado)
                              @if($padreapoderado->pad_estado == 1 && $padreapoderado->pad_parentesco == "Madre")   
                              <tr align ="left">
                                <th>Nombres *</th>
                                <td><input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}"><input type="text" id="mad_nom_ape" class="form-control" name="mad_nom_ape" autocomplete="mad_nom_ape" value="{{$padreapoderado->pad_nombres}}" focus></td>
                              </tr>
                              <tr>
                                <th>Apellidos *</th>
                                <td>
                                  <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                                  <input type="text" id="mad_ape" class="form-control" name="mad_ape" value="{{$padreapoderado->pad_apellidos}}" autocomplete="mad_ape" focus>
                                </td>
                              </tr>
                              <tr>
                                <th>Nacionalidad *</th>
                                <td><input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}"><input type="text" id="mad_nacionalidad" class="form-control" name="mad_nacionalidad" autocomplete="mad_nacionalidad" value="{{$padreapoderado->pad_nacionalidad}}" focus></td>
                              </tr>
                              <tr>
                                <th>Email (Opcional)</th>  
                                <td>
                                  <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                                  <input type="text" id="mad_email" class="form-control" name="mad_email" autocomplete="mad_email" focus value="{{$padreapoderado->pad_email}}"> 
                                </td>
                              </tr>
                              <tr>
                                <th>Ocupacion *</th>
                                <td><input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}"><input type="text" id="mad_ocupacion" class="form-control" name="mad_ocupacion" autocomplete="mad_ocupacion" value="{{$padreapoderado->pad_ocupacion}}" focus></td>
                              </tr>
                              <tr>
                                <th>Nivel de Instrucción *</th>  
                                <td><input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}"><input type="text" id="mad_nivel_instruccion" class="form-control" name="mad_nivel_instruccion" autocomplete="mad_nivel_instruccion" value="{{$padreapoderado->pad_nivel}}" focus></td>
                              </tr>
                              <tr>
                                <th>Dirección *</th>
                                <td><input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}"><input type="text" id="mad_direccion" class="form-control" name="mad_direccion" autocomplete="mad_direccion" value="{{$padreapoderado->pad_direccion}}" focus></td>
                              </tr>
                              <tr>  
                                <th>N ° Cedula *</th>
                                <td><input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}"><input type="text" id="mad_n_cedula" class="form-control" name="mad_n_cedula" autocomplete="mad_n_cedula" value="{{$padreapoderado->pad_ncedula}}" focus></td>
                              </tr>
                              <tr>  
                                <th>N ° Pasaporte (Opcional)</th>
                                <td>
                                  <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                                  <input type="text" id="mad_n_pasaporte" class="form-control" name="mad_n_pasaporte" autocomplete="mad_n_pasaporte" value="{{$padreapoderado->pad_npasaporte}}" focus>     
                                </td>
                              </tr>
                              <tr>  
                                <th>N ° Telefono Convencional (Opcional)</th>
                                <td>
                                  <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                                  <input type="text" id="mad_telf_convencional" class="form-control" value="{{$padreapoderado->pad_telf_convencional}}" name="mad_telf_convencional" autocomplete="mad_telf_convencional" focus>
                                </td>
                              </tr>
                              <tr>
                                <th>N ° Telefono Celular (Opcional)</th>
                                <td>
                                  <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                                  <input type="text" id="mad_telf_celular" class="form-control" name="mad_telf_celular" autocomplete="mad_telf_celular"  value="{{$padreapoderado->pad_telf_celular}}" focus> 
                                </td>
                              </tr>
                              <tr>
                                <th>Fecha de Nacimiento *</th>
                                <td><input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}"><input type="text" id="mad_fec_nacimiento" class="form-control" name="mad_fec_nacimiento" autocomplete="mad_fec_nacimiento" value="{{$padreapoderado->pad_fec_nac->format('d/m/Y')}}" focus></td>
                              </tr>
                              @endif
                            @endforeach
                            </tbody>
                          </table>  
                        </div>
                        <br>
                        <h4 class="profile-username text-left"><u>Datos Personales del Representante/Apoderado</u></h4>
                        <div class="card-body" style="overflow:scroll;">  
                          <table id="tabla-representantes" class="table table-bordered table-striped tabla-representantes">
                            <tbody id="tbl_datos_body">
                            @foreach($matricula->alumno->padresapoderados as $padreapoderado)
                              @if($padreapoderado->pad_estado == 1 && $padreapoderado->pad_parentesco == "Apoderado")   
                              <tr align ="center">
                                <th>Nombres *</th>
                                <td><input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}"><input type="text" id="rep_nom_ape" class="form-control" name="rep_nom_ape_pad"  value="{{$padreapoderado->pad_nombres}}" autocomplete="rep_nom_ape_pad" focus></td>
                              </tr>
                              <tr>
                                <th>Apellidos *</th>
                                <td>
                                  <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                                  <input type="text" id="rep_ape" class="form-control" name="rep_ape" value="{{$padreapoderado->pad_apellidos}}" autocomplete="rep_ape" focus>
                                </td>
                              </tr>
                              <tr>
                                <th>Nacionalidad *</th>
                                <td><input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}"><input type="text" id="rep_nacionalidad" class="form-control" value="{{$padreapoderado->pad_nacionalidad}}" name="rep_nacionalidad" autocomplete="rep_nacionalidad" focus></td>
                              </tr>
                              <tr>
                                <th>Email (Opcional)</th>        
                                <td>
                                  <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                                  <input type="text" id="rep_email" class="form-control" name="rep_email" autocomplete="rep_email" focus value="{{$padreapoderado->pad_email}}" > 
                                </td>
                              </tr>
                              <tr>
                                <th>Ocupacion *</th> 
                                <td><input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}"><input type="text" id="rep_ocupacion" class="form-control" name="rep_ocupacion" autocomplete="rep_ocupacion"  value="{{$padreapoderado->pad_ocupacion}}" focus></td>
                              </tr>
                              <tr>
                                <th>Nivel de Instrucción *</th>      
                                <td><input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}"><input type="text" id="rep_nivel_instruccion" class="form-control"  value="{{$padreapoderado->pad_nivel}}" name="rep_nivel_instruccion" autocomplete="rep_nivel_instruccion" focus></td>
                              </tr>
                              <tr>
                                <th>Dirección *</th>   
                                <td><input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}"><input type="text" id="rep_direccion" class="form-control" name="rep_direccion" autocomplete="rep_direccion" focus  value="{{$padreapoderado->pad_direccion}}"></td>
                              </tr>
                              <tr>
                                <th>N ° Cedula *</th> 
                                <td><input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}"><input type="text" id="rep_n_cedula" class="form-control" name="rep_n_cedula" autocomplete="rep_n_cedula" value="{{$padreapoderado->pad_ncedula}}" focus></td>
                              </tr>
                              <tr>
                                <th>N ° Pasaporte (Opcional)</th>  
                                <td>
                                  <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                                  <input type="text" id="rep_n_pasaporte" class="form-control" name="rep_n_pasaporte" autocomplete="rep_n_pasaporte" focus  value="{{$padreapoderado->pad_npasaporte}}">     
                                </td>
                              </tr>
                              <tr>
                                <th>N ° Telefono Convencional (Opcional)</th>
                                <td>
                                  <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                                  <input type="text" id="rep_telf_convencional" class="form-control" name="rep_telf_convencional" autocomplete="rep_telf_convencional" focus value="{{$padreapoderado->pad_telf_convencional}}">
                                </td>
                              </tr>
                              <tr>
                                <th>N ° Telefono Celular (Opcional)</th>
                                <td>
                                  <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                                  <input type="text" id="rep_telf_celular" class="form-control" value="{{$padreapoderado->pad_telf_celular}}" name="rep_telf_celular" autocomplete="rep_telf_celular" focus> 
                                </td>
                              </tr>
                              <tr>
                                <th>Fecha de Nacimiento *</th>
                                <td><input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}"><input type="text" id="rep_fec_nacimiento" class="form-control" value="{{$padreapoderado->pad_fec_nac->format('d/m/Y')}}" name="rep_fec_nacimiento" autocomplete="rep_fec_nacimiento" focus></td>
                              </tr>
                              @endif
                            @endforeach
                            </tbody>
                          </table>  
                        </div>
                      <br>
                      <h3 class="profile-username text-center"><i>Antecedentes Académicos del Estudiante:</i></h3>
                      <br>
                      <div class="card-body" style="overflow:scroll;">  
                        <strong><p>Institución de Procedencia (Opcional):</p></strong>
                        <input name ="mat_id" type="hidden" value ="{{old('mat_id', $matricula->mat_id)}}">
                        <input type="text" id="inst_procedencia" class="form-control" name="inst_procedencia" autocomplete="inst_procedencia" autofocus>
                        <br>
                        <strong><p>Motivo de Cambio (Opcional):</p></strong>
                        <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                        <input type="text" id="mot_cambio" class="form-control" name="mot_cambio" autocomplete="mot_cambio" autofocus>
                        <br>
                        <strong><p>Cursos Repetidos (Opcional):</p></strong>
                        <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                        <input type="text" id="curs_repetidos" class="form-control" name="curs_repetidos" autocomplete="curs_repetidos" autofocus>
                        <br>
                        <strong><p>Promedio General con el que ingresa (Opcional):</p></strong>
                        <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                        <input type="text" id="prom_general_acad" class="form-control" name="prom_general_acad" autocomplete="prom_general_acad" autofocus>
                        <br>
                        <strong><i><p>Nota: En caso de que el alumno se cambie a esta institución educativa se debe llenar este apartado.</p></i></strong>
                      </div>
                      <br>
                      <h3 class="profile-username text-center"><i>Antecedentes de Salud del Estudiante:</i></h3>
                      <br>
                      <div class="card-body" style="overflow:scroll;">  
                        <strong><p>Enfermedades a considerar (Opcional):</p></strong>
                        <input name ="mat_id" type="hidden" value ="{{old('mat_id', $matricula->mat_id)}}">
                        <input type="text" id="enfermedades" class="form-control" name="enfermedades" autocomplete="enfermedades" autofocus>
                        <br>
                        <strong><p>Medicamentos de uso frecuente (Opcional):</p></strong>
                        <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                        <input type="text" id="medic_frecuente" class="form-control" name="medic_frecuente" autocomplete="medic_frecuente" autofocus>
                        <br>
                        <strong><p>Alergico a: (Opcional):</p></strong>
                        <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                        <input type="text" id="alergias" class="form-control" name="alergias" autocomplete="alergias" autofocus>
                        <br>
                        <strong><p>Observaciones (Opcional):</p></strong>
                        <input name = "mat_id" type="hidden" value = "{{old('mat_id', $matricula->mat_id)}}">
                        <input type="text" id="observaciones" class="form-control" name="observaciones" autocomplete="observaciones" autofocus>
                        <br>
                        <strong><i><p>Nota: En caso de que el padre o madre o representante del alumno tenga a disposición esta información, se debe llenar este apartado.</p></i></strong>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="/secretario/matricula/table">
                    <button type="button" class="btn btn-warning center-block">
                      Regresar
                      <i class="fas fa-arrow-left"></i>
                    </button>
                  </a>
                  <button class="btn btn-danger" type="submit">
                    Generar Ficha de Matricula
                    <i class="fas fa-file-pdf"></i>
                  </button>
                </div>
                <!-- /.card-footer -->
              </div>
              <!-- /.card -->
            </div>
          </form>
          <!-- /.form POST-->
        </div>      
        <!-- /.form -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

@section('js')
<script>
  
</script>
@endsection