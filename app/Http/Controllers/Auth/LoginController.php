<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use App\Models\Permission;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // public function login(Request $request) 
    // {
    //     $data = $request->all();
    //     $user = User::where('email', $data['email'])->first();
    //     // echo $user->id;
    //     $user_role = $user->role->id; //lay ra id cua role
    //     // echo $user_role;
    //     // dd($user_role);
    //     $user_permisssions = $user->role->permissions;
    //     // dd($user_permisssions);
    //     $permissions = Permission::all();
    //     foreach ($user_permisssions as $key => $user_permisssion) {
    //         Gate::define($permission->code, function($user) use ($permission){
    //             // $user_permisssions = $user->role->permissions;
    //         dd($user_permisssion->pivot->role_id);
    //             foreach ($permissions as $key => $permission) {
    //                 if ($permission->name == $user_permisssion->code) {
    //                     return $permission->code == $user_permisssion->code;
    //                 }
    //             }
    //             // echo $permission->name;
    //     }
    // }
}
