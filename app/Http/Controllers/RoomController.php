<?php

namespace App\Http\Controllers;

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

        return view('rooms', compact('room'));
    }
}
