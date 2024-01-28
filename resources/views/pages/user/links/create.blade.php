@extends('layouts._master')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Create link</h1>
            </div>
            @livewire('create-linke')
        </div>
    </main>
@endsection
