<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\HeadReport;
use App\Models\ExpertReport;
use App\Models\CmBodyReport;
use App\Models\PmBodyReport;
use App\Models\Recommendation;
use App\Models\ReportImage;

class HeadReportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $directory = 'public/files';
        Storage::deleteDirectory($directory);
        Storage::makeDirectory($directory);

        HeadReport::factory(config('seeder.pm_count'))
                    ->has(ExpertReport::factory(1)->eecidExpert()->tenagaAhli())
                    ->has(ExpertReport::factory(1)->eecidExpert())
                    ->has(ExpertReport::factory(1)->chanceKasieObs())
                    ->has(ExpertReport::factory(3))
                    ->has(PmBodyReport::factory(1))
                    ->has(Recommendation::factory(config('seeder.recommendation_count')))
                    ->has(ReportImage::factory(3))
                    ->create();

        HeadReport::factory(config('seeder.cm_count'))
                    ->cm()
                    ->has(ExpertReport::factory(1)->eecidExpert()->tenagaAhli())
                    ->has(ExpertReport::factory(1)->eecidExpert())
                    ->has(ExpertReport::factory(1)->chanceKasieObs())
                    ->has(ExpertReport::factory(3))
                    ->has(CmBodyReport::factory(1))
                    ->has(Recommendation::factory(config('seeder.recommendation_count')))
                    ->has(ReportImage::factory(3))
                    ->create();

        HeadReport::factory(config('seeder.deleted_pm_count'))
                    ->deleted()
                    ->has(ExpertReport::factory(1)->eecidExpert()->tenagaAhli())
                    ->has(ExpertReport::factory(1)->eecidExpert())
                    ->has(ExpertReport::factory(1)->chanceKasieObs())
                    ->has(ExpertReport::factory(3))
                    ->has(PmBodyReport::factory(1))
                    ->has(Recommendation::factory(config('seeder.recommendation_count')))
                    ->create();

        HeadReport::factory(config('seeder.deleted_cm_count'))
                    ->cm()
                    ->deleted()
                    ->has(ExpertReport::factory(1)->eecidExpert()->tenagaAhli())
                    ->has(ExpertReport::factory(1)->eecidExpert())
                    ->has(ExpertReport::factory(1)->chanceKasieObs())
                    ->has(ExpertReport::factory(3))
                    ->has(CmBodyReport::factory(1))
                    ->has(Recommendation::factory(config('seeder.recommendation_count')))
                    ->create();
    }
}
