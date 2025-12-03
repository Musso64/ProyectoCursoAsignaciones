<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Gestion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
    <x-header></x-header>
    <div class="container mt-5">
        <h1>Bienvenido a L'Magno Audittore</h1>
        <p>A continuación se presenta un resumen de los empleados, compañias y asignaciones.</p>
    </div>
    <div class="card rounded mx-5 mb-3">
        <div class="card-header py-3">
            <h5>Empleados: </h5>
        </div>
        <div class="card-body shadow-sm">
            <table class="table table-dark table-striped table-hover table-rounded">
                <thead>
                    <tr class="text-danger">
                        <th>Nombre</th>
                        <th>Posición</th>
                        <th>Departamento</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empleados->take(5) as $empleado)
                    <tr>
                        <td>{{ $empleado->fname }} {{ $empleado->sname }} {{ $empleado->flastname }} {{ $empleado->slastname }}</td>
                        <td>{{ $empleado->position }}</td>  
                        <td>{{ $empleado->department }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between">
                <span>
                    <p>Total de empleados: {{ count($empleados) }}</p>
                </span>
                <span>
                    <a href="{{ route('employees.index') }}" class="btn text-dark btn-danger">Gestionar</a>
                </span>
            </div>
        </div>
    </div>
    <div class="card rounded mx-5 mb-3">
        <div class="card-header py-3">
            <h5>Empresas: </h5>
        </div>
        <div class="card-body shadow-sm">
            <table class="table table-dark table-striped table-hover table-rounded">
                <thead>
                    <tr class="text-danger">
                        <th>Nombre</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empresas->take(5) as $empresa)
                    <tr>
                        <td>{{ $empresa->name }}</td>
                        <td>{{ $empresa->email }}</td>  
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between">
                <span>
                    <p>Total de empresas: {{ count($empresas) }}</p>
                </span>
                <span>
                    <a href="{{ route('companies.index') }}" class="btn text-dark btn-danger">Gestionar</a>
                </span>
            </div>
        </div>
    </div>
    <div class="card rounded mx-5 mb-3">
        <div class="card-header py-3">
            <h5>Asignaciones: </h5>
        </div>
        <div class="card-body shadow-sm">
            <table class="table table-dark table-striped table-hover table-rounded">
                <thead>
                    <tr class="text-danger">
                        <th>Nombre del Empleado</th>
                        <th>Nombre de la Compañia</th>
                        <th>Nombre de la Asignacion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($asignaciones->take(5) as $asignacion)
                    <tr>
                        <td>{{ $asignacion->empleados->fname }} {{ $asignacion->empleados->sname }} {{ $asignacion->empleados->flastname }} {{ $asignacion->empleados->slastname }}</td>
                        <td>{{ $asignacion->empresas->name }}</td>
                        <td>{{ $asignacion->detalles_asignacions->assignation_name }}</td>  
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between">
                <span>
                    <p>Total de asignaciones: {{ count($asignaciones) }}</p>
                </span>
                <span>
                    <a href="{{ route('assignments.index') }}" class="btn text-dark btn-danger">Gestionar</a>
                </span>
            </div>
        </div>
    </div>
    <div class="card rounded mx-5 mb-3">
        <div class="card-header py-3">
            <h5>Usuarios: </h5>
        </div>
        <div class="card-body shadow-sm">
            <table class="table table-dark table-striped table-hover table-rounded">
                <thead>
                    <tr class="text-danger">
                        <th>Nombre del Usuario</th>
                        <th>Correo del Usuario</th>
                        <th>Contraseña del Usuario</th>
                        <th>Rol del Usuario</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios->take(5) as $usuari)
                    <tr>
                        <td>{{ $asignacion->name }}</td>
                        <td>{{ $asignacion->email }}</td>
                        <td>{{ $asignacion->password }}</td>  
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between">
                <span>
                    <p>Total de asignaciones: {{ count($asignaciones) }}</p>
                </span>
                <span>
                    <a href="{{ route('assignments.index') }}" class="btn text-dark btn-danger">Gestionar</a>
                </span>
            </div>
        </div>
    </div>
</body>
<x-footer></x-footer>
</html>