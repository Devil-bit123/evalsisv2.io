<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
