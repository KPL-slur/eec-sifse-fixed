<?php

namespace Database\Factories;

use App\Models\Site;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Site::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'radar_name'=> $this->faker->randomElement([$this->faker->numerify('RANGER-X#'), strtoupper($this->faker->bothify('DWSR-####?'))]),
            'image'=>'default.png',
            'station_id'=> $this->faker->city(),
        ];
    }
}
