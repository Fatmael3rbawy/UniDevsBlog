<?php

namespace Modules\User\Providers;

use Illuminate\Support\ServiceProvider ;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        $moduleName = 'User';
          // Load routes
        $this->loadRoutesFrom(loadRoute('user', $moduleName));

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {}
}