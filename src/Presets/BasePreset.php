<?php


namespace onethirtyone\preset\Presets;


use Illuminate\Foundation\Console\Presets\Preset as LaravelPreset;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

/**
 * Class BasePreset
 * @package onethirtyone\preset\Presets
 */
abstract class BasePreset extends LaravelPreset
{
    /**
     * @param $packages
     *
     * @return array
     */
    public static function updatePackageArray($packages)
    {
        return array_merge([
            'laravel-mix-tailwind' => '^0.1.0',
            'laravel-mix-purgecss' => '^2.2.0',
            'postcss-nesting' => '^5.0.0',
            'postcss-import' => '^11.1.0',
            'tailwindcss' => '>=0.5.3',
        ], Arr::except($packages, [
            'bootstrap-sass',
            'popper.js',
            'jquery',
            'bootstrap',
        ]));
    }

    /**
     * @return mixed
     */
    abstract public static function install();

    /**
     * @return mixed
     */
    abstract public static function updateMix();

    /**
     * @return mixed
     */
    abstract public static function updateJs();

    /**
     * @param $packages
     *
     * @return mixed
     */
    abstract public static function updateComposerArray($packages);

    /**
     *  Cleans Sass Directory
     */
    public static function cleanSassDirectory()
    {
        File::cleanDirectory(resource_path('sass'));

        copy(__DIR__ . './../stubs/app.scss', resource_path('/sass/app.scss'));
    }

    /**
     * Update the "composer.json" file.
     *
     * @return void
     */
    public static function updateComposer()
    {
        if (!file_exists(base_path('composer.json'))) {
            return;
        }

        $packages = json_decode(file_get_contents(base_path('composer.json')), true);

        $packages['require'] = static::updateComposerArray(
            $packages['require']
        );

        $packages['repositories'] = static::updateRepositoriesArray(
            $packages['repositories']
        );

        ksort($packages['require']);

        file_put_contents(
            base_path('composer.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . PHP_EOL
        );
    }
}