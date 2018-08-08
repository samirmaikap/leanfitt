<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use function config;
use function count;
use function dd;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use function redirect;
use function session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        logout as performLogout;
    }

    protected $userService;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->middleware('guest')->except('logout');
        $this->userService = $userService;
    }

    // Override method
    //
    protected function authenticated(Request $request, $user)
    {
        $superadmin=auth()->user()->is_superadmin;
        session([
            'user' =>renderCollection(collect($user)->except(['verification_token','password'])),
            'is_superadmin'=>$superadmin,
        ]);

        if($superadmin==1){
            return redirect(url('dashboard'));
        }

        $relatedOrganizations = $this->userService->getRelatedOrganization(auth()->user()->id);

        if(count($relatedOrganizations))
        {
            // Set related organizations for switching between organizations
            session(['relatedOrganizations' => $relatedOrganizations]);

            // Redirect to first related organization
            $url = 'http://' . $relatedOrganizations[0]->subdomain  . config('session.domain') . $this->redirectTo;
        }
        else
        {
            // User does not have any related organizations
            // Redirect to create organization page
            $url = config('app.url') . '/organizations/create';
        }
        return redirect($url);
    }

    public function logout(Request $request)
    {
        $this->performLogout($request);
        return redirect()->intended(config('app.url').'/login');
    }

    public function unauthorized()
    {
        return view('errors.403');
    }
}
