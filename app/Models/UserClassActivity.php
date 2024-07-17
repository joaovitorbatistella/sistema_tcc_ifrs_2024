<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserClassActivity extends Model
{
    use HasFactory;

    protected $table = 'user_class_activity';
    protected $primaryKey = 'user_class_activity_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_class_id',
        'name',
        'description',
        'due_at',
        'delivered_at',
        'created_at',
        'updated_at',
    ];
}
