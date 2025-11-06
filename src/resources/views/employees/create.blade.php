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
    <div class="card rounded mx-5 mb-3 mt-5">
        <div class="card-header py-3">
            <h5>Creacion de Empleado: </h5>
        </div>
        <div class="card-body shadow-sm">
            <form action="{{ route('employees.store') }}" method="post">
            @csrf
                <div class="mb-3 form-floating">
                    <input type="text" name="name" id="name" class="form-control">
                    <label for="name">Nombre Completo</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="number" name="ci" id="ci" class="form-control">
                    <label for="ci">Cédula</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="email" name="email" id="email" class="form-control" required>
                    <label for="email">Email</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" name="phonenumber" id="phonenumber" class="form-control">
                    <label for="phonenumber">Número de Teléfono</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="date" name="birthdate" id="birthdate" class="form-control">
                    <label for="birthdate">Fecha de Nacimiento</label>
                </div>
                <div class="mb-3 form-floating">
                    <select name="department" id="department" class="form-select">
                        @foreach ($departments as $department)
                            <option value="{{ $department }}">{{ $department }}</option>
                        @endforeach
                    </select>
                    <label for="department">Departamento</label>
                </div>
                <div class="mb-3 form-floating">
                    <select name="position" id="position" class="form-select">
                        @foreach ($positions as $position)
                            <option value="{{ $position }}">{{ $position }}</option>
                        @endforeach
                    </select>
                    <label for="position">Posicion</label>
                </div>
                <button type="submit" value="create" class="btn btn-success">Crear Empleado</button>
            </form>
        </div> 
    </div>
</body>
<x-footer></x-footer>
</html>