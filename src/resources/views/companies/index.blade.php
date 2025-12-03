<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresas - Gestion</title>
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
            <h5>Empresas: </h5>
        </div>
        <form method="GET" action="{{ route('companies.index') }}" class="mb-4 ms-4 mt-4">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="search" class="form-label">Buscar empresas</label>
                    <input type="text" name="search" id="search" class="form-control" placeholder="Nombre, teléfono, email..." value="{{ request('search') }}">
                </div>
                <div class="col-md-auto">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    <a href="{{ route('companies.index') }}" class="btn btn-secondary">Limpiar</a>
                </div>
            </div>
        </form>
        <div class="card-body shadow-sm overflow-auto table-responsive">
            <table class="table table-dark table-striped table-hover table-rounded">
                <thead>
                    <tr class="text-danger">
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Numero de Telefono</th>
                        <th>Direccion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empresas as $empresa)
                    <tr>
                        <td>{{ $empresa->name }}</td>
                        <td>{{ $empresa->email }}</td>
                        <td>{{ $empresa->phone }}</td>
                        <td>{{ $empresa->address }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <a href="{{ route('companies.show', $empresa->id) }}" class="btn btn-primary btn-sm">
                                    Ver
                                </a>
                                @if (auth()->user()->role != 'manager')
                                <form action="{{ route('companies.destroy', $empresa->id) }}" method="POST" class="m-0">
                                @csrf
                                @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este empleado?')">
                                        Eliminar
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $empresas->links('pagination::bootstrap-5') }}
            </div>
            <div class="d-flex justify-content-between">
                <span>
                    <p>Total de empresas: {{ count($empresas) }}</p>
                </span>
                <a href="{{ route('companies.create') }}" class="btn btn-success">Agregar Empresa</a>
            </div>
        </div>
    </div>
</body>
<x-footer></x-footer>
</html>