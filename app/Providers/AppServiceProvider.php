<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\Message;
use App\Observers\MessageObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //  Broadcast::routes();
        // Broadcast::routes(['middleware' => ['auth:api']]);
        Broadcast::routes(['middleware' => ['jwt.auth']]);

        require base_path('routes/channels.php');
        Contact::observe(UserObserver::class);
        Message::observe(MessageObserver::class);
    }
}
