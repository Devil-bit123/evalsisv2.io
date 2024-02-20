@extends('voyager::master')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    {{ $course->name }}
                </div>

                <div class="card-body">
                    <h5><p>Planificación</p></h5>

                    <p>Tareas</p>
                    @isset($homeworks)
                    <ul>
                        @foreach ($homeworks as $homework)
                            <li>{{ $homework->name }} - {{ $homework->description }}</li>
                        @endforeach
                    </ul>
                    @endisset

                    <p>Tests</p>
                    @isset($tests)
                    <ul>
                        @foreach ($tests as $test)
                            <li>{{ $test->name }} - {{ $test->description }}</li>
                        @endforeach
                    </ul>
                    @endisset

                    <p>Clases</p>
                    @isset($classes)
                    <ul>
                        @foreach ($classes as $class)
                            <li>{{ $classes->name }} - {{ $classes->description }}</li>
                        @endforeach
                    </ul>
                    @endisset

                </div>
            </div>
        </div>
    </div>
@endsection
