<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use function config;
use function count;
use function dd;
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
        session(['user' => $user]);
        $relatedOrganizations = $this->userService->getRelatedOrganization($user);
//        $defaultOrganization = $this->userService->getDefaultOrganization($user);

        if(count($relatedOrganizations))
        {
            // Set related organizations for switching between organizations
            session(['relatedOrganizations' => $relatedOrganizations]);

            // Redirect to first related organization
            $url = 'http://' . $relatedOrganizations[0]->subdomain . "." . $request->getHost() . $this->redirectTo;
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
        return redirect()->route('login');
    }

    public function unauthorized()
    {
        return view('errors.403');
    }
}
