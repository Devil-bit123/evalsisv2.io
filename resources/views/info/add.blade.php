@extends('voyager::master')

@section('content')

@if ($user->role->name == 'admin')

<div class="container">
    <h2>{{ $user->name }} Info</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('info.add', ['id' => $user->id]) }}" method="post">
        @csrf

        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="number" name="telefono" class="form-control" value="{{ old('telefono') }}" required>
        </div>

        <div class="form-group">
            <label for="fecha">Fecha de nacimiento:</label>
            <input type="date" id="fechaNacimiento" name="fechaNacimiento" class="form-control" value="{{ old('fechaNacimiento') }}" required>
        </div>

        <div class="form-group">
            <label for="cedula">Cédula:</label>
            <input type="number" name="cedula" class="form-control" value="{{ old('cedula') }}" required>
        </div>

        <div class="form-group">
            <label for="direccion">Dirección:</label>
            <textarea name="direccion" class="form-control" required>{{ old('direccion') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>


@elseif ($user->role->name == 'docente')

<div class="container">
    <h2>{{ $user->name }} Info</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('info.add', ['id' => $user->id]) }}" method="post">
        @csrf

        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="number" name="telefono" class="form-control" value="{{ old('telefono') }}" required>
        </div>

        <div class="form-group">
            <label for="fecha">Fecha de nacimiento:</label>
            <input type="date" id="fechaNacimiento" name="fechaNacimiento" class="form-control" value="{{ old('fechaNacimiento') }}" required>
        </div>

        <div class="form-group">
            <label for="cedula">Cédula:</label>
            <input type="number" name="cedula" class="form-control" value="{{ old('cedula') }}" required>
        </div>

        <div class="form-group">
            <label for="direccion">Dirección:</label>
            <textarea name="direccion" class="form-control" required>{{ old('direccion') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

@elseif ($user->role->name == 'alumno')

<div class="container">
    <h2>{{ $user->name }} Info</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('info.add', ['id' => $user->id]) }}" method="post">
        @csrf

        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="number" name="telefono" class="form-control" value="{{ old('telefono') }}" required>
        </div>

        <div class="form-group">
            <label for="fecha">Fecha de nacimiento:</label>
            <input type="date" id="fechaNacimiento" name="fechaNacimiento" class="form-control" value="{{ old('fechaNacimiento') }}" required>
        </div>

        <div class="form-group">
            <label for="cedula">Cédula:</label>
            <input type="number" name="cedula" class="form-control" value="{{ old('cedula') }}" required>
        </div>

        <div class="form-group">
            <label for="direccion">Dirección:</label>
            <textarea name="direccion" class="form-control" required>{{ old('direccion') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

@endif

@endsection


@section('javascript')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Obtén el campo de fecha de nacimiento
        var fechaNacimientoInput = document.getElementById('fechaNacimiento');

        // Agrega un evento de escucha al cambio de la fecha de nacimiento
        fechaNacimientoInput.addEventListener('change', function() {
            // Obtiene la fecha ingresada
            var fechaNacimiento = new Date(fechaNacimientoInput.value);

            // Obtiene la fecha actual
            var fechaActual = new Date();

            // Calcula la edad en años
            var edad = fechaActual.getFullYear() - fechaNacimiento.getFullYear();

            // Verifica si la edad es menor de 17 años
            if (edad < 17) {
                // Muestra una alerta
                alert('Debes tener al menos 17 años para registrarte.');

                // Elimina la fecha ingresada
                fechaNacimientoInput.value = '';
            }
        });
    });
</script>


@endsection
