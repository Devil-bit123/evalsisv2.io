@extends('voyager::master')

@section('content')


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



    <div class="card">
        <div class="card-body">
            <div class="mb-3">

                <h2>Configuracion de test</h2>

                @if ($exams->isEmpty())
                    <p>No tiene un banco de preguntas para esta Clase</p>
                @else
                    @auth


                        <!-- Área para mostrar mensajes de éxito -->
                        <div id="successMessage" class="alert alert-success" style="display: none;"></div>

                        <!-- Área para mostrar mensajes de error -->
                        <div id="errorMessage" class="alert alert-danger" style="display: none;"></div>


                        <div class="input-group mb-3">
                            <label for="formGroupExampleInput" class="form-label">Ingresa el nombre de tu test</label>
                            <input type="text" id="InputName" class="form-control" aria-label="Username"
                                aria-describedby="basic-addon1">
                        </div>


                        <label for="formGroupExampleInput" class="form-label">Selecciona tu banco de preguntas</label>
                        <select id="examDropdown" class="form-select" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            @foreach ($exams as $exam)
                                <option value="{{ $exam->id }}" data-question-count="{{ count($exam->questions) }}">
                                    {{ $exam->name }}</option>
                            @endforeach
                        </select>

                </div>

                <div class="input-group mb-3">
                    <label for="formGroupExampleInput" class="form-label">Selecciona la fecha de tu test</label>
                    <input type="date" id="InputDate" class="form-control" placeholder="Username" aria-label="Username"
                        aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <label for="formGroupExampleInput" class="form-label">Selecciona la cantidad de preguntas de tu test
                        <strong>(cantidad de preguntas del banco seleccionado: <span
                                id="questionCountPlaceholder"></span>)</strong></label>
                    <input type="number" id="InputAmount" class="form-control" aria-label="Username"
                        aria-describedby="basic-addon1" disabled>
                </div>

                <div class="input-group mb-3">
                    <label for="formGroupExampleInput" class="form-label" data-toggle="tooltip" title="IMPORTANTE: Ingrese la cantidad de de horas y minutos que desea que dure su test 01:20 representan 1 Hora con 20 minutos. El test estara disponible todo el dia">Selecciona la cantidad de tiempo que desas que dure tu test</label>




                    <input type="time" class="form-control" id="InputDuration" placeholder="Username" aria-label="Username"
                        aria-describedby="basic-addon1" step="1800" />
                </div>

            </div>
            <button type="button" class="btn btn-success">Guardar</button>
        </div>


    @endauth



<script src="{{ asset('js/app.js') }}" defer></script>

    <script>


