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
                'red_point' => $roundScores[$round]->red_point ?? 0,
                'blue_point' => $roundScores[$round]->blue_point ?? 0,
                'red_kd' => $roundScores[$round]->red_kd ?? 0,
                'blue_kd' => $roundScores[$round]->blue_kd ?? 0,
                'red_damage' => $roundScores[$round]->red_damage ?? 0,
                'blue_damage' => $roundScores[$round]->blue_damage ?? 0,
                'red_foul' => $roundScores[$round]->red_foul ?? 0,
                'blue_foul' => $roundScores[$round]->blue_foul ?? 0,
                'red_score' => $roundScores[$round]->red_score ?? 0,
                'blue_score' => $roundScores[$round]->blue_score ?? 0,
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
