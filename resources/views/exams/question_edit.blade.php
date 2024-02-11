@extends('voyager::master')

@section('content')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <div class="card">
        <div class="card-body">
            <!-- Contenido actual de la vista parcial -->
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputBankName">Nombre del banco de preguntas</span>
                <input id="bankName" type="text" class="form-control" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default">
            </div>

            <div class="input-group">
                <span class="input-group-text">Descripcion</span>
                <textarea id="bankDescription" class="form-control" aria-label="With textarea"></textarea>
            </div>
        </div>
    </div>

        <!-- Área para mostrar mensajes de éxito -->
        <div id="successMessage" class="alert alert-success" style="display: none;"></div>

        <!-- Área para mostrar mensajes de error -->
        <div id="errorMessage" class="alert alert-danger" style="display: none;"></div>



    <h2>Edición de Preguntas</h2>

    <div id="questionsContainer">
        @foreach ($exam->questions as $index => $question)
            <form>
                <label for="questionTitle">Título de la Pregunta:</label>
                <input type="text" name="questionTitle" value="{{ $question['title'] }}" required>

                <label for="responses">Respuestas:</label>
                <div class="responses">
                    @foreach ($question['responses'] as $responseIndex => $response)
                        <div>
                            <input type="text" name="response" value="{{ $response }}" required>
                            <label>
                                Correcta
                                <input type="radio" name="correctResponse" value="{{ $responseIndex }}"
                                    @if (array_key_exists('correct_asnwer_index', $question) && $responseIndex == $question['correct_asnwer_index']) checked @endif>
                            </label>
                            <button type="button" class="btn btn-warning" onclick="removeResponse(this)">Eliminar
                                Respuesta</button>
                        </div>
                    @endforeach
                </div>

                <button type="button" class="btn btn-info" onclick="addResponse(this)">Agregar Respuesta</button>
                <button type="button" class="btn btn-danger" onclick="removeQuestion(this)">Eliminar Pregunta</button>
            </form>
        @endforeach
    </div>

    <button type="button" class="btn btn-success" onclick="addQuestion()">Agregar Pregunta</button>
    <button type="button" class="btn btn-success" onclick="saveQuestions()">Guardar Preguntas</button>

    <script>
        function addQuestion() {
            const questionsContainer = document.getElementById('questionsContainer');

            const questionForm = document.createElement('form');
            questionForm.innerHTML = `
            <label for="questionTitle">Título de la Pregunta:</label>
            <input type="text" name="questionTitle" required>

            <label for="responses">Respuestas:</label>
            <div class="responses">
                <div>
                    <input type="text" name="response" required>
                    <label>
                        Correcta
                        <input type="radio" name="correctResponse" value="0">
                    </label>
                    <button type="button" class="btn btn-warning" onclick="removeResponse(this)">Eliminar Respuesta</button>
                </div>
            </div>

            <button type="button" class="btn btn-info" onclick="addResponse(this)">Agregar Respuesta</button>
            <button type="button" class="btn btn-danger" onclick="removeQuestion(this)">Eliminar Pregunta</button>
        `;

            questionsContainer.appendChild(questionForm);
        }

        function addResponse(button) {
            const responsesDiv = button.parentElement.querySelector('.responses');
            const responseCount = responsesDiv.children.length;

            const responseDiv = document.createElement('div');
            responseDiv.innerHTML = `
            <input type="text" name="response" required>
            <label>
                Correcta
                <input type="radio" name="correctResponse" value="${responseCount}">
            </label>
            <button type="button" class="btn btn-warning" onclick="removeResponse(this)">Eliminar Respuesta</button>
        `;

            responsesDiv.appendChild(responseDiv);
        }

        function removeResponse(button) {
            const responseDiv = button.parentNode;
            const responsesDiv = responseDiv.parentNode;
            responsesDiv.removeChild(responseDiv);

            // Reindexar los valores de los radio buttons después de eliminar una respuesta
            const radioButtons = responsesDiv.querySelectorAll('input[type="radio"]');
            radioButtons.forEach((radio, index) => {
                radio.value = index.toString();
            });
        }

        function removeQuestion(button) {
            const questionForm = button.parentNode;
            const questionsContainer = document.getElementById('questionsContainer');
            questionsContainer.removeChild(questionForm);
        }

        function saveQuestions() {
            let id = {{ $exam->id }}

            const questionForms = document.querySelectorAll('#questionsContainer form');

            const bankName = document.getElementById('bankName').value;
            const bankDescription = document.getElementById('bankDescription').value;

            const questions = Array.from(questionForms).map((form) => {
                const title = form.querySelector('input[name="questionTitle"]').value;
                const responseInputs = form.querySelectorAll('.responses input[name="response"]');
                const correctResponseInput = form.querySelector('input[name="correctResponse"]:checked');

                const responses = Array.from(responseInputs).map((responseInput) => {
                    return responseInput.value;
                });

                // Verificar si se ha seleccionado una respuesta correcta
                if (correctResponseInput === null) {
                    alert('Debes seleccionar una respuesta correcta para cada pregunta.');
                    return null;
                }

                const correctResponseIndex = correctResponseInput.value;
                const correctResponseText = responses[correctResponseIndex];

                return {
                    title,
                    responses,
                    correct_asnwer_index: correctResponseIndex,
                    correct_asnwer_text: correctResponseText
                };
            });

            // Si alguna pregunta no tiene respuesta correcta, detener el proceso
            if (questions.some(question => question === null)) {
                return;
            }

            $.ajax({
                url: '{{ route('exams.update', ['examId' => $exam->id]) }}',
                type: 'PUT',
                contentType: 'application/json',
                data: JSON.stringify({
                    questions,
                    bankName,
                    bankDescription
                }),
                success: function(response) {
                    //alert('Examen actualizado exitosamente.');
                    // Mostrar mensaje de éxito
                    $('#successMessage').text(response.message).show();
                    // Limpiar mensaje de error si lo hubiera
                    $('#errorMessage').text('');
                    //console.log(response);
                    // Puedes redirigir a donde sea necesario después de procesar la información.
                    setTimeout(function() {
                        // Redirigir después de 1 segundo
                        window.location.href = '{{ route('voyager.exams.index') }}';
                    }, 2500);
                },
                error: function(error) {
                    //console.error('Error al actualizar el examen:', error);
                    var errorMessage = error.responseJSON && error.responseJSON.error ?
                        error.responseJSON.error : 'Error desconocido';
                    $('#errorMessage').text(errorMessage).show();
                    // Limpiar mensaje de éxito si lo hubiera
                    $('#successMessage').text('');
                    //console.error(error);
                }
            });
        }
    </script>
@endsection
