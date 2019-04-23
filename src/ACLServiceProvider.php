<?php

namespace Nagarjun\ACL;

use Illuminate\Support\ServiceProvider;

class ACLServiceProvider extends ServiceProvider {
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    // protected $defer = true;
    public function boot() {
        
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/Migrations');
//        app('router')->aliasMiddleware('scopes', \Modules\Auth\Http\Middleware\CheckScopes::class);
        $this->app['router']->aliasMiddleware('acl', \Nagarjun\ACL\Middlewares\PermissionMiddleware::class);
        $this->loadViewsFrom(__DIR__.'/Views', 'ACL');
        
//        $this->loadRoutesFrom(__DIR__.'/routes.php');
//        $this->loadViewsFrom(__DIR__.'/views', 'CurrencyFormatter');
//        $this->app->make('Nagarjun\UUID\UUID');
    // $this->app->singleton('UUID', function () {
    // return UUID::v4();
    // });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
//        dd('register');
//        $this->app->singleton(Connection::class, function ($app) {
//            return new Connection(config('riak'));
//        });
        // $this->app->make('UUID');
//              $this->app->singleton('Nagarjun\UUID\UUID', function ($app) {
//           return new UUID($app);
//       });
    }

//    public function provides() {
//    	return array('Nagarjun\UUID\UUID');
//    }
}
