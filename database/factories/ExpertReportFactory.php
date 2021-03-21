<?php

namespace Database\Factories;

use App\Models\ExpertReport;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpertReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ExpertReport::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'expert_id'=> $this->faker->numberBetween(1, 50),
            'role' => $this->faker->randomElement(['Teknisi', 'Tenaga Ahli', 'Kasie Obs']),
            'created_at'=>now()
        ];
    }
}
