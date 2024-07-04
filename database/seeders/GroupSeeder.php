<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('group')->insert([
            'name'               => "Administrador",
            'able_to_create_tcc' => true,
            'able_to_read_tcc'   => true,
            'able_to_update_tcc' => true,
            'able_to_delete_tcc' => true,
            'created_at'         => Carbon::now(),
            'updated_at'         => Carbon::now()
        ]);

        DB::table('group')->insert([
            'name'               => "Coordenador",
            'able_to_create_tcc' => true,
            'able_to_read_tcc'   => true,
            'able_to_update_tcc' => true,
            'able_to_delete_tcc' => true,
            'created_at'         => Carbon::now(),
            'updated_at'         => Carbon::now()
        ]);

        DB::table('group')->insert([
            'name'               => "Orientador",
            'able_to_create_tcc' => false,
            'able_to_read_tcc'   => true,
            'able_to_update_tcc' => false,
            'able_to_delete_tcc' => false,
            'created_at'         => Carbon::now(),
            'updated_at'         => Carbon::now()
        ]);

        DB::table('group')->insert([
            'name'               => "Aluno",
            'able_to_create_tcc' => false,
            'able_to_read_tcc'   => true,
            'able_to_update_tcc' => false,
            'able_to_delete_tcc' => false,
            'created_at'         => Carbon::now(),
            'updated_at'         => Carbon::now()
        ]);

        DB::table('group')->insert([
            'name'               => "Professor",
            'able_to_create_tcc' => false,
            'able_to_read_tcc'   => true,
            'able_to_update_tcc' => false,
            'able_to_delete_tcc' => false,
            'created_at'         => Carbon::now(),
            'updated_at'         => Carbon::now()
        ]);
    }
}
