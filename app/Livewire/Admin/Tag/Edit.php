<?php

namespace App\Livewire\Admin\Tag;

use App\Models\Tag;
use Livewire\Component;
use Illuminate\Support\Str;
use Mary\Traits\Toast;

class Edit extends Component
{
    use Toast;
    public $id;
    public $tag;
    public $name;
    public $slug;

    protected $rules = [
        'name' => ['required','unique:'.Tag::class],
    ];

    public function save()
    {
        $this->validate();
        $newSlug = Str::slug($this->name);

        $this->tag->name = $this->name;
        $this->tag->slug = $newSlug;
        $this->tag->save();
        // dd($this->tag );
        $this->slug = $newSlug;
        return $this->success(
            'Changes saved!',
        );
    }

    public function deleteTag()
    {
        $this->tag= Tag::findOrFail($this->id);
        $this->tag->delete();
        return $this->success(
            'Tag deleted!',
            redirectTo: '/admin/tag/'
        );
        // return $this->redirect('/admin/tag/', navigate: true);
    }

    function mount()  {
        $this->tag= Tag::findOrFail($this->id);
        $this->name = $this->tag->name;
        $this->slug = $this->tag->slug;
        // dd($this->tag);
    }


    public function render()
    {
        return view('livewire.admin.tag.edit');
    }
}
