<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends \TCG\Voyager\Models\User
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_info',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relación inversa con la tabla infos
    public function info()
    {
        return $this->belongsTo(Info::class, 'id_info');
    }

    /*
    $user = \App\Models\User::find(1);
    $info = $user->info;
    */

    public function deleteInfo()
    {
        $this->info()->delete();
    }

    /*
    $user = User::find($userId);
    if ($user) {
    $user->deleteInfo();
    */

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'user_company', 'user_id', 'company_id');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_user', 'user_id', 'course_id')
            ->withPivot('role')
            ->withTimestamps();
    }

    public function enrollInCourse(Course $course)
    {
        $this->courses()->attach($course->id, ['role' => 'alumno']);
    }

    public function teachCourse(Course $course)
    {
        $this->courses()->attach($course->id, ['role' => 'docente']);
    }

    public function tests()
{
    return $this->hasMany(Test::class, 'id_user');
}

}
