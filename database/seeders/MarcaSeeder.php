<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('marca')->insert([
            [
                'id' => 1,
                'nome' => 'Electrolux',
                'codigo' => 'electrolux',
                'status' => 1,
            ],
            [
                'id' => 2,
                'nome' => 'Brastemp',
                'codigo' => 'brastemp',
                'status' => 1,
            ],
            [
                'id' => 3,
                'nome' => 'Fischer',
                'codigo' => 'fischer',
                'status' => 1,
            ],
            [
                'id' => 4,
                'nome' => 'Samsung',
                'codigo' => 'samsung',
                'status' => 1,
            ],
            [
                'id' => 5,
                'nome' => 'LG',
                'codigo' => 'lg',
                'status' => 1,
            ]
        ]);
    }

    public function down(): void
    {
        DB::table('marca')->where('id', '>', 0)->delete();
    }
}
