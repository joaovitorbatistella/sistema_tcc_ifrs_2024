<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserClassActivityAppend extends Model
{
    use HasFactory;

    protected $table = 'user_class_activity_append';
    // protected $primaryKey = ['user_class_activity_id', 'append_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_class_activity_id',
        'append_id',
        'created_at',
        'updated_at'
    ];
}
