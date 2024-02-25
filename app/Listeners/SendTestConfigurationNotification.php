<?php

namespace App\Listeners;

use App\Models\Exam;
use App\Models\Course;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use App\Events\TestConfigurationCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
            $this->sendEmail($email, $testConfiguration, $question_bank, $course);
        }
    }

    private function sendEmail($to, $testConfiguration, $question_bank, $course)
    {
        $client = new Client();

        try {
            $response = $client->post('https://api.sendinblue.com/v3/smtp/email', [
                'json' => [
                    'sender' => ['name' => env('APP_NAME'), 'email' =>  env('NOTIFICATION_CHANNEL')],
                    'to' => [['email' => $to]],
                    'subject' => 'Notificación de Nuevos Examenes',
                    'htmlContent' => view('emails.test_configuration_created', compact('testConfiguration', 'course'))->render()
                ],
                'headers' => [
                    'api-key' => env('V3_API_KEY '),
                    'Content-Type' => 'application/json'
                ]
            ]);

            $statusCode = $response->getStatusCode();

            if ($statusCode == 201) {
                Log::info('Email sent successfully to: ' . $to);
            } else {
                Log::error('Failed to send email to: ' . $to . ', status code: ' . $statusCode);
            }
        } catch (\Exception $e) {
            Log::error('Error sending email to: ' . $to . ', error: ' . $e->getMessage());
        }
    }
}
