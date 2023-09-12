<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function authentication(Request $request)
    {
            $credentials = $request->only('email', 'password');
            
            if (auth()->attempt($credentials)) {
                $user = auth()->user();
                if ($user->role == 'admin') {
                    return redirect()->route('admin.dashboard');
                } elseif ($user->role == 'owner') {
                    return redirect()->route('owner.dashboard');
                } elseif ($user->role == 'user') {
                    return redirect()->route('user.dashboard');
                }
            } elseif (auth()->attempt(['name' => $credentials['email'], 'password' => $credentials['password']])) {
                $user = auth()->user();
                if ($user->role == 'admin') {
                    return redirect()->route('admin.dashboard');
                } elseif ($user->role == 'owner') {
                    return redirect()->route('owner.dashboard');
                } elseif ($user->role == 'user') {
                    return redirect()->route('user.dashboard');
                }
            }

            return redirect()->route('auth.login')->with('error', 'Invalid email, name, or password');
        }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

}
