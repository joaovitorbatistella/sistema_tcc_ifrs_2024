<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;
use Illuminate\Database\Seeder;

class TCCType extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tcc_type')->insert([
            'name'               => "TCC I",
            'created_at'         => Carbon::now(),
            'updated_at'         => Carbon::now()
        ]);

        DB::table('tcc_type')->insert([
            'name'               => "TCC II",
            'created_at'         => Carbon::now(),
            'updated_at'         => Carbon::now()
        ]);
    }
}
