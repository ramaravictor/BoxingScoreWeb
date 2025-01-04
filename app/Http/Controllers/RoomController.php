<?php

namespace App\Http\Controllers;

use App\Models\FinalScore;
use App\Models\Room;
use Carbon\Carbon;

class RoomController extends Controller
{
    public function show($id)
    {
        $room = Room::findOrFail($id);
        $room->formatted_schedule = Carbon::parse($room->schedule)
            ->timezone('Asia/Jakarta') // Menyesuaikan zona waktu WIB
            ->translatedFormat('D, M j / g:i A').' WIB';

        // Cek apakah ada final score untuk room ini
        $finalScoreExists = FinalScore::where('room_id', $id)->exists();

        return view('rooms', compact('room', 'finalScoreExists'));
    }
}
