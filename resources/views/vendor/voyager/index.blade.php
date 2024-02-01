@extends('voyager::master')

@section('content')

    @auth
        @php
            $user = Auth::user();
            $roleName = $user->role->name ?? '';
        @endphp

        @switch($roleName)
            @case('admin')
                <div class="card">
                    <div class="card-body">

                        @if ($user->info)
                            @php
                                $infoData = json_decode($user->info->info, true);
                            @endphp

                            <p>Cédula: {{ $infoData['ci'] ?? 'No disponible' }}</p>
                            <p>Fecha de Nacimiento: {{ $infoData['date'] ?? 'No disponible' }}</p>
                            <p>Teléfono: {{ $infoData['phone'] ?? 'No disponible' }}</p>
                            <p>Dirección: {{ $infoData['address'] ?? 'No disponible' }}</p>
                        @else
                            <div class="card w-75 mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Hey, {{ $user->name }}!</h5>
                                    <p class="card-text">No tenemos registrada tu información.</p>
                                    <a href="{{ route('info.view') }}" class="btn btn-info">Agregar</a>
                                    <a href="#" class="btn btn-danger">Skip</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @break

            @case('docente')
                <div class="card">
                    <div class="card-body">

                        @if ($user->info)
                            @php
                                $infoData = json_decode($user->info->info, true);
                            @endphp

                            <p>Cédula: {{ $infoData['ci'] ?? 'No disponible' }}</p>
                            <p>Fecha de Nacimiento: {{ $infoData['date'] ?? 'No disponible' }}</p>
                            <p>Teléfono: {{ $infoData['phone'] ?? 'No disponible' }}</p>
                            <p>Dirección: {{ $infoData['address'] ?? 'No disponible' }}</p>
                        @else
                            <div class="card w-75 mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Hey, {{ $user->name }}!</h5>
                                    <p class="card-text">No tenemos registrada tu información.</p>
                                    <a href="{{ route('info.view') }}" class="btn btn-info">Agregar</a>
                                    <a href="#" class="btn btn-danger">Skip</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @break

            @case('alumno')
                <div class="card">
                    <div class="card-body">

                        @if ($user->info)
                            @php
                                $infoData = json_decode($user->info->info, true);
                            @endphp

                            <p>Cédula: {{ $infoData['ci'] ?? 'No disponible' }}</p>
                            <p>Fecha de Nacimiento: {{ $infoData['date'] ?? 'No disponible' }}</p>
                            <p>Teléfono: {{ $infoData['phone'] ?? 'No disponible' }}</p>
                            <p>Dirección: {{ $infoData['address'] ?? 'No disponible' }}</p>
                        @else
                            <div class="card w-75 mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Hey, {{ $user->name }}!</h5>
                                    <p class="card-text">No tenemos registrada tu información.</p>
                                    <a href="{{ route('info.view') }}" class="btn btn-info">Agregar</a>
                                    <a href="#" class="btn btn-danger">Skip</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @break

            @default
                <div class="card w-75 mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Hey, {{ $user->name }}!</h5>
                        <p class="card-text">No tienes un rol asignado contacta con tu administrador de sistemas .</p>
                        <a href="#" class="btn btn-danger">Skip</a>
                    </div>
                </div>
        @endswitch

    @endauth

@stop


@section('javascript')



@stop
