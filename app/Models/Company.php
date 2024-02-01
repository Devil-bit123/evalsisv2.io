<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'phone',
        'ruc_ci',
        'address',
    ];

    // Relación One-to-Many con el modelo Course
    public function courses()
    {
        return $this->hasMany(Course::class, 'id_company');
    }


}
