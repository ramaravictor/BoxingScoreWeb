<?php

namespace Database\Seeders;

use App\Models\RoundScore;
use Illuminate\Database\Seeder;

class RoundScoreSeeder extends Seeder
{
    public function run()
    {
        // Define room_id and user_ids (3 judges)
        $room_id = 1;
        $judges = [1, 2, 3]; // User IDs of the judges

        // Loop for 5 rounds
        for ($round = 1; $round <= 5; $round++) {
            foreach ($judges as $judge_id) {
                // Generate random scores for red and blue
                $damage_red = rand(8, 10);
                $damage_blue = rand(8, 10);
                $knock_red = rand(0, 1);
                $knock_blue = rand(0, 1);
                $penalty_red = rand(0, 1);
                $penalty_blue = rand(0, 1);

                // Calculate total scores
                $total_red = max(0, $damage_red - $knock_red - $penalty_red);
                $total_blue = max(0, $damage_blue - $knock_blue - $penalty_blue);

                // Insert data into the database
                RoundScore::create([
                    'user_id' => $judge_id,
                    'room_id' => $room_id,
                    'round_number' => $round,
                    'damage_red' => $damage_red,
                    'damage_blue' => $damage_blue,
                    'knock_red' => $knock_red,
                    'knock_blue' => $knock_blue,
                    'penalty_red' => $penalty_red,
                    'penalty_blue' => $penalty_blue,
                    'total_red' => $total_red,
                    'total_blue' => $total_blue,
                ]);
            }
        }
    }
}
