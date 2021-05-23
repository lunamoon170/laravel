<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePass extends Controller
{
    public function CPassword(){
        return view('admin.body.change_password');
    }

    public function UpdatePassword(Request $request){
        $validateData=$request->validate([
            'old_password'=>'required',
            'password'=>'required|confirmed'
        ]);

        $hashedPassword=Auth::user()->password;
        if(Hash::check($request->old_password,$hashedPassword)){
            $user=User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('success','Password is change Successfully');
        }else{
            return redirect()->back()->with('error','Current Password is Invaid');
        }
    }
}
