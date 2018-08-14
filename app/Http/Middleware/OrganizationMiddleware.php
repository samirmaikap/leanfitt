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
        $orgUser=auth()->user()->userOrganization->where('organization_id',$organization->id)->first();
        if(isset($orgUser->user_id)){
            $organization['user_id']=$orgUser->user_id;
        }

        session(['organization' => $organization]);

        $roleRepo=new \App\Repositories\RoleRepository();
        $currentRoles=$roleRepo->currentRoles($orgUser->organization_id,$orgUser->user_id);
        $currentRole=$currentRoles->first();
        // First unset this domain group parameter 'organization'
        // Set it back again to the new value
        // This way controllers will be able receive parameters from the routes in the same order they are defined in the routes
        $request->route()->forgetParameter('organization');
        $request->route()->setParameter('organization', $organization);

        session()->forget('currentRole');
        session()->put('currentRole',$currentRole);

        session()->forget('is_admin');
        session()->put('is_admin',in_array('Admin',$currentRoles->pluck('name')->toArray()));

        session()->put('organization_user',$orgUser);

        return $next($request);
    }
}
