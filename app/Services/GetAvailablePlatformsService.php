<?php

namespace App\Services;

use App\Helpers\FlashMessage;
use App\Repositories\GetAvailablePlatformsRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class GetAvailablePlatformsService
{
    use FlashMessage;
    protected $getAvailablePlatformsRepository;

    public function __construct(GetAvailablePlatformsRepository $getAvailablePlatformsRepository)
    {
        $this->getAvailablePlatformsRepository = $getAvailablePlatformsRepository;
    }

    /**
     * Get the available platforms.
     *
     * @return array
     */
    public function getPlatforms(): LengthAwarePaginator
    {
        $getAvailablePlatforms =  $this->getAvailablePlatformsRepository->getPlatforms();

        if ($getAvailablePlatforms) {
            $this->message('success', 'Available platforms retrieved successfully.');
        } else {
            $this->message('error', 'Failed to retrieve available platforms.');
        }
        return $getAvailablePlatforms;
    }
}
