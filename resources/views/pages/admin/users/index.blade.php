@extends('layouts._master')

@section('content')
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">

    <main class="content">
        <div class="container-fluid p-0">
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">All Users</h1>
            </div>

            {{-- Search Form --}}
            {{-- <form class="search-form" action="{{ route('users.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search users">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form> --}}

            <div class="row">
                <div class="col-12">
                    <table class="table" id="usersTable">
                        <thead class="table-dark">
                            <td>ID</td>
                            <td>First name</td>
                            <td>Last name</td>
                            <td>Email</td>
                            <td>Phone</td>
                            <td>Actions</td>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>#{{ $user->id }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        <a class="btn btn-info" href="{{ route('users.edit', $user->id) }}">
                                            <i class="fa-solid fa-user-pen"></i><span> Edit</span>
                                        </a>

                                        <a class="btn btn-danger" href="{{ route('users.delete', $user->id) }}">
                                            <i class="fa-solid fa-trash"></i><span> Delete</span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Pagination Links --}}
                    {{-- <div class="d-flex justify-content-center">
                        {{ $users->links() }}
                    </div> --}}
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>

        <!-- DataTables JS -->
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

        <script>
            $(document).ready(function() {
                $('#usersTable').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    // Additional options and configurations can be added here
                });
            });
        </script>
    </main>
@endsection
