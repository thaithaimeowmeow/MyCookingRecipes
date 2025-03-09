<div>
    <div class="max-w-6xl mx-auto mt-6 bg-white px-4 shadow-md pt-2 pb-4 mb-3">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Column (Image) -->
            <div class="relative flex justify-center items-center">
                <img src="{{ $post->image }}" alt="{{ $post->name }}" class="w-full h-[400px] object-cover shadow-md">
                @if ($post->video)
                    <a href="{{ $post->video }}" target="_blank"
                        class="absolute bottom-4 right-4 bg-slate-600 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-gray-700 transition ">
                        Watch Video
                    </a>
                @endif
            </div>

            <!-- Right Column (Content) -->
            <div class="flex flex-col justify-center p-6 border-b-2 self-stretch">
                <div class="text-center">
                    <h1 class="text-4xl font-semibold break-words md:max-w-xl">
                        {{ $post->name }}
                    </h1>
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
                <h2 class="text-md font-semibold mt-1">Yield: {{ $post->yields }} </h2>
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

       

    </div>

</div>
