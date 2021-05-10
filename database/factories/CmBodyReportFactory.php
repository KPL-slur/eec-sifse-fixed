<?php

namespace Database\Factories;

use App\Models\CmBodyReport;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Services\FactoryHelper;

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
        $helper = new FactoryHelper;

        return [
            'remark' => $helper->createPara(10),
            'created_at' => now()
        ];
    }
}
