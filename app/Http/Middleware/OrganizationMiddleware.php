<?php

namespace App\Http\Middleware;

use App\Repositories\OrganizationRepository;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrganizationMiddleware
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

        if (!auth()->check())
        {
            return redirect(config('app.url') . '/login');
        }

        $subdomain = $request->route()->parameter('organization');

        $organizationRepository = new OrganizationRepository();
        $organization = $organizationRepository->where('subdomain', '=', $subdomain)->first();

        // Set Organization to session for global access
        session(['organization' => $organization]);
        $orgUser=auth()->user()->userOrganization->where('organization_id',$organization->id)->first();

        // First unset this domain group parameter 'organization'
        // Set it back again to the new value
        // This way controllers will be able receive parameters from the routes in the same order they are defined in the routes
        $request->route()->forgetParameter('organization');
        $request->route()->setParameter('organization', $organization);

        $subscribed=$organization->subscribed('main');
        if(!$subscribed){
            session()->put(['not_accessible'=>'subscription']);
            return redirect(url('users').'/'.$orgUser->user_id.'/profile');
        }

        if($orgUser->is_suspended==1){
            session()->put(['not_accessible'=>'suspended']);
            return redirect(url('users').'/'.$orgUser->user_id.'/profile');
        }

        if($orgUser->is_invited==1){
            session()->put(['not_accessible'=>'invited']);
            return redirect(url('users').'/'.$orgUser->user_id.'/profile');
        }

        session()->forget('not_accessible');

        return $next($request);
    }
}
