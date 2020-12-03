<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = ['body', 'level'];


    public function answers(){
        return $this->hasMany('App\Models\Answer','question_id','id');
    }

    public function games(){
        return $this->belongsToMany('App\Models\Game',);
    }
}
