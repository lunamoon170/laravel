<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use App\Models\Multipic;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;


class BrandController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function Allbrand(){
        $brands=Brand::latest()->paginate(5);
        return view('admin.brand.index',compact('brands'));
    }

    public function StoreBrand(Request $request ){
        $validatedData = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpeg,jpg,png',
        ],
        [
            'brand_name.required' => 'Please Input Brand Name',
            'brand_image.min'=>'Brand longer than 4 characters',
        ] );

         $brand_image =$request->file('brand_image');
        // $name_gen = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name=$name_gen.'.'.$img_ext;
        // $up_location='image/brand/';
        // $last_img=$up_location.$img_name;
        // $brand_image->move($up_location,$img_name);


        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);

        $last_img='image/brand/'.$name_gen;


//eloquent insert

    Brand::insert([
            'brand_name'=>$request->brand_name,
            'brand_image'=>$last_img,
            'created_at'=>Carbon::now()
   ]);

     $notification=array(
         'message'=>'Brand Inserted Successfully',
         'alert-type'=>'success'
     );

     return Redirect()->back()->with($notification);
    }

    public function Edit($id){
        $brands=Brand::find($id);
        return view('admin.brand.edit',compact('brands'));

    }

    public function Update(Request $request,$id){
        $validatedData = $request->validate([
            'brand_name' => 'required|min:4',
        ],
        [
            'brand_name.required' => 'Please Input Brand Name',
            'brand_image.min'=>'Brand longer than 4 characters',
        ] );

        $old_image= $request->old_image;
        $brand_image =$request->file('brand_image');

        if($brand_image){
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name=$name_gen.'.'.$img_ext;
        $up_location='image/brand/';
        $last_img=$up_location.$img_name;
        $brand_image->move($up_location,$img_name);

        //eloquent insert
        unlink($old_image);
        Brand::find($id)->update([
        'brand_name'=>$request->brand_name,
        'brand_image'=>$last_img,
        'created_at'=>Carbon::now()
        ]);

        $notification=array(
            'message'=>'Brand Updated Successfully',
            'alert-type'=>'info'
        );

     return Redirect()->back()->with($notification);

        }else{
            Brand::find($id)->update([
                'brand_name'=>$request->brand_name,
                'created_at'=>Carbon::now()
                ]);

                $notification=array(
                    'message'=>'Brand Updated Successfully',
                    'alert-type'=>'warning'
                );
             return Redirect()->back()->with($notification);
        }

    }

    public function Delete($id){
        $image=Brand::find($id);
        $old_image=$image->brand_image;
        unlink($old_image);
        Brand::find($id)->delete();
        $notification=array(
            'message'=>'Brand Deleted Successfully',
            'alert-type'=>'warning'
        );
        return Redirect()->back()->with($notification);
    }

    /// This is  for Multi Image All Methods

    public function Multipic(){
        $image=Multipic::all();
        return view('admin.multipic.index',compact('image'));
    }

    public function StoreImg(Request $request){
     $image=$request->file('image');

        foreach($image as $multi_img){
            $name_gen = hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();
            Image::make($multi_img)->resize(300,200)->save('image/multi/'.$name_gen);

            $last_img='image/multi/'.$name_gen;

            Multipic::insert([
                'image'=>$last_img,
                'created_at'=>Carbon::now()
       ]);
     }
     return Redirect()->back()->with('success','Multi Image Inserted Successful');
    }

    public function Logout(){
        Auth::logout();
        return Redirect()->route('login')->with('success','User Logout');
    }
}


