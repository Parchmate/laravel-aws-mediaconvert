<?php

namespace Parchmate\AwsMediaConvert;

use Aws\Credentials\Credentials;
use Aws\MediaConvert\MediaConvertClient;
use Parchmate\AwsMediaConvert\Http\Controllers\AwsMediaConvertWebhookController;
use Illuminate\Support\Facades\Route;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AwsMediaConvertServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-aws-mediaconvert')
            ->hasConfigFile();
    }

    public function registeringPackage()
    {
        $this->app->singleton(AwsMediaConvert::class, function () {
            return new AwsMediaConvert(
                client: new MediaConvertClient([
                    'version' => config('aws-mediaconvert.version'),
                    'region' => config('aws-mediaconvert.region'),
                    'credentials' => new Credentials(
                        key: config('aws-mediaconvert.credentials.key'),
                        secret: config('aws-mediaconvert.credentials.secret')
                    ),
                ])
            );
        });
    }

    public function packageBooted()
    {
        Route::macro('awsMediaConvertWebhook', function ($url) {
            return Route::post($url, AwsMediaConvertWebhookController::class);
        });
    }
}
