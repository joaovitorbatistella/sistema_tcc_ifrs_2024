<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'state_id',
        'name',
        'created_at',
        'updated_at',
      ];
    
      public function region(){
        return $this->belongsTo(States::class, 'id', 'state_id');
      } 
}
