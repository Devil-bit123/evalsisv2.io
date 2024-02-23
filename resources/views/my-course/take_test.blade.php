//sin logica de recargas

@extends('voyager::master')

@section('content')
    <div class="container">
        <h1>Tomar Examen</h1>

        <p>Bienvenido, {{ $user->name }}.</p>
        <p>Para completar las preguntas, da clic en empezar, tienes <span
                id="countdown">{{ $test_configuration->time }}</span> minutos para resolver el examen</p>


        <!-- Área para mostrar mensajes de éxito -->
        <div id="successMessage" class="alert alert-success" style="display: none;"></div>

        <!-- Área para mostrar mensajes de error -->
        <div id="errorMessage" class="alert alert-danger" style="display: none;"></div>


        <!-- Agrega este bloque para mostrar el tiempo restante -->
        <div id="timerDisplay" style="display: none;">
            <h5>Tiempo restante: <span id="minutes">00</span>:<span id="seconds">00</span></h5>
        </div>


        <!-- Agrega un div para mostrar la pregunta actual -->
        <div id="questionContainer" style="display: none;">
            <h3 id="questionTitle"></h3>
            <form id="responseForm">
                <ul id="responseList"></ul>
            </form>
            <button id="nextButton" onclick="nextQuestion()">Siguiente</button>
        </div>



        <!-- Utiliza startTimerWithConfirmation en lugar de startTimer directamente -->
        <button type="button" class="btn btn-success" id="startBtn"
            onclick="startTimerWithConfirmation()">Empezar</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>

        var test_conf = {{ $test_configuration->id }};
        // Obtén las preguntas desde la variable de PHP y conviértelas a formato JavaScript
        var randomQuestions = @json($random_questions);
        //console.log(randomQuestions);

        // Otras variables necesarias
        var currentQuestionIndex = 0; // Índice de la pregunta actual
        var userResponses = []; // Array para almacenar las respuestas del usuario

        var timeParts = "{{ $test_configuration->time }}".split(":");
        var totalMinutes = parseInt(timeParts[0]) * 60 + parseInt(timeParts[1]);

        var currentQuestion = randomQuestions[currentQuestionIndex];

        // Función para mostrar la pregunta actual
        function showCurrentQuestion() {
            currentQuestion = randomQuestions[currentQuestionIndex];
            document.getElementById("questionTitle").textContent = currentQuestion.title;

            var responseList = document.getElementById("responseList");
            responseList.innerHTML = "";

            // Agregar respuestas como opciones de radio
            currentQuestion.responses.forEach(function(response, index) {
                var listItem = document.createElement("li");
                var radioInput = document.createElement("input");
                radioInput.type = "radio";
                radioInput.name = "responseOption";
                radioInput.value = index;
                radioInput.id = "responseOption_" + index;

                var label = document.createElement("label");
                label.textContent = response;
                label.setAttribute("for", "responseOption_" + index);

                listItem.appendChild(radioInput);
                listItem.appendChild(label);
                responseList.appendChild(listItem);
            });

            // Mostrar el contenedor de la pregunta
            document.getElementById("questionContainer").style.display = "block";
        }

        // Función para avanzar a la siguiente pregunta
        function nextQuestion() {
            var selectedOption = document.querySelector('input[name="responseOption"]:checked');

            if (selectedOption === null) {
                alert("Por favor, selecciona una respuesta antes de continuar.");
                return; // Detiene la ejecución de la función si no hay una respuesta seleccionada
            }

            if (selectedOption) {
                var userResponse = {
                    title: currentQuestion.title,
                    responses: currentQuestion.responses,
                    correct_answer_text: currentQuestion.correct_answer_text,
                    correct_answer_index: parseInt(currentQuestion.correct_answer_index),
                    user_answer_text: currentQuestion.responses[selectedOption.value],
                    user_anwser_index: parseInt(selectedOption.value),

                };
                userResponses.push(userResponse);
            }

            currentQuestionIndex++;

            // Verificar si hay más preguntas
            if (currentQuestionIndex < randomQuestions.length) {
                // Mostrar la siguiente pregunta
                showCurrentQuestion();
            } else {
                // Todas las preguntas han sido respondidas, muestra los resultados
                //showResults();
                axios.post('/admin/submit-test/', {
                        userResponses: userResponses,
                        complete_status: 'complete',
                        id_test_configuration: test_conf,
                    })
                    .then(function(response) {
                        // Manejar la respuesta del servidor si es necesario
                        //console.log(response.data);
                        //window.location.href = "{{ route('voyager.my-courses-view.index') }}";

                        // Mostrar mensaje de éxito
                        $('#successMessage').text(response.data.success).show();
                        // Limpiar mensaje de error si lo hubiera
                        $('#errorMessage').text('');
                        //console.log(response);
                        // Puedes redirigir a donde sea necesario después de procesar la información.
                        setTimeout(function() {
                            // Redirigir después de 1 segundo

                            window.location.href = "{{ route('voyager.my-courses-view.index') }}";

                        }, 2500);

                    })
                    .catch(function(error) {
                        // Manejar errores si es necesario
                        //console.error(error);
                    });
            }
        }

        // Función para iniciar el temporizador con confirmación
        function startTimerWithConfirmation() {
            // Preguntar al usuario si realmente desea empezar
            var confirmStart = confirm("¿Estás seguro de que deseas comenzar el examen?");

            if (confirmStart) {
                // Mostrar la primera pregunta
                showCurrentQuestion();

                // Iniciar el temporizador
                startTimer();
            } else {
                // El usuario canceló, puedes agregar código adicional si es necesario
            }
        }


        // Función para iniciar el temporizador
        function startTimer() {



            // Mostrar el tiempo restante
            document.getElementById("timerDisplay").style.display = "block";
            document.getElementById("startBtn").style.display = "none";

            var timeRemaining = totalMinutes * 60; // Convertir a segundos

            // Actualizar el tiempo restante cada segundo
            var timerInterval = setInterval(function() {
                var minutes = Math.floor(timeRemaining / 60);
                var seconds = timeRemaining % 60;

                // Mostrar el tiempo restante en la interfaz
                document.getElementById("minutes").textContent = minutes < 10 ? "0" + minutes : minutes;
                document.getElementById("seconds").textContent = seconds < 10 ? "0" + seconds : seconds;

                // Disminuir el tiempo restante
                timeRemaining--;

                // Detener el temporizador cuando el tiempo llega a cero
                if (timeRemaining < 0) {
                    clearInterval(timerInterval);

                    completeUnansweredQuestions();

                    // Mostrar los resultados
                    //showResults();

                    axios.post('/admin/submit-test/', {
                            userResponses: userResponses,
                            complete_status: 'partial',
                            id_test_configuration: test_conf,
                        })
                        .then(function(response) {
                            // Manejar la respuesta del servidor si es necesario
                            //console.log(response.data);

                            // Mostrar mensaje de éxito
                            $('#successMessage').text('¡El Tiempo se agoto! tus respuestas seran enviadas para su calificación').show();
                            // Limpiar mensaje de error si lo hubiera
                            $('#errorMessage').text('');
                            //console.log(response);
                            setTimeout(function() {
                            // Redirigir después de 1 segundo

                            window.location.href = "{{ route('voyager.my-courses-view.index') }}";

                        }, 2500);

                        })
                        .catch(function(error) {
                            // Manejar errores si es necesario
                            //console.error(error);
                        });


                }
            }, 1000);
        }

        // Función para completar las preguntas no respondidas
        function completeUnansweredQuestions() {
            for (var i = currentQuestionIndex; i < randomQuestions.length; i++) {
                var unansweredQuestion = randomQuestions[i];
                var userResponse = {
                    title: unansweredQuestion.title,
                    responses: unansweredQuestion.responses,
                    correct_asnwer_text: unansweredQuestion.correct_asnwer_text,
                    correct_asnwer_index: parseInt(unansweredQuestion.correct_asnwer_index),
                    user_answer_text: "none",
                    user_anwser_index: 9999,
                };
                userResponses.push(userResponse);
            }
        }
    </script>
@endsection

@push('javascript')
    <!-- Puedes seguir utilizando otros scripts en esta sección si es necesario -->
@endpush
