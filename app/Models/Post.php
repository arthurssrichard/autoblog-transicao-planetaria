<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $casts = [
        'tags' => 'array',
        'published_at' => 'datetime',
    ];

    protected $guarded = [];

    public function getReadingTime()
    {
        $words = str_word_count($this->body);
        $minutes = round($words / 250);
        return ($minutes < 1) ? 1 : $minutes;
    }
    
    public function getExcerpt($words)
    {
        return Str::limit($this->body, $words);
    }
    
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function getImagePathAttribute(){
        return  (str_starts_with($this->image, 'https://') ? $this->image : asset('storage/'.$this->image));
    }
    public function imageIsLocal(){
        return str_starts_with($this->image, 'uploads/images');
    }
}
