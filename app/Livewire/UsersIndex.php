<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UsersIndex extends Component
{
    public $name, $email, $user_type;

    public function render()
    {
        $users = $this->queryUsers();

        return view('livewire.users-index', compact('users'));
    }

    public function queryUsers()
    {
        // Build your query based on the attributes
        $query = User::query();

        if ($this->name) {
            $query->where('first_name', 'like', '%' . $this->name . '%')->orWhere('last_name', 'like', '%' . $this->name . '%');
        }

        if ($this->email) {
            $query->where('email', 'like', '%' . $this->email . '%');
        }

        if ($this->user_type !== null) {
            $query->where('user_type', $this->user_type);
        }
        return $query->get();
    }
}
