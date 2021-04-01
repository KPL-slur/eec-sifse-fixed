<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExpiredStockNotificationEmail;

class SendStockExpiredEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:expired-stock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notification to admin whenever there exist any stocks that are expired within the next year.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $expired_stocks = Stock::whereBetween('expired', [Carbon::now(), Carbon::now()->addYear()])->get();

        if(sizeof($expired_stocks) != 0){
            Mail::to("wicaklearn@gmail.com")
                ->send(new ExpiredStockNotificationEmail($expired_stocks));
        }

    }
}
