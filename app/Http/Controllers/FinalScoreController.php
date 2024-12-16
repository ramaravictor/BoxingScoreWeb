<?php

namespace App\Http\Controllers;

use App\Models\FinalScore;
use App\Models\Room;
use Illuminate\Http\Request;

class FinalScoreController extends Controller
{
    public function index()
    {
        return view('history.index');
    }

    public function show($room_id)
    {
        // Ambil data room berdasarkan ID
        $room = Room::findOrFail($room_id);

        // Ambil data finalscore berdasarkan room_id
        $finalScore = FinalScore::where('room_id', $room_id)->firstOrFail();

        // Kirim data ke view finalscore.blade.php
        return view('history.showscore', [
            'room' => $room,
            'finalScore' => $finalScore,
        ]);
    }

    public function store(Request $request)
    {
        // Validasi Input
        $request->validate([
            'round' => 'required|integer|min:1',
            'winner' => 'required|string|in:red,blue',
            'method' => 'required|string|in:ko_tko,decision_point,disqualified',
            'score_ave_red' => 'required|numeric',
            'score_ave_blue' => 'required|numeric',
        ]);

        // Simpan ke Database
        FinalScore::create([
            'room_id' => $request->input('room_id'),
            'round' => $request->input('round'),
            'winner' => $request->input('winner'),
            'method' => $request->input('method'),
            'score_ave_red' => $request->input('score_ave_red'),
            'score_ave_blue' => $request->input('score_ave_blue'),
        ]);

        // Redirect dengan Pesan Sukses
        return redirect()->back()->with('success', 'Final Decision submitted successfully!');
    }

    public function edit($id)
    {
        // Cari FinalScore berdasarkan ID
        $finalScore = FinalScore::findOrFail($id);

        // Kirim data ke view
        return view('history.editscore', compact('finalScore'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'round' => 'required|integer|min:1',
            'winner' => 'required|in:red,blue',
            'method' => 'required|string|max:255',
        ]);

        // Update FinalScore
        $finalScore = FinalScore::findOrFail($id);
        $finalScore->update([
            'round' => $request->round,
            'winner' => $request->winner,
            'method' => $request->method,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('history.index')->with('success', 'Final score updated successfully.');
    }
}
