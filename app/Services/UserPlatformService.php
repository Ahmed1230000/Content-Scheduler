<?php

namespace App\Services;

use App\Helpers\FlashMessage;
use App\Repositories\UserPlatformRepository;

class UserPlatformService
{
    use FlashMessage;
    protected $userPlatformRepository;

    public function __construct(UserPlatformRepository $userPlatformRepository)
    {
        $this->userPlatformRepository = $userPlatformRepository;
    }

    public function userPlatform()
    {
        $userPlatform = $this->userPlatformRepository->userPlatform();

        if ($userPlatform) {
            $this->message('success', 'User platforms retrieved successfully.');
        } else {
            $this->message('error', 'Failed to retrieve user platforms.');
        }

        return $userPlatform;
    }

    public function userNoHavePlatform()
    {
        $userNoHavePlatform = $this->userPlatformRepository->userNotHavePlatform();

        if ($userNoHavePlatform) {
            $this->message('success', 'User without platforms retrieved successfully.');
        } else {
            $this->message('error', 'Failed to retrieve users without platforms.');
        }

        return $userNoHavePlatform;
    }

    public function subscribeToPlatform(array $data)
    {
        $result = $this->userPlatformRepository->subscribeToPlatform($data);

        if ($result) {
            $this->message('success', 'Subscribed to platform successfully.');
        } else {
            $this->message('error', 'Failed to subscribe to platform.');
        }

        return $result;
    }

    public function unsubscribeFromPlatform(array $data)
    {
        $result = $this->userPlatformRepository->unsubscribeFromPlatform($data);

        if ($result) {
            $this->message('success', 'Unsubscribed from platform successfully.');
        } else {
            $this->message('error', 'Failed to unsubscribe from platform.');
        }

        return $result;
    }
}
