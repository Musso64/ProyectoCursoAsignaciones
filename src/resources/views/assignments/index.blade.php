<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignaciones - Gestion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <x-header></x-header>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    <div class="card rounded mx-5 mb-3 mt-5">
        <div class="card-header py-3">
            <h5>Asignaciones: </h5>
        </div>
        <form method="GET" action="{{ route('assignments.index') }}" class="mb-4 ms-4 mt-4">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="search" class="form-label">Buscar asignaciones</label>
                    <input type="text" name="search" id="search" class="form-control"  placeholder="Nombre, empresa, empleado..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="department" class="form-select">
                        <option value="">Todos los departamentos</option>
                        <option value="Administracion" {{ request('department') == 'Administracion' ? 'selected' : '' }}>Administración</option>
                        <option value="IT" {{ request('department') == 'IT' ? 'selected' : '' }}>IT</option>
                        <option value="Marketing" {{ request('department') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                        <option value="Auditoria" {{ request('department') == 'Auditoria' ? 'selected' : '' }}>Auditoría</option>
                        <option value="Impuesto" {{ request('department') == 'Impuesto' ? 'selected' : '' }}>Impuesto</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="position" class="form-select">
                        <option value="">Todas las posiciones</option>
                        <option value="Gerente" {{ request('position') == 'Gerente' ? 'selected' : '' }}>Gerente</option>
                        <option value="Senior" {{ request('position') == 'Senior' ? 'selected' : '' }}>Senior</option>
                        <option value="Asistente" {{ request('position') == 'Asistente' ? 'selected' : '' }}>Asistente</option>
                        <option value="Socio" {{ request('position') == 'Socio' ? 'selected' : '' }}>Socio</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">Todos los estados</option>
                        <option value="Completada" {{ request('status') == 'Completada' ? 'selected' : '' }}>Completada</option>
                        <option value="Pendiente" {{ request('status') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="En progreso" {{ request('status') == 'En progreso' ? 'selected' : '' }}>En progreso</option>
                        <option value="Cancelada" {{ request('status') == 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
                    </select>
                </div>
                <div class="col-md-auto">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    <a href="{{ route('assignments.index') }}" class="btn btn-secondary">Limpiar</a>
                </div>
            </div>
        </form>
        <div class="card-body shadow-sm overflow-auto table-responsive">
            <table class="table table-dark table-striped table-hover table-rounded">
                <thead>
                    <tr class="text-danger">
                        <th>Nombre de la Asignación</th>
                        <th>Detalles</th>
                        <th>Fecha de Asignación</th>
                        <th>Fecha Limite</th>
                        <th>Empleado a Cargo</th>
                        <th>Empresa</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($asignaciones as $asignacion)
                    <tr>
                        <td>{{ $asignacion->detalles_asignacions->assignation_name }}</td>
                        <td>{{ $asignacion->detalles_asignacions->description }}</td>
                        <td>{{ $asignacion->detalles_asignacions->assigned_date }}</td>
                        <td>{{ $asignacion->detalles_asignacions->due_date }}</td>
                        <td>{{ $asignacion->empleados->fname }} {{ $asignacion->empleados->sname }} {{ $asignacion->empleados->flastname }} {{ $asignacion->empleados->slastname }}</td>
                        <td>{{ $asignacion->empresas->name }}</td>
                        <td>{{ $asignacion->detalles_asignacions->status }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <a href="{{ route('assignments.show', $asignacion->id) }}" class="btn btn-primary btn-sm">
                                    Ver
                                </a>
                                <form action="{{ route('assignments.destroy', $asignacion->id) }}" method="POST" class="m-0">
                                @csrf
                                @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta asignación?')">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $asignaciones->links('pagination::bootstrap-5') }}
            </div>
            <div class="d-flex justify-content-between">
                <span>
                    <p>Total de asignaciones: {{ count($asignaciones) }}</p>
                </span>
                <a href="{{ route('assignments.create') }}" class="btn btn-success">Agregar Asignación</a>
            </div>
        </div>
    </div>
</body>
<x-footer></x-footer>
</html>