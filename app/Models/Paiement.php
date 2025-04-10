<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;
    protected $table = 'paiements';
    protected $fillable = ['montant', 'user_id', 'bien_id', 'service_id', 'owner_id', 'etat', 'reference'];

    public function client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function proprietaire()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function bien()
    {
        return $this->belongsTo(Bien::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
