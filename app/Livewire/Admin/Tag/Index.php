<?php

namespace App\Livewire\Admin\Tag;

use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination; 

    public int $perPage = 10;

    public $headers = [
        ['key' => 'id', 'label' => 'ID', 'class' => ''],
        ['key' => 'name', 'label' => 'TAG NAME', 'class' => ''],
        ['key' => 'slug', 'label' => 'SLUG', 'class' => ''],
    ];


    public function render()
    {
        // return view('livewire.admin.tag.index');
        return view('livewire.admin.tag.index', [
            'tags' => Tag::paginate($this->perPage),
        ])->layout('components.layouts.admin');
    }
}
