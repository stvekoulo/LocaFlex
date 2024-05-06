<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    use HasFactory;
    protected $table = 'biens';
    protected $fillable = ['titre', 'description', 'categorie', 'caracteristiques', 'prix', 'emplacement', 'disponibilite', 'tags', 'user_id', 'publie'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
