@extends('layouts._master')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Create User</h1>
            </div>

            <form action="{{ route('users.update', $user) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">User type</h5>
                            </div>
                            <div class="card-body row">
                                <select name="user_type" id="user_type" class="input">
                                    <option value="user" @if ($user->user_type == 'user') selected @endif>User</option>
                                    @if (Auth::user()->user_type == 'super-admin')
                                        <option value="admin" @if ($user->user_type == 'admin') selected @endif>Admin
                                        </option>
                                    @endif
                                </select>
                                @if ($errors->has('user_type'))
                                    <span class="text-danger">{{ $errors->first('user_type') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">First Name</h5>
                            </div>
                            <div class="card-body row">
                                <input type="text" class="form-control input" placeholder="Firstname" name="first_name"
                                    value="{{ $user->first_name }}" />
                                @if ($errors->has('first_name'))
                                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Last Name</h5>
                            </div>
                            <div class="card-body row">
                                <input type="text" class="form-control input" placeholder="Lastname" name="last_name"
                                    value="{{ $user->last_name }}" />
                                @if ($errors->has('last_name'))
                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Email</h5>
                            </div>
                            <div class="card-body row">
                                <input type="email" class="form-control input" placeholder="Email" name="email"
                                    value="{{ $user->email }}" />
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Phone</h5>
                            </div>
                            <div class="card-body row">
                                <input type="text" class="form-control input" placeholder="Phone" name="phone"
                                    value="{{ $user->phone }}" />
                                @if ($errors->has('phone'))
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Password</h5>
                            </div>
                            <div class="card-body row">
                                <input type="password" class="form-control input" placeholder="password" name="password" />
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Password Confirmation</h5>
                            </div>
                            <div class="card-body row">
                                <input type="password_confirmation" class="form-control input"
                                    placeholder="Password confirmation" name="password_confirmation" />
                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn btn-warning">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </div>
                </div>
        </div>
    </main>
@endsection
