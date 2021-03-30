<?php

namespace Database\Factories;

use App\Models\HeadReport;
use Illuminate\Database\Eloquent\Factories\Factory;

class HeadReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HeadReport::class;

    /**
     * override maintenance_type to cm
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function cm()
    {
        return $this->state(function (array $attributes) {
            return [
                'maintenance_type' => 'cm',
            ];
        });
    }

    /**
     * override maintenance_type to cm
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function deleted()
    {
        return $this->state(function (array $attributes) {
            return [
                'deleted_at' => now(),
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
        $startDate = $this->faker->dateTimeThisYear('+24 months');
        return [
            'site_id' => $this->faker->numberBetween(1, 20),
            'maintenance_type' => 'pm', //$this->faker->randomElement(['pm','cm']),
            'kasat_name' => $this->faker->firstNameFemale()." ".$this->faker->lastName(),
            'kasat_nip' => $this->faker->numerify('##################'),
            'report_date_start' => $startDate,
            'report_date_end' => $this->faker->dateTimeInInterval($startDate, '+4 days'),
            'created_at' => now(),
        ];
    }
}
