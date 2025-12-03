<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresa - {{ $empresa->name }}</title>
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
            <h5>Empresa: </h5>
        </div>
        <div class="card-body shadow-sm">
            <dl class="row">
                <dt class="col-sm-3">Nombre</dt>
                <dd class="col-sm-9">{{ $empresa->name }}</dd>
                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9">{{ $empresa->email }}</dd>
                <dt class="col-sm-3">Número Telefonico</dt>
                <dd class="col-sm-9">{{ $empresa->phone }}</dd>
                <dt class="col-sm-3">Dirección:</dt>
                <dd class="col-sm-9">{{ $empresa->address }}</dd>
                @if ($empresa->asignaciones->count() > 0)
                    <div class="mt-4">
                        <h5>Asignaciones relacionadas a la empresa</h5>
                        <ul>
                            @foreach ($empresa->asignaciones as $asignacion)
                                <li>
                                    <strong>Empleado:</strong> {{ $asignacion->empleados->fname }} {{ $asignacion->empleados->sname }} {{ $asignacion->empleados->flastname }} {{ $asignacion->empleados->slastname }} <br>
                                    <strong>Detalles de Asignación:</strong>
                                    <p>{{ $asignacion->detalles_asignacions->assignation_name}}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </dl>
            <div class="d-flex justify-content-end gap-2">
            @if (auth()->user()->role != 'manager')
            <a href="{{ route('companies.edit', $empresa->id) }}" class="btn btn-warning btn-sm">
                Editar
            </a>
            <form action="{{ route('companies.destroy', $empresa->id) }}" method="POST" class="m-0">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este empresa?')">
                    Eliminar
                </button>
            </form>
            @endif
            <a href="{{ route('companies.index')}}" class="btn btn-primary btn-sm">
                Regresar al inicio
            </a>
            </div>
        </div> 
    </div>
</body>
<x-footer></x-footer>
</html>