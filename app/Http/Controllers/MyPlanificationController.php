<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Planification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $planifications = Planification::where('course_id', $course->id)->orderBy('type')->get();

        $homeworks = $planifications->where('type', 'homework');
        $tests = $planifications->where('type', 'test');
        $classes = $planifications->where('type', 'class');

        return view('vendor.voyager.planifications.my-planification', compact('course', 'planifications', 'homeworks', 'tests', 'classes'));
    }


    public function save(Request $request)
    {
        // Validar los datos recibidos del formulario
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name' => 'required|string',
            'type' => 'required|string|in:test,homework,class',
            'description' => 'nullable|string',
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
    }
}
