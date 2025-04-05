<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
     * Determine if the user can access the Filament panel.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role === 'Loueur';
    }

    /**
     * User's biens relationship
     */
    public function biens(): HasMany
    {
        return $this->hasMany(Bien::class);
    }

    /**
     * User's services relationship
     */
    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    /**
     * User's demande reservations relationship
     */
    public function demandeReservations(): HasMany
    {
        return $this->hasMany(DemandeReservation::class);
    }

    /**
     * User's demande services relationship
     */
    public function demandeServices(): HasMany
    {
        return $this->hasMany(DemandeService::class);
    }
}
