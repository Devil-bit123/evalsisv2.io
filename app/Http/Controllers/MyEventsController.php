<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyEventsController extends Controller
{
    //
    public function index() {
        $user = Auth::user();
        $courses = $user->courses;
        $events = [];

        foreach ($courses as $course) {
            $exams = $course->exams;

            foreach ($exams as $exam) {
                $configurations = $exam->testConfigurations;

                foreach ($configurations as $configuration) {
                    // Construir el objeto evento para cada configuración de examen
                    $event = [
                        'title' => $course->name.'-'.$configuration->name, // Nombre de la configuración
                        'start' => $configuration->date, // Fecha de la configuración
                        'end' => $configuration->date,   // Mismo día para inicio y fin, ajusta según tus necesidades
                    ];

                    // Agregar el evento al array de eventos
                    $events[] = $event;
                }
            }
        }

        // Convertir el array de eventos a formato JSON
        //$events = json_encode($events);
        // Output o utilización de $jsonEvents según tus necesidades
        //dd($events);

        return view('Calendar.my-calendar',compact('events'));
    }



}
