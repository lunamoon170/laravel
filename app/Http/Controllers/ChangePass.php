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

    public function PUpdate(){
        if(Auth::user()){
            $user=User::find(Auth::user()->id);
            if($user){
                return view('admin.body.update_profile',compact('user'));
            }
        }
    }

    public function UpdateProfile(Request $request){
        $user = User::find(Auth::user()->id);
        if($user){
            $user->name=$request['name'];
            $user->email=$request['email'];
            $user->save();
            return Redirect()->back()->with('success','User Profile Is update Successfully');
        }else {
            return Redirect()->back();
        }
    }
    public function UserStore(Request $request){
        User::insert([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return Redirect()->route('register')->with('success','User Inserted Succefully');
    }
}
