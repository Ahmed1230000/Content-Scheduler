<?php

namespace App\Repositories;

use App\Helpers\HandleError;
use App\Models\platform;
use Illuminate\Support\Facades\Auth;

class UserPlatformRepository
{
    use HandleError;
    public function userPlatform()
    {
        return $this->handleError(function () {
            return Auth::user()->platforms()->get();
        });
    }
    public function userNotHavePlatform()
    {
        return $this->handleError(function () {
            $user = Auth::user();

            return \App\Models\Platform::whereDoesntHave('users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })->get();
        });
    }

    public function subscribeToPlatform(array $data)
    {
        return $this->handleError(function () use ($data) {
            $user = Auth::user();
            foreach ($data['platforms'] as $platformId) {
                if ($user->platforms()->where('platform_id', $platformId)->exists()) {
                    throw new \Exception('You are already subscribed to platform id ' . $platformId);
                }
            }

            $user->platforms()->attach($data['platforms']);
            return true;
        });
    }

    public function unsubscribeFromPlatform(array $data)
    {
        return $this->handleError(function () use ($data) {
            $user = Auth::user();

            foreach ($data['platforms'] as $platfomrId) {
                $user->platforms()->detach($platfomrId);
                if (!$user->platforms()->where('platform_id', $platfomrId)->exists()) {
                    throw new \Exception('You are not subscribed to platform id ' . $platfomrId);
                }
            }
            return true;
        });
    }
}
