<?php


namespace App\Enums;

use BenSampo\Enum\Enum;

enum PlatformType: string
{
    case TWITTER = 'twitter';
    case INSTAGRAM = 'instagram';
    case LINKEDIN = 'linkedin';
}
