    <div>
        <div class="max-w-7xl mx-auto p-6">

            <!-- Page Header -->
            <div class="text-center">
                <h1 class="text-4xl font-bold">Browse recipes</h1>
                <div wire:poll.300ms>Current search: {{ $search }}</div>
                <p class="text-lg text-gray-600 mt-2">Discover thousands of delicious recipes, handpicked for you.</p>
            </div>
            <!-- Search & Filters -->
            <div class="mt-6 flex flex-col md:flex-row gap-4 justify-between items-center">
                <!-- Search Bar -->
                <input type="text" wire:model.debounce.300="search" placeholder="Search recipes..."
                    class="w-full md:w-1/3 px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-500">

                <!-- Filters -->
                <select class="px-4 py-2 border rounded-lg">
                    <option>Latest recipes</option>
                    <option>Oldest recipes</option>
                    <option>Most liked</option>
                </select>

                <select class="px-4 py-2 border rounded-lg">
                    <option>Meal Type</option>
                    <option>Breakfast</option>
                    <option>Lunch</option>
                    <option>Dinner</option>
                </select>

                <select class="px-4 py-2 border rounded-lg">
                    <option>Dietary</option>
                    <option>Vegetarian</option>
                    <option>Vegan</option>
                    <option>Gluten-Free</option>
                </select>
            </div>

            <!-- Recipe Grid -->
            <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mt-8">
                @foreach ($posts as $post)
                    <div wire:key="{{ $post->id }}" class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="{{ $post->image }}" class="w-full h-52 object-cover">
                        <div class="p-4">
                            <h3 class="text-xl font-semibold">{{ $post->name }}</h3>
                            <h3 class="text-md">Posted by: <b>{{ $post->user->username }}</b> </h3>
                            <h3 class="text-md">
                                @if ($post->likers()->count() > 1)
                                    {{ $post->likers()->count() }} likes
                                @elseif ($post->likers()->count() == 1)
                                    1 like
                                @else
                                    0 like
                                @endif
                            </h3>
                            <h3 class="text-md mb-2">{{ $post->totalTime }} minutes</h3>
                            <x-mary-button small link="/recipe/{{ $post->slug }}">View Recipe</x-mary-button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8 text-center">
                <x-mary-button wire:click.prevent="loadMore" primary>Load More Recipes</x-mary-button>
            </div>

        </div>
    </div>
