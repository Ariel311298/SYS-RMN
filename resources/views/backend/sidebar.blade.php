<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('backend/dist/img/logo_institucion_educativa.png')}}" alt="Logo_Institución_Educativa" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SYS-RMN</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        
        <div class="image">
          @if(auth()->user()->rol_id == '1')
            @if(Auth::user()->personal->pers_foto)
              <img src="/uploads/saved/personal/{{Auth::user()->personal->pers_foto}}" class="img-circle elevation-2" alt="Imagen de Usuario">
            @else
              <img src="/uploads/logo/teacher.png" class="img-circle elevation-2" alt="Imagen de Usuario">
            @endif
          @elseif(auth()->user()->rol_id == '2')
            @if(Auth::user()->personal->pers_foto)
              <img src="/uploads/saved/personal/{{Auth::user()->personal->pers_foto}}" class="img-circle elevation-2" alt="Imagen de Usuario">
            @else
              <img src="/uploads/logo/teacher.png" class="img-circle elevation-2" alt="Imagen de Usuario">
            @endif
          @elseif(auth()->user()->rol_id == '3')
            @if(Auth::user()->personal->pers_foto)
              <img src="/uploads/saved/personal/{{Auth::user()->personal->pers_foto}}" class="img-circle elevation-2" alt="Imagen de Usuario">
            @else
              <img src="/uploads/logo/teacher.png" class="img-circle elevation-2" alt="Imagen de Usuario">
            @endif
          @elseif(auth()->user()->rol_id == '4')
            @if(Auth::user()->personal->pers_foto)
              <img src="/uploads/saved/personal/{{Auth::user()->personal->pers_foto}}" class="img-circle elevation-2" alt="Imagen de Usuario">
            @else
              <img src="/uploads/logo/teacher.png" class="img-circle elevation-2" alt="Imagen de Usuario">
            @endif
          @elseif(auth()->user()->rol_id == '5')
            @if(Auth::user()->alumno->alum_foto)
              <img src="/uploads/saved/personal/{{Auth::user()->alumno->alum_foto}}" class="img-circle elevation-2" alt="Imagen de Usuario">
            @else
              <img src="/uploads/logo/teacher.png" class="img-circle elevation-2" alt="Imagen de Usuario">
            @endif
          @endif
        </div>

        <div class="info">
          @if(auth()->user()->rol_id == '1')
            <a href="#" class="d-block">{{ Auth::user()->personal->pers_apellidos }}</a>
          @elseif(auth()->user()->rol_id == '2')
            <a href="#" class="d-block">{{ Auth::user()->personal->pers_apellidos }}</a>
          @elseif(auth()->user()->rol_id == '3')
            <a href="#" class="d-block">{{ Auth::user()->personal->pers_apellidos }}</a>
          @elseif(auth()->user()->rol_id == '4')  
            <a href="#" class="d-block">{{ Auth::user()->personal->pers_apellidos }}</a>
          @elseif(auth()->user()->rol_id == '5')
            <a href="#" class="d-block">{{ Auth::user()->alumno->alum_apellidos }}</a>
          @endif
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Buscar" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @if(auth()->user()->rol_id == '1')
          <li class="nav-header"><b>DATOS PERSONALES</b></li>
          <li class="nav-item">
            <a href="{{url('administrador/editar-datos-personales', ['pers_id' => Auth::user()->pers_id] )}}" class="nav-link">
              <i class="nav-icon fas fa-pen"></i>
              <p>
                Editar Datos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('administrador/cambiar-password', ['id' => Auth::user()->id] )}}" class="nav-link">
              <i class="nav-icon fas fa-key"></i>
              <p>
                Cambiar Contraseña
              </p>
            </a>
          </li>
          <li class="nav-header"><b>MANTENIMIENTO USUARIOS</b></li>
          <li class="nav-item">
            <a href="/administrador/users/index" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Gestionar Usuarios
              </p>
            </a>
          </li>
          <li class="nav-header"><b>MANTENIMIENTO PRINCIPAL</b></li>
          <li class="nav-item">
            <a href="/administrador/periodo/index" class="nav-link">
              <i class="nav-icon fas fa-clock"></i>
              <p>
                Gestionar Periodos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/administrador/curso/index" class="nav-link">
              <i class="nav-icon fas fa-school"></i>
              <p>
                Gestionar Cursos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/administrador/area/index" class="nav-link">
              <i class="nav-icon fas fa-shapes"></i>
              <p>
                Gestionar Áreas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/administrador/asignatura/index" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Gestionar Asignaturas
              </p>
            </a>
          </li>
          <li class="nav-header"><b>MANTENIMIENTO PERSONAL</b></li>
          <li class="nav-item">
            <a href="/administrador/personal/index" class="nav-link">
              <i class="nav-icon fas fa-user-lock"></i>
              <p>
                Gestionar Personal
              </p>
            </a>
          </li>
          <li class="nav-header"><b>MANTENIMIENTO ASIGNACIONES</b></li>
          <li class="nav-item">
            <a href="/administrador/oferta/index" class="nav-link">
              <i class="nav-icon fas fa-graduation-cap"></i>
              <p>
                Gestionar Ofertas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/administrador/malla/index" class="nav-link">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                Gestionar Asignaciones (Malla Curricular)
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/administrador/tutorproyecto/index" class="nav-link">
              <i class="nav-icon fas fa-chalkboard-teacher"></i>
              <p>Control de Tutores de Proyectos Escolares</p>
            </a>
          </li>
          <li class="nav-header"><b>MANTENIMIENTO MATRICULAS</b></li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-address-card"></i>
              <p>
                Datos Estudiantes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/administrador/alumno/create" class="nav-link">
                <i class="nav-icon fas fa-child"></i>
                  <p>Estudiante</p>
                </a>
              </li>  
              <li class="nav-item">
                <a href="/administrador/padreapoderado/searchncedulaalumno" class="nav-link">
                <i class="nav-icon fas fa-people-arrows"></i>
                  <p>Padre / Madre</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="/administrador/matricula/searchncedula" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Matricular Estudiante
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/administrador/alumno/index" class="nav-link">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                Gestionar Alumnos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/administrador/padreapoderado/index" class="nav-link">
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Lista de Padres/Apoderados
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/administrador/matricula/index" class="nav-link">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Gestionar Matriculas
              </p>
            </a>
          </li>
          <li class="nav-header"><b>CALIFICACIONES</b></li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-star"></i>
              <p>
                Notas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/administrador/calificacion/index" class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                  <p>Manejo de Asignaciones (Calificaciones)</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/administrador/calificacion/cursos" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                  <p>Consulta de Calificaciones</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header"><b>COMPORTAMIENTO</b></li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-award"></i>
              <p>
              Notas de Comportamiento
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/administrador/comportamiento/index" class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                  <p>Manejo de Asignaciones (Comportamiento)</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/administrador/comportamiento/cursos" class="nav-link">
                <i class="nav-icon fas fa-border-all"></i>
                  <p>Consulta de Calificaciones de Comportamiento</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header"><b>PROYECTO ESCOLAR</b></li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-atom"></i>
              <p>
              Notas de Proyecto Escolar
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/administrador/proyectoescolar/index" class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                  <p>Manejo de Asignaciones (Proyecto Escolar)</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/administrador/proyectoescolar/cursos" class="nav-link">
                <i class="nav-icon fas fa-th-list"></i>
                  <p>Consulta de Calificaciones de Proyectos Escolares</p>
                </a>
              </li>
            </ul>
          </li>
          @endif

          @if(auth()->user()->rol_id == '2')
          <li class="nav-header"><b>DATOS PERSONALES</b></li>
          <li class="nav-item">
            <a href="{{url('secretario/editar-datos-personales', ['pers_id' => Auth::user()->pers_id] )}}" class="nav-link">
              <i class="nav-icon fas fa-pen"></i>
              <p>
                Editar Datos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('secretario/cambiar-password', ['id' => Auth::user()->id] )}}" class="nav-link">
              <i class="nav-icon fas fa-key"></i>
              <p>
                Cambiar Contraseña
              </p>
            </a>
          </li>
          <li class="nav-header"><b>MANTENIMIENTO USUARIOS</b></li>
          <li class="nav-item">
            <a href="/secretario/users/index" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Gestionar Usuarios
              </p>
            </a>
          </li>
          <li class="nav-header"><b>MANTENIMIENTO PERSONAL</b></li>
          <li class="nav-item">
            <a href="/secretario/personal/index" class="nav-link">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Gestionar Personal
              </p>
            </a>
          </li>
          <li class="nav-header"><b>MANTENIMIENTO OFERTAS</b></li>
          <li class="nav-item">
            <a href="/secretario/oferta/index" class="nav-link">
              <i class="nav-icon fas fa-graduation-cap"></i>
              <p>
                Gestionar Ofertas
              </p>
            </a>
          </li>
          <li class="nav-header"><b>MANTENIMIENTO MATRICULAS</b></li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-address-card"></i>
              <p>
                Datos Estudiantes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/secretario/alumno/create" class="nav-link">
                <i class="nav-icon fas fa-child"></i>
                  <p>Estudiante</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/secretario/padreapoderado/searchncedulaalumno" class="nav-link">
                <i class="nav-icon fas fa-people-arrows"></i>
                  <p>Padre / Madre</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="/secretario/matricula/searchncedula" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Matricular Estudiante
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/secretario/matricula/index" class="nav-link">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Gestionar Matriculas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/secretario/alumno/index" class="nav-link">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                Gestionar Alumnos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/secretario/padreapoderado/index" class="nav-link">
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Lista de Padres/Apoderados
              </p>
            </a>
          </li>
          <li class="nav-header"><b>CALIFICACIONES</b></li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-star"></i>
              <p>
                Notas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/secretario/calificacion/index" class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                  <p>Manejo de Asignaciones (Calificaciones)</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/secretario/calificacion/cursos" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                  <p>Consulta de Calificaciones</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header"><b>COMPORTAMIENTO</b></li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-award"></i>
              <p>
              Notas de Comportamiento
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/secretario/comportamiento/index" class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                  <p>Manejo de Asignaciones (Comportamiento)</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/secretario/comportamiento/cursos" class="nav-link">
                <i class="nav-icon fas fa-border-all"></i>
                  <p>Consulta de Calificaciones de Comportamiento</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header"><b>PROYECTO ESCOLAR</b></li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-atom"></i>
              <p>
              Notas de Proyecto Escolar
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/secretario/proyectoescolar/index" class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                  <p>Manejo de Asignaciones (Proyecto Escolar)</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/secretario/proyectoescolar/cursos" class="nav-link">
                <i class="nav-icon fas fa-th-list"></i>
                  <p>Consulta de Calificaciones de Proyectos Escolares</p>
                </a>
              </li>
            </ul>
          </li>
          @endif

          @if(auth()->user()->rol_id == '3')
          <li class="nav-header"><b>DATOS PERSONALES</b></li>
          <li class="nav-item">
            <a href="{{url('docente/editar-datos-personales', ['pers_id' => Auth::user()->pers_id] )}}" class="nav-link">
              <i class="nav-icon fas fa-pen"></i>
              <p>
                Editar Datos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('docente/cambiar-password', ['id' => Auth::user()->id] )}}" class="nav-link">
              <i class="nav-icon fas fa-key"></i>
              <p>
                Cambiar Contraseña
              </p>
            </a>
          </li>
          <li class="nav-header"><b>CALIFICACIONES</b></li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-star"></i>
              <p>
                Notas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('docente/calificacion/asignaturas', ['pers_id' => Auth::user()->pers_id] )}}" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                  <p>Registro / Consulta de Calificaciones</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('docente/calificacion/curso-actual', ['pers_id' => Auth::user()->pers_id] )}}" class="nav-link">
                <i class="nav-icon fas fa-border-all"></i>
                  <p>Ver Calificaciones - Curso Actual (Tutor de Curso)</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('docente/calificacion/cursos', ['pers_id' => Auth::user()->pers_id] )}}" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                  <p>Ver Calificaciones - Todos los cursos (Tutor de Curso)</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header"><b>COMPORTAMIENTO</b></li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-award"></i>
              <p>
              Notas de Comportamiento
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('docente/comportamiento/cursos', ['pers_id' => Auth::user()->pers_id] )}}" class="nav-link">
                <i class="nav-icon fas fa-book-reader"></i>
                <p>Registro / Consulta de Notas de Comportamiento</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header"><b>PROYECTO ESCOLAR</b></li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-atom"></i>
              <p>
              Notas de Proyecto Escolar
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('docente/proyescolar/cursos', ['pers_id' => Auth::user()->pers_id] )}}" class="nav-link">
                <i class="nav-icon fas fa-clipboard-list"></i>
                  <p>Registro / Consulta de Notas de Proyecto Escolar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('docente/proyescolar/curso-actual', ['pers_id' => Auth::user()->pers_id] )}}" class="nav-link">
                <i class="nav-icon fas fa-border-all"></i>
                  <p>Ver Calificaciones de Proyectos Escolares - Curso Actual (Tutor de Curso)</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('docente/proyescolar/aulas', ['pers_id' => Auth::user()->pers_id] )}}" class="nav-link">
                <i class="nav-icon fas fa-th-list"></i>
                  <p>Ver Calificaciones de Proyectos Escolares - Todos los cursos (Tutor de Curso)</p>
                </a>
              </li>
            </ul>
          </li>
          @endif

          @if(auth()->user()->rol_id == '4')
          <li class="nav-header"><b>DATOS PERSONALES</b></li>
          <li class="nav-item">
            <a href="{{url('rector/editar-datos-personales', ['pers_id' => Auth::user()->pers_id] )}}" class="nav-link">
              <i class="nav-icon fas fa-pen"></i>
              <p>
                Editar Datos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('rector/cambiar-password', ['id' => Auth::user()->id] )}}" class="nav-link">
              <i class="nav-icon fas fa-key"></i>
              <p>
                Cambiar Contraseña
              </p>
            </a>
          </li>
          <li class="nav-header"><b>ALUMNOS</b></li>
          <li class="nav-item">
            <a href="/rector/matricula/index" class="nav-link">
              <i class="nav-icon fas fa-list-ul"></i>
              <p>
                Consultar Alumnos
              </p>
            </a>
          </li>
          <li class="nav-header"><b>CALIFICACIONES</b></li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-star"></i>
              <p>
                Notas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/rector/calificacion/cursos" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                  <p>Consulta de Calificaciones</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header"><b>COMPORTAMIENTO</b></li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-award"></i>
              <p>
              Notas de Comportamiento
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/rector/comportamiento/cursos" class="nav-link">
                <i class="nav-icon fas fa-border-all"></i>
                  <p>Consulta de Calificaciones de Comportamiento</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header"><b>PROYECTO ESCOLAR</b></li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-atom"></i>
              <p>
              Notas de Proyecto Escolar
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/rector/proyectoescolar/cursos" class="nav-link">
                <i class="nav-icon fas fa-th-list"></i>
                  <p>Consulta de Calificaciones de Proyectos Escolares</p>
                </a>
              </li>
            </ul>
          </li>
          @endif

          @if(auth()->user()->rol_id == '5')
          <li class="nav-header"><b>DATOS PERSONALES</b></li>
          <li class="nav-item">
            <a href="{{url('alumno/editar-datos-personales', ['alum_id' => Auth::user()->alum_id] )}}" class="nav-link">
              <i class="nav-icon fas fa-pen"></i>
              <p>
                Editar Datos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('alumno/cambiar-password', ['id' => Auth::user()->id] )}}" class="nav-link">
              <i class="nav-icon fas fa-key"></i>
              <p>
                Cambiar Contraseña
              </p>
            </a>
          </li>
          <li class="nav-header"><b>CALIFICACIONES</b></li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-star"></i>
              <p>
                Notas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('alumno/calificacion/cursos', ['alum_id' => Auth::user()->alum_id] )}}" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                  <p>Consulta de Calificaciones</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header"><b>COMPORTAMIENTO</b></li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-award"></i>
              <p>
              Notas de Comportamiento
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('alumno/comportamiento/cursos', ['alum_id' => Auth::user()->alum_id] )}}" class="nav-link">
                  <i class="nav-icon fas fa-border-all"></i>
                  <p>Consulta de Calificaciones de Comportamiento</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header"><b>PROYECTO ESCOLAR</b></li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-atom"></i>
              <p>
              Notas de Proyecto Escolar
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('alumno/proyecto-escolar/cursos', ['alum_id' => Auth::user()->alum_id] )}}" class="nav-link">
                  <i class="nav-icon fas fa-th-list"></i>
                  <p>Consulta de Calificaciones de Proyectos Escolares</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>