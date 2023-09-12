<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Debug\Dumper;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
    }


    /**
     * Register the commands for the application.
     */
    protected $commands = [
       
    ];
    // crontab -e
    // take in terminal crontab - e here 
    # * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1

}
