<?php

namespace Database\Factories;

use App\Models\ClientEmployee;
use App\Models\InternalEmployee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

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
            'username' => $this->faker->unique()->userName(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'employeeable_id' => $this->faker->randomElement($ids),
            'employeeable_type' => $this->faker->randomElement([InternalEmployee::class, ClientEmployee::class])
        ];
    }
}
