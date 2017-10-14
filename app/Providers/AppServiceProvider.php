<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind every interface from our core to a repository
        $models = [
            'Moderator',
            'Team',
            'Match'
        ];

        foreach ($models as $model) {
            $this->app->bind("Core\Interfaces\\" . "I" . $model, "Core\Repositories\\" . $model . "Repository");
        }
    }
}
