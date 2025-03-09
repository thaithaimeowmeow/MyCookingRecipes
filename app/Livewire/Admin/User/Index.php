<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;


class Index extends Component
{
    use WithPagination; 
    use Toast;

    public $search = '';
    
    public int $perPage = 10;

    public $headers = [
        ['key' => 'id', 'label' => 'ID', 'class' => ''],
        ['key' => 'username', 'label' => 'USERNAME', 'class' => ''],
        ['key' => 'email', 'label' => 'EMAIL', 'class' => ''],
        ['key' => 'isActive', 'label' => 'isActive', 'class' => ''],
        ['key' => 'isAdmin', 'label' => 'isAdmin', 'class' => ''],
    ];

    public function getRowClasses(User $user)
    {
        return array_keys(array_filter($this->row_decoration, fn($key) => $user->$key));
    }
    
    public function clicktest(){
        $this->success('We are done, check it out');
    }

    public function updateSearch()
    {
        $this->resetPage();
        $this->perPage = 10;
    }

    public function render()
    {

        $users = User::where(function ($query) {
            $query->where('username', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%');
        })->paginate($this->perPage); 

        // return view('livewire.admin.tag.index');
        return view('livewire.admin.user.index', [
            'users' => $users,
        ])->layout('components.layouts.admin');
    }
}
