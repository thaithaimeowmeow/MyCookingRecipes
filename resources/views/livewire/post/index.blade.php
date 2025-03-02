<div>
    <div class="max-w-6xl mx-auto p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
            <!-- Left Column (Image) -->
            <div class="flex justify-center items-center">
                <img src="{{ $post->image }}" alt="{{ $post->name }}" class="w-full h-[400px] object-cover shadow-md">
            </div>

            <!-- Right Column (Content) -->
            <div class="flex flex-col items-center justify-center p-4 h-full border-b-2">
                <div class="text-center">
                    <h1 class="text-4xl font-semibold">{{ $post->name }}</h1>
                    <p class="text-gray-600 mt-2">
                        By <a href="{{ route('user.index', $post->user->username) }}"
                            class="font-medium">{{ $post->user->username }}</a>
                    </p>
                    <p class="text-sm">
                        Posted on {{ $post->created_at->format('Y-m-d H:i') }}
                    </p>
                </div>
            </div>

        </div>
        <!-- New Two-Column Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6 border-b-2 pb-6">
            <!-- Left Column (Likes & Tags) -->
            <div class="flex flex-col items-center md:items-start w-full">
                <!-- Time Information in 2 columns -->
                <div class="grid grid-cols-2 gap-2 w-full">
                    <div class="font-bold">Total Time</div>
                    <div>{{ $post->totalTime }} minutes</div>

                    <div class="font-semibold">Prep Time</div>
                    <div>{{ $post->prepTime }} minutes</div>

                    <div class="font-semibold">Cooking Time</div>
                    <div>{{ $post->cookTime }} minutes</div>
                </div>

                <!-- Upvote section -->
                <div class="grid grid-cols-2 gap-2 mt-2 w-full items-center">
                    <div class="font-semibold">Upvote</div>
                    <div class="flex gap-4">
                        @auth
                            @if ($post->isLikedBy(auth()->user()))
                                <button class="flex items-center" wire:click="toggleLikeFromPost()">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="size-6">
                                        <path
                                            d="M7.493 18.5c-.425 0-.82-.236-.975-.632A7.48 7.48 0 0 1 6 15.125c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75A.75.75 0 0 1 15 2a2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23h-.777Z" />
                                    </svg>
                                    <div class="ml-1">Liked</div>
                                </button>
                            @else
                                <button class="flex items-center" wire:click="toggleLikeFromPost()">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                                    </svg>
                                    <div class="ml-1">Like</div>
                                </button>
                            @endif
                        @endauth
                        <div class="text-lg">
                            @if ($post->likers()->count() > 1)
                                {{ $post->likers()->count() }} likes
                            @elseif ($post->likers()->count() == 1)
                                1 like
                            @else
                                0 like
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Tags Section in 2 Columns -->
                <div class="grid grid-cols-2 gap-2 mt-2 w-full">
                    <div class="font-semibold">Tags</div>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($post->tags as $tag)
                            <x-mary-badge value="{{ $tag->name }}" class="text-md badge-neutral pb-1" />
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Column (Description) -->
            <div>
                <h2 class="text-2xl font-semibold">Description</h2>
                <p class="mt-2 text-gray-700">{{ $post->description }}</p>
            </div>
        </div>


        <!-- New Two-Column Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6 border-b-2 pb-6">
            <!-- Recipe Details -->
            <div class="">
                <h2 class="text-2xl font-semibold">Ingredients</h2>
                <ul class="mt-2 space-y-1 list-disc list-inside text-gray-700">
                    @foreach ($post->ingredients as $ingredient)
                        <li>{{ $ingredient->quantity . ' ' . $ingredient->name }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- Right Column (Description) -->
            <div>
                <h2 class="text-2xl font-semibold">Instructions</h2>
                <ol class="mt-2 space-y-2 list-decimal list-inside text-gray-700">
                    @foreach ($post->steps as $step)
                        <div class="text-xl font-semibold mt-2">Step {{ $loop->iteration }}</div>
                        <div>{{ $step->text }}</div>
                    @endforeach
                </ol>
            </div>
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
