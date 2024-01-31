<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class info extends Model
{
    use HasFactory;

    protected $table = 'infos';

    // Relación inversa, un usuario tiene una información
    public function user(){
        return $this->belongsTo(User::class);
    }
}
