<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TccType extends Model
{
    use HasFactory;

    protected $table = 'tcc_type';
    protected $primaryKey = 'tcc_type_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];
}
