<?php

namespace App\Providers;

use App\Models\Contact;
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
        // Broadcast::routes(['middleware' => ['jwt.auth']]);
        // require base_path('routes/channels.php');
        Contact::observe(ItemObserver::class);
    }
}
