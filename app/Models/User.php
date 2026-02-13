<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'avatar',
        'is_admin',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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
            'is_admin' => 'boolean',
        ];
    }

    // Helper methods untuk role
    public function isAdministrator(): bool
    {
        return $this->role === 'administrator';
    }

    public function isKartar(): bool
    {
        return $this->role === 'kartar';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    public function canAccessAdmin(): bool
    {
        return in_array($this->role, ['administrator', 'kartar']);
    }

    public function hasRole(string|array $roles): bool
    {
        if (is_array($roles)) {
            return in_array($this->role, $roles);
        }
        return $this->role === $roles;
    }

    // Get role label untuk tampilan
    public function getRoleLabelAttribute(): string
    {
        return match($this->role) {
            'administrator' => 'Administrator',
            'kartar' => 'Karang Taruna',
            'user' => 'User',
            default => 'Unknown',
        };
    }

    // Get role badge color
    public function getRoleBadgeAttribute(): string
    {
        return match($this->role) {
            'administrator' => 'danger',
            'kartar' => 'primary',
            'user' => 'secondary',
            default => 'secondary',
        };
    }
}
