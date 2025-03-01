<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-8 border">
    <!-- User Avatar & Info -->
    <div class="flex items-center space-x-4">
        <x-mary-avatar class="!w-24">
            <x-slot:title class="text-3xl pl-2">
                {{ $user->username }}
            </x-slot:title>

            <x-slot:subtitle class="text-gray-500 flex flex-col gap-1 mt-2 pl-2">
                <x-mary-icon name="o-paper-airplane" label="5 posts" />
                <x-mary-icon name="o-chat-bubble-left" label="20 comments" />
            </x-slot:subtitle>
        </x-mary-avatar>
    </div>

    <!-- User Posts (Dummy Data) -->
    <div class="mt-6">
        <h2 class="text-xl font-semibold mb-4">Recent Posts</h2>
        @if ($user->posts->isEmpty())
            <h1>This user has no posts.</h1>
        @else
            @foreach ($user->posts as $post)
                <div class="border-b py-4">
                    <h3 class="text-lg font-medium">
                        <a href="/recipe/{{ $post->slug }}" class="text-blue-600 hover:underline">
                            {{ $post->name }}
                        </a>
                    </h3>
                    <p class="text-gray-600 text-sm">{{ Str::limit($post->description, 100) }}</p>
                    <span class="text-gray-400 text-xs">{{ $post->created_at }}</span>
                </div>
            @endforeach
        @endif

    </div>
</div>
