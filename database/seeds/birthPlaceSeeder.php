<?php

use Illuminate\Database\Seeder;
use \App\BirthPlaces;

class birthPlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BirthPlaces::create([
            'place'=>'SP'
        ]);
        BirthPlaces::create([
            'place'=>'BA'
        ]);
    }
}
