<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

use App\Models\Site;
use App\Models\Distribution;
use App\Models\SitedStock;
use App\Models\Stock;
use App\Models\HeadReport;
use App\Models\Expert;
use App\Models\ExpertReport;
use App\Models\CmBodyReport;
use App\Models\PmBodyReport;
use App\Models\Recommendation;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Expert::factory(10)->eecid()->create();
        Expert::factory(50)->create();
        Stock::factory(250)->create();

        Site::factory(20)
                    ->has(Distribution::factory(2))
                    ->has(SitedStock::factory(30))
                    ->create();

        HeadReport::factory(10)
                    ->has(ExpertReport::factory(1)->eecidExpert()->tenagaAhli())
                    ->has(ExpertReport::factory(1)->eecidExpert())
                    ->has(ExpertReport::factory(1)->kasieObs())
                    ->has(ExpertReport::factory(3))
                    ->has(PmBodyReport::factory(1))
                    ->has(Recommendation::factory(5))
                    ->create();

        HeadReport::factory(10)
                    ->cm()
                    ->has(ExpertReport::factory(1)->eecidExpert()->tenagaAhli())
                    ->has(ExpertReport::factory(1)->eecidExpert())
                    ->has(ExpertReport::factory(1)->kasieObs())
                    ->has(ExpertReport::factory(3))
                    ->has(CmBodyReport::factory(1))
                    ->has(Recommendation::factory(5))
                    ->create();

        HeadReport::factory(10)
                    ->cm()
                    ->deleted()
                    ->has(ExpertReport::factory(1)->eecidExpert()->tenagaAhli())
                    ->has(ExpertReport::factory(1)->eecidExpert())
                    ->has(ExpertReport::factory(1)->kasieObs())
                    ->has(ExpertReport::factory(3))
                    ->has(CmBodyReport::factory(1))
                    ->has(Recommendation::factory(5))
                    ->create();

        // ===== ================ =====
        $this->call([UsersTableSeeder::class]);
        // $this->call([HeadReportsSeeder::class]);
        // $this->call([PmBodyReportsSeeder::class]);
        // $this->call([CmBodyReportsSeeder::class]);
        // $this->call([ExpertsSeeder::class]);
        // $this->call([StocksSeeder::class]);
        // $this->call([SitesSeeder::class]);
        // $this->call([RecommendationsSeeder::class]);
        // $this->call([ExpertReportsSeeder::class]);
        // $this->call([DistributionsSeeder::class]);
        // $this->call([SitedStockSeeder::class]);
    }
}
