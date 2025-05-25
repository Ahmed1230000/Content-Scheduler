<?php


namespace App\Enums;

use BenSampo\Enum\Enum;

enum PlatformStatus: string
{
    case PENDING = 'pending';
    case SUCCESS = 'success';

    case FAILED = 'failed';
   
}
