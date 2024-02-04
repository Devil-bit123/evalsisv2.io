@extends('voyager::master')

@section('content')

@if ($user->role->name == 'admin')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Detalles del Curso
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $course->name }}</h5>
                    <p class="card-text">{{ $course->description }}</p>
                    @if ($docentesNombres->isEmpty())
                        <p>No hay docentes asignados a este curso.</p>
                    @else
                        <h5 class="card-title">Docentes:</h5>
                        <ul>
                            @foreach ($docentesNombres as $docente)
                                <li>{{ $docente->name }}</li>
                                @if ($user->role->name == 'admin')
                                    <form method="POST"
                                        action="{{ route('courses.removeTeacher', ['course' => $course->id, 'teacher' => $docente->id]) }}"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('¿Estás seguro de eliminar a este maestro?')">Eliminar</button>
                                    </form>
                                @endif
                            @endforeach
                        </ul>
                    @endif


                    @if ($estudiantesNombres->isEmpty())
                        <p>No hay docentes asignados a este curso.</p>
                    @else
                        <h5 class="card-title">Estudiantes:</h5>
                        <ul>
                            @foreach ($estudiantesNombres as $estudiante)
                                <li>{{ $estudiante->name }}</li>
                                @if ($user->role->name == 'admin')
                                    <form method="POST"
                                        action="{{ route('courses.removeStudent', ['course' => $course->id, 'student' => $estudiante->id]) }}"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('¿Estás seguro de eliminar a este estudiante?')">Eliminar</button>
                                    </form>
                                @endif
                            @endforeach
                        </ul>
                    @endif


                    <!-- Agrega aquí más detalles del curso según tu necesidad -->

                    <a href="{{ route('courses.index') }}" class="btn btn-primary">Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>

@elseif ($user->role->name == 'docente')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Detalles del Curso
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $course->name }}</h5>
                    <p class="card-text">{{ $course->description }}</p>
                    @if ($docentesNombres->isEmpty())
                        <p>No hay docentes asignados a este curso.</p>
                    @else
                        <h5 class="card-title">Docentes:</h5>
                        <ul>
                            @foreach ($docentesNombres as $docente)
                                <li>{{ $docente->name }}</li>

                            @endforeach
                        </ul>
                    @endif


                    @if ($estudiantesNombres->isEmpty())
                        <p>No hay estudiantes asignados a este curso.</p>
                    @else
                        <h5 class="card-title">Estudiantes:</h5>
                        <ul>
                            @foreach ($estudiantesNombres as $estudiante)
                                <li>{{ $estudiante->name }}</li>
                            @endforeach
                        </ul>
                    @endif


                    <!-- Agrega aquí más detalles del curso según tu necesidad -->

                    <a href="{{ route('courses.index') }}" class="btn btn-primary">Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>


@elseif ($user->role->name == 'alumno')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Detalles del Curso
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $course->name }}</h5>
                    <p class="card-text">{{ $course->description }}</p>
                    @if ($docentesNombres->isEmpty())
                        <p>No hay docentes asignados a este curso.</p>
                    @else
                        <h5 class="card-title">Docentes:</h5>
                        <ul>
                            @foreach ($docentesNombres as $docente)
                                <li>{{ $docente->name }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <!-- Agrega aquí más detalles del curso según tu necesidad -->

                    <a href="{{ route('courses.index') }}" class="btn btn-primary">Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endif




@endsection
