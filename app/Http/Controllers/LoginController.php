<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function postlogin(Request $request)
    {
        if ($request->has('email') && $request->has('password')) {
            $credentials = [
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ];
    
            $user = User::where('email', $request->input('email'))->first();
            if (Auth::attempt($credentials)) {
                if ($user->level == 'admin') {
                    return redirect('/index');
                } elseif ($user->level == 'guru') {
                    return redirect('/guru');
                } elseif ($user->level == 'siswa') {
                    return redirect('/profilsiswa');
                } elseif ($user->level == 'wali_kelas') {
                    return redirect('/profilwalas');
                }
            }
            if ($user) {
                return redirect('/login')->with('error', 'Password salah.');
            } else {
                return redirect('/login')->with('error', 'NISN/NIP tidak terdaftar.');
            }
        }
        return back()->with('error', 'NISN/NIP dan Password harus diisi.');
    }

    public function logout(Request $request){
        auth::logout();
        return redirect('login');
    }
    
}
