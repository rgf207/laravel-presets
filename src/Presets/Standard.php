<?php

namespace onethirtyone\preset\Presets;

use Illuminate\Support\Arr;
use function resource_path;

/**
 * Class Standard
 * @package onethirtyone\preset\Presets
 */
class Standard extends BasePreset
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
     * @param $packages
     *
     * @return array
     */
    public static function updateComposerArray($packages)
    {
        return array_merge([
            'laravel/nova' => '~1.0',
        ], Arr::except($packages, [
            //
        ]));

    }

    /**
     * @param $repositories
     *
     * @return array
     */
    public static function updateRepositoriesArray($repositories)
    {
        return array_merge([
            [
                "type" => "composer",
                "url" => "https://nova.laravel.com",
            ],
        ], Arr::except($repositories, [
            //
        ]));
    }

    /**
     *  Updates laravel mix scaffolding
     */
    public static function updateMix()
    {
        copy(__DIR__ . './../stubs/webpack.mix.js', base_path('webpack.mix.js'));
    }

    /**
     *  Updates core JS files
     */
    public static function updateJs()
    {
        mkdir(resource_path('/js/classes'));
        copy(__DIR__ . './../stubs/Form.js', resource_path('/js/classes/Form.js'));
        copy(__DIR__ . './../stubs/Error.js', resource_path('/js/classes/Error.js'));
        copy(__DIR__ . './../stubs/bootstrap.js', resource_path('/js/bootstrap.js'));
        copy(__DIR__ . './../stubs/app.js', resource_path('/js/app.js'));
        copy(__DIR__ . './../stubs/tailwind.js', base_path('tailwind.js'));
    }

}