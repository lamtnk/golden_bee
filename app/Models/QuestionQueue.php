<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionQueue extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'partner_id',
        'created_at',
        'updated_at'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id');
    }
}
