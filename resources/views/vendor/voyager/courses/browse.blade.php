@extends('voyager::master')

@section('content')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if ($user->role->name == 'admin' || $user->role->name == 'docente')
        <a href="{{ route('courses.add') }}" class="btn btn-warning">Agregar</a>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Área para mostrar mensajes de éxito -->
            <div id="successMessage" class="alert alert-success" style="display: none;"></div>

            <div id="errorMessage" class="alert alert-danger" style="display: none;"></div>


            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @foreach ($courses as $course)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-header">
                            {{ $course->name }}
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->description }}</h5>
                            <a href="{{ route('courses.details', ['id' => $course->id]) }}" class="btn btn-primary">Ver
                                detalles</a>
                            @if ($user->role->name == 'admin' || $user->role->name == 'docente')
                                <a href="{{ route('courses.edit', ['id' => $course->id]) }}"
                                    class="btn btn-warning">Editar</a>
                            @endif
                            @if ($user->role->name == 'admin')
                                <a href="{{ route('courses.addTeacher', ['course' => $course->id, 'id' => $user->id]) }}"
                                    class="btn btn-warning">Agregar Maestro</a>
                                <a href="{{ route('courses.delete', ['id' => $course->id]) }}"
                                    class="btn btn-danger">Eliminar</a>
                            @endif
                            @if ($user->role->name == 'alumno')
                                @php
                                    $showDictarButton = false;
                                @endphp

                                @foreach ($switchs as $switch)
                                    @if ($switch->name === 'Matriculation' && $switch->status === 1)
                                        @php
                                            $showDictarButton = true;
                                            break;
                                        @endphp
                                    @endif
                                @endforeach

                                @if ($showDictarButton)
                                    <a href="#" class="btn btn-danger matricularse-btn"
                                        data-course-id="{{ $course->id }}"
                                        data-user-id="{{ $user->id }}">Matricularse</a>
                                @endif
                            @endif

                            @if ($user->role->name == 'docente')
                                @php
                                    $showDictarButton = false;
                                @endphp

                                @foreach ($switchs as $switch)
                                    @if ($switch->name === 'Inscription' && $switch->status === 1)
                                        @php
                                            $showDictarButton = true;
                                            break;
                                        @endphp
                                    @endif
                                @endforeach

                                @if ($showDictarButton)
                                    <a href="#" class="btn btn-danger dictar-btn"
                                        data-course-id="{{ $course->id }}" data-user-id="{{ $user->id }}">Dictar</a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection


@section('javascript')
    <script>
        $(document).ready(function() {
            $('.btn-edit').click(function(e) {
                e.preventDefault();

                var courseId = $(this).data('course-id');

                // Redirige a la ruta de edición con el ID del curso
                window.location.href = '/edit-course/' + courseId;
            });

            $('.btn-delete').click(function(e) {
                e.preventDefault();

                var courseId = $(this).data('course-id');

                if (confirm('¿Estás seguro de que deseas eliminar este curso?')) {
                    // Aquí puedes realizar una solicitud Ajax para enviar la solicitud de eliminación al servidor.
                    // Puedes usar la ruta '/delete-course/{id}' y el método DELETE en tu controlador CourseController.

                    // Ejemplo de solicitud Ajax:
                    $.ajax({
                        url: '/delete-course/' + courseId,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            // Manejar la respuesta del servidor (puede ser redireccionar, actualizar la interfaz, etc.).
                            //console.log(data);
                        },
                        error: function(error) {
                            //console.log(error);
                        }
                    });


                    // Si no estás utilizando Ajax, puedes redirigir directamente a la ruta de eliminación.
                    // window.location.href = '/delete-course/' + courseId;
                }
            });

            $('.btn-add').click(function(e) {
                e.preventDefault();

                var courseId = $(this).data('course-id');

                if (confirm('¿Estás seguro de que deseas agregar este curso?')) {
                    // Redirige a la ruta de agregar curso
                    window.location.href = '/admin/add-course';
                }
            });

            $('.btn-details').click(function(e) {
                e.preventDefault();

                var courseId = $(this).data('course-id');

                // Redirige a la ruta de detalles del curso
                window.location.href = '/course-details/' + courseId;
            });


            $('.matricularse-btn').click(function(e) {
                e.preventDefault();

                var courseId = $(this).data('course-id');
                var userId = $(this).data('user-id');

                if (confirm('¿Estás seguro de matricularte en este curso?')) {
                    $.ajax({
                        url: '/admin/courses/' + courseId + '/add-student/' + userId,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
                                // alert('Matriculado exitosamente.');
                                // Puedes redirigir o realizar otras acciones después del éxito.

                                // Mostrar mensaje de éxito
                                $('#successMessage').text(response.success).show();
                                // Limpiar mensaje de error si lo hubiera
                                $('#errorMessage').text('');
                                //console.log(response);

                            }
                        },
                        error: function(xhr, status, error) {

                            $('#errorMessage').text(xhr.responseJSON.message).show();
                            // Limpiar mensaje de éxito si lo hubiera
                            $('#successMessage').text('');
                            //console.error(error);


                        }
                    });
                }
            });


            $('.dictar-btn').click(function(e) {
                e.preventDefault();

                var courseId = $(this).data('course-id');
                var userId = $(this).data('user-id');

                if (confirm('¿Estás seguro de inscribirte como maestro en este curso?')) {
                    // Realiza una solicitud Ajax para agregar al usuario como maestro en el curso
                    $.ajax({
                        url: '/admin/courses/' + courseId + '/add-teacher/' + userId,
                        type: 'POST', // Cambia a método POST ya que estás enviando datos al servidor
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            'user_id': userId // Asegúrate de incluir el campo user_id en los datos enviados
                        },
                        success: function(response) {
                            if (response.success) {

                                // Mostrar mensaje de éxito
                                $('#successMessage').text(response.success).show();
                                // Limpiar mensaje de error si lo hubiera
                                $('#errorMessage').text('');
                                //console.log(response);

                            }
                        },
                        error: function(xhr, status, error) {

                            $('#errorMessage').text(xhr.responseJSON.message).show();
                            // Limpiar mensaje de éxito si lo hubiera
                            $('#successMessage').text('');
                            //console.error(error);

                        }
                    });
                }
            });






        });
    </script>
@endsection
