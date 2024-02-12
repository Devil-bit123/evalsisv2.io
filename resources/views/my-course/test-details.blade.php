@extends('voyager::master')

@section('content')

<div class="card">
    <div class="card-body">
     <h2>Edición de examenes</h2>
    </div>
  </div>

  @foreach ($configurations as $configuration)

  <div class="card">
    <div class="card-header">
    </div>
    <div class="card-body">
      <h5 class="card-title">{{ $configuration['name'] }}</h5>
      <p class="card-text">Fecha:  {{ $configuration['date'] }}</p>
      <a href="{{ route('my-course.test_configuration_edit',['id'=>$configuration['id']]) }}" class="btn btn-primary">Editar</a>
      <form action="{{ route('my-course.test_configuration_delete', ['id' => $configuration['id']]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>

    </div>
  </div>


  @endforeach

@endsection
