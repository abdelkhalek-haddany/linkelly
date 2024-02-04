@extends('layouts._master')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Create User</h1>
            </div>
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">User information</h5>
                            </div>
                            <div class="card-body row">
                                <div class="col-sm-12">
                                    <label class="card-title mb-0">User type</label>

                                    <select name="user_type" id="user_type" class="input">
                                        <option value="user" selected>User</option>
                                        @if (Auth::user()->user_type == 'super-admin')
                                            <option value="admin">Admin</option>
                                        @endif
                                    </select>
                                    @if ($errors->has('user_type'))
                                        <span class="text-danger">{{ $errors->first('user_type') }}</span>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label class="card-title mb-0"> First Name</label>

                                    <input type="text" class="form-control input" placeholder="Firstname"
                                        name="first_name" />
                                    @if ($errors->has('first_name'))
                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                    @endif
                                </div>

                                <div class="col-sm-6">
                                    <label class="card-title mb-0"> Last Name</label>
                                    <input type="text" class="form-control input" placeholder="Lastname"
                                        name="last_name" />
                                    @if ($errors->has('last_name'))
                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                    @endif
                                </div>


                                <div class="col-sm-6">
                                    <label class="card-title mb-0">Email</label>
                                    <input type="email" class="form-control input" placeholder="Email" name="email" />
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>


                                <div class="col-sm-6">
                                    <label class="card-title mb-0">Phone</label>
                                    <input type="text" class="form-control input" placeholder="Phone" name="phone" />
                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>



                                <div class="col-sm-6">
                                    <label class="card-title mb-0">Password</label>
                                    <input type="password" class="form-control input" placeholder="password"
                                        name="password" />
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>


                                <div class="col-sm-6">
                                    <label class="card-title mb-0"> Password Confirmation</label>
                                    <input type="password" class="form-control input" placeholder="Password confirmation"
                                        name="password_confirmation" />
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
            </form>
        </div>
    </main>
@endsection