$(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

        $(document).ready(function() {

            // Función para obtener la fecha actual en formato YYYY-MM-DD
            function getCurrentDate() {
                const today = new Date();
                const year = today.getFullYear();
                let month = today.getMonth() + 1;
                let day = today.getDate();

                // Ajustar el formato para que siempre tenga dos dígitos
                month = month < 10 ? `0${month}` : month;
                day = day < 10 ? `0${day}` : day;

                return `${year}-${month}-${day}`;
            }

            // Configurar el atributo min con la fecha actual
            $('#InputDate').attr('min', getCurrentDate());

            // Agregar eventos input y change para validar la fecha al cambiarla
            $('#InputDate').on('input change', function() {
                const dateParts = $(this).val().split('/');
                const formattedDate = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];
                const selectedDate = new Date(formattedDate);
                const currentDate = new Date(getCurrentDate());

                if (selectedDate < currentDate) {
                    alert('La fecha seleccionada no puede ser anterior al día actual.');
                    // Puedes resetear la fecha a la actual si lo deseas
                    $(this).val(getCurrentDate());
                }
            });

            $('#examDropdown').on('change', function() {
                const questionCount = $(this).find('option:selected').data('question-count');
                $('#questionCountPlaceholder').text(questionCount);

                // Obtener el ID del banco de preguntas en lugar del nombre
                const examId = $(this).val();

                // Habilitar o deshabilitar el campo de entrada según si se ha seleccionado un banco
                const isExamSelected = examId !== 'Open this select menu';
                $('#InputAmount').prop('disabled', !isExamSelected);

                // Limpiar el valor del campo de entrada si no se ha seleccionado un banco
                if (!isExamSelected) {
                    $('#InputAmount').val('');
                }
            });

            $('#InputAmount').on('input', function() {
                const selectedQuestionCount = parseInt($(this).val());
                const availableQuestionCount = parseInt($('#questionCountPlaceholder').text());

                if (selectedQuestionCount > availableQuestionCount) {
                    $('#errorMessage').text(
                        'La cantidad de preguntas seleccionadas es mayor que la cantidad disponible en el banco de preguntas.'
                    ).show();
                    // Limpiar mensaje de éxito si lo hubiera
                    $('#successMessage').text('');
                    $('#InputAmount').val('');

                    // Desaparecer el contenedor de error después de 2.5 segundos
                    setTimeout(function() {
                        $('#errorMessage').hide();
                    }, 2500);
                }
            });

            // Agregar evento de clic al botón "Guardar"
            $('.btn-success').on('click', function() {

                // Obtener los valores de los campos de entrada
                const testName = $('#InputName').val();
                const examId = $('#examDropdown').val();
                const selectedDate = $('#InputDate').val();
                const questionAmount = $('#InputAmount').val();
                const testDuration = $('#InputDuration').val();


                // Validar que todos los campos requeridos estén llenos
                if (!testName || !examId || !selectedDate || !
                    questionAmount || !testDuration) {
                    alert('Por favor, complete todos los campos antes de guardar.');
                    return;
                }

                // Obtener el valor del input
                var unformated_duration = $('#InputDuration').val();

                // Expresión regular para verificar si el formato es de 12 horas (con am/pm)
                var regex12HourFormat = /^(0?[1-9]|1[0-2]):[0-5][0-9] (am|pm)$/i;

                // Expresión regular para verificar si el formato es de 24 horas
                var regex24HourFormat = /^([01]?[0-9]|2[0-3]):[0-5][0-9]$/;

                if (regex12HourFormat.test(unformated_duration)) {
                    // Si está en formato de 12 horas, convertir a formato de 24 horas
                    var hour = parseInt(unformated_duration.split(':')[0]);
                    var minutes = unformated_duration.split(':')[1].split(' ')[0];
                    var period = unformated_duration.split(' ')[1];

                    if (period.toLowerCase() === 'pm' && hour !== 12) {
                        hour += 12;
                    } else if (period.toLowerCase() === 'am' && hour === 12) {
                        hour = 0;
                    }

                    // Formatear la hora a 24 horas
                    var hour24Format = ("0" + hour).slice(-2) + ":" + minutes;

                    console.log("Hora en formato de 24 horas:", hour24Format);
                } else if (regex24HourFormat.test(unformated_duration)) {
                    //console.log("La hora ya está en formato de 24 horas.");
                } else {
                    //console.log("El formato de hora no es reconocido.",unformated_duration);
                }


                // Realizar la solicitud AJAX
                $.ajax({
                    type: 'POST',
                    url: '/admin/my-test-configuration-add',
                    data: {
                        testName: testName,
                        examId: examId,
                        selectedDate: selectedDate,
                        questionAmount: questionAmount,
                        testDuration: unformated_duration ?? hour24Format
                    },
                    success: function(response) {
                        // Mostrar mensaje de éxito
                        $('#successMessage').text(response.message).show();
                        // Limpiar mensaje de error si lo hubiera
                        $('#errorMessage').text('');
                        //console.log(response);
                        // Puedes redirigir a donde sea necesario después de procesar la información.
                        setTimeout(function() {
                            // Redirigir después de 1 segundo
                            window.location.href =
                                '{{ route('my-course.dashboard', ['id' => $exam->id_course]) }}';
                        }, 2500);

                    },
                    error: function(error) {
                        // Manejar errores si es necesario
                        // console.error(error);
                        // alert('Hubo un error al guardar los datos.');
                        $('#errorMessage').text(error).show();
                        // Limpiar mensaje de éxito si lo hubiera
                        $('#successMessage').text('');
                        //console.error(error);


                    }
                });



            });

        });
    </script>
    @endif



@endsection
