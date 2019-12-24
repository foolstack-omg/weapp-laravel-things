<?php
/**
 * Created by PhpStorm.
 * User: liuxiaofeng
 * Date: 2019-03-16
 * Time: 16:50
 */

namespace App\Http\Controllers\Api;


use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function me()
    {
        return $this->success(auth()->user());
    }

    public function user(Request $request)
    {
        $user = User::query()->select('name', 'avatar_url')->find($request->input('id'));

        return $this->success($user);
    }


}
