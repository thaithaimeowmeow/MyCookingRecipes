<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-8 border">
    <!-- User Avatar & Info -->
    <div class="flex items-center space-x-4">
        <x-mary-avatar :image="$user->avatar" class="!w-24">
            <x-slot:title class="text-3xl pl-2">
                {{ $user->username }}
                @if($user->IsActive == false)
                <x-mary-button wire:click="enableUser" class="p-[-2] bg-green-500">Enable this user</x-mary-button>
                @else
                <x-mary-button wire:click="disableUser" class="p-[-2] bg-red-500">Disable this user</x-mary-button>
                @endif

            </x-slot:title>

            <x-slot:subtitle class="text-gray-500 flex flex-col gap-1 mt-2 pl-2">
                <x-mary-icon name="o-paper-airplane" label="{{ $user->posts->count() }} posts" />
                <x-mary-icon name="o-chat-bubble-left" label="{{ $user->comments->count() }} comments" />
            </x-slot:subtitle>
        </x-mary-avatar>
    </div>

    <!-- User Posts (Dummy Data) -->
    <div class="mt-6">
        <h2 class="text-xl font-semibold mb-4">Recent Posts</h2>
        @if ($user->posts->isEmpty())
            <h1>This user has no post.</h1>
        @else
            @foreach ($user->posts()->orderBy('created_at', 'desc')->get() as $post)
                <div class="border-b py-4 flex justify-between items-center">
                    <div>
                        <h3 class="flex text-lg font-medium">
                            @if ($post->isApproved)
                                <a href="/recipe/{{ $post->slug }}" class="text-blue-600 hover:underline">
                                    {{ $post->name }}
                                </a>
                            @elseif($post->user->id == Auth::user()->id)
                                {{-- <a href="/recipe/{{ $post->slug }}/preview" class="text-blue-600 hover:underline">
                                    {{ $post->name }}
                                </a> --}}
                                <x-mary-badge value="Waiting for approval" class="text-black bg-yellow-300 mt-1 ml-2" />
                            @endif
                        </h3>
                        <p class="text-gray-600 text-sm">{{ Str::limit($post->description, 100) }}</p>
                        <span class="text-gray-400 text-xs">{{ $post->created_at }}</span>
                    </div>

                    <div class="flex space-x-2">
                        <!-- Edit Button -->
                        <a href="{{ route('post.edit', $post->slug) }}" class="text-blue-500 hover:text-blue-700">
                            <x-mary-icon name="o-pencil" />
                        </a>

                        <!-- Delete Button -->
                        <button type="button"
                            wire:confirm="Are you sure you want to delete this post? (This action can NOT be reverted)"
                            wire:click="deletePostWithID({{ $post->id }})" class="text-red-500 hover:text-red-700">
                            <x-mary-icon name="o-trash" />
                        </button>
                    </div>
                </div>
            @endforeach

        @endif

    </div>
</div>
