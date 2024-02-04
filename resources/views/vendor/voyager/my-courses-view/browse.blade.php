@extends('voyager::master')

@section('content')
    @auth

        @if ($user->role->name == 'docente')
            @forelse ($user->courses as $course)
                <p>{{ $course->name }}</p>
            @empty
                <p>No hay cursos asociados al docente.</p>
            @endforelse
        @elseif ($user->role->name == 'alumno')

        <div class="card">
            <div class="card-body">
                @forelse ($user->courses as $course)
                    <div class="card col-md-4 mb-4">
                        <div class="card-header">
                            <!-- Puedes agregar contenido al encabezado si es necesario -->
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"> {{ $course->name }} </h5>
                            <p class="card-text"> {{ $course->description }} </p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                @empty
                    <p>No hay cursos disponibles.</p>
                @endforelse
            </div>
        </div>



        @endif


    @endauth
@endsection
