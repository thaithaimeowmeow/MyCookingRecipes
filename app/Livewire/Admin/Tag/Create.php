<?php

namespace App\Livewire\Admin\Tag;

use App\Models\Tag;
use Livewire\Component;
use Illuminate\Support\Str;

class Create extends Component
{
    public $name;
    protected $rules = [
        'name' => ['required','unique:'.Tag::class],
    ];

    public function save()
    {
        $this->validate();
        $slug = Str::slug($this->name);

        $tag = Tag::create([
            'name' => $this->name,
            'slug' => $slug,
        ]);
        return $this->redirect('/admin/tag/'.$tag->id.'/edit', navigate: true);

    }   
    public function render()
    {
        return view('livewire.admin.tag.create');
    }
}
