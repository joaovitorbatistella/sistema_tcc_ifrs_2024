<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserClassActivityStep extends Model
{
    use HasFactory;

    protected $table = 'user_class_activity_step';
    protected $primaryKey = 'user_class_activity_step_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_class_activity_id',
        'name',
        'completed',
        'notes',
        'delivered_at',
        'created_at',
        'updated_at',
    ];
}
