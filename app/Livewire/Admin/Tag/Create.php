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

        return $this->success(
            'Tag created!',
            redirectTo: '/admin/tag/'.$tag->id.'/edit'
        );

        // return $this->redirect('/admin/tag/'.$tag->id.'/edit', navigate: true);

    }   
    public function render()
    {
        return view('livewire.admin.tag.create');
    }
}
