<div>
    @foreach ($destinations as $index => $destination)
        <div class="card" wire:ignore>
            <div class="card-header">
                <h5 class="card-title mb-0">Destination {{ $index + 1 }}</h5>
            </div>
            <div class="card-body row">
                <div class="col-lg-9 col-sm-8 col-6">
                    <input type="url" class="form-control input" placeholder="URL"
                        wire:model="destinations.{{ $index }}.url" />
                </div>
                <div class="col-lg-2 col-sm-3 col-5">
                    <input type="number" class="form-control percentage-input input" placeholder="Percentage"
                        wire:model="destinations.{{ $index }}.percentage" />
                </div>
                <div class="col-sm-1 col-1">
                    <button class="btn btn-danger input" type="button"
                        wire:click="removeDestination({{ $index }})">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    @endforeach

    <div class="add-distination-container">
        <button type="button" class="add-distination-btn" wire:click="addDestination">Add Input</button>
    </div>

    @if ($error = Session::get('error'))
        <div class="error-block">
            <span class="icon"><i class="fa-solid fa-circle-exclamation"></i></span>
            <span class="message">{{ $error }}</span>
        </div>
    @endif

    <div class="form-actions">
        <button type="button" class="btn btn-warning" wire:click="cancelForm">Cancel</button>
        <button type="button" class="btn btn-primary" wire:click="submitForm">Update</button>
    </div>
</div>
