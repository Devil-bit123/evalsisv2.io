<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Test;
use App\Models\Course;
use App\Helpers\TestHelper;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\TestConfiguration;
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

    public function test_configuration_delete($id)
    {


        $configuration = TestConfiguration::find($id);
        $exam = $configuration->exam;
        $course = $exam->course;
        $configuration->delete();

        $user = Auth::user();
        //$course = Course::find($id);

        return view('my-course.dashboard', compact('user', 'course'));
    }


    public function test_view($id)
    {
        $course = Course::find($id);
        $user = Auth::user();

        // Check if the course is found
        if (!$course) {
            abort(404); // Or handle the case when the course is not found
        }

        $testConfigurations = $course->exams->flatMap->testConfigurations;
        $testResults = []; // Initialize an array to store test results

        foreach ($testConfigurations as $e) {
            $response = Test::where('id_test_configuration', '=', $e->id)->first();

            // Add the current test result to the array
            $testResults[] = $response;
        }


        //dd($testResults);



        return view('my-course.my-test', compact('testConfigurations', 'user','testResults'));
    }



    public function take_test($id)
    {

        $user = Auth::user();
        $test_configuration = TestConfiguration::find($id);
        $questionBank = $test_configuration->exam->questions;
        $questionamount = $test_configuration->number_questions;

        $random_questions = TestHelper::get_random_questions($questionBank, $questionamount);
        //dd($random_questions);
        return view('my-course.take_test', compact('random_questions', 'user', 'test_configuration'));
    }

    public function submitTest(Request $request)
    {
        $user = Auth::user();
        $user_answers = $request->input('userResponses');
        $score = TestHelper::get_my_score($user_answers);

        $test = new Test([
            'id_user' => $user->id,
            'id_test_configuration' => $request->input('id_test_configuration'),
            'responses' => json_encode($request->input('userResponses')),
            'score' => $score,
            'completed_status' => $request->input('complete_status'),
        ]);
        //dd($test);
        $test->save();
        $configuration = TestConfiguration::find($request->input('id_test_configuration'));
        $course = $configuration->exam->course;

        // Crear una respuesta JSON con la URL de redirección y cualquier otro dato que desees enviar
        $response = [
            'redirect_url' => route('my-course.dashboard', ['id' => $course->id]),
            'message' => 'Test submitted successfully.', // O cualquier otro mensaje que desees enviar
        ];

        // Retornar la respuesta JSON
        return response()->json($response);
    }


    public function my_score($id)
    {
        $scored_test = Test::where('id_test_configuration', $id)->first();

        if ($scored_test) {
            $decoded_responses = json_decode($scored_test->responses, true);
            return view('my-course.my-score', compact('scored_test', 'decoded_responses'));
        }
    }


}