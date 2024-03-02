<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Course;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\View;

class ExamController extends Controller
{
    //
    public function index()
    {
        $courses = Course::all();

        return view('exams.index', compact('courses'));
    }


    public function createExamForm($courseId)
    {
        $course = Course::findOrFail($courseId);
        return view('exams.create', compact('course'));
    }



    public function storeExam(Request $request, Course $course)
    {
        try {
            $request->validate([
                'bankName' => 'required|string|max:255',
                'bankDescription' => 'required|string|max:255',
                'questions' => 'required|array|min:1',
                'questions.*.title' => 'required|string|max:255',
                'questions.*.responses' => 'required|array|min:2',
                'questions.*.responses.*' => 'required|string|max:255',
                'questions.*.correct_answer_index' => 'required|int|min:0',
                'questions.*.correct_answer_text' => 'required|string',
            ]);

            $exam = Exam::create([
                'id_course' => $course->id,
                'name' => $request->input('bankName'),
                'description' => $request->input('bankDescription'),
                'questions' => $request->input('questions'),
            ]);

            $courses = Course::all();
            return response()->json(['message' => 'Banco de preguntas Agregado.'], 200);
            //return view('exams.index', compact('courses'))->with('success', 'Banco de preguntas agregado correctamente');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Ha ocurrido un error al procesar la solicitud.']);
        }
    }



    public function showexam($course)
    {

        $course = Course::findOrFail($course);
        $exams = $course->exams;

        //dd($exams);
        return view('exams.show', compact('exams'));
    }


    public function edit($examId)
    {
        $exam = Exam::findOrFail($examId);

        return view('exams.question_edit', ['exam' => $exam]);
    }


    public function update(Request $request, $examId)
    {
        $request->validate([
            'bankName' => 'required|string|max:255',
            'bankDescription' => 'required|string|max:255',
            'questions' => 'required|array|min:1',
            'questions.*.title' => 'required|string|max:255',
            'questions.*.responses' => 'required|array|min:2',
            'questions.*.responses.*' => 'required|string|max:255',
            'questions.*.correct_answer_index' => 'required|int',
            'questions.*.correct_answer_text' => 'required|string',
        ]);

        $exam = Exam::findOrFail($examId);
        $exam->name = $request->bankName;
        $exam->description = $request->bankDescription;
        $exam->questions = $request->questions;
        $exam->save();

        // Devolver un objeto JSON con la clave 'message'
        return response()->json(['message' => 'Banco de preguntas Actualizado.'], 200);
    }



    public function destroy($examId)
    {
        // Find the exam by ID
        $exam = Exam::findOrFail($examId);

        $exam->delete();

        // Redirect back or to a specific page after deletion
        return redirect()->route('voyager.exams.index')->with('success', 'Banco de preguntas eliminado con exito');
    }



}
