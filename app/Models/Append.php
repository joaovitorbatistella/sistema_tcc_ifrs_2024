<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Append extends Model
{
    use HasFactory;

    protected $table = 'append';
    protected $primaryKey = 'append_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user_id',
        'type_id',
        'public',
        'path',
        'created_at',
        'updated_at',
    ];
}
