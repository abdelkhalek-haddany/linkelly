@include('includes/_header')
<div class="wrapper">
    @include('layouts/_sidebar')
    <div class="main">
        @include('layouts/_navbar')
        @yield('content')
        @include('layouts/_footer')
    </div>
</div>
@include('includes/_footer')