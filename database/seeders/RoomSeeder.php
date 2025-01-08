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
            'birthdate' => '1978-12-17',
            'weight_class' => 'middleweight',
            'champions' => 'The only octuple champion; Philipinnes All Time Champ',
        ]);

        $blueCornerFighter = Fighter::firstOrCreate([
            'name' => 'Floyd Mayweather',
            'birthdate' => '1977-02-24',
            'weight_class' => 'middleweight',
            'champions' => 'Fifteen world titles and the lineal championship in four different weight classes; Bronze medal in the featherweight division at the 1996 Olympics; U.S. Golden Gloves titles (at light flyweight, flyweight, and featherweight)',

        ]);

        // Insert Rooms
        Room::insert([
            [
                'name' => 'Pacquiao vs Mayweather',
                'weight_class' => 'middleweight',
                'schedule' => '2024-12-10 14:00:00',
                'availability' => true,
                'red_corner_id' => $redCornerFighter->id,
                'blue_corner_id' => $blueCornerFighter->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tyson vs Jake Paul',
                'wight_class' => 'heavyweight',
                'schedule' => '2025-03-07 14:00:00',
                'availability' => true,
                'red_corner_id' => Fighter::firstOrCreate([
                    'name' => 'Mike Tyson',
                    'birthdate' => '1966-06-30',
                    'weight_class' => 'heavyweight',
                    'champions' => 'World heavyweight champion; Youngest heavyweight champion; Lineal champion; Notable victories',

                ])->id,
                'blue_corner_id' => Fighter::firstOrCreate([
                    'name' => 'Jake Paul',
                    'weight_class' => 'heavyweight',
                    'birthdate' => '1997-01-17',
                    'champions' => 'As a pro, he has gone 10-1 with seven knockouts against opponents that include a YouTuber, a retired NBA player and four MMA fighters',
                ])->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
