<!-- resources/views/exams/index.blade.php -->

@extends('voyager::master')
@section('content')

<div class="row">
    @foreach ($courses as $course)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <!-- Contenido del encabezado de la tarjeta -->
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $course->name }}</h5>
                    <p class="card-text">{{ $course->description }}</p>
                    <a href="{{ route('courses.create_exam_form',['course'=>$course->id]) }}" class="btn btn-primary">Agregar Banco</a>
                    <a href="{{ route('exams.show',['course'=>$course->id]) }}" class="btn btn-primary">Ver Bancos</a>
                </div>
            </div>
        </div>
    @endforeach
</div>


@endsection
