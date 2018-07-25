<?php

namespace laract\Providers;

use laract\Projectors\UnitProjector;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Spatie\EventProjector\Projectionist;




class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Projectionist $projectionist)
    {
        $projectionist->addProjector(UnitProjector::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
