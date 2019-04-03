<?php

namespace Corp\Console;

use Corp\Http\Middleware\EncryptCookies;
use Corp\Http\Middleware\VerifyCsrfToken;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Session\Middleware\AuthenticateSession;

class Kernel extends ConsoleKernel
{
    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => 'App\Http\Middleware\Authenticate',
        'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
        'guest' => 'App\Http\Middleware\RedirectIfAuthenticated',
    ];
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
        // $schedule->command('inspire')
        //          ->hourly();
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
//
//    protected $middleware = [
//        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
//        EncryptCookies::class,
//        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
//        \Illuminate\Session\Middleware\StartSession::class,
//        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
//        VerifyCsrfToken::class,
//        AuthenticateSession::class
//    ];
}
