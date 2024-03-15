<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'name',
        'phoneCode',
        'created_at',
        'updated_at',
    ];

    public function regions(){
        return $this->hasMany(State::class, 'state_id', 'id');
    } 
}
