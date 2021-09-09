<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $ids = collect();
        for ($i = 1; $i <= 5; $i++)
            $ids->add($i);

        return [
            'name' => $this->faker->name(),
//            'client_id' => null,
            'client_id' => $this->faker->randomElement($ids),
            'is_headquarter' => false
        ];
    }
}
