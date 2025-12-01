<div>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <span class="navbar-brand ms-4 me-4 h4 mb-0">L'Magno Audittore</span>
            <ul class="list-inline mb-0 me-4">
            @guest
                <li class="list-inline-item">
                    <a href="{{ route('login') }}" class="text-white px-4 py-3 rounded hover-bg-fade {{ request()->routeIs('login') ? 'active-nav' : '' }}">Inicio de Sesion</a>
                </li>
                @if (Route::has('register'))
                <li class="list-inline-item">
                    <a href="{{ route('register') }}" class="text-white px-4 py-3 rounded hover-bg-fade {{ request()->routeIs('register') ? 'active-nav' : '' }}"></a>
                </li>
                @endif
            @else
                <li class="list-inline-item">
                    <a href="{{ route('home') }}" class="text-white px-4 py-3 rounded hover-bg-fade {{ request()->routeIs('home') ? 'active-nav' : '' }}">Inicio</a>
                </li>
                <li class="list-inline-item">
                    <a href="{{ route('employees.index') }}" class="text-white px-4 py-3 rounded hover-bg-fade {{ request()->is('employees*') ? 'active-nav' : '' }}">Empleados</a>
                </li>
                <li class="list-inline-item">
                    <a href="{{ route('companies.index') }}" class="text-white px-4 py-3 rounded hover-bg-fade {{ request()->is('companies*') ? 'active-nav' : '' }}">Empresas</a>
                </li>
                <li class="list-inline-item">
                    <a href="{{ route('assignments.index') }}" class="text-white px-4 py-3 rounded hover-bg-fade {{ request()->is('assignments*') ? 'active-nav' : '' }}">Asignaciones</a>
                </li>
                <li class="list-inline-item dropdown">
                    <a id="navbarDropdown" class="text-white px-4 py-3 rounded hover-bg-fade dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
            @endguest
            </ul>
        </div>
    </nav>
</div>

