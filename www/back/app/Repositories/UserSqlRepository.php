<?php


namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSqlRepository implements UserRepositoryInterface
{

    public function login($request)
    {
        // TODO: Implement login() method.
        $user = User::where('email', $request->email)->first();
        if($user){
            $checkPassword = Hash::check($request->password, $user->password);
            if($checkPassword){
                $user->api_token = Str::random(80);
                $user->save();

                return $user->api_token;
            }
        }

        return null;
    }
}
