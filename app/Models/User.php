<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Http\Traits\LastLogin;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, LastLogin;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'last_login',
        'roles',
        'password'
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
        'last_login' => 'datetime',
    ];


    public function userLastLog(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->last_login ? $this->last_login->diffForHumans() :  $this->is_online,
        );
    }

    public function scopeTeacher()
    {
        return $this->where('roles', 'teacher');
    }
    public function scopeOperator()
    {
        return $this->where('roles', 'operator');
    }
    public function scopeStudents()
    {
        return $this->where('roles', 'students');
    }
    public function scopeNotOperator()
    {
        return $this->where('roles', '!=', 'operator');
    }
    public function scopeOnline()
    {
        return $this->where('roles', '!=', 'operator')->where('is_online', 1);
    }
    public function scopeOffline()
    {
        return $this->where('roles', '!=', 'operator')->where('is_online', 0);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Courses::class, 'id', 'user_id');
    }
}
