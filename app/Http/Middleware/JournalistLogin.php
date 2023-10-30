<?php

namespace App\Http\Middleware;

use App\Enums\Users\UserTypeEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JournalistLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check() && auth()->user()->user_type === UserTypeEnum::JOURNALIST){
			return $next($request);
		}
		return to_route('journalist.login');
    }
}
