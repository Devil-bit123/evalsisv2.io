<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Course;
use App\Models\TestConfiguration;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class MyCourseViewController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $courses = Course::all();
        return view('vendor.voyager.my-courses-view.browse', compact('user', 'courses'));
    }

    public function dashboard($id)
    {

        $user = Auth::user();
        $course = Course::find($id);

        return view('my-course.dashboard', compact('course', 'user'));
    }

    public function test_configuration($id)
    {

        $exams = Exam::where('id_course', '=', $id)->get();




        return view('my-course.test-configuration', compact('exams'));
    }

    public function test_configuration_save(Request $request)
    {
        $request->validate([
            'testName' => 'required|string',
            'examId' => ['required', Rule::exists(Exam::class, 'id')],
            'selectedDate' => 'required|date',
            'questionAmount' => 'required|integer|min:1', // Puedes ajustar el mínimo según tus requisitos
            'testDuration' => 'required|string', // Ajusta según tus requisitos
        ]);

        $configuration = new TestConfiguration([
            'name' => $request->input('testName'),
            'id_exam' => $request->input('examId'),
            'date' => $request->input('selectedDate'),
            'number_questions' => $request->input('questionAmount'),
            'time' => $request->input('testDuration'),
            'status' => 'new'
        ]);

        $configuration->save();
        return response()->json(['message' => 'Datos guardados exitosamente'], 200);
    }

    public function test_configuration_show($id)
    {
        $course = Course::find($id);
        $exams = $course->exams;
        $configurations = [];
        foreach ($exams as $exam) {
            $configurations = array_merge($configurations, $exam->testConfigurations->toArray());
        }
        //dd($configurations);
        return view('my-course.test-details', compact('course', 'exams', 'configurations'));
    }

    public function test_configuration_edit($id)
    {
        $user = Auth::user();
        $configuration = TestConfiguration::find($id);

        if ($configuration) {
            $exam = $configuration->exam;


            if ($exam) {
                $course = $exam->course;
                // Utiliza get() o first() para obtener los resultados reales de la consulta
                $exams = Exam::where('id_course', '=', $course->id)->get();
                // o $exams = Exam::where('id_course', '=', $course->id)->first();

                //dd($exams);
                return view('my-course.test-edit', compact('exams', 'configuration', 'user', 'course'));
            } else {
                dd("No se encontró el examen asociado a la configuración de prueba.");
            }
        } else {
            dd("No se encontró la configuración de prueba con el ID proporcionado.");
        }
    }


    public function test_configuration_update(Request $request, $id)
    {
        $request->validate([
            'testName' => 'required|string',
            'examId' => ['required', Rule::exists(Exam::class, 'id')],
            'selectedDate' => 'required|date',
            'questionAmount' => 'required|integer|min:1',
            'testDuration' => 'required|string',
        ]);

        // Encuentra la configuración de prueba por su ID
        $configuration_update = TestConfiguration::find($id);

        // Verifica la validez antes de continuar
        if (!$configuration_update) {
            return response()->json(['error' => 'No se encontró la configuración de prueba con el ID proporcionado.'], 404);
        }

        // Actualiza los datos con los valores proporcionados en el formulario
        $configuration_update->name = $request->input('testName');
        $configuration_update->id_exam = $request->input('examId');
        $configuration_update->date = $request->input('selectedDate');
        $configuration_update->number_questions = $request->input('questionAmount');
        $configuration_update->time = $request->input('testDuration');
        $configuration_update->status = 'new';

        // Guarda los cambios en la base de datos
        $configuration_update->save();

        // Verifica si la actualización fue exitosa
        if (!$configuration_update) {
            return response()->json(['error' => 'Error al actualizar la configuración de prueba.'], 500);
        }

        // Continúa con el resto de la lógica si la actualización fue exitosa
        $exam = $configuration_update->exam;

        if ($exam) {
            $course = $exam->course;

            // Aquí puedes devolver una respuesta JSON con la información necesaria
            return response()->json(['success' => true, 'user' => Auth::user(), 'course' => $course]);
        } else {
            return response()->json(['error' => 'No se encontró el examen asociado a la configuración de prueba.'], 404);
        }
    }

    public function test_configuration_delete($id){


        $configuration = TestConfiguration::find($id);
        $exam = $configuration->exam;
        $course = $exam->course;
        $configuration->delete();

        $user = Auth::user();
        //$course = Course::find($id);

        return view('my-course.dashboard',compact('user','course'));
    }


}
