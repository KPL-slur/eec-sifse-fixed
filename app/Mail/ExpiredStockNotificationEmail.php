<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExpiredStockNotificationEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $expired_stocks;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($expired_stocks)
    {
        $this->expired_stocks = $expired_stocks;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("admin@eecid.com")->markdown('stocks.notification', ['expired_stocks'=>$this->expired_stocks]);
    }
}
