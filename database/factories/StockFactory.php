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
        $tgl_masuk = $this->faker->dateTimeInInterval('-1 years', '+1 years');
         
        return [
            'nama_barang' => $this->faker->unique()->word(),
            'group' => $this->faker->randomElement(['Receiver', 'Transmitter', 'Antenna', 'Tambahan']),
            'part_number' => strtoupper($this->faker->numerify('PL-######-###')), //PL-133157-100
            'ref_des' => $this->faker->bothify('#?###'),
            'tgl_masuk' => $tgl_masuk,
            'expired' => $this->faker->dateTimeInInterval($tgl_masuk, '+5 years'),
            'kurs_beli' => $this->faker->randomFloat(2, 1500000, 1500000000), //1500000000.11
            'jumlah_unit' => $this->faker->randomDigitNotNull(),
            'status' => $this->faker->randomElement(['Not Obsolete', 'Obsolete', 'Dummy']),
            'keterangan' => $this->faker->paragraphs(2, true),
            'created_at'=>now()
        ];
    }
}
