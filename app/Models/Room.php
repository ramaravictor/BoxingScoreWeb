<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Room extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'image',
        'name',
        'class',
        'schedule',
        'location',
        'availability',
        'red_corner_id',
        'blue_corner_id',
    ];

    public function redCorner()
    {
        return $this->belongsTo(Fighter::class, 'red_corner_id');
    }

    public function blueCorner()
    {
        return $this->belongsTo(Fighter::class, 'blue_corner_id');
    }

    //add model observer
    protected static function booted()
    {
        //add delete event
        static::deleting(function ($room) {
            // Hapus image jika ada
            if ($room->image && Storage::disk('public')->exists($room->image)) {
                Storage::disk('public')->delete($room->image);
            }
        });
    }

    public function roundScores(): HasMany
    {
        return $this->hasMany(RoundScore::class);
    }

    public function finalScore()
    {
        return $this->hasOne(FinalScore::class);
    }
}
