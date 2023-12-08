<nav class="main-header navbar navbar-expand navbar-dark">
  <!-- Left navbar links -->
  @if(auth()->user()->rol_id == '1')
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="/administrador/dashboard" class="nav-link"><p><i class="fas fa-home"></i>Dashboard</p></a>
    </li>
  </ul>
  @endif

  @if(auth()->user()->rol_id == '2')
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="/secretario/dashboard" class="nav-link"><p><i class="fas fa-home"></i>Dashboard</p></a>
    </li>
  </ul>
  @endif

  @if(auth()->user()->rol_id == '3')
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="/docente/dashboard" class="nav-link"><p><i class="fas fa-home"></i>Dashboard</p></a>
    </li>
  </ul>
  @endif

  
  @if(auth()->user()->rol_id == '4')
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="/rector/dashboard" class="nav-link"><p><i class="fas fa-home"></i>Dashboard</p></a>
    </li>
  </ul>
  @endif

  @if(auth()->user()->rol_id == '5')
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="/alumno/dashboard" class="nav-link"><p><i class="fas fa-home"></i>Dashboard</p></a>
    </li>
  </ul>
  @endif

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Navbar para cerrar sesion -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">      
        <p>
          <i class="fas fa-door-open"></i>
          Cerrar Sesion 
        </p>
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
      </form>
    </li>
  </ul>
</nav>