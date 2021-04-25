<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // ===== ================ =====
        $this->call([UsersTableSeeder::class]);
        $this->call([HeadReportsSeeder::class]);
        // $this->call([PmBodyReportsSeeder::class]);
        // $this->call([CmBodyReportsSeeder::class]);
        $this->call([ExpertsSeeder::class]);
        $this->call([StocksSeeder::class]);
        $this->call([SitesSeeder::class]);
        // $this->call([RecommendationsSeeder::class]);
        // $this->call([ExpertReportsSeeder::class]);
        // $this->call([DistributionsSeeder::class]);
        // $this->call([SitedStockSeeder::class]);
    }
}
