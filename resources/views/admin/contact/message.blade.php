@extends('admin.admin_master')

@section('admin')
    <div class="py-12">
    <div class="container">
    <div class="row">
        <h4>Contact Form</h4>
        <br><br>
        <div class="col-md-12">
            <div class="card">
            <div class="card-header">All Contact Message</div>
        <table class="table">
            <thead>
              <tr>
                <th scope="col" width="5%">SL No</th>
                <th scope="col" width="5%">Name</th>
                <th scope="col" width="5%">Email</th>
                <th scope="col" width="5%">Subject</th>
                <th scope="col" width="5%">Message</th>
                <th scope="col" width="5%">Action</th>
              </tr>
            </thead>
            <tbody>
                @php($i=1)
                @foreach ($messages as $mess)
              <tr>
                <th scope="row">{{ $i++ }}</th>
                <td>{{ $mess->name}}</td>
                <td>{{ $mess->email}}</td>
                <td>{{ $mess->subject}}</td>
                <td>{{ $mess->message}}</td>
                <td>
                <a href="{{ url('/message/delete/'.$mess->id) }}" onclick="return confirm('Are you sure to delete')" class="btn btn-danger">Delete</a>
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

