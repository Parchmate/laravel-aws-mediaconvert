<?php

namespace Parchmate\AwsMediaConvert\Support\Hls;

use Parchmate\AwsMediaConvert\Support\MediaConvertGroup;

class DefaultHlsMediaConvertGroup extends MediaConvertGroup
{
    public static function make(string $Destination): self
    {
        return new self([
            'CustomName' => 'Standard Apple HLS',
            'Name' => 'Apple HLS',
            'Outputs' => [],
            'OutputGroupSettings' => [
                'Type' => 'HLS_GROUP_SETTINGS',
                'HlsGroupSettings' => [
                    'SegmentLength' => 10,
                    'Destination' => $Destination,
                    'MinSegmentLength' => 0,
                ],
            ],
        ]);
    }
}
