<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoundScore extends Model
{
    protected $fillable = [
        'room_id',
        'user_id',
        'round_number',
        'damage_red',
        'knock_red',
        'penalty_red',
        'total_red',
        'damage_blue',
        'knock_blue',
        'penalty_blue',
        'total_blue',
    ];

    /**
     * Relasi ke Room.
     * Setiap RoundScore dimiliki oleh satu Room.
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Relasi ke Judge.
     * Setiap RoundScore dimiliki oleh satu Judge.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
