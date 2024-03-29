<div>
    @if ($error = Session::get('error'))
        {{-- <div class="error-block">
            <span class="icon"><i class="fa-solid fa-circle-exclamation"></i></span>
            <span class="message">{{ $error }}</span>
        </div> --}}

        <div class="message-container">
            <div class="message-heading">
                Error
            </div>
            <div class="message-description">
                {{ $error }}
            </div>
        </div>
    @endif
    <div class="card" wire:ignore>
        <div class="card-header">
            <h5 class="card-title mb-0">Name</h5>
        </div>
        <div class="card-body row">
            <div class="col-sm-12">
                <input type="text" class="form-control input" placeholder="Name" name="name"
                    value="{{ $link->name }}" wire:model="name" />
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
        </div>
    </div>
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


    <!-- Display the generated link ID -->
    <div class="card" wire:ignore>
        <div class="card-header">
            <label for="linkId">Link ID: <strong>{{ $link->slug }}</strong></label>
            <input type="text" name="linkId" id="linkId" wire:model="linkId" readonly hidden>
        </div>
        <div class="card-header">
            <h5 for="selectedDomain" class="card-title mb-0">Edit Domain:</h5>
        </div>

        <div class="card-body row">
            <div class="col-lg-9 col-sm-8 col-6">
                <select id="selectedDomain" wire:model="selectedDomain" class="form-control">
                    @foreach (Domains() as $domain)
                        <option value="{{ $domain->domain }}">
                            {{ $domain->domain }}/{{ $linkId }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <button type="button" class="btn btn-warning" wire:click="cancelForm">Cancel</button>
        <button type="button" class="btn btn-primary" wire:click="submitForm">Update</button>
    </div>
</div>
