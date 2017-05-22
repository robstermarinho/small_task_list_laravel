<?php
namespace App\Http\Middleware;

use Closure;
use Jrean\UserVerification\Exceptions\UserNotVerifiedException;
use Illuminate\Support\Facades\Auth;
class IsVerified
{

    public function handle($request, Closure $next)
    {
        if(! is_null($request->user()) && ! $request->user()->verified) {
            Auth::logout();
            return redirect('/login')->with(['warning' => "We've sent you an email. Please check your email to verify your account."]);
        }
        return $next($request);
    }
}
