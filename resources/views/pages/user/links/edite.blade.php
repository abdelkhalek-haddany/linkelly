@extends('layouts._master')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Edit</h1>
            </div>
            <form action="{{ route('links.update', $link) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div id="inputContainer">

                            {{-- <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Name</h5>
                                </div>
                                <div class="card-body row">
                                    <input type="text" class="form-control input" placeholder="name"
                                        name="name" />
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div> --}}
                            @php $i =0; @endphp
                            @foreach ($link->distinations as $distination)
                                @php $i++; @endphp
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Distination {{ $i }}</h5>
                                    </div>
                                    <div class="card-body row">
                                        <div class="col-lg-9 col-sm-8 col-12">
                                            <input type="url" class="form-control input"
                                                value="{{ $distination->distination }}" placeholder="url"
                                                name="distinations[]" />
                                        </div>
                                        <div class="col-lg-2 col-sm-3 col-8">
                                            <input type="number" class="form-control percentage-input input"
                                                value="{{ $distination->percentage }}" placeholder="Percentage"
                                                name="percentages[]" />
                                        </div>
                                        <div class="col-sm-1 col-4">
                                            <button class="btn btn-danger input" type="button"
                                                onclick="deleteInput(this.parentNode.parentNode.parentNode)"><i
                                                    class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="add-distination-container">
                            <button type="button" class="add-distination-btn" onclick="addInput()">Add
                                Input</button>
                        </div>
                        {{-- <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Textarea</h5>
                        </div>
                        <div class="card-body">
                            <textarea class="form-control" rows="2" placeholder="Textarea" name="textarea"></textarea>
                        </div>
                    </div> --}}
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-warning">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </main>
    <script>
        var inputCounter = 2;

        function addInput() {
            var totalPercentage = calculateTotalPercentage();

            // Check if the total percentage is less than 100
            if (totalPercentage < 100) {
                // Create a new card container
                var cardContainer = document.createElement("div");
                cardContainer.classList.add("card");

                // Create card header
                var cardHeader = document.createElement("div");
                cardHeader.classList.add("card-header");

                var cardTitle = document.createElement("h5");
                cardTitle.classList.add("card-title", "mb-0");
                cardTitle.textContent = "Distination " + inputCounter;

                cardHeader.appendChild(cardTitle);
                cardContainer.appendChild(cardHeader);

                // Create card body
                var cardBody = document.createElement("div");
                cardBody.classList.add("card-body", "row");

                var linkContainer = document.createElement("div");
                linkContainer.classList.add("col-md-9", "col-sm-8", "col-6");

                var percentageContainer = document.createElement("div");
                percentageContainer.classList.add("col-md-2", "col-sm-3", "col-5");

                var deleteContainer = document.createElement("div");
                deleteContainer.classList.add("col-1");

                // Create the first input
                var input1 = createInput("distination " + inputCounter, 'url');
                linkContainer.appendChild(input1);
                input1.classList.add("distination-input");

                // Create the second input with a percent symbol
                var input2 = createInput("percentage", 'number');
                input2.classList.add("percentage-input");
                percentageContainer.appendChild(input2);

                // Append the inputs to the card body
                cardBody.appendChild(linkContainer);
                cardBody.appendChild(percentageContainer);

                // Create a delete button
                var deleteButton = document.createElement("button");
                var icon = document.createElement("i");
                deleteButton.classList.add("btn", "btn-danger", "input");
                icon.classList.add("fas", "fa-trash");
                deleteButton.appendChild(icon);
                deleteButton.onclick = function() {
                    event.preventDefault();
                    // Remove the corresponding card when the delete button is clicked
                    deleteInput(cardContainer);
                };

                // Append the delete button to the card body
                deleteContainer.appendChild(deleteButton);
                cardBody.appendChild(deleteContainer);

                // Append the card body to the card container
                cardContainer.appendChild(cardBody);

                // Append the card container to the main input container
                document.getElementById("inputContainer").appendChild(cardContainer);

                // Increment the input counter for the next card
                inputCounter++;

                // Disable the "Add Input" button if the total percentage reaches 100
                if (totalPercentage + 100 / (inputCounter - 1) >= 100) {
                    document.querySelector('.add-distination-btn').disabled = true;
                }
            } else {
                alert("Total percentage is already 100. Cannot add more inputs.");
            }
        }

        function calculateTotalPercentage() {
            var percentageInputs = document.querySelectorAll('.percentage-input');
            var totalPercentage = 0;

            percentageInputs.forEach(function(input) {
                totalPercentage += parseFloat(input.value) || 0;
            });

            return totalPercentage;
        }

        function createInput(placeholder, type) {
            var input = document.createElement("input");
            input.type = type;
            if (type == 'url') {
                input.name = 'distinations[]';
            } else {
                input.name = 'percentages[]';
            }
            input.classList.add("form-control", "input");
            input.placeholder = placeholder;
            return input;
        }

        // function deleteInput(container) {
        //     // Remove the corresponding card when the delete button is clicked
        //     document.getElementById("inputContainer").removeChild(container);

        //     // Enable the "Add Input" button
        //     document.querySelector('.add-distination-btn').disabled = false;
        // }

        function deleteInput(container) {
            // Remove the corresponding card when the delete button is clicked
            document.getElementById("inputContainer").removeChild(container);

            // Renumber the remaining inputs
            var cards = document.querySelectorAll('.card');
            cards.forEach(function(card, index) {
                var cardTitle = card.querySelector('.card-title');
                cardTitle.textContent = "Distination " + (index + 1);
            });

            // Enable the "Add Input" button
            document.querySelector('.add-distination-btn').disabled = false;
        }
    </script>
@endsection
