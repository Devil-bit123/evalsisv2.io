<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $table = 'tests';


    protected $fillable = [
        'id_user',
        'id_test_configuration',
        'responses',
        'score',
        'completed_status'
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function configuration()
    {
        return $this->belongsTo(TestConfiguration::class, 'test_configuration_id');
    }



}
