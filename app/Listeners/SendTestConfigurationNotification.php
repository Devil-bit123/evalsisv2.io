<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Events\TestConfigurationCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\TestConfigurationCreated as TestConfigurationCreatedMail;
use App\Models\Course;
use App\Models\Exam;

class SendTestConfigurationNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  \App\Events\TestConfigurationCreated  $event
     * @return void
     */
    public function handle(TestConfigurationCreated $event)
    {
        // Obtén la información de la configuración de prueba
        $testConfiguration = $event->configuration;

        $question_bank = Exam::find($testConfiguration->id_exam);

        $course = Course::find($question_bank->id_course);

        $alumnos = $course->users()->wherePivot('role', 'alumno')->get();

        foreach ($alumnos as $alumno) {

            $email = $alumno->email;
            Mail::to($email)->send(new TestConfigurationCreatedMail($testConfiguration,$question_bank,$course));

            //Log::info('email: ' . json_encode($email));
        }

    }
}
