<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
//    protected function validator(array $data)
//    {
//        return Validator::make($data, [
//            'name' => 'required|max:255',
//            'email' => 'required|email|max:255|unique:users',
//            'password' => 'required|confirmed|min:6',
//            'terms' => 'required',
//        ]);
//    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
//    protected function create(array $data)
//    {
//        return User::create([
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'password' => bcrypt($data['password']),
//        ]);
//    }


public function showRegistrationForm()
{
    if(auth('user')->check())
        return redirect('/home');
    return view('auth.register');
}


    public function login(Request $request)
    {
        $this->validateLoginRequest($request);

        $role = $request->role;

        $remember = $request->remember ? true : false;

        if(!auth($role)->check())
        {
            $role == 'admin' ? $username = 'email' : $username = 'username';
            $attempt = auth($role)->attempt([$username => $request->$username, 'password' => $request->password],$remember);

            if( $attempt )
            {
                session(['role' => $role]);
                $role == 'admin' ? $rdrUrl = 'admin/home' : $rdrUrl ='/home';
                return redirect($rdrUrl);
            }
            else
            {
                return back();
            }
        }
        else
        {
            return back();
        }
    }

    public function showAdminLoginForm()
    {
        if(auth('admin')->check())
            return redirect('admin/home');
        return view('admin.login');
    }

    public function showLoginForm()
    {
        if(auth('user')->check())
            return redirect('/home');
        return view('auth.login');
    }

    public function validateLoginRequest(Request $request)
    {
        $role = $request->role;
        if($role == 'admin')
            return $this->validate($request,[
                'email' =>'required|email',
                'password' => 'required'
            ]);
        else
            return $this->validate($request,[
                'username' =>'required',
                'password' => 'required'
            ]);
    }


    public function logout(Request $request)
    {
        $role = $request->role;
        auth($role)->logout();
        $request->session()->forget($role);
        $rdrUri = $role == 'admin' ? 'admin/login' : '/' ;
        return redirect($rdrUri);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users,email,NULL,id,provider,NULL',
            'password' => 'required|min:6',
            'avatar' => 'required|image',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        $destinationPath = 'images/users'; // upload path
        $extension = $data['avatar']->getClientOriginalExtension(); // getting image extension
        $fileName = strtotime(Carbon::now()) . '.' . $extension; // renameing image
        $data['avatar']->move($destinationPath, $fileName); // uploading file to given path
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'avatar' => $fileName,
        ]);

        if (!$user) {
            if (file_exists($destinationPath . "/" . $fileName)) {
                unlink($destinationPath . "/" . $fileName);
            }
            return false;
        }

        return $user;
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $user =  $this->create($request->all());
        auth('user')->login($user);
        return redirect($this->redirectPath());
    }
}
