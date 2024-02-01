<!-- resources/views/courses/add-student.blade.php -->

@extends('voyager::master')

@section('content')
    <div class="container">
        <h1>Add Student to Course: {{ $course->name }}</h1>

        <form method="POST" action="{{ route('courses.storeStudent', $course->id) }}">
            @csrf

            <label for="user_id">Select User:</label>
            <select name="user_id" id="user_id">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>

            <button type="submit">Add as Student</button>
        </form>
    </div>
@endsection
