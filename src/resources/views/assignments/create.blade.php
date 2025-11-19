<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignaciones - Crear</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <x-header></x-header>
    <div class="card rounded mx-5 mb-3 mt-5">
        <div class="card-header py-3">
            <h5>Creación de Asignación: </h5>
        </div>
        <div class="card-body shadow-sm">
            <form action="{{ route('assignments.store') }}" enctype="multipart/form-data" method="post">
            @csrf
                <div class="mb-3 form-floating">
                    <input type="text" name="empresa_id" list="company" id="empresa_id" value="{{ old('empresa_id') }}" class="form-control @error('empresa_id') is-invalid @enderror " title="Maximo 50 caracteres, ingrese un nombre valido." minlength="2" maxlength="50" required>
                    <label for="empresa_id"> Empresa <span class="text-danger">*</span></label>
                    <datalist id="company">
                        @foreach($empresas as $empresa)
                            <option value="{{ $empresa->id }}">{{ $empresa->name }}</option>
                        @endforeach
                    </datalist>
                    @error('empresa_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" list="employee" name="ci" id="ci" value="{{ old('ci') }}" class="form-control @error('ci') is-invalid @enderror" title="Maximo 50 caracteres, ingrese un nombre valido." minlength="2" maxlength="50" required>
                    <label for="ci">Empleado <span class="text-danger">*</span></label>
                    <datalist id="employee">
                        @foreach($empleados as $empleado)
                            <option value="{{ $empleado->ci }}">{{ $empleado->fname }} {{ $empleado->sname }} {{ $empleado->flastname }} {{ $empleado->slastname }}</option>
                        @endforeach
                    </datalist>
                    @error ('ci')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" name="assignation_name" id="assignation_name" value="{{ old('assignation_name') }}" required minlength="10" maxlength="100" title="Describa brevemente la asignacion"  class="form-control @error('assignation_name') is-invalid @enderror">
                    <label for="assignation_name">Nombre de la Asignación <span class="text-danger">*</span></label>
                    @error('assignation_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 form-floating">
                    <textarea type="text" name="description" id="description" value="{{ old('description') }}" required minlength="10" maxlength="65535" title="Describa la asignacion"  class="form-control @error('description') is-invalid @enderror"> Describe la asignacion</textarea>
                    <label for="assignation_name">Descripción de la Asignación <span class="text-danger">*</span></label>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 form-floating">
                    <input type="date" name="assigned_date" id="assigned_date" value="{{ old('assigned_date')!= null ? old('assigned_date') : date('Y-m-d')  }}" required title="Establezca la fecha cuando se establecio la asignción, no puede ser anterior a una semana a partir de hoy."  class="form-control @error('assigned_date') is-invalid @enderror">
                    <label for="assigned_date">Fecha de Asignación<span class="text-danger">*</span></label>
                    @error('assigned_date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 form-floating">
                    <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}" required  title="Establezca la fecha limite de la asignación, no puede ser mayor a 6 meses"  class="form-control @error('due_date') is-invalid @enderror">
                    <label for="due_date">Fecha Limite de Asignación<span class="text-danger">*</span></label>
                    @error('due_date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" value="create" class="btn btn-success">Agregar Asignación</button>
            </form>
        </div> 
    </div>
</body>
<x-footer></x-footer>
</html>