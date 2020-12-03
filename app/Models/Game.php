<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = ['user_id', 'total_count', 'questions_count', 'status'];


    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function questions(){
        return $this->belongsToMany('App\Models\Question');
    }
}
