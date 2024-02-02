<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
   // CourseController.php

   public function details($id)
    {
        $user=Auth::user();
        $course = Course::findOrFail($id);
        $companies = Company::all();
        $docentesNombres = $course->users()
    ->wherePivot('role', 'docente')->get();

    $estudiantesNombres = $course->users()
    ->wherePivot('role', 'alumno')->get();


        return view('vendor.voyager.courses.details', compact('course', 'companies','docentesNombres','user','estudiantesNombres'));
    }



    public function index()
    {
        // Obtener todas las compañías para mostrarlas en un formulario
        $user=Auth::user();
        $courses = Course::all();

        return view('vendor.voyager.courses.browse', ['courses' => $courses, 'user'=>$user]);
    }



    public function add()
    {

        $companies = Company::all();

        return view('vendor.voyager.courses.add', compact('companies'));
    }



    public function store(Request $request)
    {


        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'id_company' => 'required|exists:companies,id',
        ]);

        // Crear un nuevo curso
        Course::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'id_company' => $request->input('id_company'),
        ]);

        // Redireccionar a la vista de cursos o a donde desees
        return redirect()->route('voyager.dashboard')->with('success', 'Curso agregado correctamente');
    }


    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $companies = Company::all();

        return view('vendor.voyager.courses.edit', compact('course', 'companies'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'id_company' => 'required|exists:companies,id',
        ]);

        $course = Course::findOrFail($id);
        $course->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'id_company' => $request->input('id_company'),
        ]);

        return redirect()->route('courses.index')->with('success', 'Curso actualizado correctamente');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Curso eliminado correctamente');
    }


}


