<?php

namespace App\Mail;

use App\Models\TestConfiguration;
use App\Models\Exam;
use App\Models\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestConfigurationCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $testConfiguration;
    public $exam;
    public $course;

    /**
     * Create a new message instance.
     *
     * @param  TestConfiguration  $testConfiguration
     * @param  Exam  $exam
     * @param  Course  $course
     * @return void
     */
    public function __construct(TestConfiguration $testConfiguration, Exam $exam, Course $course)
    {
        $this->testConfiguration = $testConfiguration;
        $this->exam = $exam;
        $this->course = $course;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Notificación de Nuevos Examenes')
            ->view('emails.test_configuration_created');
    }
}
