<?php

namespace App\Console\Commands;

use App\Models\Pemesanan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

// run with php artisan schedule:run
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
    protected $description = 'Checks for pemesanans with the status "pending" and automatically sets the status to cancelled if current time is past expired_at';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredOrders = Pemesanan::where('status', 'pending')
            ->where('expired_at', '<=', now())
            ->get();

        foreach ($expiredOrders as $order) {
            $order->status = 'cancelled';
            $order->save();
            Log::info('Order expired');
        }
    }
}
