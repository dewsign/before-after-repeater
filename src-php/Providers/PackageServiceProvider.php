<?php

namespace Dewsign\BeforeAfterRepeater\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $this->publishConfigs();
        $this->bootViews();
        $this->bootAssets();
        $this->bootCommands();
        $this->publishDatabaseFiles();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            $this->getConfigsPath(),
            'before-after-repeater'
        );
    }

    /**
     * Publish configuration file.
     *
     * @return void
     */
    private function publishConfigs()
    {
        $this->publishes([
            $this->getConfigsPath() => config_path('before-after-repeater.php'),
        ], 'config');
    }
    /**
     * Get local package configuration path.
     *
     * @return string
     */
    private function getConfigsPath()
    {
        return __DIR__.'/../Config/before-after-repeater.php';
    }

    /**
     * Register the artisan packages' terminal commands
     *
     * @return void
     */
    private function bootCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                // MyCommand::class,
            ]);
        }
    }

    /**
     * Load custom views
     *
     * @return void
     */
    private function bootViews()
    {
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'before-after-repeater');
        $this->publishes([
            __DIR__.'/../Resources/views' => resource_path('views/vendor/before-after-repeater'),
        ]);
    }

    /**
     * Define publishable assets
     *
     * @return void
     */
    private function bootAssets()
    {
        $this->publishes([
            __DIR__.'/../Resources/assets/js' => resource_path('assets/js/vendor/before-after-repeater'),
        ], 'js');
    }

    private function publishDatabaseFiles()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');

        $this->app->make('Illuminate\Database\Eloquent\Factory')->load(
            __DIR__ . '/../Database/factories'
        );

        $this->publishes([
            __DIR__ . '/../Database/factories' => base_path('database/factories')
        ], 'factories');

        $this->publishes([
            __DIR__ . '/../Database/migrations' => base_path('database/migrations')
        ], 'migrations');

        $this->publishes([
            __DIR__ . '/../Database/seeds' => base_path('database/seeds')
        ], 'seeds');
    }
}
