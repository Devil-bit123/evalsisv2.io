<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $table = 'exams';

    protected $fillable = [
        'id_course',
        'name',
        'description',
        'questions'
    ];


    public function course()
    {
        return $this->belongsTo(Course::class, 'id_course', 'id');
    }



    protected $casts = [
        'questions' => 'array',
    ];

    public function testConfigurations()
    {
        return $this->hasMany(TestConfiguration::class, 'id_exam', 'id');
    }
}
