<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\ClientEmployee;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientEmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClientEmployee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $ids = collect();
        for ($i = 1; $i <= 10; $i++)
            $ids->add($i);

        return [
            'client_id' => $this->faker->randomElement($ids),
            'name' => $this->faker->name,
            'sex' => $this->faker->randomElement(['MALE', 'FEMALE', 'OTHER']),
            'department' => $this->faker->randomElement(['OWNER', 'PROGRAMMER', 'SALER']),
            'birth_date' => $this->faker->date
        ];
    }
}
