@extends('voyager::master')

@section('content')
    <!--jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Agregar Curso</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif


                        <!-- Área para mostrar mensajes de éxito -->
                        <div id="successMessage" class="alert alert-success" style="display: none;"></div>

                        <div id="errorMessage" class="alert alert-danger" style="display: none;"></div>

                        <div class="form-group">
                            <label for="name">Nombre del Curso</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Descripción del Curso</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="id_company">Compañía</label>
                            <select class="form-control" id="id_company" name="id_company" required>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <button type="button" class="btn btn-primary" id="agregarCurso">Agregar Curso</button>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')

    <script>
        $(document).ready(function() {
            // Manejar el clic en el botón mediante AJAX
            $('#agregarCurso').click(function() {
                // Obtener los valores del formulario
                var name = $('#name').val();
                var description = $('#description').val();
                var id_company = $('#id_company').val();

                // Realizar la petición AJAX
                $.ajax({
                    type: 'POST',
                    url: '{{ route('courses.store') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'name': name,
                        'description': description,
                        'id_company': id_company,
                    },
                    success: function(data) {
                        // Manejar la respuesta exitosa
                        // alert('Curso agregado correctamente');
                        // window.location.href = '/admin/index-course';
                        // Puedes redirigir a otra página o realizar acciones adicionales aquí

                        // Mostrar mensaje de éxito
                        $('#successMessage').text(data.success).show();
                        // Limpiar mensaje de error si lo hubiera
                        $('#errorMessage').text('');
                        //console.log(response);
                        setTimeout(function() {
                            // Redirigir después de 1 segundo
                            window.location.href = '/admin/index-course';
                        }, 2500);


                    },
                    error: function(error) {
                        // Manejar errores en la petición AJAX
                        //console.error('Error al agregar el curso:', error);
                        // alert(
                        //'Error al agregar el curso. Consulta la consola para más detalles.');

                        $('#errorMessage').text(xhr.responseJSON.message).show();
                        // Limpiar mensaje de éxito si lo hubiera
                        $('#successMessage').text('');
                        //console.error(error);
                    }
                });
            });
        });
    </script>

@stop
