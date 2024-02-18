@extends('voyager::master')

@section('content')
    @auth

        @if ($user->role->name == 'admin' || $user->role->name == 'docente')

            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <div class="row">

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Crear Planificación</h5>
                            <p class="card-text">Carga archivos para que tus estudiantes puedan desarollar actividades</p>
                            <a href="{{ route('voyager.planifications.index') }}" class="btn btn-primary">Ver Planificación</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Crear un Test</h5>
                            <p class="card-text">Configura un test para tus estudiantes a partir de un banco de preguntas
                                preseleccionado</p>
                            <a href="{{ route('my-course.test_configuration', ['id' => $course->id]) }}"
                                class="btn btn-primary">Crear</a>

                            @if ($course->exams->isNotEmpty() && $course->exams->pluck('testConfigurations')->flatten()->isNotEmpty())
                                <a href="{{ route('my-course.test_configuration_show', ['id' => $course->id]) }}"
                                    class="btn btn-warning">Ver Tests</a>
                            @endif
                        </div>

                    </div>
                </div>

                <!-- Agrega más tarjetas siguiendo el mismo formato -->


                <div class="col-md-4">
                    <div class="card">
                        <!-- Contenido de la tercera tarjeta -->
                    </div>
                </div>

                <!-- Puedes agregar más tarjetas siguiendo el mismo formato -->

            </div>
        @elseif ($user->role->name == 'alumno')
            <div class="container text-center">
                <div class="row">
                    <div class="col">

                        <div class="card">
                            <div class="card-body">
                                <p>Mis Profesores:</p>
                                @foreach ($course->users as $professor)
                                    @if ($professor['pivot']['role'] === 'docente')
                                        <!-- Display information about the teacher -->
                                        <strong>{{ $professor['name'] }}<br></strong>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                    </div>
                    <div class="col">

                        <div class="row">
                            <!-- First card in the second column -->
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">

                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Proximas tareas</h5>
                                        <p class="card-text">Aquí encontraras todas las Tareas de tu curso</p>
                                        <a href="#" class="btn btn-primary">Go somewhere</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Second card in the second column -->
                            <div class="col-md-4 mt-3">
                                <div class="card">
                                    <div class="card-header">

                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Proximos tests</h5>
                                        <p class="card-text">Aquí encontraras todos los Tests de tu curso</p>
                                        <a href="{{ route('my-course.test_view', ['id' => $course->id]) }}"
                                            class="btn btn-primary">Ir a examanes</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Third card in the second column -->
                            <div class="col-md-4 mt-3">
                                <div class="card">
                                    <div class="card-header">

                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Planificacion del curso</h5>
                                        <p class="card-text">Aquí encontraras la planificacion de tu curso</p>
                                        <a href="#" class="btn btn-primary">Go somewhere</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col">

                        <!-- Content for the third column -->

                    </div>
                </div>
            </div>
        @endif

    @endauth
@endsection
