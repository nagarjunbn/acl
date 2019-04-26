<?php

namespace Nagarjun\ACL;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;

class ACLServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        $this->app['router']->aliasMiddleware('acl', \Nagarjun\ACL\Middlewares\PermissionMiddleware::class);
        $this->app['router']->aliasMiddleware('user_acl', \Nagarjun\ACL\Middlewares\UserPermissionMiddleware::class);
        $this->loadViewsFrom(__DIR__ . '/Views', 'ACL');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        
    }

    public function provides() {
        
    }

}
