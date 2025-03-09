<?php

namespace App\Livewire\Admin\Tag;

use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination; 

    public $search = '';

    public int $perPage = 10;

    public $headers = [
        ['key' => 'id', 'label' => 'ID', 'class' => ''],
        ['key' => 'name', 'label' => 'TAG NAME', 'class' => ''],
        ['key' => 'slug', 'label' => 'SLUG', 'class' => ''],
    ];


    public function updatingSearch()
    {
        $this->resetPage(); 
        $this->perPage = 10;
    }

    public function render()
    {
        // $tags = Tag::where('name', 'like', '%' . $this->query . '%') 
        // ->paginate($this->perPage);
        $tags = Tag::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('slug', 'like', '%' . $this->search . '%');
        })->paginate($this->perPage); 

        return view('livewire.admin.tag.index', [
            'tags' =>  $tags,
        ])->layout('components.layouts.admin');
    }
}
