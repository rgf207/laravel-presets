<?php

namespace onethirtyone\preset;

use Illuminate\Foundation\Console\Presets\Preset as LaravelPreset;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use function resource_path;

class Preset extends LaravelPreset
{
    /**
     *  Installs the One Thirty One Studios Preset
     */
    public static function install()
    {
        static::cleanSassDirectory();
        static::updatePackages();
        static::updateComposer();
        static::updateMix();
        static::updateJs();
    }


    /**
     *  Cleans Sass Directory
     */
    public static function cleanSassDirectory()
    {
        File::cleanDirectory(resource_path('assets/sass'));

        File::put(resource_path('assets/sass/app.scss'), '');
    }

    /**
     * @param $packages
     *
     * @return array
     */
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

    /**
     *  Updates laravel mix scaffolding
     */
    public static function updateMix()
    {
        copy(__DIR__.'/stubs/webpack.mix.js', base_path('webpack.mix.js'));
    }

    /**
     *  Updates core JS files
     */
    public static function updateJs()
    {
        mkdir(resource_path('/assets/js/classes'));
        copy(__DIR__.'/stubs/Form.js', resource_path('assets/js/classes/Form.js'));
        copy(__DIR__.'/stubs/Error.js', resource_path('assets/js/classes/Error.js'));
        copy(__DIR__.'/stubs/bootstrap.js', resource_path('assets/js/bootstrap.js'));
        copy(__DIR__.'/stubs/app.js', resource_path('assets/js/app.js'));
        copy(__DIR__.'/stubs/tailwind.js', base_path('tailwind.js'));
    }

    /**
     * Update the "composer.json" file.
     *
     * @return void
     */
    protected static function updateComposer()
    {
        if (! file_exists(base_path('composer.json'))) {
            return;
        }

        $packages = json_decode(file_get_contents(base_path('composer.json')), true);

        $packages['require'] = static::updateComposerArray(
            $packages['require']
        );

        ksort($packages['require']);

        file_put_contents(
            base_path('composer.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    /**
     * @param $packages
     *
     * @return array
     */
    public static function updateComposerArray($packages)
    {
        return array_merge([
            'backpack/crud' => '^3.4.0',
        ], Arr::except($packages, [
            //
        ]));
        
    }

    public static function updateDependencies($composer = true)
    {
        shell_exec($composer ? 'composer update' : 'npm install');
    }
}