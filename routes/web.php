<?php

use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangePass;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\DB;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $brands=DB::table('brands')->get();
    $abouts=DB::table('home_abouts')->first();
    $images=DB::table('multipics')->get();
    $contacts=DB::table('contacts')->get();
    return view('home',compact('brands','abouts','images','contacts'));
});

Route::get('/contact-asdfa-adsc',[ContactController::class,'index'])->name('con');

//category route
Route::get('/category/all',[CategoryController::class,'Allcat'])->name('all.category');

Route::post('/category/add',[CategoryController::class,'Addcat'])->name('store.category');

Route::get('/category/edit/{id}',[CategoryController::class,'Edit']);

Route::post('/category/update/{id}',[CategoryController::class,'Update']);

Route::get('/softDelete/category/{id}',[CategoryController::class,'SoftDelete']);

Route::get('/category/restore/{id}',[CategoryController::class,'Restore']);

Route::get('pdelete/category/{id}',[CategoryController::class,'Pdelete']);

//brand route
Route::get('/brand/all',[BrandController::class,'AllBrand'])->name('all.brand');

Route::post('/brand/add',[BrandController::class,'StoreBrand'])->name('store.brand');

Route::get('/brand/edit/{id}',[BrandController::class,'Edit']);

Route::post('/brand/update/{id}',[BrandController::class,'Update']);

Route::get('/brand/delete/{id}',[BrandController::class,'Delete']);

//Multi Image Route
Route::get('/multi/image',[BrandController::class,'Multipic'])->name('multi.image');

Route::post('/multi/add',[BrandController::class,'StoreImg'])->name('store.image');

//Admin all route
Route::get('/home/slider',[HomeController::class,'HomeSlider'])->name('home.slider');
Route::get('/add/slider',[HomeController::class,'AddSlider'])->name('add.slider');
Route::post('/store/slider',[HomeController::class,'StoreSlider'])->name('store.slider');
Route::get('/slider/edit/{id}',[HomeController::class,'Edit']);
Route::post('/slider/update/{id}',[HomeController::class,'Update']);

// Home About ALL Route
Route::get('/home/About',[AboutController::class,'HomeAbout'])->name('home.about');
Route::get('/add/About',[AboutController::class,'AddAbout'])->name('add.about');
Route::post('/store/About',[AboutController::class,'StoreAbout'])->name('store.about');
Route::get('/about/edit/{id}',[AboutController::class,'EditAbout']);
Route::post('/update/homeabout/{id}',[AboutController::class,'UpdateAbout']);
Route::get('/about/delete/{id}',[AboutController::class,'DeleteAbout']);

//Portfolio Page route
Route::get('/portfolio',[AboutController::class,'Portfolio'])->name('portfolio');

//admin contact Page route
Route::get('/admin/contact',[ContactController::class,'AdminContact'])->name('admin.contact');
Route::get('/admin/add/contact',[ContactController::class,'AdminAddContact'])->name('add.contact');
Route::post('admin/store/contact',[ContactController::class,'StoreContact'])->name('store.contact');
Route::get('/contact/edit/{id}',[ContactController::class,'EditContact']);
Route::post('/update/contact/{id}',[ContactController::class,'UpdateContact']);
Route::get('/contact/delete/{id}',[ContactController::class,'DeleteContact']);

Route::get('admin/message',[ContactController::class,'AdminMessage'])->name('admin.message');
Route::get('/message/delete/{id}',[ContactController::class,'DeleteMessage']);


//Home contact Page route
Route::get('/contact',[ContactController::class,'Contact'])->name('contact');
Route::post('/contact/form',[ContactController::class,'ContactForm'])->name('contact.form');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
     // $users= User::all();
    //$users=DB::table('users')->get();
 return view('admin.index');
})->name('dashboard');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/user/logout',[BrandController::class,'Logout'])->name('user.logout');

//change password and user profile route
Route::get('/user/password',[ChangePass::class,'CPassword'])->name('change.password');
Route::post('/password/update',[ChangePass::class,'UpdatePassword'])->name('password.update');

//User Profile
Route::get('/user/profile',[ChangePass::class,'PUpdate'])->name('profile.update');
Route::post('/user/profile/update',[ChangePass::class,'UpdateProfile'])->name('update.user.profile');
Route::post('/user/store',[ChangePass::class,'UserStore'])->name('user.store');


