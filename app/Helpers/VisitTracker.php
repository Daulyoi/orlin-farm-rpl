<?php

use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use App\Models\PageVisit;

if (!function_exists('trackVisit')) {
    function trackVisit()
    {
        if (session('visited') == true) {
            return;
        }
        session(['visited' => true]);

        $date = Carbon::now()->toDateString();

        $visit = PageVisit::where('date', $date)->first();

        if ($visit) {
            $visit->increment('visit_count');
        } else {
            PageVisit::create([
                'date' => $date,
                'visit_count' => 1,
            ]);
        }
    }
}

if (!function_exists('getLastVisitCount')) {
    function getLastVisitCount()
    {
        $start_date = Carbon::now()->subDays(30)->toDateString();
        $visits = PageVisit::where('date', '>=', $start_date)->orderBy('date', 'asc')->get();
        return $visits;
    }
}
