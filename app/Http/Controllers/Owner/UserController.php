<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profesi;

class UserController extends Controller
{
    public function index(){
        return view('owner.pengguna.index', [
            'title' => 'Data Pengguna',
         ]);
    }

    public function create(){
        $profesis = Profesi::orderBy('name', 'ASC')->get();
        return view('owner.pengguna.create', [
            'title' => 'Tambah Pengguna',
            'profesis' => $profesis,
         ]);
    }

    public function show($id){
        $user = User::with('profesis')->find($id);
        return view('owner.pengguna.show', [
            'user' => $user,
            'title' => 'Detail Informasi Data Pengguna'
        ]);
    }
    

    public function store(Request $request){

        $this->validate($request, [
            'name' => 'required|string|max:255|min:3',
            'email' => 'nullable|unique:users,email',
            'password' => 'required|min:6',
        ]);


        $user = User::create([
            'role' => 'user',
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
     
         // Attach professions to the user
         $user->profesis()->attach($request->profesi_id);

         return redirect()->route('owner.users')->with('success', 'Berhasil di Daftarkan!');
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('owner.pengguna.edit', [
            'user' => $user,
            'title' => 'Detail Informasi Data Pengguna'
        ]);
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

            return redirect()->route('owner.users')->with('info','Data Berhasil diubah');
        }
        else{
            return redirect()->back()->with('danger','Password Salah');
        }
    }

    public function destroy($id){
       $user = User::findOrFail($id);
       $user->delete();
       return redirect()->route('owner.users')->with('danger',' Data Berhasil Di Hapuskan');
    }
}
