<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('revisar:asistencias')->dailyAt('1:00')->days([Schedule::TUESDAY, Schedule::WEDNESDAY, Schedule::THURSDAY, Schedule::FRIDAY, Schedule::SATURDAY]);
        $schedule->command('revisar:permisos_activos')->dailyAt('1:00')->days([Schedule::TUESDAY, Schedule::WEDNESDAY, Schedule::THURSDAY, Schedule::FRIDAY, Schedule::SATURDAY]);
        $schedule->command('calcular:tiempo_permisos')->lastDayOfMonth('23:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
