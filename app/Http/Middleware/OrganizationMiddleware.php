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
        $request->route()->forgetParameter('organization');;

        $host = explode('.', $request->getHost());
        $subdomain = $host[0];
        $domain = $host[1];
        $extension = $host[2];

        if (!auth()->check())
        {
            return redirect('http://' . $domain . "." . $extension . '/login');
        }

        $organizationRepository = new OrganizationRepository();
        $organization = $organizationRepository->where('subdomain', '=', $subdomain)->first();


        // Set Organization Identifier for global access
        session(['organization' => $organization]);
//        $request->route()->setParameter('organization', $organization);

//        $request->route()->forgetParameter('domain');

        return $next($request);
    }
}
