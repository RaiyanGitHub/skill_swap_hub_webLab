<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Skill;
use App\Models\Rating;
use App\Models\Notification;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;
    protected $fillable = ['name', 'email', 'password'];

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
    public function skills()
    {
        return $this->hasMany(Skill::class);
    }
    public function ratingsReceived()
    {
    return $this->hasMany(Rating::class, 'to_user_id');
    }

    public function ratingsGiven()
    {
    return $this->hasMany(Rating::class, 'from_user_id');
    }

}
