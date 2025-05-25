<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeToPlatformFormRequest;
use App\Services\UserPlatformService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetUserPlatformController extends Controller
{
    protected $userPlatformService;

    public function __construct(UserPlatformService $userPlatformService)
    {
        $this->userPlatformService = $userPlatformService;
    }

    public function getUserPlatform(Request $request)
    {
        $userPlatforms = $this->userPlatformService->userPlatform();
        return view('userPlatforms.index', compact('userPlatforms'));
    }

    public function getNotHavePlatfrom(Request $request)
    {
        $userNoHavePlatform = $this->userPlatformService->userNoHavePlatform();
        return view('userPlatforms.noPlatforms', compact('userNoHavePlatform'));
    }


    public function subscribeToPlatform(SubscribeToPlatformFormRequest $request)
    {
        $result = $this->userPlatformService->subscribeToPlatform($request->validated());
        return redirect()->route('get.platform')->with('message', $result ? 'Subscribed to platform successfully.' : 'Failed to subscribe to platform.');
    }

    public function unsubscribeFromPlatform(SubscribeToPlatformFormRequest $request)
    {
        $result = $this->userPlatformService->unsubscribeFromPlatform($request->validated());
        return redirect()->route('user.platform')->with('message', $result ? 'Unsubscribed from platform successfully.' : 'Failed to unsubscribe from platform.');
    }
}
