<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\SalinDanHapusAntrian::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Versi testing - jalankan setiap 2 menit
        // $schedule->command('antrian:salin-dan-hapus')
        //     ->everyTwoMinutes()
        //     ->timezone('Asia/Makassar')
        //     ->appendOutputTo(storage_path('logs/antrian-scheduler.log'))
        //     ->emailOutputOnFailure('admin@example.com'); // Ganti dengan email Anda

         
        // Versi production - jalankan setiap hari jam 00:00
        $schedule->command('antrian:salin-dan-hapus')
            ->dailyAt('00:00')
            ->timezone('Asia/Makassar')
            ->appendOutputTo(storage_path('logs/antrian-scheduler.log'))
            ->emailOutputOnFailure('admin@example.com');
        
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

    /**
     * Get the timezone that should be used by default for scheduled events.
     *
     * @return \DateTimeZone|string|null
     */
    protected function scheduleTimezone()
    {
        return 'Asia/Makassar';
    }
    protected $middlewareGroups = [
        'web' => [],
    ];
}