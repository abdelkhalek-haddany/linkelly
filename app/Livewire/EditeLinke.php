<?php

namespace App\Livewire;

use App\Models\Distination;
use App\Models\Link;
use Livewire\Component;

class EditeLinke extends Component
{
    public $link;
    public $destinations = [];
    public $linkId;

    public function mount(Link $link)
    {
        $this->link = $link;
        $this->linkId = $link->slug;

        // Populate destinations array with existing values
        foreach ($this->link->distinations as $destination) {
            $this->destinations[] = [
                'url' => $destination->distination,
                'percentage' => $destination->percentage,
            ];
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
        $this->destinations = [];
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

            // Delete existing destinations
            $this->link->slug = $this->linkID;
            $this->link->link_domain = $this->selectedDomain;
            $this->save();
            $this->link->distinations()->delete();

            // Add updated destinations
            foreach ($this->destinations as $destination) {
                $newDistination = new Distination();
                $newDistination->link_id = $this->link->id;
                $newDistination->distination = $destination['url'];
                $newDistination->percentage = $destination['percentage'];
                $newDistination->save();
            }

            // Redirect or show a success message
            session()->flash('success', 'Link updated successfully!');
            return redirect()->route('links.index');
        } catch (\Exception $e) {
            // Handle the exception if needed
            session()->flash('error', 'Oops, an error occurred!');
        }
    }

    public function render()
    {
        return view('livewire.edite-linke');
    }
}