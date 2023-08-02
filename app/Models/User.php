<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function connections()
    {
        // Assuming you have a connections relationship defined in the User model

        return $this->hasMany(Connection::class, 'user_id');
    }

    public function sentInvitations()
    {
        return $this->hasMany(Invitation::class, 'user_id');
    }

    public function receivedInvitations()
    {
        // Assuming you have a receivedInvitations relationship defined in the User model
        return $this->hasMany(Invitation::class, 'invited_user_id');
    }
}
