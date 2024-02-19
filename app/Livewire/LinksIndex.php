<?php

namespace App\Livewire;

use App\Models\Link;
use App\Models\User;
use Livewire\Component;

class LinksIndex extends Component
{
    public $status, $name, $username;

    public function render()
    {
        $links = $this->queryLinks();

        return view('livewire.links-index', [
            'links' => $links,
        ]);
    }


    public function queryLinks()
    {

        $query = Link::query();

        if ($this->name) {
            $userIds = User::where('first_name', $this->username)
                ->orWhere('last_name', $this->username)
                ->pluck('id');
            $query->whereIn('user_id', $userIds);
        }

        if ($this->name) {
            $query->where('name', 'like', '%' . $this->name . '%');
        }

        if ($this->status !== null) {
            $query->where('status', $this->status);
        }
        return $query->get();
    }
}
