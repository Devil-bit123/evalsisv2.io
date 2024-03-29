@extends('voyager::master')

@section('content')
    @auth

        @if ($user->role->name == 'docente')
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif


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
                                <a href="{{ route('my-course.dashboard', ['id' => $course->id]) }}" class="btn btn-primary">Ver mi
                                    curso</a>
                            </div>
                        </div>
                    @empty
                        <p>No hay cursos disponibles.</p>
                    @endforelse
                </div>
            </div>
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
                                <a href="{{ route('my-course.dashboard', ['id' => $course->id]) }}" class="btn btn-primary">Ver mi
                                    curso</a>
                            </div>
                        </div>
                    @empty
                        <p>No hay cursos disponibles.</p>
                    @endforelse
                </div>
            </div>
        @elseif ($user->role->name == 'admin')
            <div class="card">
                <div class="card-body">
                    @forelse ($courses as $course)
                        <div class="card col-md-4 mb-4">
                            <div class="card-header">
                                <!-- Puedes agregar contenido al encabezado si es necesario -->
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"> {{ $course->name }} </h5>
                                <p class="card-text"> {{ $course->description }} </p>
                                <a href="{{ route('my-course.dashboard', ['id' => $course->id]) }}" class="btn btn-primary">Ver mi
                                    curso</a>
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
