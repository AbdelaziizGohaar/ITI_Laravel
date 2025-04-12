<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Jobs\PruneOldPostsJob;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new PruneOldPostsJob)->dailyAt("00:00");
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');