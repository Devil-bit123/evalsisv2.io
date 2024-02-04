@extends('voyager::master')

@section('content')
    @auth

        @if ($user->role->name == 'admin' || $user->role->name == 'docente')
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Crear un Test</h5>
                            <p class="card-text">Configura un test para tus estudiantes a partir de un banco de preguntas preseleccionado</p>
                            <a href="{{ route('my-course.test_configuration', ['id'=>$course->id]) }}" class="btn btn-primary">Crear</a>

                            @if ($course->exams->isNotEmpty() && $course->exams->pluck('testConfigurations')->flatten()->isNotEmpty())
                                <a href="{{ route('my-course.test_configuration_show', ['id'=>$course->id]) }}" class="btn btn-warning">Ver Tests</a>
                            @endif
                        </div>

                    </div>
                </div>

                <!-- Agrega más tarjetas siguiendo el mismo formato -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Crear Planificación</h5>
                            <p class="card-text">Carga archivos para que tus estudiantes puedan desarollar actividades</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <!-- Contenido de la tercera tarjeta -->
                    </div>
                </div>

                <!-- Puedes agregar más tarjetas siguiendo el mismo formato -->

            </div>

        @elseif ($user->role->name == 'alumno')
        @endif

    @endauth
@endsection
