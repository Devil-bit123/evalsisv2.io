@extends('voyager::master')

@section('content')
    @auth

        <div class="card">
            <div class="card-body">
                <h3>Estudiante, {{ $user->name }}</h3>
                <p>Para empezar a resolver el curso, haz clic en "Empezar". Recuerda que cuentas con
                    <strong>{{ $test_configuration->time }} minutos</strong> para resolverlo desde el momento en que presionas
                    "Empezar".
                </p>
                <button type="button" class="btn btn-success" id="startButton">Empezar</button>
                <p id="timerDisplay"></p>
            </div>
        </div>

        <div id="errorContainer"></div>

        <div id="questionsContainer" style="display: none;">
            <!-- Aquí se mostrarán las preguntas -->
            @foreach ($random_questions as $index => $question)
                <div class="question" id="question{{ $index + 1 }}"
                    data-correct-answer-index="{{ $question['correct_asnwer_index'] }}">
                    <h4>{{ $question['title'] }}</h4>
                    <!-- Mostrar las opciones de respuesta como botones de radio -->
                    @foreach ($question['responses'] as $responseIndex => $response)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="response{{ $index + 1 }}"
                                id="response{{ $index + 1 }}_{{ $responseIndex }}" value="{{ $responseIndex }}">
                            <label class="form-check-label" for="response{{ $index + 1 }}_{{ $responseIndex }}">
                                {{ $response }}
                            </label>
                        </div>
                    @endforeach
                </div>
            @endforeach

            <button type="button" class="btn btn-primary" id="submitButton">Enviar Respuestas</button>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                // Variable para almacenar el tiempo restante
                var countdownTimer;

                // Recuperar el tiempo restante del almacenamiento local
                var storedTime = localStorage.getItem('timeRemaining');
                var startWithoutConfirmation = localStorage.getItem('startWithoutConfirmation');

                // Función para iniciar el contador
                function startCountdown(minutes) {
                    var seconds = minutes * 60;
                    countdownTimer = setInterval(function() {
                        var minutesDisplay = Math.floor(seconds / 60);
                        var secondsDisplay = seconds % 60;
                        $('#timerDisplay').text('Tiempo restante: ' + minutesDisplay + 'm ' + secondsDisplay +
                            's');

                        if (seconds === 0) {
                            clearInterval(countdownTimer);
                            alert('¡Tiempo agotado!');

                            $.ajax({
                                url: '/admin/submit-test/',
                                method: 'POST',
                                data: {
                                    user_answers: userAnswers,
                                    _token: '{{ csrf_token() }}',
                                    complete_status: 'partial'
                                },
                                success: function(response) {
                                    console.log(response);
                                    // Aquí puedes manejar la respuesta del servidor si es necesario
                                },
                                error: function(error) {
                                    console.error(error);
                                    // Manejar errores si es necesario
                                }
                            });

                        }

                        // Almacenar el tiempo restante en el almacenamiento local
                        localStorage.setItem('timeRemaining', seconds);

                        seconds--;
                    }, 1000);
                }

                // Función para convertir formato HH:MM a minutos
                function convertToMinutes(timeString) {
                    var parts = timeString.split(":");
                    var hours = parseInt(parts[0], 10);
                    var minutes = parseInt(parts[1], 10);
                    return hours * 60 + minutes;
                }

                // Función para mostrar las preguntas y ocultar el mensaje de inicio
                function showQuestions() {
                    $('#questionsContainer').show(); // Mostrar el contenedor de preguntas
                    $('#timerDisplay').text(''); // Limpiar el mensaje de tiempo restante
                    $('#startButton').hide(); // Ocultar el botón "Empezar"
                }

                // Manejador de eventos para el botón de inicio
                $('#startButton').on('click', function() {
                    // Convertir el tiempo a minutos
                    var timeInMinutes = convertToMinutes("{{ $test_configuration->time }}");

                    // Utilizar el tiempo almacenado si está disponible
                    if (storedTime) {
                        timeInMinutes = storedTime / 60; // Convertir a minutos
                    }

                    // Si se había almacenado 'startWithoutConfirmation' como 'true', iniciar el contador automáticamente
                    if (startWithoutConfirmation && JSON.parse(startWithoutConfirmation)) {
                        startCountdown(timeInMinutes);
                        showQuestions(); // Llamar a la función para mostrar las preguntas
                    } else {
                        // Preguntar al usuario si realmente desea empezar
                        var confirmStart = confirm('¿Estás seguro de que deseas comenzar?');

                        if (confirmStart) {
                            startCountdown(timeInMinutes);
                            showQuestions(); // Llamar a la función para mostrar las preguntas

                            // Almacenar que se inició el contador sin cancelar
                            localStorage.setItem('startWithoutConfirmation', 'true');
                        } else {
                            // Almacenar que se canceló el inicio del contador
                            localStorage.setItem('startWithoutConfirmation', 'false');
                        }
                    }
                });

                // Manejador de eventos para el botón de envío
                $('#submitButton').on('click', function() {
                    var userAnswers = []; // Array para almacenar las respuestas del usuario

                    // Recorrer cada pregunta y obtener la respuesta seleccionada por el usuario
                    $('.question').each(function(index) {
                        var questionTitle = $(this).find('h4').text();
                        var selectedResponseIndex = $('input[name="response' + (index + 1) +
                            '"]:checked').val();
                        var selectedResponseText = $(this).find('label[for="response' + (index + 1) +
                            '_' + selectedResponseIndex + '"]').text();

                        var userAnswer = {
                            "title": questionTitle,
                            "responses": getResponsesArray(index + 1),
                            "correct_asnwer_text": getCorrectAnswerText(index + 1),
                            "correct_asnwer_index": getCorrectAnswerIndex(index + 1),
                            "user_anser_text": selectedResponseText,
                            "user_anser_index": selectedResponseIndex
                        };

                        userAnswers.push(userAnswer);
                    });


                    $.ajax({
                        url: '/admin/submit-test/',
                        method: 'POST',
                        data: {
                            complete_status: 'complete',
                            user_answers: userAnswers,
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            console.log(response);
                            // Aquí puedes manejar la respuesta del servidor si es necesario

                            // Agregar lógica adicional según sea necesario
                            // Por ejemplo, redirigir a otra página después del éxito

                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error(jqXHR);

                            // Mostrar los errores en la vista
                            if (jqXHR.responseJSON && jqXHR.responseJSON.errors) {
                                var errorMessages = jqXHR.responseJSON.errors;
                                var errorMessageList = '<ul>';

                                for (var field in errorMessages) {
                                    if (errorMessages.hasOwnProperty(field)) {
                                        errorMessageList += '<li>' + errorMessages[field].join(
                                            ', ') + '</li>';
                                    }
                                }

                                errorMessageList += '</ul>';

                                // Mostrar errores en un contenedor en tu vista
                                $('#errorContainer').html('<div class="alert alert-danger">' +
                                    errorMessageList + '</div>');
                            } else {
                                // Manejar otros errores si es necesario
                            }
                        }
                    });

                    console.log(userAnswers);
                });

                // Función para obtener todas las opciones de respuesta de una pregunta
                function getResponsesArray(questionIndex) {
                    var responsesArray = [];

                    $('#question' + questionIndex + ' .form-check-label').each(function() {
                        responsesArray.push($(this).text());
                    });

                    return responsesArray;
                }

                // Función para obtener la respuesta correcta de una pregunta
                function getCorrectAnswerText(questionIndex) {
                    return $('#question' + questionIndex + ' .form-check-input[value="' + getCorrectAnswerIndex(
                        questionIndex) + '"]').next().text();
                }

                // Función para obtener el índice de la respuesta correcta de una pregunta
                function getCorrectAnswerIndex(questionIndex) {
                    return $('#question' + questionIndex).data('correct-answer-index');
                }

                // Restablecer 'startWithoutConfirmation' al cerrar o recargar la página
                window.onbeforeunload = function() {
                    localStorage.setItem('startWithoutConfirmation', 'false');
                };

                // Iniciar el contador si el tiempo se había almacenado previamente y no se hizo clic en "Cancelar"
                if (storedTime && startWithoutConfirmation && JSON.parse(startWithoutConfirmation)) {
                    startCountdown(storedTime / 60); // Convertir a minutos
                    showQuestions(); // Llamar a la función para mostrar las preguntas
                }
            });
        </script>

    @endauth
@endsection
