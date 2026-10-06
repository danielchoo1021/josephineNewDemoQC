<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Agent;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * The guard that actually authenticated the current request.
     * Storefront accounts can be a Member (web guard / users table), an
     * Agent (agent guard / agents table), or a Merchant (merchant guard /
     * merchants table) - attemptLogin() below tries all three and records
     * here which one succeeded.
     *
     * @var string
     */
    protected $authGuardUsed = 'web';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard($this->authGuardUsed);
    }

    /**
     * Attempt to log the user in as a Member first, then as an Agent,
     * then as a Merchant.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);
        $remember = $request->filled('remember');

        if (Auth::guard('web')->attempt($credentials, $remember)) {
            $this->authGuardUsed = 'web';
            return true;
        }

        if (Auth::guard('agent')->attempt($credentials, $remember)) {
            $this->authGuardUsed = 'agent';
            return true;
        }

        if (Auth::guard('merchant')->attempt($credentials, $remember)) {
            $this->authGuardUsed = 'merchant';
            return true;
        }

        return false;
    }

    /**
     * Ensure only active accounts can attempt to authenticate.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    protected function credentials(Request $request)
    {
        return array_merge(
            $request->only($this->username(), 'password'),
            ['status' => '1']
        );
    }

    /**
     * An agent whose registration is still waiting for admin verification
     * (status 99) cannot log in yet. When the credentials are otherwise
     * correct, say so instead of the generic "Email / Password Invalid".
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $agent = Agent::where('email', strtolower($request->input($this->username())))->first();

        if (!empty($agent->id) && (string) $agent->status === '99' && Hash::check($request->input('password'), $agent->password)) {
            throw ValidationException::withMessages([
                'pending' => [__('Your account is still pending verification. You will be able to log in once it has been approved.')],
            ]);
        }

        return parent::sendFailedLoginResponse($request);
    }

    /**
     * Immediately logout users whose status changed between login attempts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return \Illuminate\Http\RedirectResponse|void
     */
    protected function authenticated(Request $request, $user)
    {
        if ((string) $user->status === '1') {
            return;
        }

        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->withErrors([
            'inactive' => __('Your account is inactive. Please contact support for assistance.'),
        ]);
    }
}
