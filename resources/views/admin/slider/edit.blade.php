@extends('admin.admin_master')
@section('admin')

<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Update Slider</h2>
        </div>
        <div class="card-body">
            <form action="{{url('slider/update/'.$sliders->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="old_image" value="{{ $sliders->image}}">
                <div class="form-group">
                    <label for="exampleFormControlInput1"> Update Slider Title</label>
                    <input type="text" class="form-control"name="title" placeholder="" value="{{ $sliders->title}}">
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Update Slider Description</label>
                    <textarea class="form-control"  rows="3" name="description" value="{{ $sliders->description }}"></textarea>
                    @error('description')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Update Image</label>
                    <input type="file" class="form-control-file" name="image" value="{{ $sliders->image}}">
                </div>
                <div class="form-group">
                    <img src="{{ asset($sliders->image) }}" style="height:200px;width:400px;">
                    </div>
                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default" >Update</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    @endsection
