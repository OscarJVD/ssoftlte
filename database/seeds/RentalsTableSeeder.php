<?php

use Illuminate\Database\Seeder;

// COMPONENTE GENERADO DE DATOS ALEATORIOS
use Faker\Factory as Faker;

// PARA GENERAR NUEVOS USUARIOS
use App\Models\Rental;

class RentalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=0; $i < 10; $i++) {
            $rental = new Rental;
            $rental->start_date = $faker->dateTime();
            $rental->end_date = $faker->dateTime();
            $rental->total = $faker->randomFloat();
            $rental->user_id = $faker->numberBetween($min = 1, $max = 10); // que raro
            $rental->status_id = 1;
            $rental->save();
        }
    }
}
