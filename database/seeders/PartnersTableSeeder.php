<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('partners')->insert([
            [
                'name' => 'Partner One',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Partner Two',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Partner Three',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Partner Four',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Partner Five',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Partner Six',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Partner Seven',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Partner Eight',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Partner Nine',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Partner Ten',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}


