<?php

namespace Database\Factories;

use App\Models\SitedStock;
use Illuminate\Database\Eloquent\Factories\Factory;

class SitedStockFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SitedStock::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'stock_id'=>$this->faker->numberBetween(1, config('seeder.stock_count')),
            'created_at' => now()
        ];
    }
}
