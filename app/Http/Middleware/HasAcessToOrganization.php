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

        $organization_user=session()->get('organization_user');
        $user_id=session()->get('user')->id;
        $subscribed=session()->get('organization')->subscribed('main');
        if(!$subscribed){
            session()->put('not_accessible',true);
            if(isAdmin()){
                return redirect(url('organizations').'/'.$organization_user->id.'/view');
            }
            else{
                return redirect(url('users').'/'.$user_id.'/profile');
            }
        }

        if($organization_user->is_suspended==1){
            session()->put('not_accessible',true);
            return redirect(url('users').'/'.$user_id.'/profile');
        }

        if($organization_user->is_invited==1){
            session()->put('not_accessible',true);
            return redirect(url('users').'/'.$user_id.'/profile');
        }

        session()->forget('not_accessible');
        return $next($request);
    }
}
