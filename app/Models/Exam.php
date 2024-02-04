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
        return $this->belongsTo(Course::class);
    }

    protected $casts = [
        'questions' => 'array',
    ];
}
