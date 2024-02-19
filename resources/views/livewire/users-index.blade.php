<div>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">

    <main class="content">
        <div class="container-fluid p-0">
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">All Users</h1>
            </div>

            <div class="search-form">
                <div class="form">
                    <div class="row">

                        <div class="col-sm-4">
                            <label for="name">Name</label>
                            <div class="input">
                                <input type="text" wire:model="name" wire:change="queryUsers" name="name"
                                    placeholder='Search'>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <label for="email">Email</label>
                            <div class="input">
                                <input type="text" wire:model="email" wire:change="queryUsers" name="email"
                                    placeholder='Search'>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <label for="user_type">User Type</label>
                            <select class="input" name="user_type" id="" wire:model="user_type"
                                wire:change="queryUsers">
                                <option value="">All</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>

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
</div>
