<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            'name' => "Maik",
            'email' => 'maik.proba@gmail.com',
            'password' => Hash::make('password'),
        ]);

        // Testdaten für Schiff
        DB::table('ships')->insert([
            'name' => 'RMS Titanic',
            'description' => 'Auf ihrer Jungfernfahrt kollidierte die Titanic am 14. April 1912 gegen 23:40 Uhr',
            'shiptype' => 'Passagierdampfer',
            'width' => 28.19,
            'length' => 269.04,
            'crew' => 897,
            'brt' => 46.329
        ]);

        DB::table('ships')->insert([
            'name' => 'Queen Elizabeth II',
            'description' => 'Kiellegung erfolgte am 5. Juli 1965, der Stapellauf am 20. September 1967',
            'shiptype' => 'Passagierschiff',
            'width' => 32.03,
            'length' => 293.5,
            'crew' => 1015,
            'brt' => 70.327
        ]);
    }
}
