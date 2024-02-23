@extends('voyager::master')

@section('content')

    @if ($user->role->name === 'admin' || $user->role->name === 'docente')
        <div class="card">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        {{ $course->name }}
                    </div>

                    <div class="card-body">
                        <h5>
                            <p>Planificación</p>
                        </h5>

                        @isset($homeworks)
                            <p>Tareas</p>
                            @foreach ($homeworks as $homework)
                                <div class="card">
                                    <div class="card-header">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $homework->name }}</h5>
                                        <p class="card-text">{{ $homework->description }}</p>
                                        <button type="button" class="btn btn-warning">Editar</button>
                                    </div>
                                </div>
                            @endforeach
                        @endisset

                        @isset($tests)
                            <p>Tests</p>
                            @foreach ($tests as $test)
                                <div class="card">
                                    <div class="card-header">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $test->name }}</h5>
                                        <p class="card-text">{{ $test->description }}</p>
                                        <button type="button" class="btn btn-warning">Editar</button>
                                    </div>
                                </div>
                            @endforeach
                        @endisset

                        @isset($classes)
                            <p>Clases</p>
                            @foreach ($classes as $class)
                                <div class="card">
                                    <div class="card-header">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $class->name }}</h5>
                                        <p class="card-text">{{ $class->description }}</p>
                                        <button type="button" class="btn btn-warning">Editar</button>
                                    </div>
                                </div>
                            @endforeach
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        {{ $course->name }}
                    </div>

                    <div class="card-body">
                        <h5>
                            <p>Planificación</p>
                        </h5>

                        @isset($homeworks)
                            <p>Tareas</p>
                            @foreach ($homeworks as $homework)
                                <div class="card">
                                    <div class="card-header">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $homework->name }}</h5>
                                        <p class="card-text">{{ $homework->description }}</p>

                                    </div>
                                </div>
                            @endforeach
                        @endisset

                        @isset($tests)
                            <p>Tests</p>
                            @foreach ($tests as $test)
                                <div class="card">
                                    <div class="card-header">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $test->name }}</h5>
                                        <p class="card-text">{{ $test->description }}</p>

                                    </div>
                                </div>
                            @endforeach
                        @endisset

                        @isset($classes)
                            <p>Clases</p>
                            @foreach ($classes as $class)
                                <div class="card">
                                    <div class="card-header">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $class->name }}</h5>
                                        <p class="card-text">{{ $class->description }}</p>

                                    </div>
                                </div>
                            @endforeach
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    @endif



@endsection
