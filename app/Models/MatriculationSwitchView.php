<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatriculationSwitchView extends Model
{
    use HasFactory;

    protected $table = 'matriculation_switch_views';

    protected $fillable = [
        'name',
        'status'
    ];
}
