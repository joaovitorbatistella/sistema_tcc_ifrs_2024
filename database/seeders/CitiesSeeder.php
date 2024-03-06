<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use Faker\Generator as Faker;
use Faker\Factory as Factory;

class CitiesSeeder extends Seeder
{
    public function run(){  

      $array = json_decode(file_get_contents(database_path('data/cities.json')), true);

      foreach($array as $c){
          City::create([
              "state_id"    =>  $c['id'],
              "name"        =>  $c['name'],
          ]);
      }
    }
}
