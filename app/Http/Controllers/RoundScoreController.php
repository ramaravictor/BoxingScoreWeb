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
                    'red_point' => $score['red_point'] ?? 0,
                    'blue_point' => $score['blue_point'] ?? 0,
                    'red_kd' => $score['red_kd'] ?? 0,
                    'blue_kd' => $score['blue_kd'] ?? 0,
                    'red_damage' => $score['red_damage'] ?? 0,
                    'blue_damage' => $score['blue_damage'] ?? 0,
                    'red_foul' => $score['red_foul'] ?? 0,
                    'blue_foul' => $score['blue_foul'] ?? 0,
                    'red_score' => $score['red_score'] ?? 0, // Pastikan field ini ditangkap
                    'blue_score' => $score['blue_score'] ?? 0, // Pastikan field ini ditangkap
                ]);
            } else {
                // Buat data baru jika belum ada
                RoundScore::create([
                    'room_id' => $request->room_id,
                    'user_id' => Auth::id(),
                    'round_number' => $round,
                    'red_point' => $score['red_point'] ?? 0,
                    'blue_point' => $score['blue_point'] ?? 0,
                    'red_kd' => $score['red_kd'] ?? 0,
                    'blue_kd' => $score['blue_kd'] ?? 0,
                    'red_damage' => $score['red_damage'] ?? 0,
                    'blue_damage' => $score['blue_damage'] ?? 0,
                    'red_foul' => $score['red_foul'] ?? 0,
                    'blue_foul' => $score['blue_foul'] ?? 0,
                    'red_score' => $score['red_score'] ?? 0, // Ditambahkan di sini
                    'blue_score' => $score['blue_score'] ?? 0, // Ditambahkan di sini
                ]);
            }
        }

        return redirect()->back()->with('success', 'Scores saved successfully!');
    }

    public function calculateAverage($room_id)
    {
        $room = Room::findOrFail($room_id); // Ambil data room
        $roundScores = RoundScore::where('room_id', $room_id)->get();

        // Ambil daftar juri berdasarkan user_id yang unik di roundScores
        $judges = User::whereIn('id', $roundScores->pluck('user_id')->unique())->get();

        $totalScores = [];
        foreach ($judges as $judge) {
            $totalScores[$judge->id] = [
                'red' => $roundScores->where('user_id', $judge->id)->sum('red_score'),
                'blue' => $roundScores->where('user_id', $judge->id)->sum('blue_score'),
            ];
        }

        // Ambil total skor Red dan Blue dari masing-masing juri
        $totalRed = $roundScores->groupBy('user_id')->sum(fn ($scores) => $scores->sum('red_score'));
        $totalBlue = $roundScores->groupBy('user_id')->sum(fn ($scores) => $scores->sum('blue_score'));

        // Jumlah juri
        $judgeCount = $roundScores->groupBy('user_id')->count();

        // Rata-rata skor
        $averageRed = $judgeCount > 0 ? $totalRed / $judgeCount : 0;
        $averageBlue = $judgeCount > 0 ? $totalBlue / $judgeCount : 0;

        // Ambil nilai tertinggi untuk masing-masing parameter
        $maxDamage = [
            'red' => $roundScores->max('red_damage'),
            'blue' => $roundScores->max('blue_damage'),
        ];

        $maxKnockDown = [
            'red' => $roundScores->max('red_kd'),
            'blue' => $roundScores->max('blue_kd'),
        ];

        $maxFoul = [
            'red' => $roundScores->max('red_foul'),
            'blue' => $roundScores->max('blue_foul'),
        ];

        // Kirim data ke view
        return view('calculatescore', [
            'room' => $room,
            'roundScores' => $roundScores,
            'judges' => $judges,
            'totalScores' => $totalScores,
            'averageRed' => number_format($averageRed, 2),
            'averageBlue' => number_format($averageBlue, 2),
            'maxDamage' => $maxDamage,
            'maxKnockDown' => $maxKnockDown,
            'maxFoul' => $maxFoul,
        ]);
    }
}
