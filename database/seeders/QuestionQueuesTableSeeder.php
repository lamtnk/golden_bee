<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionQueuesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('question_queues')->insert([
            [
                'question_id' => 1,
                'partner_id' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 2,
                'partner_id' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 3,
                'partner_id' => '3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 4,
                'partner_id' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 5,
                'partner_id' => '5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 6,
                'partner_id' => '6',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 7,
                'partner_id' => '7',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 8,
                'partner_id' => '8',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 9,
                'partner_id' => '9',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 10,
                'partner_id' => '10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('starts')->insert([
            'activate' =>false
        ]);
    }
}
