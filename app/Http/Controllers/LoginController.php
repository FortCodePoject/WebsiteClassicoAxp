<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function loginview(){
        return view("login");
    }

    public function login(Request $request){
        $credentials = $this->validate($request, [
            "email" => ["required"],
            "password" => ["required"]
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()-> role == "Administrador") {
                return redirect()->route("admin.index");
            }if (Auth::user()-> role == "SuperAdmin") {
                return redirect()->route("super.admin.index");
            }
        }else{
            return redirect()->back()->with('error', 'Credenciais Incorretas');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route("anuncio.login.view");
    }
}
