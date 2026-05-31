<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
protected $fillable = [
    'id',
    'name',
    'location',
    'price',
    'maxPlayer',
    'minPlayer',
    'openTime',
    'closeTime',
    'owner_id',
    'created_at',
    'updated_at'
];
// relationship many stadium may be belong to one owner
    public function owner() {
        return $this->belongsTo(User::class,'owner_id');
    }
    public function bookings() {
        return $this -> hasMany(Booking::class,'stadium_id');
    }
}
