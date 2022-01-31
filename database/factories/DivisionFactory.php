<?php

namespace Database\Factories;

use App\Models\Division;
use Illuminate\Database\Eloquent\Factories\Factory;

class DivisionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           'name'=>substr($this->faker->company(), 0, 40)  ,
           'ambassador'=>$this->faker->name() .' '. $this->faker->lastName(),
           'collaborators'=>$this->faker->numberBetween(1, 250),
           'level'=>$this->faker->numberBetween(1, 20),

        ];
    }

    public function children()
    {
        return $this->state(function (array $attributes) {
            return [
            'parent_division_id'=>$this->faker->numberBetween(1, 3)
        ];
        });
    }
}
