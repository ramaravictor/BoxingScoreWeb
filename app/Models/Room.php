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
        'name',
        'weight_class',
        'red_corner_id',
        'blue_corner_id',
        'schedule',
        'availability',
        'image',
    ];

    public function redCorner()
    {
        return $this->belongsTo(Fighter::class, 'red_corner_id');
    }

    public function blueCorner()
    {
        return $this->belongsTo(Fighter::class, 'blue_corner_id');
    }

    // Relasi untuk mengambil weight_class dari fighter
    public function allWeightClasses()
    {
        // Mengambil semua weight_class dari model Fighter
        return Fighter::pluck('weight_class')->unique()->toArray();
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
