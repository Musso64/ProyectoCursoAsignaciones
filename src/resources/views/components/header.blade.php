<div>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <span class="navbar-brand ms-4 me-4 h4 mb-0">L'Magno Audittore</span>
            <ul class="list-inline mb-0 me-4">
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
            </ul>
        </div>
    </nav>
</div>

