@extends('layouts._master')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Create Domain</h1>
            </div>
            <form action="{{ route('domains.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Domain information</h5>
                            </div>
                            <div class="card-body row">

                                <div class="col-sm-6">
                                    <label class="card-title mb-0">Name</label>

                                    <input type="text" class="form-control input" placeholder="Name" name="name" />
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                <div class="col-sm-6">
                                    <label class="card-title mb-0">Domain</label>
                                    <input type="text" class="form-control input" placeholder="https://example.com"
                                        name="domain" />
                                    @if ($errors->has('domain'))
                                        <span class="text-danger">{{ $errors->first('domain') }}</span>
                                    @endif
                                </div>

                                <div class="col-sm-12">
                                    <label class="card-title mb-0">Status</label>

                                    <select name="status" id="status" class="input">
                                        <option value="1" selected>Activate</option>
                                        <option value="0">Desactivate</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="text-danger">{{ $errors->first('status') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn btn-warning">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
