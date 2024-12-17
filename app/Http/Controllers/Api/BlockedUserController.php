<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\BlockedUser;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;
use App\Services\planOrderService;
use App\Http\Controllers\Controller;
use App\Services\blockedUserService;

class BlockedUserController extends Controller
{
    use jsonTrait;
//admin
    public  function getBlockedUsers()
    {
        $result = blockedUserService::getBlockedUsers();

        return response()->json(['message' => $result]);
    }
    public  function blockUser($id,Request $request)
    {

        $result = blockedUserService::blockUser($id,$request);

        return response()->json(['message' => $result]);
    }
    public  function disblockUser($id)
    {
        $result = blockedUserService::disblockUser($id);

        return response()->json(['message' => $result]);
    }

    public  function countBlockUser()
    {
        $result = blockedUserService::countBlockUser();

        return response()->json(['message' => $result]);
    }
}
