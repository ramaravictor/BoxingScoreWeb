<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoundScore;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoundScoreController extends Controller
{
    public function store(Request $request)
    {
        foreach ($request->scores as $round => $score) {
            $existingScore = RoundScore::where('room_id', $request->room_id)
                ->where('user_id', Auth::id())
                ->where('round_number', $round)
                ->first();

            if ($existingScore) {
                // Update data jika sudah ada
                $existingScore->update([
                    'damage_red' => $score['damage_red'],
                    'damage_blue' => $score['damage_blue'],
                    'knock_red' => $score['knock_red'],
                    'knock_blue' => $score['knock_blue'],
                    'penalty_red' => $score['penalty_red'],
                    'penalty_blue' => $score['penalty_blue'],
                    'total_red' => $score['total_red'],
                    'total_blue' => $score['total_blue'],
                ]);
            } else {
                // Buat data baru jika belum ada
                RoundScore::create([
                    'room_id' => $request->room_id,
                    'user_id' => Auth::id(),
                    'round_number' => $round,
                    'damage_red' => $score['damage_red'],
                    'damage_blue' => $score['damage_blue'],
                    'knock_red' => $score['knock_red'],
                    'knock_blue' => $score['knock_blue'],
                    'penalty_red' => $score['penalty_red'],
                    'penalty_blue' => $score['penalty_blue'],
                    'total_red' => $score['total_red'],
                    'total_blue' => $score['total_blue'],
                ]);
            }
        }

        return redirect()->back()->with('success', 'Scores saved successfully!');
    }

    public function showRoundScores($room_id)
    {
        $room = Room::findOrFail($room_id);
        $userId = Auth::id(); // Ambil ID juri yang login

        // Ambil data round scores sesuai room_id dan user_id
        $roundScores = RoundScore::where('room_id', $room_id)
            ->where('user_id', $userId)
            ->get()
            ->keyBy('round_number'); // Kelompokkan berdasarkan round_number

        // Siapkan skor default jika data tidak ditemukan
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

        return view('calculatescore', [
            'room' => $room,
            'roundScores' => $defaultScores, // Kirim skor ke view
        ]);
    }

    public function calculateAverage($room_id)
    {
        $room = Room::findOrFail($room_id); // Ambil data room
        $roundScores = RoundScore::where('room_id', $room_id)->get();

        // Ambil total skor Red dan Blue dari masing-masing juri
        $totalRed = $roundScores->groupBy('user_id')->sum(fn ($scores) => $scores->sum('total_red'));
        $totalBlue = $roundScores->groupBy('user_id')->sum(fn ($scores) => $scores->sum('total_blue'));

        // Jumlah juri
        $judgeCount = $roundScores->groupBy('user_id')->count();

        // Rata-rata skor
        $averageRed = $judgeCount > 0 ? $totalRed / $judgeCount : 0;
        $averageBlue = $judgeCount > 0 ? $totalBlue / $judgeCount : 0;

        // Total Damage, Knock Down, Penalty
        $totalDamage = [
            'red' => $roundScores->sum('damage_red'),
            'blue' => $roundScores->sum('damage_blue'),
        ];

        $totalKnockDown = [
            'red' => $roundScores->sum('knock_red'),
            'blue' => $roundScores->sum('knock_blue'),
        ];

        $totalPenalty = [
            'red' => $roundScores->sum('penalty_red'),
            'blue' => $roundScores->sum('penalty_blue'),
        ];

        return view('calculatescore', [
            'room' => $room,
            'roundScores' => $roundScores,
            'judges' => User::whereIn('id', $roundScores->pluck('user_id')->unique())->get(),
            'averageRed' => number_format($averageRed, 2),
            'averageBlue' => number_format($averageBlue, 2),
            'totalDamage' => $totalDamage,
            'totalKnockDown' => $totalKnockDown,
            'totalPenalty' => $totalPenalty,
        ]);
    }
}
