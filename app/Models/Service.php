<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'services';
    protected $fillable = ['titre', 'description', 'categorie', 'prix', 'disponibilite', 'tags', 'user_id', 'publie'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
