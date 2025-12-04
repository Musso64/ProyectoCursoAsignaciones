<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados - {{ $empleado->fname }} {{ $empleado->sname }} {{ $empleado->flastname }} {{ $empleado->slastname }}</title>
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
            <h5>Empleado: </h5>
        </div>
        <div class="card-body shadow-sm">
            <dl class="row">
            <dt class="col-sm-3">Foto:</dt>
                <dd class="col-sm-9">
                        <img src="{{ asset('storage/images/' . $empleado->photo) }}" class="img-thumbnail" width="150">
                </dd>
                <dt class="col-sm-3">Nombre Completo</dt>
                <dd class="col-sm-9">{{ $empleado->fname }} {{ $empleado->sname }} {{ $empleado->flastname }} {{ $empleado->slastname }}</dd>
                <dt class="col-sm-3">Cedúla de Identidad</dt>
                <dd class="col-sm-9">{{ $empleado->ci }}</dd>
                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9">{{ $empleado->email }}</dd>
                <dt class="col-sm-3">Número Telefonico</dt>
                <dd class="col-sm-9">{{ $empleado->phonenumber }}</dd>
                <dt class="col-sm-3">Fecha de Nacimiento</dt>
                <dd class="col-sm-9">{{ $empleado->birthdate }}</dd>
                <dt class="col-sm-3">Fecha de Contratación</dt>
                <dd class="col-sm-9">{{ $empleado->hiredate }}</dd>
                <dt class="col-sm-3">Posición</dt>  
                <dd class="col-sm-9">{{ $empleado->position }}</dd>
                <dt class="col-sm-3">Departamento</dt>
                <dd class="col-sm-9">{{ $empleado->department }}</dd>
                @if ($empleado->asignaciones->count() > 0)
                    <div class="mt-4">
                        <h5>Asignaciones del Empleado</h5>
                        <ul>
                            @foreach ($empleado->asignaciones as $asignacion)
                                <li>
                                    <strong>Empresa:</strong> {{ $asignacion->empresas->name }} <br>
                                    <strong>Detalles de Asignación:</strong>
                                    <p>{{ $asignacion->detalles_asignacions->assignation_name}}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </dl>
            <div class="d-flex justify-content-end gap-2">
            @if (auth()->user()->role === 'sadmin')
            <a href="{{ route('user.edit', $usuario->id) }}" class="btn btn-warning btn-sm">
                Editar
            </a>
            <form action="{{ route('employees.destroy', $usuario->id) }}" method="POST" class="m-0">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                    Eliminar
                </button>
            </form>
            @endif
            <a href="{{ route('employees.index')}}" class="btn btn-primary btn-sm">
                Regresar al inicio
            </a>
            </div>
        </div> 
    </div>
</body>
<x-footer></x-footer>
</html>