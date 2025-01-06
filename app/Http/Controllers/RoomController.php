<?php

namespace App\Http\Controllers;

use App\Models\FinalScore;
use App\Models\Room;
use App\Models\RoundScore;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function show($id)
    {
        $room = Room::findOrFail($id);
        $room->formatted_schedule = Carbon::parse($room->schedule)
            ->timezone('Asia/Jakarta') // Menyesuaikan zona waktu WIB
            ->translatedFormat('D, M j / g:i A').' WIB';

        $userId = Auth::id(); // ID juri yang sedang login

        // Ambil skor berdasarkan room_id dan user_id
        $roundScores = RoundScore::where('room_id', $id)
            ->where('user_id', $userId)
            ->get()
            ->keyBy('round_number'); // KeyBy agar skor berdasarkan nomor ronde

        // Siapkan skor default untuk ditampilkan
        $defaultScores = [];
        for ($round = 1; $round <= 5; $round++) {
            $defaultScores[$round] = [
                'damage_red' => $roundScores[$round]->damage_red ?? 0,
                'damage_blue' => $roundScores[$round]->damage_blue ?? 0,
                'knock_red' => $roundScores[$round]->knock_red ?? 0,
                'knock_blue' => $roundScores[$round]->knock_blue ?? 0,
                'penalty_red' => $roundScores[$round]->penalty_red ?? 0,
                'penalty_blue' => $roundScores[$round]->penalty_blue ?? 0,
                'total_red' => $roundScores[$round]->total_red ?? 0,
                'total_blue' => $roundScores[$round]->total_blue ?? 0,
            ];
        }

        $finalScoreExists = FinalScore::where('room_id', $id)->exists(); // Cek apakah final score ada

        return view('rooms', [
            'room' => $room,
            'finalScoreExists' => $finalScoreExists,
            'roundScores' => $defaultScores, // Skor yang dikirim ke form di Blade
        ]);
    }
}
