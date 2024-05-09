<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;
    protected $table = 'paiements';
    protected $fillable = ['montant', 'user_id', 'bien_id', 'service_id', 'owner_id', 'etat'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bien()
    {
        return $this->belongsTo(Bien::class);
    }

    public function services()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
