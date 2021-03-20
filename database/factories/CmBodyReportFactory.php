<?php

namespace Database\Factories;

use App\Models\CmBodyReport;
use Illuminate\Database\Eloquent\Factories\Factory;

class CmBodyReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CmBodyReport::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'remark' => $this->faker->paragraphs(3, true),
            'created_at' => now()
        ];
    }
}
