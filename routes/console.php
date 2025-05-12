<?php

use App\Console\Commands\ExpireOrders;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Activate with : php artisan schedule:work in a separate terminal
Schedule::command(ExpireOrders::class)->everyminute();
