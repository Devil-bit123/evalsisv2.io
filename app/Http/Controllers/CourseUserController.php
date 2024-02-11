<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CourseUserController extends Controller
{
    public function showAddTeacherForm(Course $course, User $user)
    {
        // Obtén todos los usuarios que aún no son docentes en este curso
        $users = User::whereNotIn('id', $course->users()->wherePivot('role', 'docente')->pluck('users.id'))->get();

        return view('courses-teachers.add-teacher', compact('course', 'users'));
    }

    public function addTeacher(Request $request, Course $course, User $user)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ], [
            'user_id.required' => 'El campo user_id es obligatorio.',
            'user_id.exists' => 'El usuario seleccionado no existe.',
        ]);

        try {
            // Verificar si el usuario ya es docente en el curso
            if ($course->users()->where('user_id', $request->user_id)->wherePivot('role', 'docente')->exists()) {
                return response()->json(['message' => 'El usuario ya es docente en este curso.'], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }

            // Asocia el usuario seleccionado como docente al curso
            $course->users()->attach($request->user_id, ['role' => 'docente']);

            return response()->json(['success' => 'Usuario agregado como docente correctamente.']);
        } catch (\Exception $e) {
            // Si hay una excepción no controlada, devuelve un mensaje de error genérico
            return response()->json(['message' => 'Error al procesar la solicitud.'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
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
            return response()->json(['message' => 'Usuario no encontrado.'], 404);
        }

        // Verificar si el usuario ya está matriculado en el curso
        if ($course->users->contains($user)) {
            return response()->json(['message' => 'El usuario ya está matriculado en este curso.'], 422);
        }

        // Asociar el usuario seleccionado como estudiante al curso
        $course->users()->attach($id, ['role' => 'alumno']);

        return response()->json(['success' => 'Usuario matriculado exitosamente.']);
    }



    public function removeStudent(Course $course, User $student)
    {
        // Desvincula al estudiante del curso
        $course->users()->detach($student->id);

        return redirect()->route('courses.index', $course->id)->with('success', 'Estudiante eliminado correctamente.');
    }
}
