<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Setting;
use App\Models\Car;
use App\Models\Driver;
use App\Models\Mission;
use App\Models\Expediteur;
use App\Models\Destination;
use App\Models\Courrire;
use App\Models\Mail;
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
     * @var array<int, string>
     */
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

    public function setting(){
        return $this->hasOne(Setting::class);
    }

    public function mails(){
        return $this->hasMany(Mail::class);
    }

    public function car(){
        return $this->hasMany(Car::class);
    }

    public function driver(){
        return $this->hasMany(Driver::class);
    }

    public function mission(){
        return $this->hasMany(Mission::class);
    }

    public function expediteurs(){
        return $this->hasMany(Expediteur::class);
    }

    public function destinations(){
        return $this->hasMany(Destination::class);
    }

    public function courrires(){
        return $this->hasMany(Courrire::class);
    }



}
