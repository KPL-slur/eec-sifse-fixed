<?php

namespace Database\Factories;

use App\Models\Expert;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpertFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Expert::class;

    /**
     * override expert_company to Era Elektra Corpora Indonesia
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function eecid()
    {
        return $this->state(function (array $attributes) {
            return [
                'expert_company' => 'Era Elektra Corpora Indonesia',
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
            'name' => $this->faker->firstNameMale()." ".$this->faker->lastName(),
            'nip' => $this->faker->randomNumber(18, true),
            'expert_company'=> 'Statsiun Metereologi '.$this->faker->city(),//$this->faker->randomElement(['Era Elektra Corpora Indonesia','Statsiun Metereologi '.$this->faker->city()]),
            'created_at' => now()
        ];
    }
}
