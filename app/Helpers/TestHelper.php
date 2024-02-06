<?php
// app/helpers/TestHelper.php

namespace App\Helpers;

class TestHelper
{
    public static function get_random_questions($bank = [], $amount)
    {
        // Verificar si la cantidad solicitada es mayor que el total de preguntas disponibles
        $total_questions = count($bank);
        if ($amount > $total_questions) {
            return "La cantidad de preguntas solicitada es mayor que el total de preguntas disponibles.";
        }

        // Obtener preguntas aleatorias sin repetición
        $random_keys = array_rand($bank, $amount);
        $selected_questions = [];

        if (!is_array($random_keys)) {
            $random_keys = [$random_keys];
        }

        foreach ($random_keys as $key) {
            $selected_questions[] = $bank[$key];

            // Eliminar la pregunta seleccionada del banco para evitar repeticiones
            unset($bank[$key]);
        }

        return $selected_questions;
    }


    public static function get_my_score($responses = [])
    {
        $totalQuestions = count($responses);
        $correctAnswersCount = 0;

        foreach ($responses as $response) {
            if (
                $response['correct_asnwer_text'] === $response['user_answer_text'] &&
                $response['correct_asnwer_index'] === $response['user_anwser_index']
            ) {
                $correctAnswersCount++;
            }
        }

        $percentageCorrect = ($correctAnswersCount / $totalQuestions) * 100;

        // Si todas las respuestas son correctas, asigna una calificación perfecta (10)
        if ($correctAnswersCount === $totalQuestions) {
            return 10;
        }

        // Calcula una calificación basada en el porcentaje de respuestas correctas
        $score = ($percentageCorrect / 100) * 10;

        return round($score, 2);  // Redondea la calificación a dos decimales
    }



}
