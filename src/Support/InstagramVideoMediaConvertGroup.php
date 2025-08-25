<?php

namespace Parchmate\AwsMediaConvert\Support;

class InstagramVideoMediaConvertGroup extends MediaConvertGroup
{
    public static function make(string $Destination, int $MaxDimension = 1920): self
    {
        return new self([
            'CustomName' => 'Instagram Video Type',
            'Name' => 'File Group',
            'Outputs' => [
                [
                    'ContainerSettings' => [
                        'Container' => 'MP4',
                        'Mp4Settings' => [
                            'CslgAtom' => 'EXCLUDE', // No edit lists
                            'FreeSpaceBox' => 'EXCLUDE',
                            'MoovPlacement' => 'PROGRESSIVE_DOWNLOAD', // Moov atom at front
                        ],
                    ],
                    'VideoDescription' => array_merge(
                        [
                            'ScalingBehavior' => 'FIT',
                            'TimecodeInsertion' => 'DISABLED',
                            'AntiAlias' => 'ENABLED',
                            'Sharpness' => 50,
                            'CodecSettings' => [
                                'Codec' => 'H_264', // Can be 'H_264' or 'H_265'
                                'H264Settings' => [
                                    'InterlaceMode' => 'PROGRESSIVE', // Progressive scan
                                    'NumberReferenceFrames' => 3,
                                    'Syntax' => 'DEFAULT',
                                    'Softness' => 0,
                                    'GopClosedCadence' => 1, // Closed GOP
                                    'GopSize' => 90,
                                    'Slices' => 1,
                                    'GopBReference' => 'DISABLED',
                                    'MaxBitrate' => 25000000, // 25Mbps maximum
                                    'SlowPal' => 'DISABLED',
                                    'SpatialAdaptiveQuantization' => 'ENABLED',
                                    'TemporalAdaptiveQuantization' => 'ENABLED',
                                    'FlickerAdaptiveQuantization' => 'DISABLED',
                                    'EntropyEncoding' => 'CABAC',
                                    'FramerateControl' => 'SPECIFIED', // Control framerate
                                    'FramerateNumerator' => 60, // Default 60fps (max)
                                    'FramerateDenominator' => 1,
                                    'FramerateConversionAlgorithm' => 'DUPLICATE_DROP',
                                    // Frame rate limits
                                    'AllowedFramerates' => [
                                        'FRAME_RATE_23_97',
                                        'FRAME_RATE_24',
                                        'FRAME_RATE_25',
                                        'FRAME_RATE_29_97',
                                        'FRAME_RATE_30',
                                        'FRAME_RATE_50',
                                        'FRAME_RATE_59_94',
                                        'FRAME_RATE_60',
                                    ],
                                    'RateControlMode' => 'VBR', // Variable Bit Rate
                                    'CodecProfile' => 'MAIN',
                                    'Telecine' => 'NONE',
                                    'MinIInterval' => 0,
                                    'AdaptiveQuantization' => 'HIGH',
                                    'CodecLevel' => 'AUTO',
                                    'FieldEncoding' => 'PAFF',
                                    'SceneChangeDetect' => 'ENABLED',
                                    'QualityTuningLevel' => 'SINGLE_PASS',
                                    'UnregisteredSeiTimecode' => 'DISABLED',
                                    'GopSizeUnits' => 'FRAMES',
                                    'ParControl' => 'SPECIFIED', // Control pixel aspect ratio
                                    'ParNumerator' => 1,
                                    'ParDenominator' => 1,
                                    'NumberBFramesBetweenReferenceFrames' => 2,
                                    'RepeatPps' => 'DISABLED',
                                    'ColorSpaceSettings' => [
                                        'ColorSpacePassthrough' => 'ENABLED',
                                    ],
                                    'ChromaSubsampling' => 'YUV420P', // 4:2:0 chroma subsampling
                                ],
                            ],
                            'AfdSignaling' => 'NONE',
                            'DropFrameTimecode' => 'ENABLED',
                            'RespondToAfd' => 'NONE',
                            'ColorMetadata' => 'INSERT',
                            'VideoPreprocessors' => [
                                'Rotate' => 'AUTO',
                            ],
                        ],
                        ['Width' => min($MaxDimension, 1920)], // Maximum horizontal pixels: 1920
                    ),
                    'AudioDescriptions' => [
                        [
                            'AudioTypeControl' => 'FOLLOW_INPUT',
                            'CodecSettings' => [
                                'Codec' => 'AAC',
                                'AacSettings' => [
                                    'AudioDescriptionBroadcasterMix' => 'NORMAL',
                                    'Bitrate' => 128000, // 128kbps audio bitrate
                                    'RateControlMode' => 'CBR',
                                    'CodecProfile' => 'LC',
                                    'CodingMode' => 'CODING_MODE_2_0', // Stereo (2 channels)
                                    'RawFormat' => 'NONE',
                                    'SampleRate' => 48000, // 48kHz sample rate maximum
                                    'Specification' => 'MPEG4',
                                ],
                            ],
                            'LanguageCodeControl' => 'FOLLOW_INPUT',
                        ],
                    ],
                ],
            ],
            'OutputGroupSettings' => [
                'Type' => 'FILE_GROUP_SETTINGS',
                'FileGroupSettings' => [
                    'Destination' => $Destination,
                    'MaxFileLength' => 900, // 15 minutes (in seconds) maximum
                    'MinFileLength' => 3, // 3 seconds minimum
                    'FileSizeLimit' => 300, // 300MB maximum file size
                ],
            ],
        ]);
    }
}