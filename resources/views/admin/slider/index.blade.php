@extends('admin.admin_master')

@section('admin')
    <div class="py-12">
    <div class="container">
    <div class="row">
        <h4>Home slider</h4>
        <a href="{{ route('add.slider') }}"><button class="btn btn-info">Add Slider</button></a>
        <br><br>
        <div class="col-md-12">
            <div class="card">
                @if(session('success'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{session('success')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif
            <div class="card-header">All Slider</div>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">SL No</th>
                <th scope="col">Slider Title</th>
                <th scope="col">Description</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @php($i=1)
                @foreach ($sliders as $slider)
              <tr>
                <th scope="row">{{ $i++ }}</th>
                <td>{{ $slider->title }}</td>
                <td>{{ $slider->description }}</td>
                {{-- join table id and get user name --}}
                <td><img src="{{ asset($slider->image) }}" style="height:40px;width:70px;"></td>

                <td>
                <a href="{{ url('/slider/edit/'.$slider->id) }}" class="btn btn-info">Edit</a>
                <a href="{{ url('/slider/delete/'.$slider->id) }}" onclick="return confirm('Are you sure to delete')" class="btn btn-danger">Delete</a>
                </td>
              </tr>
            </tbody>
            @endforeach
          </table>
        </div>
    </div>

    </div>
    </div>
    </div>
@endsection

