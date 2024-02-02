<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseUserController extends Controller
{
    public function showAddTeacherForm(Course $course)
    {
        // Obtén todos los usuarios que aún no son docentes en este curso
        $users = User::whereNotIn('id', $course->users()->wherePivot('role', 'docente')->pluck('users.id'))->get();

        return view('courses-teachers.add-teacher', compact('course', 'users'));
    }

    public function addTeacher(Request $request, Course $course)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // Asocia el usuario seleccionado como docente al curso
        $course->users()->attach($request->user_id, ['role' => 'docente']);

        return redirect()->route('courses.index', $course->id)->with('success', 'Usuario agregado como docente correctamente.');
    }

     public function removeTeacher(Course $course, User $teacher)
    {
        // Desvincula al maestro del curso
        $course->users()->detach($teacher->id);

        return redirect()->route('courses.index', $course->id)->with('success', 'Maestro eliminado correctamente.');
    }


    public function addStudentForm(Course $course, User $user)
    {
        // Puedes agregar lógica adicional si es necesario
        return view('courses.add-student', compact('course', 'user'));
    }

    public function addStudent(Request $request, Course $course, $id)
    {
        // Verificar si el usuario existe
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('courses.index')->with('error', 'Usuario no encontrado.');
        }

        // Asocia el usuario seleccionado como estudiante al curso
        $course->users()->attach($id, ['role' => 'alumno']);

        return redirect()->route('courses.index')->with('success', 'Usuario agregado como estudiante correctamente.');
    }


    public function removeStudent(Course $course, User $student)
    {
        // Desvincula al estudiante del curso
        $course->users()->detach($student->id);

        return redirect()->route('courses.index', $course->id)->with('success', 'Estudiante eliminado correctamente.');
    }


}
