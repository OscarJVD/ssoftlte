<?php

use Illuminate\Database\Seeder;

// COMPONENTE GENERADO DE DATOS ALEATORIOS
use Faker\Factory as Faker;

// PARA GENERAR NUEVOS USUARIOS
use App\Models\Movie;

class MoviesTableSeeder extends Seeder
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
            $movie = new Movie;
            $movie->name = $faker->jobTitle;
            $movie->description = $faker->realText();
            $movie->user_id = $faker->numberBetween($min = 1, $max = 10); // que raro
            $movie->status_id = 1;  
            $movie->save();
        }
    }
}
