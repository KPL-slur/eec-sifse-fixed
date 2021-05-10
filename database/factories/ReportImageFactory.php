<?php

namespace Database\Factories;

use App\Models\ReportImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ReportImage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'caption' => $this->faker->sentence(2),
            'image' => 'files' . '/' . $this->faker->image(storage_path('app/public/files'), 650, $this->faker->randomNumber(3, true), null, false),
        ];
    }
}
