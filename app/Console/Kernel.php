<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Admin\Search;
use App\Admin\User;
use App\Admin\Sector;
use App\Jobs\SendMailJob;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $searches = Search::all();
        foreach ($searches as $search) {
            if (\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($search->date_start)) == 0) {
                foreach ($search->users as $user) {

                    $schedule->job(new SendMailJob("dashboard/email/new-search", $user, $search))->dailyAt('08:00');
                }
            }
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
