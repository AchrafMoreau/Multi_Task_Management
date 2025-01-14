<?php

namespace App\Models;

use App\Models\Courrire;
use App\Models\Mail;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expediteur extends Model
{
    //
    use HasFactory;

    protected $fillable = ['nom','adresse','ville_id','phone','email','zip', 'user_id'];

    protected static function booted(){
        static::addGlobalScope(new UserScope);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function Courrires(){
        return $this->hasMany(Courrire::class);
    }


    public function Mails(){
        return $this->hasMany(Mail::class);
    }

    public function ville(){
        return $this->belongsTo(Ville::class);
    }
}
