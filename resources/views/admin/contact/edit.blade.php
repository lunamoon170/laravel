@extends('admin.admin_master')
@section('admin')
<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Update Contact</h2>
        </div>
        <div class="card-body">
            <form action="{{ url('/update/contact/'.$contact->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Contact Email</label>
                    <input type="text" class="form-control" name="email" value="{{ $contact->email}}">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Contact Phone</label>
                    <input type="text" class="form-control" name="phone" value="{{ $contact->phone}}">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Contact Address</label>
                    <textarea class="form-control"  rows="3" name="address">{{ $contact->address}}</textarea>
                </div>

                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default" >Submit</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    @endsection
