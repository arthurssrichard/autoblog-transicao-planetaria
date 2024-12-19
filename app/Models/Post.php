<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function getReadingTime(){
        $words = str_word_count($this->body);
        $minutes = round($words/250);
        return ($minutes < 1) ? 1 : $minutes;
    }
    public function getExcerpt($words){
        return Str::limit($this->body,$words);
    }
}
