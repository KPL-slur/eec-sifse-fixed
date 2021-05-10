<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Factories\Factory;

class FactoryHelper extends Factory
{
    public function definition()
    {
        //DUMMY
    }

    public function createPara($paraCount)
    {
        $para = "";

        for ($i=1; $i < $paraCount; $i++) {
            $para = $para . "<p>".$this->faker->paragraphs(3, true)."</p>";

            if ($i == $paraCount-1) {
                $para = $para . "<p> Kesimpulan ".$this->faker->paragraphs(3, true)."</p>";
            }
        }
        return $para;
    }
}