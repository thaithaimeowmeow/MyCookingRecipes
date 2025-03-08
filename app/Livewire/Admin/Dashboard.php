<?php

namespace App\Livewire\Admin;

use App\Models\Notification;
use Livewire\Component;

class Dashboard extends Component
{

    public $notifications;


    public function mount()
    {
        $this->notifications = Notification::orderBy('created_at', 'DESC')->get();
    }


    public function render()
    {
        return view('livewire.admin.dashboard')->layout('components.layouts.admin');
    }
}
