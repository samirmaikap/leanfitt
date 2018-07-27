<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class HasSubscription
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
        $subscribed=session('organization')->subscribed('main');
        if(!$subscribed){
            return redirect('abort');
        }

        Log::info('Cheking....');

        return $next($request);
    }
}
