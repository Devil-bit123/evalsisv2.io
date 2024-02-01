<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{

    use HasFactory;


    protected $fillable = [
        'info'
    ];


    public function user()
    {
        return $this->hasOne(User::class, 'id_info');
    }

    /*
    $info = \App\Models\Info::find(1);
    $user = $info->user;
    */

    public function updateInfo($newInfo)
    {
        $this->update(['info' => $newInfo]);
    }

    /*
        if ($info) {
        // Actualiza la información
        $info->updateInfo($newInfo);
    */
}
