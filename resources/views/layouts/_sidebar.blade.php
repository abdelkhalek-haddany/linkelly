<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">Linkelly</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <li class="sidebar-item active">
                <a class="sidebar-link" href="index.html">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            {{-- <li class="sidebar-item">
                <a class="sidebar-link" href="">
                    <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Statistics</span>
                </a>
            </li> --}}

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('profile.edit') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
                </a>
            </li>

            {{-- <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('users.index') }}">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Users</span>
                </a>
            </li>


            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('links.index') }}">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Links</span>
                </a>
            </li> --}}




            {{-- <li class="sidebar-item">
                <a class="sidebar-link" href="pages-sign-in.html">
                    <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Sign In</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="pages-sign-up.html">
                    <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Sign
                        Up</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="pages-blank.html">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Blank</span>
                </a>
            </li> --}}

            @if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'super-admin')
                <li class="sidebar-header">
                    Users & Accounts
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('users.index') }}">
                        <i class="align-middle" data-feather="users"></i> <span class="align-middle">All users</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('users.create') }}">
                        <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Add user</span>
                    </a>
                </li>
            @endif

            <li class="sidebar-header">
                Links
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('links.index') }}">
                    <i class="align-middle" data-feather="link"></i> <span class="align-middle">All links</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('links.create') }}">
                    <i class="align-middle" data-feather="plus"></i> <span class="align-middle">Add link</span>
                </a>
            </li>


            {{-- 
            <li class="sidebar-item">
                <a class="sidebar-link" href="ui-cards.html">
                    <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Cards</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="ui-typography.html">
                    <i class="align-middle" data-feather="align-left"></i> <span class="align-middle">Typography</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="icons-feather.html">
                    <i class="align-middle" data-feather="coffee"></i> <span class="align-middle">Icons</span>
                </a>
            </li>

            <li class="sidebar-header">
                Plugins & Addons
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="charts-chartjs.html">
                    <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Charts</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="maps-google.html">
                    <i class="align-middle" data-feather="map"></i> <span class="align-middle">Maps</span>
                </a>
            </li> --}}
        </ul>

        <div class="sidebar-cta">
            <div class="sidebar-cta-content">
                {{-- <strong class="d-inline-block mb-2">Upgrade to Pro</strong>
                <div class="mb-3 text-sm">
                    Are you looking for more components? Check out our premium version.
                </div> --}}
                {{-- <div class="d-grid"> --}}
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary" style="width:100%">Logout</button>
                </form>
                {{-- </div> --}}
            </div>
        </div>
    </div>
</nav>
