<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function index(){
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('error', 'Email atau password salah!');
    }

    public function register(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|email:rfc,dns',
            'password' => 'required|min:8',
        ]);
        //if user exist
        if(User::where('email', $validatedData['email'])->first()){
            return redirect('/register')->with('error', 'Pengguna telah terdaftar!');
        }
        $validatedData['password'] = bcrypt($validatedData['password']);
        User::create($validatedData);
        return redirect('/login')->with('success', 'Registrasi Sukses, silahkan login kembali!');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $this->middleware('guest')->except('logout');
        return redirect('/');
    }

}
