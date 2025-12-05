<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <x-header></x-header>
    <div class="card rounded mx-5 mb-3 mt-5">
        <div class="card-header py-3">
            <h5>Creación de Usuario</h5>
        </div>
        <div class="card-body shadow-sm">
            <form action="{{ route('user.store') }}" enctype="multipart/form-data" method="post">
            @csrf
                <div class="mb-3 form-floating">
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" title="Escribe un nombre de usuario no mayor a 255 caracteres." required minlength="2" maxlength="255">
                    <label for="name">Nombre <span class="text-danger">*</span></label>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 form-floating">
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" pattern="[a-zA-Z0-9._%+-]+@lmagnoaudittore\.com" title="El correo debe de pertener al dominio de la empresa." required>
                    <label for="email">Email <span class="text-danger">*</span></label>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 form-floating">
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" value="" title="La contraseña debe ser valida, no mayor a 255 caracteres ni menor a 8 caracteres." required minlength="8" maxlength="255">
                    <label for="password">Contraseña <span class="text-danger">*</span></label>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 form-floating">
                    <select name="role" id="role" class="form-select @error('role') is-invalid @enderror">
                        @foreach ($roles as $role)
                            @if (old('role') == $role)
                                <option value="{{ $role }}" selected>{{ $role }}</option>
                            @else
                                <option value="{{ $role }}">{{ $role }}</option>
                            @endif
                        @endforeach
                    </select>
                    <label for="role">Rol del Usuario <span class="text-danger">*</span></label>
                    @error('role')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" value="create" class="btn btn-success">Crear Usuario</button>
            </form>
        </div> 
    </div>
</body>
<x-footer></x-footer>
</html>
