@extends('voyager::master')

@section('content')

@auth

<div class="card bg-blue-200 p-4">
    <div class="card-body">
        <h4 class="text-2xl font-bold mb-4">Contratación de Docentes</h4>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="company_id">Selecciona una compañía:</label>
            <select name="company_id" id="company_id" class="form-select form-select-sm" aria-label="Compañía" required>
                <option value="" selected>Seleccione una compañía</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="user_id">Selecciona un usuario:</label>
            <select name="user_id" id="user_id" class="form-select form-select-sm" aria-label="Usuario" required>
                <option value="" selected>Seleccione un usuario</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="button" id="crearUsuarioBtn" class="btn btn-primary">
            Crear Usuario
        </button>

        <button type="button" id="eliminarUsuarioBtn" class="btn btn-danger">
            Eliminar Usuario de la Compañía
        </button>


    </div>
</div>

@endauth

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#crearUsuarioBtn').on('click', function() {
            var companyId = $('#company_id').val();
            var userId = $('#user_id').val();

            // Realizar la petición AJAX
            $.ajax({
                url: '/admin/inscription-store/' + userId,
                type: 'POST',
                data: {
                    company_id: companyId,
                    user_id: userId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Manejar la respuesta si es necesario
                    console.log(response);
                    // Puedes redirigir a donde sea necesario después de procesar la información.
                    window.location.href = '/admin';
                },
                error: function(error) {
                    // Manejar errores si es necesario
                    console.error(error);
                }
            });
        });


        $('#eliminarUsuarioBtn').on('click', function() {
            var companyId = $('#company_id').val();
            var userId = $('#user_id').val();

            // Realizar la petición AJAX para eliminar usuario de la compañía
            $.ajax({
                url: '/admin/remove-user-from-company/' + userId + '/' + companyId,
                type: 'GET', // Puedes cambiarlo a 'DELETE' si lo prefieres
                success: function(response) {
                    // Manejar la respuesta si es necesario
                    console.log(response);
                    // Puedes redirigir o actualizar la vista según sea necesario.
                    window.location.href = '/admin';
                },
                error: function(error) {
                    // Manejar errores si es necesario
                    console.error(error);
                }
            });
        })



    });
</script>

@endsection
