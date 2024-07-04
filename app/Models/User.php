<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
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
        'course',
        'gender',
        'birthday',
        'nationality',
        'special_need',
        'martial_status',
        'cpf',
        'rg',
        'family_income',
        'family_number',
        'password',
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
        'password' => 'hashed',
    ];

    public static function students()
    {
        return User::select('users.*')
                   ->join('user_group', 'users.id', '=', 'user_group.user_id')
                   ->where('user_group.group_id', 4)
                   ->get();
    }

    public static function teachers()
    {
        return User::select('users.*')
                   ->join('user_group', 'users.id', '=', 'user_group.user_id')
                   ->where('user_group.group_id', 5)
                   ->get();
    }
}
