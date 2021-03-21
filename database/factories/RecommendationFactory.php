<?php

namespace Database\Factories;

use App\Models\Recommendation;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecommendationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Recommendation::class;
    

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'jumlah_unit_needed' => $this->faker->randomDigitNotNull().' units',
            'year' => $this->faker->dateTimeBetween('-1 years', '+2 year')->format("Y"),
        ];
    }
}
