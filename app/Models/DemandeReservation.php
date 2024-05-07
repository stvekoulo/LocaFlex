<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeReservation extends Model
{
    use HasFactory;
    protected $table = 'demande_reservations';
    protected $fillable = ['bien_id', 'duree', 'motif', 'user_id', 'owner_id', 'etat'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bien()
    {
        return $this->belongsTo(Bien::class);
    }
}
