@extends('voyager::master')

@section('content')
    <div class="card">
        <div class="card-body">
            Edición de examen: {{ $exam->title }}
        </div>
    </div>

    <h2>Edición de Preguntas</h2>

    <div id="questionsContainer">
        @foreach($exam->questions as $question)
            @include('exams.question_edit', ['question' => $question])
        @endforeach
    </div>

    <form method="POST" action="{{ route('exams.update', ['examId' => $exam->id]) }}">
        @method('PUT')
        @csrf

        <button type="button" class="btn btn-primary" onclick="addQuestion()">Agregar Nueva Pregunta</button>
        <button type="submit" class="btn btn-success">Guardar Preguntas</button>
    </form>


@endsection
