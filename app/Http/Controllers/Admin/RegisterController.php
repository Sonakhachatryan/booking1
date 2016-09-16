<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Restaurant;
use Carbon\Carbon;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
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

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = 'admin/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */

    public function showRegistrationForm()
    {
        if (!auth('admin')->check())
            return view('admin.register');
        return back();
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
            'deleted_at' => Carbon::now(),
        ]);
    }

    public function register(Request $request)
    {
        if (auth('admin')->check())
            return back();

        $this->validate($request,[
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:admins',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        $admin = $this->create($request->all());

        Restaurant::create([
            'name' => 'restaurant',
            'address' => 'Your address.',
            'longitude' => '0.0',
            'latitude' => '0.0',
            'country_id' => 1,
            'city_id' => 1,
            'avatar' => 'logo.png',
            'email' => 'jondoe@somemail.com',
            'phone' => '123456',
            'working_hours' => '00:00-00:00',
            'admin_id' => $admin->id,
        ]);
        
        if ($admin)
           dd('Wait admin approve.');
        else
            return redirect('admin/register');
    }

}
