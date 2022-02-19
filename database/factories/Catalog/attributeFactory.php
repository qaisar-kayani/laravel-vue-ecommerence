<?php

namespace Database\Factories\catalog;

use Illuminate\Database\Eloquent\Factories\Factory;

class attributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->name(),
            'name' => $this->faker->name(),
            'status'=>'active'

            
        ];
        
    }
}
