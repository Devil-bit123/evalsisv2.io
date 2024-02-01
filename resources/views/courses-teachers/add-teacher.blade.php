<!-- resources/views/courses/add-teacher.blade.php -->

@extends('voyager::master')

@section('content')
    <div class="container">
        <h1>Add Teacher to Course: {{ $course->name }}</h1>

        <form method="POST" action="{{ route('courses.storeTeacher', $course->id) }}">
            @csrf

            <label for="user_id">Select User:</label>
            <select name="user_id" id="user_id">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>

            <button type="submit">Add as Teacher</button>
        </form>
    </div>
@endsection
