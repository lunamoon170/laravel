<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    public function AdminContact(){
       $contacts=Contact::all();
       return view('admin.contact.index',compact('contacts'));
    }
    public function AdminAddContact(){
        return view('admin.contact.create');
    }
    public function StoreContact(Request $request){
        Contact::insert([
            'address'=>$request->address,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'created_at'=>Carbon::now()
        ]);

        return Redirect()->route('admin.contact')->with('success','Contact Inserted Succefully');
    }
    public function EditContact($id){
        $contact=Contact::find($id);
        return view('admin.contact.edit',compact('contact'));
    }

    public function UpdateContact(Request $request,$id){
        $update=Contact::find($id)->update([
            'address'=>$request->address,
            'phone'=>$request->phone,
            'email'=>$request->email,
        ]);
        return Redirect()->route('admin.contact')->with('success','Contact Update Succefully');
    }

    public function DeleteContact($id){
        $delete=Contact::find($id)->Delete();
        return Redirect()->back()->with('success','Contact Delete Succefully');
    }
}
