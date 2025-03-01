<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $user;
    public $username;

    public function mount()
    {
        $this->user = User::where('username', $this->username)
            ->with(['posts'])
            ->firstOrFail();
    }
    public function render()
    {
        return view('livewire.profile.index');
    }
}
