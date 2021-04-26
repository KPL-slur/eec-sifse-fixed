<?php

namespace Database\Factories;

use App\Models\Distribution;
use Illuminate\Database\Eloquent\Factories\Factory;

class DistributionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Distribution::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'expert_id'=> $this->faker->numberBetween(1, config('seeder.eecid_expert_count')),
            'created_at' => now()
        ];
    }
}
