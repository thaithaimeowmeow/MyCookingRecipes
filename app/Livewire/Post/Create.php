<?php

namespace App\Livewire\Post;

use App\Models\Post;
use App\Models\Tag;
use App\Services\NotificationService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Mary\Traits\Toast;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Create extends Component
{
    use Toast;
    use WithFileUploads;
    public Collection $tags;
    public array $tags_multi_ids = [];

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

    private $notificationService;

    public function boot(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    protected $rules = [
        'name' => ['required'],
        'description' => ['required'],
        'image' => 'required|image',
        'prepTime' => 'required|numeric|min:0',
        'cookTime' => 'required|numeric|min:0',
        'tags_multi_ids' => ['required'],
        'yields' => ['required'],
        'ingredients' => ['required'],
        'ingredients.*.name' => 'required|string',
        'ingredients.*.quantity' => 'required|string',
        'steps' => ['required'],
        'steps.*.text' => 'required',
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

    public function addStep()
    {
        $this->steps[] = ['text' => ''];
    }

    public function removeStep($index)
    {
        unset($this->steps[$index]);
        $this->steps = array_values($this->steps);
    }

    public function save()
    {
        $this->validate();

        $cloudinaryUploadUrl = cloudinary()->upload($this->image->getRealPath())->getSecurePath();

        if ($this->video && !str_contains($this->video, 'youtube.com')) {
            $this->video = null;
        }
        
        $newPost = auth()->user()->posts()->create(
            [
                'name' => $this->name,
                'slug' => Str::slug($this->name) . '-' . rand(1000, 9999),
                'image' => $cloudinaryUploadUrl,
                'video' => $this->video,
                'prepTime' => $this->prepTime,
                'cookTime' => $this->cookTime,
                'totalTime' => (int) $this->prepTime + (int) $this->cookTime,
                'yields' => $this->yields,
                'description' => $this->description,
            ]
        );

        $newPost->tags()->attach($this->tags_multi_ids);

        foreach ($this->ingredients as $ingredient) {
            $newPost->ingredients()->create($ingredient);
        }

        foreach ($this->steps as $step) {
            $newPost->steps()->create($step);
        }

        $this->notificationService->createApproval( $newPost->id,auth()->user()->id);
        
        return $this->success(
            'Your post is waiting for approval.',
            redirectTo: '/user/' . Auth::user()->username,
        );
    }

    public function mount()
    {
        $this->tags = Tag::All();
    }


    public function render()
    {
        return view('livewire.post.create');
    }
}
