     <!-- Heading -->
    <h6 class="navbar-heading p-0 text-muted">
      <span class="docs-normal">
        @if (auth()->user()->role == 'admin')
      Administración
      @else
      Menú
      @endif
      </span>
    </h6>
     <!-- Nav items -->
    <ul class="navbar-nav">
      @if (auth()->user()->role == 'admin')

      <li class="nav-item">
        <a class="nav-link active" href="/home">
          <i class="ni ni-tv-2 text-primary"></i>
          <span class="nav-link-text">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/specialties">
          <i class="ni ni-planet text-orange"></i>
          <span class="nav-link-text">Especialidades</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/doctors">
          <i class="ni ni-single-02 text-primary"></i>
          <span class="nav-link-text">Médicos</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/patients">
          <i class="ni ni-satisfied text-yellow"></i>
          <span class="nav-link-text">Pacientes</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="examples/tables.html">
          <i class="ni ni-bullet-list-67 text-default"></i>
          <span class="nav-link-text">Horarios</span>
        </a>
      </li>
      @elseif(auth()->user()->role == 'doctor')
      <li class="nav-item">
        <a class="nav-link" href="/schedule">
          <i class="ni ni-calendar-grid-58 text-danger"></i>
          <span class="nav-link-text">Gestionar horarios</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="examples/tables.html">
          <i class="ni ni-time-alarm text-blue"></i>
          <span class="nav-link-text">Mis Citas</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/patients">
          <i class="ni ni-satisfied text-info"></i>
          <span class="nav-link-text">Mis pacientes</span>
        </a>
      </li>
      @else{{-- Patient --}}
      <li class="nav-item">
        <a class="nav-link" href="/appointments/create">
          <i class="ni ni-send text-danger"></i>
          <span class="nav-link-text">Reservar cita</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/appointments">
          <i class="ni ni-time-alarm text-blue"></i>
          <span class="nav-link-text">Mis Citas</span>
        </a>
      </li>
      @endif
      <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
          <i class="ni ni-key-25 text-info"></i>
          <span class="nav-link-text">Cerrar sesión</span>
        </a>
        <form action=" {{ route('logout') }}" method="POST" style="display: none;" id="formLogout">
          @csrf
        </form>
      </li>  
    </ul>
    @if (auth()->user()->role == 'admin')
     <!-- Divider -->
    <hr class="my-3">
    <!-- Heading -->
    <h6 class="navbar-heading p-0 text-muted">
      <span class="docs-normal">Reportes</span>
    </h6>
    <!-- Navigation -->
    <ul class="navbar-nav mb-md-3">
      <li class="nav-item">
        <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html" target="_blank">
          <i class="ni ni-watch-time text-red"></i>
          <span class="nav-link-text">Frecuencia de citas</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html" target="_blank">
          <i class="ni ni-spaceship text-blue"></i>
          <span class="nav-link-text">Médicos más activos</span>
        </a>
      </li>
    </ul>
    @endif
