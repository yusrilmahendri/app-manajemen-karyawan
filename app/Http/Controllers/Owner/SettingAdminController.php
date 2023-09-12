<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class SettingAdminController extends Controller
{
    public function index(){
        return view('owner.settingAdmin.index');
    }

    public function show($id){
        $user = User::findOrFail($id);
        return view('owner.settingAdmin.show', compact('user'));
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('owner.settingAdmin.edit', compact('user'));
    }
    public function update(Request $request,$id){
        $this->validate($request, [
            'name'  => 'required|min:3',
        ]);

        $userInputPassword= $request->passwordOld;
        $user = User::findOrFail($id);
        $hashedPasswordFromDatabase = $user->password;
        if (password_verify($userInputPassword, $hashedPasswordFromDatabase)) {
            $user->update([
                'name' => $request->name,
                'password' => bcrypt($request->password),
            ]);

            return redirect()->route('owner.setting.admin')->with('info','Data Berhasil diubah');
        }
        else{
            return redirect()->back()->with('danger','Password Salah');
        }
    }
}
