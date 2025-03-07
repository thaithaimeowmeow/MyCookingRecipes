<?php

namespace App\Livewire\Admin\Tag;

use App\Models\Tag;
use Livewire\Component;
use Illuminate\Support\Str;
use Mary\Traits\Toast;

class Create extends Component
{
    use Toast;
    public $name;
    protected $rules = [
        'name' => ['required','unique:'.Tag::class],
    ];
    
    public function save()
    {
        $this->validate();
        $slug = Str::slug($this->name);

        $tag = Tag::create(attributes: [
            'name' => $this->name,
            'slug' => $slug,
        ]);

        $this->success(
            'Tag created!'
        );

        return redirect()->to('/admin/tag/'.$tag->id.'/edit');


    }   
    public function render()
    {
        return view('livewire.admin.tag.create')->layout('components.layouts.admin');
    }
}
