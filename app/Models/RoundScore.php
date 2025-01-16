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
        'red_point',
        'blue_point',
        'red_kd',
        'blue_kd',
        'red_damage',
        'blue_damage',
        'red_foul',
        'blue_foul',
        'red_score', // Ditambahkan di sini
        'blue_score', // Ditambahkan di sini
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
