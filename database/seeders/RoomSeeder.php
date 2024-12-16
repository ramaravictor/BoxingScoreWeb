<?php

namespace Database\Seeders;

use App\Models\Fighter;
use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil dua fighter sebagai contoh
        $redCornerFighter = Fighter::firstOrCreate([
            'name' => 'Manny Pacquiao',
            'description' => 'A world champion in multiple weight classes.',
            'weight_class' => 'Welterweight',
            'birthdate' => '1978-12-17',
            'wins' => 62,
            'losses' => 7,
            'draws' => 2,
        ]);

        $blueCornerFighter = Fighter::firstOrCreate([
            'name' => 'Floyd Mayweather',
            'description' => 'Known for his undefeated record.',
            'weight_class' => 'Welterweight',
            'birthdate' => '1977-02-24',
            'wins' => 50,
            'losses' => 0,
            'draws' => 0,
        ]);

        // Insert Rooms
        Room::insert([
            [
                'name' => 'Pacquiao vs Mayweather',
                'class' => '65 kg',
                'schedule' => '2024-12-10 14:00:00',
                'location' => 'Jakarta, Indonesia',
                'availability' => true,
                'red_corner_id' => $redCornerFighter->id,
                'blue_corner_id' => $blueCornerFighter->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tyson vs Jake Paul',
                'class' => '75 kg',
                'schedule' => '2024-12-15 10:00:00',
                'location' => 'New York, USA',
                'availability' => true,
                'red_corner_id' => Fighter::firstOrCreate([
                    'name' => 'Mike Tyson',
                    'description' => 'One of the greatest heavyweights of all time.',
                    'weight_class' => 'Heavyweight',
                    'birthdate' => '1966-06-30',
                    'wins' => 50,
                    'losses' => 6,
                    'draws' => 0,
                ])->id,
                'blue_corner_id' => Fighter::firstOrCreate([
                    'name' => 'Jake Paul',
                    'description' => 'Upcoming boxing sensation.',
                    'weight_class' => 'Cruiserweight',
                    'birthdate' => '1997-01-17',
                    'wins' => 8,
                    'losses' => 1,
                    'draws' => 0,
                ])->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
