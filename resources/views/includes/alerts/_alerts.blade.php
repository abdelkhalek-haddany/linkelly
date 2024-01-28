@if ($message = Session::get('success'))
    <div class="alert-message-wrapper alert alert-success alert-block"
        style="display: flex;justify-content: space-between;align-items: center;">
        <strong>{{ $message }}</strong>
        <button type="button" class="alert-message-close close btn btn-success" data-dismiss="alert">×</button>
    </div>
@endif
@if ($message = Session::get('error'))
    <div class="alert-message-wrapper alert alert-danger alert-block"
        style="display: flex;justify-content: space-between;align-items: center;">
        <strong>{{ $message }}</strong>
        <button type="button" class="alert-message-close close btn btn-danger" data-dismiss="alert">×</button>
    </div>
@endif
@if ($errors->any())
    <div class="alert-message-wrapper alert alert-danger alert-block"
        style="display: flex;justify-content: space-between;align-items: center;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="alert-message-close close btn btn-danger" data-dismiss="alert">×</button>
    </div>
@endif
