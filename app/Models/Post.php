<?php

namespace App\Models;

use App\Models\Comentario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [ //informacion que se va a llenar en la base de datos para que laravel sepa que informacion es la que se va a procesar
        'titulo',
        'descripcion',
        'imagen',
        'user_id'

    ];

    public function user()
    {
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //revisar si un usuario ya le dio like una publicacion

    public function checkLike(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }
}
