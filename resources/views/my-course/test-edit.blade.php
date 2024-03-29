@extends('voyager::master')

@section('content')
    @auth

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />

        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <h2>Configuracion de test</h2>


                    <!-- Área para mostrar mensajes de éxito -->
                    <div id="successMessage" class="alert alert-success" style="display: none;"></div>

                    <!-- Área para mostrar mensajes de error -->
                    <div id="errorMessage" class="alert alert-danger" style="display: none;"></div>

                    <div class="input-group mb-3">
                        <label for="InputName" class="form-label">Ingresa el nombre de tu test</label>
                        <input type="text" id="InputName" class="form-control" value="{{ $configuration->name }}"
                            aria-label="Username" aria-describedby="basic-addon1">
                    </div>

                    <label for="examDropdown" class="form-label">Selecciona tu banco de preguntas</label>
                    <select id="examDropdown" class="form-select" aria-label="Default select example">
                        <option selected>Selecciona la el banco</option>
                        @foreach ($exams as $exam)
                            <option value="{{ $exam->id }}" data-question-count="{{ count($exam->questions) }}"
                                {{ $configuration->exam && $configuration->exam->id == $exam->id  }}>
                                {{ $exam->name }}
                            </option>
                        @endforeach
                    </select>


                </div>

                <div class="input-group mb-3">
                    <label for="InputDate" class="form-label">Selecciona la fecha de tu test</label>
                    <input type="date" id="InputDate" class="form-control" value="{{ $configuration->date }}"
                        aria-label="Username" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <label for="InputAmount" class="form-label">Selecciona la cantidad de preguntas de tu test
                        <strong>(cantidad de preguntas del banco seleccionado: <span
                                id="questionCountPlaceholder">{{--  --}}</span>)</strong>
                    </label>
                    <input type="number" id="InputAmount" class="form-control" value="{{ $configuration->number_questions }}"
                        aria-label="Username" aria-describedby="basic-addon1" disabled>
                </div>

                <div class="input-group mb-3">
                    <label for="InputDuration" class="form-label">Selecciona la cantidad de tiempo que deseas que dure tu
                        test</label>
                    <input type="time" id="InputDuration" class="form-control" value="{{ $configuration->time }}"
                        aria-label="Username" aria-describedby="basic-addon1">
                </div>

            </div>
            <button type="button" class="btn btn-success">Guardar</button>
        </div>
    @endauth

@endsection

@section('javascript')

    <script>
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
                        $('#InputAmount').val('');
                    // Ocultar el mensaje después de 2.5 segundos
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
                //if (!testName || !examId || !selectedDate || !questionAmount || !testDuration) {
                //   alert('Por favor, complete todos los campos antes de guardar.');
                //    return;
                //}

                // Obtener el ID de la configuración de prueba
                const configurationId = '{{ $configuration->id }}';

                // Realizar la solicitud AJAX
                $.ajax({
                    type: 'PUT',
                    url: '/admin/my-test-configuration-update/' + configurationId,
                    data: {
                        testName: testName,
                        examId: examId,
                        selectedDate: selectedDate,
                        questionAmount: questionAmount,
                        testDuration: testDuration
                    },
                    success: function(response) {
                        // Manejar la respuesta del servidor si es necesario
                        //console.log(response);
                        //alert('Datos guardados exitosamente.');
                        // window.location.href = '{{ route('my-course.dashboard', ['id' => $course->id]) }}';

                        // Mostrar mensaje de éxito
                        $('#successMessage').text(response.message).show();
                        // Limpiar mensaje de error si lo hubiera
                        $('#errorMessage').text('');
                        //console.log(response);
                        // Puedes redirigir a donde sea necesario después de procesar la información.
                        setTimeout(function() {
                            // Redirigir después de 1 segundo
                            window.location.href =
                                '{{ route('my-course.dashboard', ['id' => $course->id]) }}';

                        }, 2500);


                    },
                    error: function(error) {
                        // Manejar errores si es necesario
                        //console.error(error);
                        // alert('Hubo un error al guardar los datos.');

                        //$('#errorMessage').text(JSON.stringify(error)).show();
                        // Limpiar mensaje de éxito si lo hubiera
                        //$('#successMessage').text('');
                        //console.error(error);

                        // Manejar errores si es necesario
                        var errors = JSON.parse(error.responseText).errors;

                        // Mostrar mensaje de error para el nombre del test
                        if (errors.testName) {
                            $('#errorMessage').append('<p>' + errors.testName[0] + '</p>')
                                .show();
                            // Ocultar el mensaje después de 2.5 segundos
                            setTimeout(function() {
                                $('#errorMessage').hide().empty();
                            }, 2500);
                        }
                        // Mostrar mensaje de error para el nombre del test
                        if (errors.examId) {
                            $('#errorMessage').append('<p>' + errors.examId[0] + '</p>')
                                .show();
                            // Ocultar el mensaje después de 2.5 segundos
                            setTimeout(function() {
                                $('#errorMessage').hide().empty();
                            }, 2500);
                        }
                        // Mostrar mensaje de error para el nombre del test
                        if (errors.selectedDate) {
                            $('#errorMessage').append('<p>' + errors.selectedDate[0] + '</p>')
                                .show();
                            // Ocultar el mensaje después de 2.5 segundos
                            setTimeout(function() {
                                $('#errorMessage').hide().empty();
                            }, 2500);
                        }
                        // Mostrar mensaje de error para el nombre del test
                        if (errors.questionAmount) {
                            $('#errorMessage').append('<p>' + errors.questionAmount[0] + '</p>')
                                .show();
                            // Ocultar el mensaje después de 2.5 segundos
                            setTimeout(function() {
                                $('#errorMessage').hide().empty();
                            }, 2500);
                        }
                        // Mostrar mensaje de error para el nombre del test
                        if (errors.testDuration) {
                            $('#errorMessage').append('<p>' + errors.testDuration[0] + '</p>')
                                .show();
                            // Ocultar el mensaje después de 2.5 segundos
                            setTimeout(function() {
                                $('#errorMessage').hide().empty();
                            }, 2500);
                        }
                        // Limpiar mensaje de éxito si lo hubiera
                        $('#successMessage').text('');
                        console.error(error);


                    }
                });
            });

        });
    </script>


@stop
