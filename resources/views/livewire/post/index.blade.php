<div>
    <div class="max-w-6xl mx-auto p-6">

        <!-- Recipe Header -->
        <div class="text-center">
            <h1 class="text-4xl font-bold">{{ $post->name }}</h1>
            <p class="text-gray-600 mt-2">
                By <span class="font-medium">{{ $post->user->username }}</span> | {{ $post->created_at->format('Y-m-d H:i') }}
            </p>
        </div>

        <!-- Recipe Tags -->
        <div class="mt-6 flex gap-2 item-center justify-center">
            @foreach ($post->tags as $tag)
                <x-mary-badge value="{{ $tag->name }}" class="text-lg badge-neutral pb-1" />
            @endforeach
        </div>

        <!-- Recipe Image -->
        <div class="mt-6 border-b-2 pb-6">
            <img src="{{$post->image}}" alt="{{$post->name}}" class="w-full h-96 object-cover rounded-lg shadow-md">
        </div>

        <!-- Recipe Description -->
        <div class="mt-6 border-b-2 pb-6">
            <h2 class="text-2xl font-semibold">Description</h2>
            <p class="mt-2 text-gray-700">{{ $post->description }}</p>
        </div>

        <!-- Recipe Details -->
        <div class="mt-6 border-b-2 pb-6">
            <h2 class="text-2xl font-semibold">Ingredients</h2>
            <ul class="mt-2 space-y-1 list-disc list-inside text-gray-700">
                @foreach ($post->ingredients as $ingredient)
                    <li>{{ $ingredient->quantity . ' ' . $ingredient->name }}</li>
                @endforeach
            </ul>
        </div>

        <div class="mt-6">
            <h2 class="text-2xl font-semibold">Instructions</h2>
            <ol class="mt-2 space-y-2 list-decimal list-inside text-gray-700">
                @foreach ($post->steps as $step)
                    <li>{{ $step->text }}</li>
                @endforeach
            </ol>
        </div>

        
        <!-- Related Recipes -->
        <div class="mt-12">
            <h2 class="text-2xl font-semibold mb-4">Related Recipes</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{-- @foreach ($relatedRecipes as $related)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <img src="{{ $related['image'] }}" class="w-full h-40 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold">{{ $related['title'] }}</h3>
                                <x-mary-button small href="#">View Recipe</x-mary-button>
                            </div>
                        </div>
                    @endforeach --}}
            </div>
        </div>

    </div>
</div>
