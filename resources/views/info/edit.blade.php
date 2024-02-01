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

    <form action="{{ route('info.update', ['id' => $user->id]) }}" method="put">
        @csrf

        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="number" name="telefono" class="form-control" value="{{ old('telefono') }}" required>
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

    <form action="{{ route('info.update', ['id' => $user->id]) }}" method="post">
        @csrf

        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="number" name="telefono" class="form-control" value="{{ old('telefono') }}" required>
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

    <form action="{{ route('info.update', ['id' => $user->id]) }}" method="put">
        @csrf

        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="number" name="telefono" class="form-control" value="{{ old('telefono') }}" required>
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


@endsection
