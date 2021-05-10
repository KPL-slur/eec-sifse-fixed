<?php

namespace Database\Factories;

use App\Models\PmBodyReport;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Services\FactoryHelper;

class PmBodyReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PmBodyReport::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $helper = new FactoryHelper;

        return [
            'radio_general_visual' => $this->faker->numberBetween(0, 1),
            'radio_rcms' => $this->faker->numberBetween(0, 1),
            'radio_wipe_down' => $this->faker->numberBetween(0, 1),
            'radio_inspect_all' => $this->faker->numberBetween(0, 1),
            'radio_compressor_visual' => $this->faker->numberBetween(0, 1),
            'radio_duty_cycle' => $this->faker->numberBetween(0, 1),
            'radio_transmitter_visual' => $this->faker->numberBetween(0, 1),
            'radio_receiver_visual' => $this->faker->numberBetween(0, 1),
            'radio_stalo_check' => $this->faker->numberBetween(0, 1),
            'radio_afc_check' => $this->faker->numberBetween(0, 1),
            'radio_mrp_check' => $this->faker->numberBetween(0, 1),
            'radio_rcu_check' => $this->faker->numberBetween(0, 1),
            'radio_iq2_check' => $this->faker->numberBetween(0, 1),
            'radio_antenna_visual' => $this->faker->numberBetween(0, 1),
            'radio_inspect_motor' => $this->faker->numberBetween(0, 1),
            'radio_clean_slip' => $this->faker->numberBetween(0, 1),
            'radio_grease_gear' => $this->faker->numberBetween(0, 1),

            'running_time' => $this->faker->randomFloat(1),
            'radiate_time' => $this->faker->randomFloat(1),
            'hvps_v_0_4us' => $this->faker->randomFloat(1),
            'hvps_i_0_4us' => $this->faker->randomFloat(1),
            'mag_i_0_4us' => $this->faker->randomFloat(1),
            'hvps_v_0_8us' => $this->faker->randomFloat(1),
            'hvps_i_0_8us' => $this->faker->randomFloat(1),
            'mag_i_0_8us' => $this->faker->randomFloat(1),
            'hvps_v_1_0us' => $this->faker->randomFloat(1),
            'hvps_i_1_0us' => $this->faker->randomFloat(1),
            'mag_i_1_0us' => $this->faker->randomFloat(1),
            'hvps_v_2_0us' => $this->faker->randomFloat(1),
            'hvps_i_2_0us' => $this->faker->randomFloat(1),
            'mag_i_2_0us' => $this->faker->randomFloat(1),
            'forward_power' => $this->faker->randomFloat(2),
            'reverse_power' => $this->faker->randomFloat(2),
            'vswr' => $this->faker->randomFloat(2),
            
            'remark' => $helper->createPara(10),
            'created_at' => now(),
        ];
    }
}
