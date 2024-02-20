@extends('voyager::master')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    {{-- --}}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('my-planification-save') }}">
                        @csrf
                        <div class="input-group">
                            <h5><span class="input-group-text">Seleccione la materia</span></h5>
                            <select name="course_id" class="form-control">
                                <option value="">Selecciona una materia</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-group">
                            <h5><span class="input-group-text">Nombre de la planificación</span></h5>
                        </div>
                        <textarea name="name" class="form-control" placeholder="Nombre de la planificación"></textarea>

                        <div class="input-group">
                            <h5><span class="input-group-text">Seleccione el tipo de planificacion</span></h5>
                            <select name="type" class="form-control">
                                <option value="">Selecciona un tipo de planificación</option>
                                <option value="test">Test</option>
                                <option value="homework">Homework</option>
                                <option value="class">Class</option>
                            </select>
                        </div>

                        <div class="input-group">
                            <h5><span class="input-group-text">Descripción de la planificación</span></h5>
                            <textarea name="description" class="form-control" aria-label="Descripción de la planificación"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
