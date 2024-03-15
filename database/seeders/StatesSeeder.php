<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\State;
use Faker\Generator as Faker;
use Faker\Factory as Factory;

class StatesSeeder extends Seeder
{
    public function run(){  

      $array = json_decode(file_get_contents(database_path('data/states.json')), true);

      foreach($array as $c){
          State::create([
              "id"          =>  $c['id'],
              "country_id"  =>  $c['sortname'],
              "name"        =>  $c['name'],
          ]);
      }
    }
}
