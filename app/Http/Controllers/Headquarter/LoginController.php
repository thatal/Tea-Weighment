<?php

namespace App\Http\Controllers\Headquarter;

use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator;

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
    protected $redirectTo = "/headquarter/dashboard";
    protected $role = "headquarter";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('headquarter.guest')->except('logout', "changePassword", "changePasswordPost");
    }
    public function getForm()
    {
        return view("headquarter.login");
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return [
            $this->username() => $request->username,
            'password'=> $request->password,
            "role" => $this->role
        ];
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }
        /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $this->loggedOut($request) ?: redirect('/');
    }

    public function changePassword()
    {
        return view("headquarter.change-password");
    }
    public function changePasswordPost()
    {
        $validator = Validator::make(request()->all(), $this->changePassRules());
        if($validator->fails()){
            return redirect()
                ->back()
                ->with("error", "Please fix the issues and try again later.")
                ->withInput(request()->all())
                ->withErrors($validator);
        }
        $headquarter = auth()->user();
        if(Hash::check(request("password"), $headquarter->password)){
            return redirect()
                ->back()
                ->with("error", "Current Password does not matched.");
        }
        try {
            $headquarter->password = bcrypt(request("password"));
            $headquarter->save();
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with("error", "Whoops! something went wrong try again later.");
        }
        return redirect()
            ->back()
            ->with("success", "Password Successfully changed.");
    }

    private function changePassRules()
    {
        return [
            "current_password"  => "required",
            "password"          => "required|confirmed"
        ];
    }
}
