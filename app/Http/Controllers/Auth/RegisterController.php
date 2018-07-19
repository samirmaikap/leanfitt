<?php

namespace App\Http\Controllers\Auth;

use App\Services\OrganizationService;
use App\Services\UserService;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Validators\UserValidator;
use function bcrypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    protected $userService;
    protected $organizationService;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/organizations/create';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userService, OrganizationService $organizationService)
    {
        $this->middleware('guest');
        $this->userService = $userService;
        $this->organizationService = $organizationService;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

//        return new UserValidator($data, 'create');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

    // Override method
   protected function registered(Request $request, $user)
   {
       // $this->organizationService->create($request->only(['organization']));
        session(['user' => $user]);
        return redirect($this->redirectTo);
   }
}
