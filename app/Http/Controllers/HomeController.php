<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function HomeSlider(){
        $sliders=Slider::latest()->get();
        return view('admin.slider.index',compact('sliders'));
    }

    public function AddSlider(){
        return view('admin.slider.create');
    }

    public function StoreSlider(Request $request){
        $slider_image =$request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920,1088)->save('image/slider/'.$name_gen);

        $last_img='image/slider/'.$name_gen;

        Slider::insert([
            'title'=>$request->title,
            'description'=>$request->description,
            'image'=>$last_img,
            'created_at'=>Carbon::now()
        ]);


     return Redirect()->route('home.slider')->with('success','Slider Inserted Successful');
    }

    public function Edit($id){
        $sliders =Slider::find($id);
        // $categories = DB::table('categories')->where('id',$id)->first();
        return view('admin.slider.edit',compact('sliders'));
    }

    public function Update(Request $request,$id){

        $old_image= $request->old_image;
        $slider_image =$request->file('image');


        if($slider_image ){
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($slider_image ->getClientOriginalExtension());
        $img_name=$name_gen.'.'.$img_ext;
        $up_location='image/slider/';
        $last_img=$up_location.$img_name;
        $slider_image ->move($up_location,$img_name);

        //eloquent insert
        unlink($old_image);
        Slider::find($id)->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'image'=>$last_img,
            'created_at'=>Carbon::now()
        ]);

     return Redirect()->route('home.slider')->with('success','Slider Updated Successful');

        }else{
            Slider::find($id)->update([
                'title'=>$request->title,
                'description'=>$request->description,
                'created_at'=>Carbon::now()
                ]);

             return Redirect()->route('home.slider')->with('success','Slider Updated Successful');
        }

    }

}
