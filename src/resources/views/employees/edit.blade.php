<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleado - {{ $empleado->fname }} {{ $empleado->sname }} {{ $empleado->flastname }} {{ $empleado->slastname }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <x-header></x-header>
    <div class="card rounded mx-5 mb-3 mt-5">
        <div class="card-header py-3">
            <h5>Edición de Empleado: </h5>
        </div>
        <div class="card-body shadow-sm">
            <form action="{{ route('employees.update', $empleado->ci) }}" enctype="multipart/form-data" method="post">
            @csrf
            @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 form-floating">
                            <input type="text" name="fname" id="fname" class="form-control" value="{{ $empleado->fname }}" required>
                            <label for="fname">Primer Nombre</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 form-floating">
                            <input type="text" name="sname" id="sname" class="form-control" value="{{ $empleado->sname }}">
                            <label for="sname">Segundo Nombre</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 form-floating">
                            <input type="text" name="flastname" id="flastname" class="form-control" value="{{ $empleado->flastname }}" required>
                            <label for="flastname">Primer Apellido</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 form-floating">
                            <input type="text" name="slastname" id="slastname" class="form-control" value="{{ $empleado->slastname }}">
                            <label for="slastname">Segundo Apellido</label>
                        </div>
                    </div>
                </div>
                <div class="mb-3 form-floating">
                    <input type="number" name="ci" id="ci" class="form-control" value="{{ $empleado->ci }}" disabled>
                    <label for="ci">Cédula</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="email" name="email" id="email" class="form-control" required value="{{ $empleado->email }}">
                    <label for="email">Email</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" name="phonenumber" id="phonenumber" class="form-control" value="{{ $empleado->phonenumber}}">
                    <label for="phonenumber">Número de Teléfono</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="date" name="birthdate" id="birthdate" class="form-control" value="{{ $empleado->birthdate }}" disabled>
                    <label for="birthdate">Fecha de Nacimiento</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" name="hiredate" id="hiredate" class="form-control" value="{{ $empleado->hiredate }}" disabled>
                    <label for="hiredate">Fecha de Contratación</label>
                </div>
                <div class="mb-3 form-floating">
                    <select name="department" id="department" class="form-select">
                        @foreach ($departments as $department)
                            @if ($department == $empleado->department)
                                <option value="{{ $department }}" selected>{{ $department }}</option>
                            @else
                            <option value="{{ $department }}">{{ $department }}</option>
                            @endif
                        @endforeach
                    </select>
                    <label for="department">Departamento</label>
                </div>
                <div class="mb-3 form-floating">
                    <select name="position" id="position" class="form-select">
                        @foreach ($positions as $position)
                        @if ($position == $empleado->position)
                                <option value="{{ $position }}" selected>{{ $position }}</option>
                            @else
                            <option value="{{ $position }}">{{ $position }}</option>
                            @endif
                        @endforeach
                    </select>
                    <label for="position">Posicion</label>
                </div>
                <div class="mb-3">
                    <label for="profile_picture" class="form-label">Foto de Perfil</label>
                    <input type="file" name="profile_picture" id="profile_picture" class="form-control" accept="image/*">
                    <div class="form-text">Formatos: JPG, PNG, GIF. Máximo 2MB.</div>
                </div>
                <button type="submit" value="create" class="btn btn-success">Modificar Empleado</button>
            </form>
        </div> 
    </div>
</body>
<x-footer></x-footer>
</html>