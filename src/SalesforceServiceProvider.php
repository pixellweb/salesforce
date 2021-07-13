<?php

namespace Citadelle\Salesforce;


use Citadelle\ReferentielApi\app\Console\Commands\Referentiel;
use Illuminate\Support\ServiceProvider;

class SalesforceServiceProvider extends ServiceProvider
{


    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->addCustomConfigurationValues();
    }

    public function addCustomConfigurationValues()
    {
        // add filesystems.disks for the log viewer
        config([
            'logging.channels.salesforce' => [
                'driver' => 'single',
                'path' => storage_path('logs/salesforce-api.log'),
                'level' => 'debug',
            ]
        ]);

    }


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/salesforce.php', 'citadelle.salesforce'
        );
    }
}
