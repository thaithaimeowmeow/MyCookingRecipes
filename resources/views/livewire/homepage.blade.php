<div>
    <!-- Hero Section with Background & Website Name -->
    <div class="relative h-[350px] bg-cover bg-center flex items-center justify-center"
        style="background-image: url('https://plus.unsplash.com/premium_photo-1673108852141-e8c3c22a4a22?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="relative text-center text-white px-6">
            <h1 class="text-5xl font-bold">MyCookingRecipes</h1>
            <p class="text-lg mt-2">Explore thousands of hand-picked recipes, just for you.</p>
        </div>
    </div>

    <!-- Featured Categories (Hardcoded Frontend) -->
    <div class="max-w-7xl mx-auto mt-12 px-6">
        <h2 class="text-3xl font-semibold text-center">Browse by Category</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-6">
            <!-- Easy -->
            @php
                $easyPost =
                    $posts
                        ->filter(function ($post) {
                            return $post->tags->contains('slug', 'easy');
                        })
                        ->first() ?? null;

                $hardPost =
                    $posts
                        ->filter(function ($post) {
                            return $post->tags->contains('slug', 'hard');
                        })
                        ->first() ?? null;

                $breakfastPost =
                    $posts
                        ->filter(function ($post) {
                            return $post->tags->contains('slug', 'breakfast');
                        })
                        ->first() ?? null;

                $weekendsPost =
                    $posts
                        ->filter(function ($post) {
                            return $post->tags->contains('slug', 'weekends');
                        })
                        ->first() ?? null;
            @endphp



            <div class="block bg-white shadow-md rounded-lg p-4 text-center">
                <a href="{{ route('browse', ['selectedTag' => 'easy']) }}" class="block">
                    <div class="w-20 h-20 mx-auto overflow-hidden">
                        <img src="{{ $easyPost ? $easyPost->image : 'https://source.unsplash.com/200x200/?cooking,easy' }}"
                            class="w-full h-full object-cover">
                    </div>
                    <h3 class="mt-2 font-semibold">Easy</h3>
                </a>
            </div>


            <!-- Hard -->
            <div class="block bg-white shadow-md rounded-lg p-4 text-center">
                <a href="{{ route('browse', ['selectedTag' => 'hard']) }}">
                    <div class="w-20 h-20 mx-auto overflow-hidden">
                        <img src="{{ $hardPost ? $hardPost->image : 'https://source.unsplash.com/200x200/?cooking,easy' }}"
                            class="w-full h-full object-cover">
                    </div>
                    <h3 class="mt-2 font-semibold">Hard</h3>
                </a>
            </div>

            <!-- Breakfast -->
            <div class="block bg-white shadow-md rounded-lg p-4 text-center">
                <a href="{{ route('browse', ['selectedTag' => 'breakfast']) }}">
                    <div class="w-20 h-20 mx-auto overflow-hidden">
                        <img src="{{ $breakfastPost ? $breakfastPost->image : 'https://source.unsplash.com/200x200/?cooking,easy' }}"
                            class="w-full h-full object-cover">
                    </div>
                    <h3 class="mt-2 font-semibold">Breakfast</h3>
                </a>
            </div>

            <!-- Weekends -->
            <div class="block bg-white shadow-md rounded-lg p-4 text-center">
                <a href="{{ route('browse', ['selectedTag' => 'weekends']) }}">
                    <div class="w-20 h-20 mx-auto overflow-hidden">
                        <img src="{{ $weekendsPost ? $weekendsPost->image : 'https://source.unsplash.com/200x200/?cooking,easy' }}"
                            class="w-full h-full object-cover">
                    </div>
                    <h3 class="mt-2 font-semibold">Weekends</h3>
                </a>
            </div>

        </div>
    </div>


    <!-- Latest Recipes -->
    <div class="max-w-7xl mx-auto mt-12 px-6">
        <!-- Latest Recipes Section -->
        <h2 class="text-3xl font-semibold text-center">Latest Recipes</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            @foreach ($posts as $item)
                <div
                    class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col transition-transform transform hover:scale-105 hover:shadow-xl duration-300">
                    <img src="{{ $item->image }}" class="w-full h-52 object-cover">
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-xl font-semibold">{{ $item->name }}</h3>
                        <p class="text-sm text-gray-500">By {{ $item->user->username }}</p>
                        <p class="text-sm flex-grow">
                            {{ $item->totalTime }} minutes •
                            @if ($item->likers()->count() > 1)
                                {{ $item->likers()->count() }} likes
                            @elseif ($item->likers()->count() == 1)
                                1 like
                            @else
                                0 like
                            @endif
                        </p>
                        <a href="{{ route('post.index', $item->slug) }}"
                            class="text-blue-600 mt-auto inline-block">View
                            Recipe →</a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Most Liked Recipes Section -->
        <h2 class="text-3xl font-semibold text-center mt-12">Most Liked Recipes</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            @foreach ($mostLiked as $item)
                <div
                    class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col transition-transform transform hover:scale-105 hover:shadow-xl duration-300">
                    <img src="{{ $item->image }}" class="w-full h-52 object-cover">
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-xl font-semibold">{{ $item->name }}</h3>
                        <p class="text-sm text-gray-500">By {{ $item->user->username }}</p>
                        <p class="text-sm flex-grow">
                            {{ $item->likers()->count() }} likes
                        </p>
                        <a href="{{ route('post.index', $item->slug) }}"
                            class="text-blue-600 mt-auto inline-block">View
                            Recipe →</a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Trending Recipes Section -->
        {{-- <h2 class="text-3xl font-semibold text-center mt-12">Trending Recipes</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            @foreach ($trending as $item)
                <div
                    class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col transition-transform transform hover:scale-105 hover:shadow-xl duration-300">
                    <img src="{{ $item->image }}" class="w-full h-52 object-cover">
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-xl font-semibold">{{ $item->name }}</h3>
                        <p class="text-sm text-gray-500">By {{ $item->user->username }}</p>
                        <p class="text-sm flex-grow">
                            Trending 🔥
                        </p>
                        <a href="{{ route('post.index', $item->slug) }}"
                            class="text-blue-600 mt-auto inline-block">View
                            Recipe →</a>
                    </div>
                </div>
            @endforeach
        </div> --}}
        
        <!-- Custom Animations -->
        <style>
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fade-in {
                animation: fadeIn 0.8s ease-out;
            }
        </style>

    </div>


    <!-- Load More Button -->
    <div class="text-center mt-8">
        <x-mary-button Link="/browse" class="bg-blue-500 text-white px-6 py-3 rounded-lg">Browse More
            Recipes</x-mary-button>
    </div>
</div>
