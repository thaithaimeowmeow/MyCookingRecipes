<?php

namespace App\Livewire\Admin\Tag;

use App\Models\Tag;
use Livewire\Component;
use Illuminate\Support\Str;
use Masmerise\Toaster\Toaster;

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
        Toaster::success('Tag created!'); // 👈
        return $this->redirect('/admin/tag/'.$tag->id.'/edit', navigate: true);

    }   
    public function render()
    {
        return view('livewire.admin.tag.create');
    }
}
