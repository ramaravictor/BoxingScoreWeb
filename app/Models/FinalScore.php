<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalScore extends Model
{
    use HasFactory;

    protected $table = 'finalscores'; // Nama tabel

    protected $fillable = [
        'room_id',
        'round',
        'winner',
        'method',
        'score_ave_red',
        'score_ave_blue',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
