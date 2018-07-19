<?php

namespace App\Http\Middleware;

use App\Repositories\OrganizationRepository;
use Closure;

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

        // First unset this domain group parameter 'organization'
        // Set it back again to the new value
        // This way controllers will be able receive parameters from the routes in the same order they are defined in the routes
        $request->route()->forgetParameter('organization');
        $request->route()->setParameter('organization', $organization);

        return $next($request);
    }
}
