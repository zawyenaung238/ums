@extends('layouts.master')
@section('content')
    {{-- message --}}
    {{-- {!! Toastr::message() !!} --}}
    <div class="page-wrapper mt-5">
        <div class="content container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title mt-4">Edit User</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row formtype">
                                    {{-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"name="name" value="{{ old('name') }}">
                                        </div>
                                    </div> --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>User Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"name="name" value="{{ old('name', $user->name) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"name="email" value="{{ old('email', $user->email) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone',$user->phone) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Role Name</label>
                                            <select class="form-control" name="role_id">
                                                <option>Select</option>
                                                @foreach ($roles as $r)
                                                    <option value="{{ $r->id }}" {{ $user->role_id == $r->id ? 'selected' : '' }}>{{ $r->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control @error('password', $user->password) is-invalid @enderror" name="password">
                                        </div>
                                    </div> --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select class="form-control" name="gender">
                                                <option>Select</option>
                                                <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                                                <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Is Active</label>
                                            <select class="form-control" name="is_active">
                                                <option>Select</option>
                                                <option value="0" {{ $user->is_active == '0' ? 'selected' : '' }}>Active</option>
                                                <option value="1" {{ $user->is_active == '1' ? 'selected' : '' }}>Not Active</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea name="address" class="form-control" rows="2">{{ old('address', $user->address) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary buttonedit1">Update User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @section('script')

    @endsection

@endsection
