<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'startGame',
        'endGame',
        'date',
        'stadium_id',
        'player_id',
        'created_at',
        'updated_at',
        'status'
    ];
    public function player()
    {
        return $this->belongsTo(User::class, 'player_id');
    }
    public function stadium() {
        return $this->belongsTo(Stadium::class,'stadium_id');
    }
}
