<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';
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

    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required','min:8']
        ]);

        // if(Auth::attempt($credentials)){
        //     $request->session()->regenerate();
        // }
        // return back()->with('loginError','Login Failed!');

        // if($user->roles->role=='admin'){
        //     return redirect()->route('dashboard');
        // }
        //     elseif ($user->roles->role=='sales'){
        //         return redirect()->route('dasboard.sales');
        //     }
        //         elseif ($user->roles->role=='pegawai toko'){
        //             return redirect()->route('dasboard.pegawai-toko');
        //         }
        //             elseif {
        //                 return back()->with('loginError','Login Failed!');
        //             }
        //             else{
        //                 return abort(403);
        //             }

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }
            return back()->with('loginError','Login Failed!');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');

    }


}
