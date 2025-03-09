<?php

namespace App\Livewire\Post;

use App\Models\Post;
use App\Models\Tag;
use App\Services\NotificationService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
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
    public $yields;
    public array $ingredients = [];
    public array $steps = [];

    private NotificationService $notificationService;

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

        if ($this->video && !str_contains($this->video, 'youtube.com')) {
            $this->video = null;
        }

        $this->post->name = $this->name;
        $this->post->video = $this->video;
        $this->post->description = $this->description;
        $this->post->prepTime = $this->prepTime;
        $this->post->cookTime = $this->cookTime;
        $this->post->totalTime = (int) $this->prepTime + (int) $this->cookTime;
        $this->post->yields = $this->yields;
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
        $this->post->isApproved = 0;

        $this->post->save();
        $this->notificationService->createApproval( $this->post->id,auth()->user()->id);


        return $this->success(
            'Your post is waiting for approval.',
            redirectTo: '/user/' . Auth::user()->username,
        );

    }

    public function boot(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }


    public function mount()
    {
        $this->tags = Tag::All();
        $this->post = Post::where('slug', $this->slug)
            ->firstOrFail();
        $this->name = $this->post->name;
        $this->prepTime = $this->post->prepTime;
        $this->cookTime = $this->post->cookTime;
        $this->yields = $this->post->yields;
        $this->video = $this->post->video;
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
