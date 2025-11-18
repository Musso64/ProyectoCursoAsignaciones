<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados - Crear</title>
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
            <form action="{{ route('employees.store') }}" enctype="multipart/form-data" method="post">
            @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 form-floating">
                            <input type="text" name="fname" id="fname" class="form-control @error('fname') is-invalid @enderror " title="Maximo 20 caracteres, ingrese un nombre valido." value="{{ old('fname') }}" minlength="2" maxlength="20" required>
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
                            <input type="text" name="sname" id="sname" title="Maximo 20 caracteres, ingrese un nombre valido." minlength="2" maxlength="20" value="{{ old('sname') }}" class="form-control @error('sname') is-invalid @enderror">
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
                            <input type="text" name="flastname" id="flastname" title="Maximo 20 caracteres, ingrese un apellido valido." value="{{ old('flastname') }}" minlength="2" maxlength="20" class="form-control @error('flastname') is-invalid @enderror" required>
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
                            <input type="text" name="slastname" id="slastname" title="Maximo 20 caracteres, ingrese un apellido valido." minlength="2" value="{{ old('slastname') }}" maxlength="20" class="form-control @error('slastname') is-invalid @enderror">
                            <label for="slastname">Segundo Apellido </label>
                            @error('slastname')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-3 form-floating">
                    <input type="number" name="ci" id="ci" value="{{ old('ci') }}" class="form-control @error('ci') is-invalid @enderror" title="Escribir unicamente la cedula, sin puntos." required pattern="d{7,8}">
                    <label for="ci">Cédula <span class="text-danger">*</span></label>
                    @error('ci')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 form-floating">
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" pattern="[a-zA-Z0-9._%+-]+@lmagnoaudittore\.com" title="El correo debe de pertener al dominio de la empresa." required>
                    <label for="email">Email <span class="text-danger">*</span></label>
                    @error ('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" name="phonenumber" id="phonenumber" value="{{ old('phonenumber') }}" required pattern="0\d{3}-\d{7}" title="Formato de referencia: 0412-3456789"  class="form-control @error('phonenumber') is-invalid @enderror">
                    <label for="phonenumber">Número de Teléfono <span class="text-danger">*</span></label>
                    @error('phonenumber')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 form-floating">
                    <input type="date" name="birthdate" id="birthdate" value="{{ old('birthdate') }}" class="form-control @error('birthdate') is-invalid @enderror" required>
                    <label for="birthdate">Fecha de Nacimiento <span class="text-danger">*</span></label>
                    @error('birthdate')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 form-floating">
                    <select name="department" id="department" class="form-select @error('department') is-invalid
                    @enderror" required>
                        @foreach ($departments as $department)
                            <option value="{{ $department }}" {{ old('department') == $department ? 'selected' : '' }}>{{ $department }}</option>
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
                    <select name="position" id="position" class="form-select @error('position') is-invalid @enderror" required>
                        @foreach ($positions as $position)
                            <option value="{{ $position }}" {{ old('position') == $position ? 'selected' : '' }}>{{ $position }}</option>
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
                <button type="submit" value="create" class="btn btn-success">Crear Empleado</button>
            </form>
        </div> 
    </div>
</body>
<x-footer></x-footer>
</html>