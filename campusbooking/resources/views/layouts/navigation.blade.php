<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
    <div class="container">

   
        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
            Sistema de Reservas
        </a>

        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        
        <div class="collapse navbar-collapse" id="mainNavbar">

          
            <ul class="navbar-nav me-auto">
               
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('espacios.*') ? 'active fw-bold' : '' }}"
                       href="{{ route('espacios.index') }}">
                       Espacios
                    </a>
                </li>
           

              
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('reservas.*') ? 'active fw-bold' : '' }}"
                       href="{{ route('reservas.index') }}">
                       Reservas
                    </a>
                </li>
              


            </ul>

          
            <ul class="navbar-nav ms-auto">

              
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold" href="#" id="userDropdown" role="button"
                       data-bs-toggle="dropdown">
                        {{ Auth::user()->name }}
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">

                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                Perfil
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item text-danger"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Cerrar sesión
                                </button>
                            </form>
                        </li>

                    </ul>
                </li>

            </ul>

        </div>
    </div>
</nav>
