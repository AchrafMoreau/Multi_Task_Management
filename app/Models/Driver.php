<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Driver extends Model
{
    //
    use HasFactory;

    protected $fillable = ['name', 'licenss', 'age', 'user_id'];

    protected static function booted(){
        static::addGlobalScope(new UserScope);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function mission(){
        return $this->hasMany(Mission::class);
    }
}
