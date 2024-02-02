<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        'id_company',
        'name',
        'description'

    ];


    // Relación inversa, perteneciente a una compañía
    public function company()
    {
        return $this->belongsTo(Company::class, 'id_company');
    }


    public function exams()
{
    return $this->hasMany(Exam::class, 'id_course', 'id'); // Ajusta según el nombre correcto de las claves
}



    public function users()
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id')
            ->withPivot('role')
            ->withTimestamps();
    }
}
