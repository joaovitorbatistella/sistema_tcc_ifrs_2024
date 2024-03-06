<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'country_id',
        'name',
        'created_at',
        'updated_at'
      ];
    
      public function country(){
        return $this->belongsTo(Country::class, 'id', 'country_id');
      } 
    
      public function cities(){
        return $this->hasMany(City::class, 'state_id', 'id');
      } 
    
      public function addr_cities(){
        return $this->hasMany(Address::class, 'country_id', 'id');
      } 
}
