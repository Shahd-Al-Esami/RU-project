<?php

namespace App\Services;

use App\Models\User;
use App\Models\BlockedUser;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;

class blockedUserService
{

use jsonTrait;
//admin
public static function getBlockedUsers()
{
    $blockedUsers = BlockedUser::with('user')->get();
    return jsonTrait::jsonResponse(200, 'Blocked users', $blockedUsers);
}
public static function countBlockUser(){
    $BlockedUser=BlockedUser::all();
    $countBlockedUser=count($BlockedUser);

    return jsonTrait::jsonResponse(200, 'Blocked users', $countBlockedUser);

}

public static function blockUser($id,Request $request)
{
    $user = User::findOrFail($id);
    $user->blocked = true;
    $user->save();

    $blockedUser = BlockedUser::create(['user_id' => $user->id]);

    if ($request->reason) {
        $blockedUser->reason = $request->reason;
        $blockedUser->save();
    }

    return jsonTrait::jsonResponse(200, 'blocked successfuly', null);
}
public static function disblockUser($id)
{
    $user = User::findOrFail($id);
    $user->blocked = false;
    $user->save();

    $userblock=BlockedUser::where('user_id',$id)->first();
    $userblock->delete();

    return jsonTrait::jsonResponse(200, ' disblocked successfuly.', null);
}
}
