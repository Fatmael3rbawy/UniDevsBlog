<?php

namespace Modules\Post\Providers;

use Illuminate\Support\ServiceProvider ;

class PostServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        $moduleName = 'Post';
          // Load routes
        $this->loadRoutesFrom(loadRoute('post', $moduleName));
        $this->loadMigrationsFrom(loadMigrations($moduleName));


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {}
}