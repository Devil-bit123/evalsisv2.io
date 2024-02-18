<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planification extends Model
{
    use HasFactory;

    protected $table = 'planifications';

    protected $fillable = [
        'course_id',
        'name',
        'type',
        'description'

    ];

    // Relación con el curso
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
