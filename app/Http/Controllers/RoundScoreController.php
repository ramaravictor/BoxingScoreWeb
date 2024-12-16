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
        // Validasi input
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'scores.*.damage_red' => 'required|integer|min:0|max:10',
            'scores.*.damage_blue' => 'required|integer|min:0|max:10',
            'scores.*.knock_red' => 'required|integer|min:0|max:10',
            'scores.*.knock_blue' => 'required|integer|min:0|max:10',
            'scores.*.penalty_red' => 'required|integer|min:0|max:10',
            'scores.*.penalty_blue' => 'required|integer|min:0|max:10',
            'scores.*.total_red' => 'required|numeric',
            'scores.*.total_blue' => 'required|numeric',
        ]);

        // Simpan setiap skor ke database
        foreach ($request->scores as $round => $score) {
            RoundScore::create([
                'room_id' => $request->room_id,
                'user_id' => Auth::id(), // Tambahkan user_id dari juri yang sedang login
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

        return redirect()->back()->with('success', 'Scores saved successfully!');
    }

    public function showRoundScores($room_id)
    {
        $room = Room::findOrFail($room_id); // Ambil room berdasarkan ID
        $roundScores = RoundScore::where('room_id', $room_id)
            ->with('user')
            ->get();

        $judges = User::whereIn('id', $roundScores->pluck('user_id'))->get();

        return view('calculatescore', [
            'room' => $room,           // Kirim data room ke view
            'roundScores' => $roundScores,
            'judges' => $judges,
            'room_id' => $room_id,
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
