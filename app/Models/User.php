<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Egulias\EmailValidator\Result\Reason\UnclosedComment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        'surname',
        'email',
        'password',
        'biography',
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

    public function academy()
    {
        return $this->belongsTo(Academy::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function setAvatar()
    {
        $imagePath = ($this->profile_picture) ? "/storage/{$this->profile_picture}" : asset('images/default_avatar.png');

        return $imagePath;
    }
}
