<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Room extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'image',        // Path gambar room (nullable)
        'name',         // Nama room
        'class',        // Kategori atau kelas room
        'schedule',     // Jadwal pertandingan (tanggal, bulan, tahun, jam, hari)
        'location',     // Lokasi pertandingan
        'availability', // Status ketersediaan room

    ];

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
}
