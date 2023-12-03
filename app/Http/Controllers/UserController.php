<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function settings(){
        $user = User::findOrFail(auth()->user()->id);
        return view('dashboard.setting.index', [
            'title' => 'Setting',
            'active' => 'setting',
            'user' => $user,
        ]);
    }
    
    public function update(Request $request){
        $user = User::findOrFail(auth()->user()->id);
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $user->update($validatedData);
        return redirect('/dashboard')->with('success', 'Profil berhasil diubah');
    }

    public function updatePassword(Request $request){
        $user = User::findOrFail(auth()->user()->id);
        $validatedData = $request->validate([
            'Oldpassword' => 'required',
            'Newpassword' => 'required',
        ]);
        // check old password
        if(password_verify($validatedData['Oldpassword'], $user->password)){
            $user->update([
                'password' => Hash::make($validatedData['Newpassword'])
            ]);
            return redirect('/dashboard')->with('success', 'Password berhasil diubah');
        }else{
            return redirect('/dashboard/settings')->with('error', 'Password lama salah');
        }
    }
}
