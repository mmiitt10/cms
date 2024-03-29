<?php

namespace App\Listeners;

use App\Events\CareerUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;

class UpdateCareerSummaries
{
    public function __construct()
    {
        //
    }

    public function handle(CareerUpdated $event)
    {
        // コマンドを実行
        Artisan::call('update:career-summaries');
    }
}
