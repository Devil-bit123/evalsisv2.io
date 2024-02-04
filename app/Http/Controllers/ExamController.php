<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Course;
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

        $request->validate([
            'bankName' => 'required|string|max:255',
            'bankDescription' => 'required|string|max:255',
            'questions' => 'required|array|min:1', // al menos una pregunta
            'questions.*.title' => 'required|string|max:255',
            'questions.*.responses' => 'required|array|min:2', // al menos dos respuestas
            'questions.*.responses.*' => 'required|string|max:255',
            'questions.*.correct_asnwer_index' => 'required|int|min:0', // Asegúrate de que sea un índice válido
            'questions.*.correct_asnwer_text' => 'required|string',
        ]);

        $exam = Exam::create([
            'id_course' => $course->id,
            'name' => $request->input('bankName'),
            'description' => $request->input('bankDescription'),
            'questions' => $request->input('questions'),
        ]);

        $courses = Course::all();

        return view('exams.index', compact('courses'));
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
            'questions.*.correct_asnwer_index' => 'required|int',
            'questions.*.correct_asnwer_text' => 'required|string',
        ]);

        $exam = Exam::findOrFail($examId);
        $exam->name = $request->bankName;
        $exam->description = $request->bankDescription;
        $exam->questions = $request->questions;
        $exam->save();

       // return redirect()->route('exams.index')->with('success', 'Examen actualizado exitosamente.');
    }



    public function destroy($examId)
    {
        // Find the exam by ID
        $exam = Exam::findOrFail($examId);

        $exam->delete();

        // Redirect back or to a specific page after deletion
        return redirect()->route('exams.index')->with('success', 'Exam deleted successfully');
    }



}
