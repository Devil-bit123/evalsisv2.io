@extends('voyager::master')

@section('content')
    <div class="container">
        <h1>Add Teacher to Course: {{ $course->name }}</h1>

        <form method="POST" action="{{ route('courses.storeTeacher', ['course' => $course->id, 'id' => '']) }}" id="addTeacherForm">

            @csrf

            <label for="user_id">Select User:</label>
            <select name="user_id" id="user_id">
                @foreach($users as $userItem)
                    <option value="{{ $userItem->id }}">{{ $userItem->name }}</option>
                @endforeach
            </select>

            <button type="submit">Add as Teacher</button>
        </form>
    </div>

    <script>
        // Capturar el select
        var selectUser = document.getElementById('user_id');

        // Agregar un evento onchange al select
        selectUser.addEventListener('change', function() {
            // Obtener el ID del usuario seleccionado
            var userId = this.value;

            // Obtener el formulario
            var form = document.getElementById('addTeacherForm');

            // Obtener la URL base de la acción del formulario
            var actionUrl = "{{ route('courses.storeTeacher', ['course' => $course->id, 'id' => '']) }}";

            // Actualizar la URL de la acción con el ID del usuario seleccionado
            form.action = actionUrl.replace('{id}', userId);
        });

        // Capturar la respuesta del formulario
        document.getElementById('addTeacherForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Evitar el envío predeterminado del formulario

            // Realizar la solicitud del formulario
            fetch(this.action, {
                method: this.method,
                body: new FormData(this)
            })
            .then(response => response.json())
            .then(data => {
                // Verificar si la respuesta es exitosa
                if (data.success) {
                    // Redirigir a la ruta deseada
                    window.location.href = "{{ route('voyager.courses.index') }}";
                } else {
                    // Manejar errores o mostrar mensajes de error si es necesario
                    console.error('Error:', data.message);
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        });
    </script>

@endsection
