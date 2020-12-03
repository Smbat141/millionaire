<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    public $fillable = ['body', 'is_correct', 'question_id'];

    public $timestamps = false;


    public function question(){
        return $this->belongsTo('App\Models\Question');
    }
}
