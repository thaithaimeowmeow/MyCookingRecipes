<?php

namespace App\Livewire\Post;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Livewire\Component;
use Mary\Traits\Toast;

class Edit extends Component
{
    use Toast;
    public Collection $tags;
    public array $tags_multi_ids = [];

    public $post;
    public $slug;
    //FORM
    public $name;
    public $prepTime;
    public $cookTime;
    public $description;
    public $image;
    public $video;
    public array $ingredients = [];
    public array $steps = [];

    public function addIngredient()
    {
        $this->ingredients[] = ['name' => '', 'quantity' => '']; // Ensure a structured array
    }

    public function removeIngredient($index)
    {
        unset($this->ingredients[$index]);
        $this->ingredients = array_values($this->ingredients); // Re-index the array properly
    }

    public function addStep()
    {
        $this->steps[] = ['text' => ''];
    }

    public function removeStep($index)
    {
        unset($this->steps[$index]);
        $this->steps = array_values($this->steps);
    }

    protected $rules = [
        'name' => ['required'],
        'description' => ['required'],
        'prepTime' => 'required|numeric|min:0',
        'cookTime' => 'required|numeric|min:0',
        'tags_multi_ids' => ['required'],
        'ingredients' => ['required'],
        'ingredients.*.name' => 'required|string',
        'ingredients.*.quantity' => 'required|string',
        'steps' => ['required'],
        'steps.*.text' => 'required',
    ];

    public function save()
    {
        $this->validate();

        $this->post->name = $this->name;
        $this->post->description = $this->description;
        $this->post->prepTime = $this->prepTime;
        $this->post->cookTime = $this->cookTime;
        $this->post->tags()->sync($this->tags_multi_ids);

        $this->post->ingredients()->delete();

        foreach ($this->ingredients as $ingredient) {
            $this->post->ingredients()->create($ingredient);
        }

        $this->post->steps()->delete();

        foreach ($this->steps as $step) {
            $this->post->steps()->create($step);
        }

        $this->post->slug = Str::slug($this->name) . '-' . rand(1000, 9999);
        $this->post->save();

        return $this->success(
            'Post saved!',
            redirectTo: '/recipe/' . $this->post->slug
        );

        // return $this->success('test');
    }


    public function mount()
    {
        $this->tags = Tag::All();
        $this->post = Post::where('slug', $this->slug)
            ->firstOrFail();
        $this->name = $this->post->name;
        $this->prepTime = $this->post->prepTime;
        $this->cookTime = $this->post->cookTime;
        $this->description = $this->post->description;
        foreach ($this->post->tags as $tag) {
            $this->tags_multi_ids[] = $tag->id; 
        }

        foreach ($this->post->ingredients as $ingredient) {
            $this->ingredients[] = ['name' => $ingredient->name, 'quantity' => $ingredient->quantity];
        }
        foreach ($this->post->steps as $step) {
            $this->steps[] = ['text' => $step->text];
        }
    }

    public function render()
    {
        return view('livewire.post.edit');
    }
}
