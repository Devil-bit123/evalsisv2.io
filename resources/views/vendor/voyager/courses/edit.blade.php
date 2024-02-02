@extends('voyager::master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Curso</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('courses.update', $course->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Nombre del Curso</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $course->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Descripción del Curso</label>
                            <textarea class="form-control" id="description" name="description" required>{{ $course->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="id_company">Compañía</label>
                            <select class="form-control" id="id_company" name="id_company" required>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" {{ $course->id_company == $company->id ? 'selected' : '' }}>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar Curso</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
