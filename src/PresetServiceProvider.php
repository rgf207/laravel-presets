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
    public function boot ()
    {
        PresetCommand::macro('onethirtyone', function ($command) {
            Preset::install();
            $command->comment('Preset loaded. Run composer update && npm install && npm run dev to compile assets.');
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register ()
    {
        //
    }
}
