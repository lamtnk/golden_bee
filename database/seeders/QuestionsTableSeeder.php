<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        // Mảng dữ liệu câu hỏi
        $questions = [
            [
                'name' => 'What is the capital of France?',
                'type' => 0,
                'content' => 'What is the capital of France?',
                'choice' => [
                    'A' => 'Berlin',
                    'B' => 'Madrid',
                    'C' => 'Paris',
                    'D' => 'Rome',
                ],
                'result' => 'C',
                'activate' => true,
            ],
            [
                'name' => 'Identify this sound',
                'type' => 1,
                'content' => 'https://example.com/audio/question1.mp3',
                'choice' => [
                    'A' => 'Dog barking',
                    'B' => 'Cat meowing',
                    'C' => 'Bird chirping',
                    'D' => 'Cow mooing',
                ],
                'result' => 'A',
                'activate' => true,
            ],
            [
                'name' => 'What is shown in this image?',
                'type' => 2,
                'content' => 'https://example.com/images/question1.jpg',
                'choice' => [
                    'A' => 'Statue of Liberty',
                    'B' => 'Eiffel Tower',
                    'C' => 'Great Wall of China',
                    'D' => 'Sydney Opera House',
                ],
                'result' => 'B',
                'activate' => true,
            ],
            [
                'name' => 'Watch this video and answer',
                'type' => 3,
                'content' => 'https://example.com/videos/question1.mp4',
                'choice' => [
                    'A' => 'Dog playing piano',
                    'B' => 'Cat playing piano',
                    'C' => 'Elephant dancing',
                    'D' => 'Lion roaring',
                ],
                'result' => 'B',
                'activate' => true,
            ],
            [
                'name' => 'What is the largest planet in our solar system?',
                'type' => 0,
                'content' => 'What is the largest planet in our solar system?',
                'choice' => [
                    'A' => 'Earth',
                    'B' => 'Mars',
                    'C' => 'Jupiter',
                    'D' => 'Saturn',
                ],
                'result' => 'C',
                'activate' => true,
            ],
            [
                'name' => 'Identify this musical instrument',
                'type' => 1,
                'content' => 'https://example.com/audio/question2.mp3',
                'choice' => [
                    'A' => 'Guitar',
                    'B' => 'Piano',
                    'C' => 'Violin',
                    'D' => 'Drum',
                ],
                'result' => 'B',
                'activate' => false,
            ],
            [
                'name' => 'What animal is in this picture?',
                'type' => 2,
                'content' => 'https://example.com/images/question2.jpg',
                'choice' => [
                    'A' => 'Lion',
                    'B' => 'Elephant',
                    'C' => 'Tiger',
                    'D' => 'Giraffe',
                ],
                'result' => 'B',
                'activate' => true,
            ],
            [
                'name' => 'Describe the action in this video',
                'type' => 3,
                'content' => 'https://example.com/videos/question2.mp4',
                'choice' => [
                    'A' => 'Person riding a bicycle',
                    'B' => 'Person swimming',
                    'C' => 'Person running',
                    'D' => 'Person cooking',
                ],
                'result' => 'A',
                'activate' => false,
            ],
            [
                'name' => 'What is the chemical symbol for water?',
                'type' => 0,
                'content' => 'What is the chemical symbol for water?',
                'choice' => [
                    'A' => 'H2O',
                    'B' => 'O2',
                    'C' => 'CO2',
                    'D' => 'NaCl',
                ],
                'result' => 'A',
                'activate' => true,
            ],
            [
                'name' => 'Identify this bird sound',
                'type' => 1,
                'content' => 'https://example.com/audio/question3.mp3',
                'choice' => [
                    'A' => 'Sparrow',
                    'B' => 'Eagle',
                    'C' => 'Parrot',
                    'D' => 'Owl',
                ],
                'result' => 'A',
                'activate' => true,
            ],
        ];

        // Lặp qua từng câu hỏi và tạo mới trong cơ sở dữ liệu
        foreach ($questions as $question) {
            Question::create($question);
        }
    }
}
