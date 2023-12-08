<nav class="main-header navbar navbar-expand navbar-dark">
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