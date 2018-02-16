<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Auth;

class Authantication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    { 
        $user = User::findOrFail(Auth::id());
        if($user->is_verified == 0)
        {
             Auth::logout();
             session()->flash('login_again','Verify Your Account' .'   '.$user->name);
            return redirect('login');
        }
        else
        {
          return  $next($request);
        }
     // return Auth::onceBasic('email') ?: $next($request);
    }
}
