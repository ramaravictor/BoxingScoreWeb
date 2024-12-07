<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FighterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fighters')->insert([
            [
                'name' => 'Mike Tyson',
                'description' => 'One of the greatest heavyweights of all time.',
                // 'available' => true,

                'weight_class' => 'Heavyweight',
                'birthdate' => '1966-06-30',
                'wins' => 50,
                'losses' => 6,
                'draws' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Muhammad Ali',
                'description' => 'The greatest boxer in history.',

                'weight_class' => 'Heavyweight',
                'birthdate' => '1942-01-17',
                'wins' => 56,
                'losses' => 5,
                'draws' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Manny Pacquiao',
                'description' => 'A world champion in multiple weight classes.',

                'weight_class' => 'Welterweight',
                'birthdate' => '1978-12-17',
                'wins' => 62,
                'losses' => 7,
                'draws' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Floyd Mayweather',
                'description' => 'Known for his undefeated record.',

                'weight_class' => 'Welterweight',
                'birthdate' => '1977-02-24',
                'wins' => 50,
                'losses' => 0,
                'draws' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Canelo Alvarez',
                'description' => 'One of the most versatile fighters today.',
                'weight_class' => 'Middleweight',
                'birthdate' => '1990-07-18',
                'wins' => 58,
                'losses' => 2,
                'draws' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
