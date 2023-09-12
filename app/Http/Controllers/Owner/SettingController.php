<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class SettingController extends Controller
{
    public function index(){
        $user = Auth()->user();
        return view('owner.setting.index', [
            'title' => 'Setting akun saya',
            'user' => $user,
        ]);
    }

    public function update(Request $request){
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|min:3',
        ]);

        $user = Auth()->user(); 
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        
        return redirect()->route('owner.setting')->with('info','Data Berhasil di ubah');
    }

    public function updatePassword(Request $request){
    
        $userInputPassword= $request->passwordOld;
        $user = Auth()->user();
        $hashedPasswordFromDatabase = $user->password;
        if (password_verify($userInputPassword, $hashedPasswordFromDatabase)) {
            $user->update([
                'password' => bcrypt($request->password),
            ]);

            return redirect()->route('owner.setting')->with('info','Password Berhasil di ubah');
        } else {
            return redirect()->back()->with('danger','Maaf, Password tidak terdaftar');
        }
       
    }
}
