<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Konseling_bk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function loginApi(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password'=> 'required',
        ]);

        $user = User::with('siswa')->where('email', $request->email)->first();

        if($user!='[]' && Hash::check($request->password,$user->password)){
            $token = $user->createToken('siswa_token')->plainTextToken;
            $siswa_id = $user->siswa;
            $response=['status'=>200,'token'=>$token,'user'=>$user,'message'=>'login berhasil!', 'relasi' => $siswa_id->id];
            return response()->json($response);
        }
    }

    public function jadwalApi(Request $request){
        $jadwals = Konseling_bk::with('siswa', 'guru', 'layanan_bk', 'wali_kelas')->where('siswa_id', $request->id)->get();
        if ($jadwals->isEmpty()) {
                    return response()->json(['message' => 'No jadwals found for this user']);
                }else{
                    return response()->json(['message' => 'Success', 'data' => $jadwals]);
                }
       }
}