@extends('voyager::master')

@section('content')
    @auth
        <div class="card">
            <div class="card-body">
                @if ($exams && !$exams->isEmpty())
                    @foreach ($exams as $exam)
                        @if (now()->isSameDay($exam->date))
                            <div class="card mt-3">
                                <h5 class="card-header"></h5>
                                <div class="card-body">
                                    <h5 class="card-title"> <strong>{{ $exam->name }}</strong></h5>
                                    <p class="card-text"></p>
                                    <a href="{{ route('my-course.take_test', ['id' => $exam->id]) }}" class="btn btn-primary">Tomar
                                        examen</a>
                                </div>
                            </div>
                        @else
                        <h1>Tienes exámenes pendientes</h1>
                        <p>Para el {{ $exam->date }}</p>
                        @endif
                    @endforeach
                @else
                    <h1>No hay exámenes pendientes hoy</h1>
                @endif
            </div>
        </div>
    @endauth
@endsection
