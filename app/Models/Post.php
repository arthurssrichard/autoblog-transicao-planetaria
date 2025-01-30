<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory;

    protected $casts = [
        'tags' => 'array',
        'published_at' => 'datetime',
    ];

    protected $guarded = [];

    public function getReadingTime(){
        $words = str_word_count($this->body);
        $minutes = round($words / 250);
        return ($minutes < 1) ? 1 : $minutes;
    }
    
    /// Retorna a parte do corpo do post
    public function getExcerpt($words){
        return strip_tags(Str::limit(html_entity_decode($this->body), $words));
    }
    

    /* Retorna a categoria do post */
    public function category(){
        return $this->belongsTo('App\Models\Category');
    }


    /* Retorna o caminho da imagem do post */
    public function getImagePathAttribute(){
        return  (str_starts_with($this->image, 'https://') ? $this->image : asset('storage/'.$this->image));
    }

    /* ImageIsLocal
        Diz se a imagem é armazenada localmente ou está num ambiente externo (pexels)
        @return boolean
    */
    public function imageIsLocal(){
        return str_starts_with($this->image, 'uploads/images');
    }


    public function scopeCategorySlug($query, $slug){
        return $query->whereHas('category', function ($q) use ($slug){
            $q->where('slug',$slug);
        });
    }


    public function scopePublished($query){
        $query->where('published_at','<=',Carbon::now());
    }

    
    public function getCategoryTextColorAttribute()
    {
        $backgroundColor = $this->category->color ?? '#ffffff'; // Define um padrão caso não haja cor definida

        return $this->isColorLight($backgroundColor) ? '#131313' : '#f5f5f5';
    }

    /**
     * Função para verificar se uma cor é clara ou escura, para determinar num texto e haver
     * contraste com o seu fundo
     */
    private function isColorLight($hexColor)
    {
        // Remove o "#" se existir
        $hexColor = ltrim($hexColor, '#');

        // Converte para RGB
        $r = hexdec(substr($hexColor, 0, 2));
        $g = hexdec(substr($hexColor, 2, 2));
        $b = hexdec(substr($hexColor, 4, 2));

        // Calcula o brilho relativo (percepção visual da cor)
        $luminance = ($r * 0.299 + $g * 0.587 + $b * 0.114) / 255;

        // Define um limite para considerar claro ou escuro (0.5 é um valor comum para esse tipo de cálculo)
        return $luminance > 0.5;
    }

}
