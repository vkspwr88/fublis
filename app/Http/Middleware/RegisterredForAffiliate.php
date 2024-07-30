<?php

namespace App\Http\Middleware;

use App\Enums\Affiliates\ApplicationStatusEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegisterredForAffiliate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
		$user = auth()->user();
		$affRegistration = $user->affRegistration;
		if(!$affRegistration){
			return to_route('affiliate.register');
		}
		if($affRegistration->application_status === ApplicationStatusEnum::APPROVED){
			return $next($request);
		}
		return to_route('affiliate.register.status', ['affRegistration' => $affRegistration->id]);
    }
}
