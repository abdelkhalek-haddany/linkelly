@extends('layouts._master')

@section('content')
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <main class="content">
        <div class="container-fluid p-0">
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">All Links</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="table" id="usersTable">
                        <thead class="table-dark">
                            <td>ID</td>
                            <td>Link ID</td>
                            <td>User</td>
                            <td>Status</td>
                            <td></td>
                        </thead>
                        <tbody>
                            @foreach ($links as $link)
                                <tr>
                                    <td>#{{ $link->id }}</td>
                                    <td><a class="link" href="http://127.0.0.1:8000/rotation/{{ $link->slug }}"><span
                                                class="domain">{{$link->link_domain}}/</span><span
                                                class="slug">{{ $link->slug }}</span></td>
                                    <td>{{ $link->user->first_name }} {{ $link->user->last_name }}</td>
                                    <td>
                                        @if ($link->status == '0')
                                            Active
                                        @else
                                            Inactive
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-info" href="{{ route('links.edit', $link->id) }}">
                                            <i class="fa-solid fa-user-pen"></i><span> Edit</span>
                                        </a>
                                        <a class="btn btn-danger" href="{{ route('links.delete', $link->id) }}">
                                            <i class="fa-solid fa-trash"></i><span> Delete</span>
                                        </a>
                                        @if ($link->status == '0')
                                            <a class="btn btn-warning" href="{{ route('links.status', $link->id) }}">
                                                <i class="fa-solid fa-ban"></i><span> Inactivate</span>
                                            </a>
                                        @else
                                            <a class="btn btn-warning" href="{{ route('links.status', $link->id) }}">
                                                <i class="fa-solid fa-check"></i><span> Activate</span>
                                            </a>
                                        @endif
                                    </td>
                                    {{-- <td class="options">
                                        <li class="dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="dropdown02"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-vertical"></i></a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdown02">

                                                <li>
                                                    <a class="dropdown-item" href="{{ route('links.edit', $user->id) }}">
                                                        <i class="fa-solid fa-user-pen"></i><span>Edit</span>
                                                    </a>
                                                </li>

                                                <li wire:click="delete({{ $user->id }})">
                                                    <a class="dropdown-item">
                                                        <i class="fa-solid fa-trash"></i><span>Delete</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
