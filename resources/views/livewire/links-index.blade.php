<div>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <main class="content">
        <div class="container-fluid p-0">
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">All Links</h1>
            </div>
            <div class="search-form">
                <div class="form">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="name">Name</label>
                            <div class="input">
                                <input type="text" wire:model="name" wire:change="queryLinks" name="name"
                                    placeholder='Search'>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <label for="username">User Name</label>
                            <div class="input">
                                <input type="text" wire:model="username" wire:change="queryLinks" name="username"
                                    placeholder='Search'>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <label for="status">Status</label>
                            <select class="input" name="status" id="" wire:model="status"
                                wire:change="queryLinks">
                                <option value="">All</option>
                                <option value="0">Active</option>
                                <option value="1">Inactive</option>
                            </select>
                        </div>
                        {{-- <div class="col-sm-4">
                            <button class="input submit" type="button">
                                Search
                            </button>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="table" id="usersTable">
                        <thead class="table-dark">
                            <td>ID</td>
                            <td>Name</td>
                            <td>Link ID</td>
                            <td>User</td>
                            <td>Status</td>
                            <td></td>
                        </thead>
                        <tbody>
                            @foreach ($links as $link)
                                <tr>
                                    <td>#{{ $link->id }}</td>
                                    <td>{{ $link->name }}</td>
                                    <td>
                                        <div class="link-container">
                                            <!-- Copy Link Button -->
                                            <button class="btn custom-btn copy-link-btn"
                                                data-link="{{ $link->link_domain }}/{{ $link->slug }}">
                                                <i class="fa-solid fa-copy"></i>
                                                {{-- <span> Copy Link</span> --}}
                                            </button>
                                            <a class="link" href="{{ $link->link_domain }}/{{ $link->slug }}">
                                                <span class="domain">{{ $link->link_domain }}/</span>
                                                <span class="slug">{{ $link->slug }}</span>
                                            </a>
                                        </div>
                                    </td>
                                    <td>{{ $link->user->first_name }} {{ $link->user->last_name }}</td>
                                    <td>
                                        @if ($link->status == '0')
                                            Active
                                        @else
                                            Inactive
                                        @endif
                                    </td>
                                    <td>
                                        <div class="actions-button">

                                            <a class="btn custom-btn" href="{{ route('links.details', $link->id) }}">
                                                <i class="fa-solid fa-info"></i><span> Details</span>
                                            </a>

                                            <a class="btn custom-btn" href="{{ route('links.edit', $link->id) }}">
                                                <i class="fa-solid fa-user-pen"></i><span> Edit</span>
                                            </a>
                                            <a class="btn custom-btn" href="{{ route('links.delete', $link->id) }}">
                                                <i class="fa-solid fa-trash"></i><span> Delete</span>
                                            </a>
                                            @if ($link->status == '0')
                                                <a class="btn custom-btn"
                                                    href="{{ route('links.status', $link->id) }}">
                                                    <i class="fa-solid fa-ban"></i><span> Inactivate</span>
                                                </a>
                                            @else
                                                <a class="btn custom-btn"
                                                    href="{{ route('links.status', $link->id) }}">
                                                    <i class="fa-solid fa-check"></i><span> Activate</span>
                                                </a>
                                            @endif
                                        </div>
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

                // Copy Link Button Click Event
                $('.copy-link-btn').on('click', function() {
                    var linkToCopy = $(this).data('link');
                    copyToClipboard(linkToCopy);
                });

                // Function to copy text to clipboard
                function copyToClipboard(text) {
                    var input = document.createElement('textarea');
                    input.value = text;
                    document.body.appendChild(input);
                    input.select();
                    document.execCommand('copy');
                    document.body.removeChild(input);
                    // Optionally, you can show a notification or perform any other action after copying.
                    alert('Link copied to clipboard!');
                }
            });
        </script>
    </main>
</div>
