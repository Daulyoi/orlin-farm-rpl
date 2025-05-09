<?php

namespace App\Console\Commands;

use App\Models\Pemesanan;
use Illuminate\Console\Command;

// run with php artisan app:expire-orders
class ExpireOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:expire-orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredOrders = Pemesanan::where('status', 'pending')
            ->where('expired_at', '<=', now())
            ->get();

        foreach ($expiredOrders as $order) {
            $order->status = 'expired';
            $order->save();
        }
    }
}
