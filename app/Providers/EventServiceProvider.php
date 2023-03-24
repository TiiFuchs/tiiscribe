<?php

namespace App\Providers;

use App\Listeners\LoginTelegramUser;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Telepath\Events\BeforeHandlingUpdate;

class EventServiceProvider extends ServiceProvider
{

    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        BeforeHandlingUpdate::class => [
            LoginTelegramUser::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }

}
