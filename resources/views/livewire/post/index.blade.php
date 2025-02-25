<div>
    <div class="max-w-4xl mx-auto p-6">

        <!-- Recipe Header -->
        <div class="text-center">
            <h1 class="text-4xl font-bold">TITLE NAME</h1>
            <p class="text-gray-600 mt-2">By <span class="font-medium">AUTHOR NAME</span> | DATE</p>
        </div>
    
        <!-- Recipe Image -->
        <div class="mt-6">
            <img src="" alt="asdasd" class="w-full h-96 object-cover rounded-lg shadow-md">
        </div>
    
        <!-- Recipe Details -->
        <div class="mt-6">
            <h2 class="text-2xl font-semibold">Ingredients</h2>
            <ul class="mt-2 space-y-1 list-disc list-inside text-gray-700">
                {{-- @foreach ($recipe['ingredients'] as $ingredient)
                    <li>{{ $ingredient }}</li>
                @endforeach --}}
            </ul>
        </div>
    
        <div class="mt-6">
            <h2 class="text-2xl font-semibold">Instructions</h2>
            <ol class="mt-2 space-y-2 list-decimal list-inside text-gray-700">
                {{-- @foreach ($recipe['instructions'] as $step)
                    <li>{{ $step }}</li>
                @endforeach --}}
            </ol>
        </div>
    
        <!-- Recipe Tags -->
        <div class="mt-6 flex flex-wrap gap-2">
            {{-- @foreach ($recipe['tags'] as $tag)
                <x-mary-badge primary>{{ $tag }}</x-mary-badge>
            @endforeach --}}
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
