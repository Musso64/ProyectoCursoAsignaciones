<div>
    <nav class="navbar navbar-dark bg-dark">
        <ul class="unstyled text-white pt-2 list-inline">
            <li class="me-4 list-inline-item">
                <a href="{{ route('home') }}" class="text-decoration-none text-white px-4 py-4 rounded hover-bg-fade {{ request()->routeIs('home') ? 'active-nav' : '' }}">Inicio</a>
            </li>
            <li class="me-4 list-inline-item">
                <a href="{{ route('employees') }}" class="text-decoration-none text-white px-4 py-4 rounded hover-bg-fade {{ request()->routeIs('employees') ? 'active-nav' : '' }}">Empleados</a>
            </li>
            <li class="me-4 list-inline-item">
                <a href="{{ route('companies') }}" class="text-decoration-none text-white px-4 py-4 rounded hover-bg-fade {{ request()->routeIs('companies') ? 'active-nav' : '' }}">Empresas</a>
            </li>
            <li class="me-4 list-inline-item">
                <a href="{{ route('assignments') }}" class="text-decoration-none text-white px-4 py-4 rounded hover-bg-fade {{ request()->routeIs('assignments') ? 'active-nav' : '' }}">Asignaciones</a>
            </li>
        </ul>
    </nav>
</div>

<style>
.hover-bg-fade:hover {
    background-color: rgba(255,255,255,0.15);
    transition: background-color 0.2s ease;
}
.active-nav {
    background-color: rgba(220, 53, 69, 0.2); /* Bootstrap danger color with transparency */
}
</style>