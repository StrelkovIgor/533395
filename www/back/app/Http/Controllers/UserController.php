<?php

namespace App\Http\Controllers;


use App\Repositories\UserSqlRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function login(Request $request, UserSqlRepository $userRepository)
    {
        $token = $userRepository->login($request);
        return response()->json([
            'api_token' => $token
        ]);
    }

}
