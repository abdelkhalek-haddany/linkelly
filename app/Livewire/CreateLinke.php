<?php

namespace App\Livewire;

use App\Models\Link;
use App\Models\Distination;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateLinke extends Component
{
    public $destinations = [];
    public $linkId; // New property to store the generated link ID
    public $selectedDomain;
    public $isUnique = false;
    public $name;

    public function mount()
    {
        // Initialize with one empty destination input
        $this->destinations[] = ['url' => '', 'percentage' => ''];
        // Generate the link ID during page load

        while (!$this->isUnique) {
            $this->linkId = $this->generateRandomStringId();
            $links = Link::where("slug", $this->linkId)->get();
            if (sizeof($links)==0) {
                $this->isUnique = true;
            }
        }
    }

    public function addDestination()
    {
        // Add a new empty destination input
        $this->destinations[] = ['url' => '', 'percentage' => ''];
    }

    public function removeDestination($index)
    {
        // Remove the specified destination input
        unset($this->destinations[$index]);

        // Reset array keys after unset
        $this->destinations = array_values($this->destinations);
    }

    public function cancelForm()
    {
        // Reset the destinations array to its initial state
        $this->destinations = [['url' => '', 'percentage' => '']];
    }

    public function submitForm()
    {
        try {
            // Validate that the sum of percentages does not exceed 100%
            $totalPercentage = array_reduce($this->destinations, function ($carry, $destination) {
                return $carry + (float)$destination['percentage'];
            }, 0);

            if ($totalPercentage > 100) {
                session()->flash('error', 'The sum of percentages cannot exceed 100%.');
                return;
            }

            $link = new Link();
            $link->name = $this->name;
            $link->slug = $this->linkId; // Use the generated link ID
            $link->link_domain = $this->selectedDomain;
            $link->user_id = Auth::id();
            $link->status = '0';
            $link->save();

            foreach ($this->destinations as $destination) {
                $distination = new Distination();
                $distination->link_id = $link->id;
                $distination->distination = $destination['url'];
                $distination->percentage = $destination['percentage'];
                $distination->save();
            }

            // Reset the destinations array to its initial state
            $this->destinations = [['url' => '', 'percentage' => '']];

            // Redirect or show a success message
            session()->flash('success', 'Link added successfully!');
            // You might want to redirect to a specific route
            return redirect()->route('links.index');
        } catch (\Exception $e) {
            // Handle the exception if needed
            session()->flash('error', 'Oops, an error occurred!');
        }
    }


    private function generateRandomStringId()
    {
        // Implement your logic to generate a random string for the link ID
        // For example, you can use Str::random(10) from Illuminate\Support\Str
        return \Illuminate\Support\Str::random(10);
    }

    public function render()
    {
        return view('livewire.create-linke');
    }
}
