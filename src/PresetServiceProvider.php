<?php

namespace onethirtyone\preset;

use Illuminate\Foundation\Console\PresetCommand;
use Illuminate\Support\ServiceProvider;

class PresetServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        PresetCommand::macro('standard', function ($command) {
            Presets\Standard::install();

            $command->comment('Preset Standard loaded.');
            $command->comment('Run composer update && npm install && php artisan nova:install && npm run dev to compile assets.');
        });


        PresetCommand::macro('spark', function ($command) {
            Presets\Spark::install();

            $command->comment('Preset Spark loaded.');
            $command->comment('Complete the spark installation process to continue.');
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
