<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestConfiguration extends Model
{
    use HasFactory;

    protected $table = 'test_configurations';


    protected $fillable = [
        'name',
        'id_exam',
        'date',
        'number_questions',
        'time',
        'status'
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'id_exam');
    }

}
