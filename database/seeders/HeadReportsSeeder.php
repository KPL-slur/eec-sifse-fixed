<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\HeadReport;
use App\Models\ExpertReport;
use App\Models\CmBodyReport;
use App\Models\PmBodyReport;
use App\Models\Recommendation;

class HeadReportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HeadReport::factory(10)
                    ->has(ExpertReport::factory(1)->eecidExpert()->tenagaAhli())
                    ->has(ExpertReport::factory(1)->eecidExpert())
                    ->has(ExpertReport::factory(1)->chanceKasieObs())
                    ->has(ExpertReport::factory(3))
                    ->has(PmBodyReport::factory(1))
                    ->has(Recommendation::factory(5))
                    ->create();

        HeadReport::factory(10)
                    ->cm()
                    ->has(ExpertReport::factory(1)->eecidExpert()->tenagaAhli())
                    ->has(ExpertReport::factory(1)->eecidExpert())
                    ->has(ExpertReport::factory(1)->chanceKasieObs())
                    ->has(ExpertReport::factory(3))
                    ->has(CmBodyReport::factory(1))
                    ->has(Recommendation::factory(5))
                    ->create();

        HeadReport::factory(10)
                    ->cm()
                    ->deleted()
                    ->has(ExpertReport::factory(1)->eecidExpert()->tenagaAhli())
                    ->has(ExpertReport::factory(1)->eecidExpert())
                    ->has(ExpertReport::factory(1)->chanceKasieObs())
                    ->has(ExpertReport::factory(3))
                    ->has(CmBodyReport::factory(1))
                    ->has(Recommendation::factory(5))
                    ->create();
    }
}
