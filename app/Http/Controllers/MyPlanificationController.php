<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Planification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class MyPlanificationController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();

        if($user->role->name === 'admin'){
            $courses = Course::all();
        }else{
            $courses = $user->courses;
        }



        //dd($courses);
        return view('vendor.voyager.planifications.my-planifications', compact('courses'));
    }

    public function find(Course $course)
    {
        $user = Auth::user();
        $planifications = Planification::where('course_id', $course->id)->orderBy('type')->get();
        $homeworks = $planifications->where('type', 'homework');
        $tests = $planifications->where('type', 'test');
        $classes = $planifications->where('type', 'class');

        return view('vendor.voyager.planifications.my-planification', compact('user','course', 'planifications', 'homeworks', 'tests', 'classes'));
    }


     public function save(Request $request)
    {
        try {
            // Validar los datos recibidos del formulario
            $request->validate([
                'course_id' => 'required|exists:courses,id',
                'name' => 'required|string',
                'type' => 'required|string|in:test,homework,class',
                'description' => 'required|string',
            ], [
                'course_id.required' => 'Debe seleccionar una materia.',
                'course_id.exists' => 'El curso seleccionado no existe.',
                'name.required' => 'El campo nombre es obligatorio.',
                'name.string' => 'El campo nombre debe ser una cadena de caracteres.',
                'type.required' => 'Debe seleccionar el tipo de planificación.',
                'type.string' => 'El campo tipo debe ser una cadena de caracteres.',
                'type.in' => 'El campo tipo debe ser uno de los siguientes: test, homework, class.',
                'description.required' => 'El campo descripción es requerido.',
                'description.string' => 'El campo descripción debe ser una cadena de caracteres.',
            ]);


            // Crear una nueva instancia de Planification con los datos del formulario
            $planification = new Planification();
            $planification->course_id = $request->course_id;
            $planification->name = $request->name;
            $planification->type = $request->type;
            $planification->description = $request->description;

            // Guardar la planificación en la base de datos
            $planification->save();

            // Enviar mensaje de éxito usando la sesión flash
            session()->flash('success', 'Planificación guardada exitosamente.');

            // Redirigir a una vista o realizar cualquier otra acción después de guardar la planificación
            return redirect()->route('voyager.my-courses-view.index');
        } catch (ValidationException $e) {
            // En caso de que falle la validación, redirigir de nuevo al formulario con los errores
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }


}
