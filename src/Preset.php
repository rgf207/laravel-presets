<?php

namespace onethirtyone\preset;

use Illuminate\Foundation\Console\Presets\Preset as LaravelPreset;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use function resource_path;

class Preset extends LaravelPreset
{
    public static function install()
    {
        static::cleanSassDirectory();
        static::updatePackages();
        static::updateMix();
        static::updateJs();
    }

    public static function cleanSassDirectory()
    {
        File::cleanDirectory(resource_path('assets/sass'));
    }

    public static function updatePackageArray($packages)
    {
        return array_merge([
            'laravel-mix-tailwind' => '^0.1.0',
            "tailwindcss" => "^0.5.3",
        ], Arr::except($packages, [
            'popper.js',
            'jquery',
            'lodash',
            'bootstrap',
        ]));
    }

    public static function updateMix()
    {
        copy(__DIR__.'/stubs/webpack.mix.js', base_path('webpack.mix.js'));
    }
    
    public static function updateJs()
    {
        mkdir(resource_path('/assets/js/classes'));
        copy(__DIR__.'/stubs/Form.js', resource_path('assets/js/classes/Form.js'));
        copy(__DIR__.'/stubs/Error.js', resource_path('assets/js/classes/Error.js'));
        copy(__DIR__.'/stubs/bootstrap.js', resource_path('assets/js/bootstrap.js'));
        copy(__DIR__.'/stubs/app.js', resource_path('assets/js/app.js'));
    }
}