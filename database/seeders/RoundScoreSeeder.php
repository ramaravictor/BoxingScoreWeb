<?php

namespace Database\Seeders;

use App\Models\RoundScore;
use Illuminate\Database\Seeder;

class RoundScoreSeeder extends Seeder
{
    public function run()
    {
        // Room ID dan user IDs (juri)
        $room_id = 1;
        $judges = [1, 2, 3]; // User IDs of the judges

        // Loop untuk 5 ronde
        for ($round = 1; $round <= 5; $round++) {
            foreach ($judges as $judge_id) {
                // Pastikan skor dihitung berdasarkan aturan penilaian
                $red_point = rand(7, 10); // Point harus 7-10
                $blue_point = rand(7, 10); // Point harus 7-10
                $red_kd = rand(0, 1); // Knock Down
                $blue_kd = rand(0, 1); // Knock Down
                $red_damage = rand(0, 3); // Damage
                $blue_damage = rand(0, 2); // Damage
                $red_foul = rand(0, 1); // Foul
                $blue_foul = rand(0, 1); // Foul

                // Hitung skor dengan batas maksimum 10
                $red_score = min(10, $red_point - $blue_damage - $red_foul);
                $blue_score = min(10, $blue_point - $red_damage - $blue_foul);

                // Jangan biarkan skor negatif
                $red_score = max(0, $red_score);
                $blue_score = max(0, $blue_score);

                // Masukkan ke database
                RoundScore::create([
                    'user_id' => $judge_id,
                    'room_id' => $room_id,
                    'round_number' => $round,
                    'red_point' => $red_point,
                    'blue_point' => $blue_point,
                    'red_kd' => $red_kd,
                    'blue_kd' => $blue_kd,
                    'red_damage' => $red_damage,
                    'blue_damage' => $blue_damage,
                    'red_foul' => $red_foul,
                    'blue_foul' => $blue_foul,
                    'red_score' => $red_score,
                    'blue_score' => $blue_score,
                ]);
            }
        }
    }
}
