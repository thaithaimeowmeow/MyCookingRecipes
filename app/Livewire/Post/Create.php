<?php

namespace App\Livewire\Post;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Mary\Traits\Toast;

class Create extends Component
{
    use Toast;

    public Collection $tags;
    public array $tags_multi_ids = [];

    //FORM
    public $name;
    public $prepTime;
    public $cookTime;
    public $description;
    public $image;
    public $video;
    public array $ingredients = [];

    protected $rules = [
        // 'name' => ['required'],
        // 'description' => ['required'],
        // 'prepTime' => ['required'],
        // 'cookTime' => ['required'],
        // 'tags_multi_ids' => ['required'],
        'ingredients' => ['required'],
        'ingredients.*.name' => 'required|string',
        'ingredients.*.quantity' => 'required|string',
    ];

    public function addIngredient()
    {
        $this->ingredients[] = ['name' => '', 'quantity' => '']; // Ensure a structured array
    }

    public function removeIngredient($index)
    {
        unset($this->ingredients[$index]);
        $this->ingredients = array_values($this->ingredients); // Re-index the array properly
    }

    public function save()
    {
        $this->validate();
        // $this->success('test');
        dd($this->ingredients);
    }
    public function mount()
    {
        $this->tags = Tag::All();
        // $this->ingredients = [
        //     ['name' => '', 'quantity' => ''],
        // ];
    }


    public function render()
    {
        return view('livewire.post.create');
    }
}
