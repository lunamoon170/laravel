<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeAbout;
use App\Models\Multipic;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function HomeAbout(){
        $homeabout=HomeAbout::latest()->get();
        return view('admin.home.index',compact('homeabout'));
    }

    public function AddAbout(){
        return view('admin.home.create');
    }

    public function StoreAbout(Request $request){
        HomeAbout::insert([
            'title'=>$request->title,
            'short_dis'=>$request->short_dis,
            'long_dis'=>$request->long_dis,
            'created_at'=>Carbon::now()
        ]);

        return Redirect()->route('home.about')->with('success','About Inserted Succefully');
    }

    public function EditAbout($id){
        $homeabout=HomeAbout::find($id);
        return view('admin.home.edit',compact('homeabout'));
    }

    public function UpdateAbout(Request $request,$id){
        $update=HomeAbout::find($id)->update([
            'title'=>$request->title,
            'short_dis'=>$request->short_dis,
            'long_dis'=>$request->long_dis,
        ]);

        return Redirect()->route('home.about')->with('success','About Update Succefully');
    }

    public function Deleteabout($id){
        $delete=HomeAbout::find($id)->Delete();
        return Redirect()->back()->with('success','About Delete Succefully');
    }

    public function Portfolio(){
        $images=Multipic::all();
        return view('pages.portfolio',compact('images'));
    }
}
