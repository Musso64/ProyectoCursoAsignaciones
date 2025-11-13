<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresas - Crear</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <x-header></x-header>
    <div class="card rounded mx-5 mb-3 mt-5">
        <div class="card-header py-3">
            <h5>Creación de Empresa: </h5>
        </div>
        <div class="card-body shadow-sm">
            <form action="{{ route('companies.store') }}" enctype="multipart/form-data" method="post">
            @csrf
                <div class="mb-3 form-floating">
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror " title="Maximo 50 caracteres, ingrese un nombre valido." minlength="2" maxlength="50" required>
                    <label for="name">Nombre <span class="text-danger">*</span></label>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 form-floating">
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" pattern="[a-zA-Z0-9._%+-]+@+[a-zA-Z0-9._%+-]" title="El correo debe de pertener al dominio de la empresa." required>
                    <label for="email">Email <span class="text-danger">*</span></label>
                    @error ('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" name="phone" id="phone" required pattern="0\d{3}-\d{7}" title="Formato de referenaddressa: 0412-3456789"  class="form-control @error('phonenumber') is-invalid @enderror">
                    <label for="phone">Número de Teléfono <span class="text-danger">*</span></label>
                    @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" title="Escribir la dirección completa." required pattern="[a-zA-Z0-9._%+-]">
                    <label for="address">Direccion <span class="text-danger">*</span></label>
                    @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" value="create" class="btn btn-success">Agregar Empresa</button>
            </form>
        </div> 
    </div>
</body>
<x-footer></x-footer>
</html>