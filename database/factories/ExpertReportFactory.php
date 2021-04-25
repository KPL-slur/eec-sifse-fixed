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
     * override expert_id to eecid's expert_id
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function eecidExpert()
    {
        return $this->state(function (array $attributes) {
            return [
                'expert_id' => $this->faker->numberBetween(1, 10),
                'role' => 'Teknisi',
            ];
        });
    }

    /**
     * chance to override role to Kasie Obs
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function chanceKasieObs()
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => $this->faker->randomElement(['Teknisi', 'Kasie Obs']),
            ];
        });
    }

    /**
     * override role to tenaga ahli
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function tenagaAhli()
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'Tenaga Ahli',
            ];
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'expert_id'=> $this->faker->numberBetween(11, 60),
            'role' => 'Teknisi',
            'created_at'=>now()
        ];
    }
}
