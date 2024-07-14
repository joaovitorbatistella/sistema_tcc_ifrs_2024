<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AppendType;

class AppendTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AppendType::create([
            "name" =>  "Document",
            "slug" =>  "document"
        ]);

        AppendType::create([
            "name" =>  "Image",
            "slug" =>  "image"
        ]);

        AppendType::create([
            "name" =>  "TCC",
            "slug" =>  "tcc"
        ]);
    }
}
