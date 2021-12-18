@extends('admin.master')
@section('content')
<section class="container my-4">
    <div class="row">
        <div class="col-md-12">
            {{-- enctype="multipart/form-data" --}}
                <form action="{{Route('user.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                @if (session()->has('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                @endif
                <div class="card">
                    <div class="card-header font-weight-bolder">
                        Add User
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="my-input">Name</label>
                            <input id="my-input" class="form-control" type="text" name="name" placeholder="Enter Name" value="{{old('name')}}">

                            @if ($errors->has('name'))
                            <div class="text text-danger">{{$errors->first('name')}}</div>
                        @endif
                        </div>


                        <div class="form-group">
                            <label for="my-input">Email</label>
                            <input id="my-input" class="form-control" type="email" name="email" placeholder="Enter Email" value="{{old('email')}}">

                            @if ($errors->has('email'))
                            <div class="text text-danger">{{$errors->first('email')}}</div>
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="my-input">Phone No</label>
                            <input id="my-input" class="form-control" type="text" name="phone_no" placeholder="Enter Phone No" value="{{old('phone_no')}}">

                            @if ($errors->has('phone_no'))
                            <div class="text text-danger">{{$errors->first('phone_no')}}</div>
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="my-input">Image</label>
                            <input id="my-input" class="form-control" type="file" name="Image"  value="{{old('Image')}}">

                            @if ($errors->has('Image'))
                            <div class="text text-danger">{{$errors->first('Image')}}</div>
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="my-input">Password</label>
                            <input id="my-input" class="form-control" type="password" name="password" placeholder="Enter Password" value="{{old('password')}}">

                            @if ($errors->has('password'))
                            <div class="text text-danger">{{$errors->first('password')}}</div>
                            @endif
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                </form>

        </div>
    </div>
</section>

@endsection
