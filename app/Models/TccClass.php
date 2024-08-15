<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TccClass extends Model
{
    use HasFactory;

    protected $table = 'tcc_class';
    protected $primaryKey = 'tcc_class_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tcc_type_id',
        'tcc_id',
        'status',
        'created_at',
        'updated_at',
    ];

}
