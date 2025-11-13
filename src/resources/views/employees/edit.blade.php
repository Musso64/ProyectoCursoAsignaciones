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
                            <input type="text" name="fname" id="fname" class="form-control @error('fname') is-invalid @enderror" value="{{ $empleado->fname }}" title="Maximo 20 caracteres, ingrese un nombre valido." minlength="2" maxlength="20" required>
                            <label for="fname">Primer Nombre <span class="text-danger">*</span></label>
                            @error('fname')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 form-floating">
                            <input type="text" name="sname" id="sname" class="form-control @error('sname') is-invalid @enderror" title="Maximo 20 caracteres, ingrese un nombre valido." minlength="2" maxlength="20" value="{{ $empleado->sname }}">
                            <label for="sname">Segundo Nombre</label>
                            @error('sname')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 form-floating">
                            <input type="text" name="flastname" id="flastname" class="form-control @error('flastname') is-invalid @enderror" value="{{ $empleado->flastname }}" title="Maximo 20 caracteres, ingrese un apellido valido." minlength="2" maxlength="20" required>
                            <label for="flastname">Primer Apellido <span class="text-danger">*</span></label>
                            @error('flastname')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 form-floating">
                            <input type="text" name="slastname" id="slastname" class="form-control @error('slastname') is-invalid @enderror" value="{{ $empleado->slastname }}" title="Maximo 20 caracteres, ingrese un apellido valido." minlength="2" maxlength="20">
                            <label for="slastname">Segundo Apellido</label>
                            @error('slastname')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-3 form-floating">
                    <input type="number" name="ci" id="ci" class="form-control @error('ci') is-invalid @enderror" value="{{ $empleado->ci }}" disabled title="Escribir unicamente la cedula, sin puntos." required pattern="d{7,8}">
                    <label for="ci">Cédula <span class="text-danger">*</span></label>
                    @error('ci')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 form-floating">
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $empleado->email }}" pattern="[a-zA-Z0-9._%+-]+@lmagnoaudittore\.com" title="El correo debe de pertener al dominio de la empresa." required>
                    <label for="email">Email <span class="text-danger">*</span></label>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" name="phonenumber" id="phonenumber" class="form-control @error('phonenumber') is-invalid @enderror" required pattern="0\d{3}-\d{7}" title="Formato de referencia: 0412-3456789" value="{{ $empleado->phonenumber}}">
                    <label for="phonenumber">Número de Teléfono <span class="text-danger">*</span></label>
                    @error('phonenumber')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 form-floating">
                    <input type="date" name="birthdate" id="birthdate" class="form-control @error('birthdate') is-invalid @enderror" value="{{ $empleado->birthdate }}" disabled>
                    <label for="birthdate">Fecha de Nacimiento <span class="text-danger">*</span></label>
                    @error('birthdate')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 form-floating">
                    <input type="date" name="hiredate" id="hiredate" class="form-control @error('hiredate') is-invalid @enderror" value="{{ $empleado->hiredate }}" disabled>
                    <label for="hiredate">Fecha de Contratación <span class="text-danger">*</span></label>
                    @error('hiredate')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 form-floating">
                    <select name="department" id="department" class="form-select @error('department') is-invalid @enderror">
                        @foreach ($departments as $department)
                            @if ($department == $empleado->department)
                                <option value="{{ $department }}" selected>{{ $department }}</option>
                            @else
                            <option value="{{ $department }}">{{ $department }}</option>
                            @endif
                        @endforeach
                    </select>
                    <label for="department">Departamento <span class="text-danger">*</span></label>
                    @error('department')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 form-floating">
                    <select name="position" id="position" class="form-select @error('position') is-invalid @enderror">
                        @foreach ($positions as $position)
                        @if ($position == $empleado->position)
                                <option value="{{ $position }}" selected>{{ $position }}</option>
                            @else
                            <option value="{{ $position }}">{{ $position }}</option>
                            @endif
                        @endforeach
                    </select>
                    <label for="position">Posicion <span class="text-danger">*</span></label>
                    @error('position')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Foto de Perfil</label>
                    <input type="file" name="photo" id="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*">
                    <div class="form-text">Formatos: JPG, PNG, GIF. Máximo 2MB.</div>
                    @error('photo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" value="create" class="btn btn-success">Modificar Empleado</button>
            </form>
        </div> 
    </div>
</body>
<x-footer></x-footer>
</html>