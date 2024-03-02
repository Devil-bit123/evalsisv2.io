<!-- resources/views/exams/show.blade.php -->

@extends('voyager::master')

@section('content')
    <h1>Bancos de Preguntas</h1>

    @foreach ($exams as $exam)
        <div class="card">

            <div class="card-body">
                <p>Nombre:</p>
                <h5 class="card-title">{{ $exam->name }}</h5>
                <p>Descripción:</p>
                <h5 class="card-title">{{ $exam->description }}</h5>
            </div>
            <div class="card-header">
                <!-- Botón para abrir el modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#examDetails{{ $exam->id }}">
                    Ver Banco
                </button>
                <button type="button" class="btn btn-warning" onclick="editExam({{ $exam->id }})">
                    Editar
                </button>
                <button type="button" class="btn btn-danger" onclick="deleteExam({{ $exam->id }})">
                    Eliminar
                </button>
            </div>
        </div>

        <!-- Modal para mostrar detalles del examen -->
        <div class="modal fade" id="examDetails{{ $exam->id }}" tabindex="-1" role="dialog"
            aria-labelledby="examDetails{{ $exam->id }}Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="examDetails{{ $exam->id }}Label">Preguntas del Banco</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                          @php
                            // Ensure $questions is an array
                            $questions = is_array($exam->questions) ? $exam->questions : [];
                        @endphp
                        <strong><p>Nombre:</p></strong>
                        <p>{{ $exam->name }}</p>
                        <strong><p>Descripción:</p></strong>
                        <p>{{ $exam->description }}</p>
                        <strong><p>Creado el:</p></strong>
                        <p>{{ $exam->created_at }}</p>

                        <!-- Iterar sobre las preguntas -->
                        @foreach ($questions as $index => $question)
                            <strong><p>Pregunta {{ $index }}: {{ $question['title'] }}</p></strong>
                            <ul>
                                <!-- Iterar sobre las respuestas -->
                                @foreach ($question['responses'] as $response)
                                    <li>{{ $response }}</li>
                                @endforeach
                            </ul>

                            @if (array_key_exists('correct_answer_index', $question))
                                <strong><p>Respuesta Correcta: {{ $question['correct_answer_text'] }}</p></strong>
                            @else
                                <p>Respuesta Correcta no especificada</p>
                            @endif


                            <hr>
                        @endforeach


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                    <form id="delete-exam-form" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('javascript')
    <script>
        function editExam(examId) {
            // Redirigir a la página de edición del examen
            window.location.href = '{{ url('/admin/exams') }}/' + examId + '/edit';
        }



        function deleteExam(examId) {
            if (confirm('Are you sure you want to delete this exam?')) {
                // If the user confirms the deletion, submit the form
                document.getElementById('delete-exam-form').action = '/admin/exams/' + examId;
                document.getElementById('delete-exam-form').submit();
            }
        }
    </script>
@stop
