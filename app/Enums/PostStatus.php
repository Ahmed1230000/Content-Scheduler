<?php


namespace App\Enums;

use BenSampo\Enum\Enum;

enum PostStatus: string
{
    case Draft = 'draft';
    case Scheduled = 'scheduled';
    case Published = 'published';

}