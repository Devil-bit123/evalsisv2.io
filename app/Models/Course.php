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
}
