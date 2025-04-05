<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'phone', 'role', 'password'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Détermine si l'utilisateur peut accéder à Filament.
     */
    public function canAccessFilament(): bool
    {
        return $this->role === 'Loueur';
    }

    // Relations
    public function biens()
    {
        return $this->hasMany(Bien::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function demandesRecues()
    {
        return $this->hasMany(DemandeReservation::class, 'owner_id');
    }

    public function demandesEnvoyees()
    {
        return $this->hasMany(DemandeReservation::class, 'user_id');
    }
}
