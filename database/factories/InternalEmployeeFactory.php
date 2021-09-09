<?php

namespace Database\Factories;

use App\Models\InternalEmployee;
use Illuminate\Database\Eloquent\Factories\Factory;

class InternalEmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InternalEmployee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'sex' => $this->faker->randomElement(['MALE', 'FEMALE', 'OTHER']),
            'department' => $this->faker->randomElement(['OWNER', 'PROGRAMMER', 'SALER']),
            'birth_date' => $this->faker->date
        ];
    }
}
