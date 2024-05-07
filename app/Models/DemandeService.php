<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeService extends Model
{
    use HasFactory;
    protected $table = 'demande_services';
    protected $fillable = ['service_id', 'duree', 'motif', 'user_id', 'owner_id', 'etat'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function services()
    {
        return $this->belongsTo(Service::class);
    }
}
