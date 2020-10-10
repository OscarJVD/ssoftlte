<?php

use Illuminate\Database\Seeder;
use App\Models\TypeStatus;

class TypeStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeStatus = array(
            ['name' => 'General'],
            ['name' => 'Usuario'],
            ['name' => 'Peliculas']
        );

        foreach ($typeStatus as $value) {
            $typeStatus = new TypeStatus;
            $typeStatus->name = $value['name'];
            $typeStatus->save();
        }
    }
}
