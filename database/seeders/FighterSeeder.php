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
                'birthdate' => '1966-06-30',
                'weight_class' => 'Heavyweight',
                'champions' => 'World heavyweight champion, Youngest heavyweight champion, Lineal champion, Notable victories',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Muhammad Ali',
                'birthdate' => '1942-01-17',
                'weight_class' => 'Heavyweight',
                'champions' => 'Ring magazine heavyweight title from 1964–1970, Undisputed champion from 1974–1978, WBA and Ring heavyweight champion from 1978–1979, World heavyweight champion for the third time on September 15, 1978',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Manny Pacquiao',
                'birthdate' => '1978-12-17',
                'weight_class' => 'Welterweight',
                'champions' => 'The only octuple champion',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Floyd Mayweather',
                'birthdate' => '1977-02-24',
                'weight_class' => 'Welterweight',
                'champions' => 'Fifteen world titles and the lineal championship in four different weight classes, bronze medal in the featherweight division at the 1996 Olympics, U.S. Golden Gloves titles (at light flyweight, flyweight, and featherweight)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
