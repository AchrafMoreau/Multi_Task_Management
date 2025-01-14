<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mission extends Model
{
    use HasFactory;
    //
    protected $fillable= [
        'serial_number',
        'start_date',
        'end_date',
        "type",
        "agent",
        'car_id',
        'driver_id',
        "des_coll_terr",
        "dep_coll_terr",
        "avance",
        "reste",
        'destination_ville',
        'depart_ville',
        'permission',
        'user_id'
    ];

    protected static function booted(){
        static::addGlobalScope(new UserScope);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function desVille(){
        return $this->belongsTo(Ville::class, 'destination_ville');
    }

    public function depVille(){
        return $this->belongsTo(Ville::class, 'depart_ville');
    }

    public function driver(){
        return $this->belongsTo(Driver::class);
    }

    public function car(){
        return $this->belongsTo(Car::class);
    }
}
