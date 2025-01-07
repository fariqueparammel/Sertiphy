<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Authenticatable // implements FilamentUser
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    const Role_Admin = "ADMIN";
    const Role_User = "USER";
    const Role_Editor = "Editor";
    const Role = [self::Role_Admin => 'Admin', self::Role_User => 'User', self::Role_Editor => 'Editor'];
    const Default_Role = self::Role_User;
    // public function canAccessPanel(Panel $panel): bool
    // {
    //     return $this->isAdmin() || $this->isEditor(); //custom method
    // }
    public function isAdmin()
    {
        return $this->role === self::Role_Admin;
    }
    public function isEditor()
    {
        return $this->role === self::Role_Editor;
    }
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
        ];
    }
    public function projects(): HasMany
    {
        return $this->hasMany(Projects::class);
    }
}
