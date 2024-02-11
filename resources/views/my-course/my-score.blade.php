@extends('voyager::master')

@section('content')

<div class="container" style="background-color: white">

@auth
<div class="card">
    <div class="card-body">
        <h2>Respuestas corregidas de: "{{ $scored_test->configuration->name }}"</h2>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h3>Calificacion: {{ $scored_test->score }}</h3>
    </div>
</div>

@if($scored_test->score >= 0 && $scored_test->score <= 1)
<img src="{{ asset('storage/animated-icons/6.gif') }}" width="5%  alt="Calificación 0-1">
@elseif($scored_test->score >= 2 && $scored_test->score <= 3)
<img src="{{ asset('storage/animated-icons/5.gif') }}" width="5%" alt="Calificación 2-3">
@elseif($scored_test->score >= 4 && $scored_test->score <= 5)
<img src="{{ asset('storage/animated-icons/4.gif') }}" width="5%" alt="Calificación 4-5">
@elseif($scored_test->score >= 6 && $scored_test->score <= 7)
<img src="{{ asset('storage/animated-icons/3.gif') }}" width="5%" alt="Calificación 6-7">
@elseif($scored_test->score >= 8 && $scored_test->score <= 9)
<img src="{{ asset('storage/animated-icons/2.gif') }}" width="5%" alt="Calificación 8-9">
@elseif($scored_test->score <= 10)
<img src="{{ asset('storage/animated-icons/1.gif') }}" width="5%" alt="Calificación 4-5">
@endif

<div class="card">
    <div class="card-body">

        @foreach ($decoded_responses as $response)
            <h4>Pregunta: {{ $response['title'] }}</h4>
            <h5>Opciones de respuesta</h5>
            <ul>
                @foreach ($response['responses'] as $option)
                    <li>{{ $option }}</li>
                @endforeach
            </ul>
            <p>Respuesta del usuario: {{ $response['user_answer_text'] }}</p>
            <p>Respuesta correcta: {{ $response['correct_asnwer_text'] }}</p>
        @endforeach

        <!-- Agrega el botón para regresar -->
        <a href="{{ URL::previous() }}" class="btn btn-primary">Volver</a>

    </div>
</div>

@endauth

</div>

@endsection
