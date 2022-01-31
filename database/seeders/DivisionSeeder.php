<?php

namespace Database\Seeders;

use App\Models\Division;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //crear solo divisiones
        Division::factory(3)->create();
        //crear crear divisiones con subdivisiones
       Division::factory(50)->children()->create();
    }
}
