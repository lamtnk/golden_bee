<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('questions')->insert([
            [
                'name' => 'What is the capital of France?',
                'type' => 0,
                'content' => 'What is the capital of France?',
                'result' => 'Paris',
                'activate' => true,
            ],
            [
                'name' => 'Identify this sound',
                'type' => 1,
                'content' => 'https://example.com/audio/question1.mp3',
                'result' => 'Dog barking',
                'activate' => true,
            ],
            [
                'name' => 'What is shown in this image?',
                'type' => 2,
                'content' => 'https://example.com/images/question1.jpg',
                'result' => 'Eiffel Tower',
                'activate' => true,
            ],
            [
                'name' => 'Watch this video and answer',
                'type' => 3,
                'content' => 'https://example.com/videos/question1.mp4',
                'result' => 'Cat playing piano',
                'activate' => true,
            ],
            [
                'name' => 'What is the largest planet in our solar system?',
                'type' => 0,
                'content' => 'What is the largest planet in our solar system?',
                'result' => 'Jupiter',
                'activate' => true,
            ],
            [
                'name' => 'Identify this musical instrument',
                'type' => 1,
                'content' => 'https://example.com/audio/question2.mp3',
                'result' => 'Piano',
                'activate' => false,
            ],
            [
                'name' => 'What animal is in this picture?',
                'type' => 2,
                'content' => 'https://example.com/images/question2.jpg',
                'result' => 'Elephant',
                'activate' => true,
            ],
            [
                'name' => 'Describe the action in this video',
                'type' => 3,
                'content' => 'https://example.com/videos/question2.mp4',
                'result' => 'Person riding a bicycle',
                'activate' => false,
            ],
            [
                'name' => 'What is the chemical symbol for water?',
                'type' => 0,
                'content' => 'What is the chemical symbol for water?',
                'result' => 'H2O',
                'activate' => true,
            ],
            [
                'name' => 'Identify this bird sound',
                'type' => 1,
                'content' => 'https://example.com/audio/question3.mp3',
                'result' => 'Sparrow',
                'activate' => true,
            ],
        ]);
    }
}
