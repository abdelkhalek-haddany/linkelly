@extends('layouts._master')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">All Users</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="table">
                        <thead class="table-dark">
                            <td>ID</td>
                            <td>First name</td>
                            <td>Last name</td>
                            <td>Email</td>
                            <td>Phone</td>
                            <td></td>
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

                                        <a class="btn btn-danger">
                                            <i class="fa-solid fa-trash"></i><span> Delete</span>
                                        </a>
                                    </td>
                                    {{-- <td class="options">
                                        <li class="dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="dropdown02"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-vertical"></i></a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdown02">

                                                <li>
                                                    <a class="dropdown-item" href="{{ route('users.edit', $user->id) }}">
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
    </main>
@endsection
