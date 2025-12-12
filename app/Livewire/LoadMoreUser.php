<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class LoadMoreUser extends Component
{
    // Number of users to show initially
    public $perPage = 15;

    // Method to increase the number of users displayed
    public function loadMore()
    {
        $this->perPage += 5; // Adds 5 more users when called
    }

    // Render method to return view with paginated users
    public function render()
    {
        // Get latest users with pagination
        $users = User::latest()->paginate($this->perPage);

        // Pass users to the view
        return view('livewire.load-more-user', compact('users'));
    }
}