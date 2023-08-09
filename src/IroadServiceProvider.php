<?php

namespace Appcart\Iroad;

Use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Routing\Router;
use Appcart\Iroad\app\Http\Middleware\InvalidLoggedIn;
use Appcart\Iroad\app\Http\Middleware\ValidLoggedIn;

class IroadServiceProvider extends ServiceProvider
{

    public function boot(Kernel $kernel)
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'blogpackage');

        $this->publishes([
            __DIR__.'/assets' => public_path('appcart/iroad'),
        ], 'assets');

        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('valid', ValidLoggedIn::class);

        // $this->app['router']->aliasMiddleware('valid', ValidLoggedIn::class);

        // $kernel->prependMiddlewareToGroup('web', InvalidLoggedIn::class); // Add it before all other middlewares
        // $kernel->prependMiddlewareToGroup('web', ValidLoggedIn::class); // Add it before all other middlewares

        // $kernel->appendMiddlewareToGroup('web', InvalidLoggedIn::class); // Add it after all other middlewares
        // $kernel->appendMiddlewareToGroup('web', ValidLoggedIn::class); // Add it after all other middlewares
    }

    public function register()
    {

    }
}

?>