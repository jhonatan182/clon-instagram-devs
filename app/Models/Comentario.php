<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comentario extends Model
{
    use HasFactory;



    protected $fillable = [
        'user_id',
        'post_id',
        'comentario'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
