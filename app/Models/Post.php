<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;


    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    //relacion inversa(uno a uno)(belogs to)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

    //un post tiene muchos comentarios
    public function comentarios(): HasMany
    {
        return $this->hasMany(Comentario::class);
    }
}
