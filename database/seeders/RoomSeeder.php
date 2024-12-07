<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room::insert([
            [
                'name' => 'Pacquiao vs Mayweather',
                'class' => '65 kg',
                'schedule' => '2024-12-10 14:00:00',
                'location' => 'Jakarta, Indonesia',
                'availability' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'name' => 'Tyson vs Jake Paul',
                'class' => '75 kg',
                'schedule' => '2024-12-15 10:00:00',
                'location' => 'New York, USA',
                'availability' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
