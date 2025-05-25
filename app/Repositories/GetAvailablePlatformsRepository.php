<?php

namespace App\Repositories;

use App\Helpers\HandleError;
use App\Models\platform;
use Illuminate\Pagination\LengthAwarePaginator;

class GetAvailablePlatformsRepository
{
    use HandleError;

    /**
     * Get the available platforms.
     *
     * @return LengthAwarePaginator
     */
    public function getPlatforms(): LengthAwarePaginator
    {
        // Assuming you have a Platform model to fetch platforms from the database
        return $this->handleError(function () {
            return platform::paginate(5);
        });
    }
}
