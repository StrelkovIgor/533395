<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class CustomApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $time = Carbon::now();
        $time->addHours(48);
        $api_token = $request->header('Authorization') ?? $request->api_token;
        $has = User::where('api_token', $api_token)->where('updated_at', '<=', $time)->count();

        if(!$has){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
