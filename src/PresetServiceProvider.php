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
        PresetCommand::macro('131studios', function ($command) {
            Preset::install();

            $command->comment('Preset 131studios loaded.');
            $command->comment('Run composer update && npm install && npm run dev to compile assets.');
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
