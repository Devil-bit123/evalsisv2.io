@extends('voyager::master')

@section('content')
    @auth
        <div class="card">
            <div class="card-body">
                @if (!empty($testConfigurations))

                    @foreach ($testConfigurations as $exam)
                        @if (!empty($testResults))
                            @php $examHasAnswers = false; @endphp
                            @foreach ($testResults as $result)
                                @if ($result && $result->id_test_configuration === $exam->id)
                                    @php $examHasAnswers = true; @endphp
                                    <h3>Tu examen ha sido calificado:</h3>
                                    <div class="card">
                                        <div class="card-header">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $exam->name }}</h5>
                                            <p class="card-text"><strong>Fecha de realizado: {{ $exam->date }}</strong></p>
                                            <a href="{{ route('my-course.my_score', ['id' => $exam->id]) }}" class="btn btn-warning">Ver</a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            @if (!$examHasAnswers)
                                <h3>Tienes exámenes pendientes:</h3>
                                <div class="card">
                                    <div class="card-header">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $exam->name }}</h5>
                                        <p class="card-text"><strong>Fecha de examen: {{ $exam->date }}</strong></p>
                                        {{-- Verificar si la fecha del examen es hoy --}}
                                        @if (\Carbon\Carbon::parse($exam->date)->isToday())
                                        <a href="{{ route('my-course.take_test', ['id' => $exam->id]) }}" class="btn btn-primary">Tomar examen</a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="card">
                                <div class="card-body">
                                    <p>No hay respuestas</p>
                                </div>
                              </div>
                        @endif
                    @endforeach
                @else
                    <div class="card">
                        <div class="card-body">
                            <p>No Hay examenes</p>
                        </div>
                      </div>
                @endif

            </div>
        </div>
    @endauth
@endsection
