<?php

namespace Database\Factories;

use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stock::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_barang' => $this->faker->word(),
            'group' => $this->faker->randomElement(['Receiver', 'Transmitter', 'Antenna', 'Tambahan']),
            'part_number' => strtoupper($this->faker->numerify('PL-######-###')), //PL-133157-100
            'serial_number' => $this->faker->uuid(),
            'tgl_masuk' => $this->faker->dateTimeInInterval('-1 years', '+10 days'),
            'expired' => $this->faker->dateTimeInInterval('+10 days', '+5 years'),
            'kurs_beli' => $this->faker->randomFloat(2, 1500000, 1500000000), //1500000000.11
            'jumlah_unit' => $this->faker->randomDigitNotNull(),
            'status' => $this->faker->randomElement(['Not Obsolete', 'Obsolete', 'Dummy']),
            'created_at'=>now()
        ];
    }
}
