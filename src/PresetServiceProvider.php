<?php

namespace onethirtyone\preset;

use Illuminate\Support\ServiceProvider;
use Laravel\Ui\UiCommand;

class PresetServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        UiCommand::macro('standard', function ($command) {
            Presets\Standard::install();

            $command->comment('Preset Standard loaded.');
            $command->comment('Run npm install && npm run dev to compile assets.');
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
