@extends('admin.master')
@section('content')
<section class="container my-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <div class="text-center">
                            <h3 class="text-center">USERS SHOW</h3>
                            <a href="{{Route('user.add')}}" class="btn btn-primary float-left">USERS ADD</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Phone No</th>
                                <th>Image</th>
                                <th>Password</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($show as $item)
                              <tr>
                                  <td>{{$item->name}}</td>
                                  <td>{{$item->email}}</td>
                                  <td>{{$item->phone_no}}</td>
                                  <td>
                                    <img src="{{URL::asset($item->Image)}}" alt="" class="img-responsive" height="100px" width="70px">
                                  </td>
                                  <td>{{$item->password}}</td>
                                  <td>
                                      <a href="{{Route('user.edit',$item->user_id)}}" class="btn btn-primary">Edit</a>
                                      <a href="{{Route('user.destroy',$item->user_id)}}" class="btn btn-danger">Delete</a>
                                  </td>
                              </tr>

                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

</section>

@endsection
