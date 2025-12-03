<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios - Gestion</title>
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
            <h5>Empleados: </h5>
        </div>
        <form method="GET" action="{{ route('employees.index') }}" class="mb-4 ms-4 mt-4">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="search" class="form-label">Buscar empleados</label>
                    <input type="text" name="search" id="search" class="form-control" placeholder="Nombre, cédula, email..." value="{{ request('search') }}">
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
                <div class="col-md-auto">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Limpiar</a>
                </div>
            </div>
        </form>
        <div class="card-body shadow-sm overflow-auto table-responsive">
            <table class="table table-sm table-dark table-striped table-hover table-rounded">
                <thead>
                    <tr class="text-danger">
                        <th>Foto:</th>
                        <th>Nombre</th>
                        <th>Cedula</th>
                        <th>Email</th>
                        <th>Numero de Telefono</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Fecha de Contratacion</th>
                        <th>Posición</th>
                        <th>Departamento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empleados as $empleado)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/images/' . $empleado->photo) }}" class="rounded-circle" width="40" height="40">
                        </td>
                        <td>{{ $empleado->fname }} {{ $empleado->sname }} {{ $empleado->flastname }} {{ $empleado->slastname }}</td>
                        <td>{{ $empleado->ci }}</td>
                        <td class="text-truncate" style="max-width: 150px;">{{ $empleado->email }}</td>
                        <td>{{ $empleado->phonenumber }}</td>
                        <td>{{ $empleado->birthdate }}</td>
                        <td>{{ $empleado->hiredate }}</td>
                        <td>{{ $empleado->position }}</td>  
                        <td>{{ $empleado->department }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <a href="{{ route('employees.show', $empleado->ci) }}" class="btn btn-primary btn-sm">
                                    Ver
                                </a>
                                <form action="{{ route('employees.destroy', $empleado->ci) }}" method="POST" class="m-0">
                                @csrf
                                @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este empleado?')">
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
                {{ $empleados->links('pagination::bootstrap-5') }}
            </div>
            <div class="d-flex justify-content-between">
                <span>
                    <p>Total de empleados: {{ count($empleados) }}</p>
                </span>
                <a href="{{ route('employees.create') }}" class="btn btn-success">Nuevo Empleado</a>
            </div>
        </div>
    </div>
</body>
<x-footer></x-footer>
</html>