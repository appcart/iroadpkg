<?php

namespace Appcart\Iroad;

Use Illuminate\Support\ServiceProvider;

class IroadServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
    }

    public function register()
    {

    }
}

?>