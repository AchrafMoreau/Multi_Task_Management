<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Destination;
use App\Models\Scopes\UserScope;
use App\Models\User;
use App\Models\Expediteur;

class Courrire extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'reception_jour', 
        'object', 
        'expediteur_id', 
        'destination_id',
        'observation', 
        'user_id', 
        'document', 
        'reception_heure'
    ];

    protected static function booted(){
        static::addGlobalScope(new UserScope);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function Destination(){
        return $this->belongsTo(Destination::class);
    }

    public function Expediteur(){
        return $this->belongsTo(Expediteur::class);
    }
}
