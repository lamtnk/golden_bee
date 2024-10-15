<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'content',
        'choice',
        'result',
        'activate'
    ];

    protected $casts = [
        'choice' => 'array', // Chuyển đổi 'choice' thành mảng
    ];

    public function type($type) {
        switch($type) {
            case 0:
                return "Text";
            case 1:
                return "Image";
            case 2:
                return "Audio";
            case 3:
                return "Video";
            default:
                return "Text";
        }
    }

    public function questionQueues()
    {
        return $this->hasMany(QuestionQueue::class, 'question_id');
    }
}
