<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use Faker\Generator as Faker;
use Faker\Factory as Factory;

class CountriesSeeder extends Seeder
{
    public function run(){  

      $array = json_decode(file_get_contents(database_path('data/countries.json')), true);

      foreach($array as $c){
          Country::create([
              "id"          =>  $c['sortname'],
              "name"        =>  $c['name'],
              "phoneCode"   =>  $c['phonecode'],
          ]);
      }
    }
}
