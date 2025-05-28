<?php

namespace Parchmate\AwsMediaConvert\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Aws\MediaConvert\MediaConvertClient getClient()
 * @method static \Aws\Result saveTo(string $s3Path, $s3bucket = null)
 * @method static \Aws\Result cancelJob(string $id)
 * @method static \Aws\Result createJob(array $settings, array $metaData = [], array $tags = [], int $priority = 0)
 * @method static \Aws\Result getJob(string $id)
 * @method static \Aws\Result listJobs(array $options)
 * @method static string getUri(?string $path) retrieve AWS S3 uri
 *
 * @see \Parchmate\AwsMediaConvert\AwsMediaConvert
 */
class AwsMediaConvert extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Parchmate\AwsMediaConvert\AwsMediaConvert::class;
    }
}
