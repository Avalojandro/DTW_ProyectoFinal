<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'genre',
        'year',
        'rating',
        'description',
        'status',
        'image_path'
    ];

    public static function genres()
    {
        return [
            'Acción', 'Aventura', 'Animación', 'Bélica', 'Ciencia ficción',
            'Comedia', 'Crimen', 'Documental', 'Drama', 'Fantasía',
            'Histórica', 'Horror', 'Musical', 'Misterio', 'Romance',
            'Suspenso', 'Terror', 'Thriller', 'Western', 'Familiar',
            'Deportes', 'Biografía', 'Guerra', 'Policial', 'Psicológico',
            'Paranormal', 'Cyberpunk', 'Steampunk', 'Superhéroes', 'Zombies'
        ];
    }
}
