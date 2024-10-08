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
        'result',
        'activate'
    ];

    public function questionQueues()
    {
        return $this->hasMany(QuestionQueue::class, 'question_id');
    }
}
