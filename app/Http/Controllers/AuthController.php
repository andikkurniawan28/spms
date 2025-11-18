<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view("login");
    }

    // public function register(){
    //     $role = Role::where("id", ">", 6)->get();
    //     return view("auth.register", compact("role"));
    // }

    public function changePassword(){
        return view("auth.change_password");
    }

    public function loginProcess(Request $request){
        $attempt = Auth::attempt([
            "username" => $request->username,
            "password" => $request->password,
            "is_active" => 1,
        ]);
        if($attempt){
            $request->session()->regenerate();
            return redirect()->intended();
        }
        else {
            return redirect("login")->with("error", "Username / password wrong.");
        }
    }

    // public function registerProcess(Request $request){
    //     $password = bcrypt($request->password);
    //     $request->request->add(["password" => $password]);
    //     User::create($request->all());
    //     return redirect()->route("login");
    // }

    public function changePasswordProcess(Request $request){
        if($request->password == $request->password2){
            User::whereId(Auth()->user()->id)->update(["password" => bcrypt($request->password)]);
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect("login");
        } else {
            return redirect()->back();
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("login");
    }
}
