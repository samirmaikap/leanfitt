<?php

namespace App\Http\Middleware;

use Closure;

class HasAcessToOrganization
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
        if(session()->has('not_accessible')){
            if(session()->get('not_accessible')=='invited')
                return redirect(url('abort/invited'));
            elseif(session()->get('not_accessible')=='subscription')
                return redirect(url('abort/subscription'));
            else
                return redirect(url('abort/suspend'));
        }

        return $next($request);
    }
}
