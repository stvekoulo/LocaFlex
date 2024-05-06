<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $table = 'photos';
    protected $fillable = ['chemin_fichier', 'description', 'bien_id'];

    public function biens()
    {
        return $this->belongsTo(Bien::class);
    }
}
