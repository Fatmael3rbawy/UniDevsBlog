<?php

namespace Modules\Comment\Providers;

use Illuminate\Support\ServiceProvider ;

class CommentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        $moduleName = 'Comment';
          // Load routes
        $this->loadRoutesFrom(loadRoute('comment', $moduleName));
        $this->loadMigrationsFrom(loadMigrations($moduleName));


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {}
}