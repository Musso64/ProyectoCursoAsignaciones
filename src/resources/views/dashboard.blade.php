<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Gestion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <x-header></x-header>
    <div class="container mt-5">
        <h1>Bienvenido a L'Magno Audittore</h1>
        <p>A continuación se presenta un resumen de los empleados, compañias y asignaciones.</p>
    </div>
    <div class="card rounded mx-5">
    <div class="card-header">
        <h5>Empleados: </h5>
    </div>
    <div class="card-body">
        <table class="table table-dark table-striped table-hover">
            <thead>
                <tr class="text-danger">
                    <th>CI</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Número de Contacto</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Fecha de Contratacion</th>
                    <th>Posición</th>
                    <th>Departamento</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->ci }}</td>
                    <td>{{ $empleado->fname }} {{ $empleado->sname }} {{ $empleado->flastname }} {{ $empleado->slastname }}</td>
                    <td>{{ $empleado->email }}</td>
                    <td>{{ $empleado->phonenumber }}</td>
                    <td>{{ $empleado->birthdate }}</td>
                    <td>{{ $empleado->hiredate }}</td>
                    <td>{{ $empleado->position }}</td>  
                    <td>{{ $empleado->department }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <span class="align-content-start">
            <p>Total de empleados: {{ count($empleados) }}</p>
        </span>
        <div>
            <a href="{{ route('employees.index') }}" class="btn btn-primary">Manage</a>
        </div>
    </div>
</div>
</body>
<x-footer></x-footer>
</html>