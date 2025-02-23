@php
    $user = App\Models\User::first();
@endphp
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md mt-4">
    <!-- User Avatar & Info -->
    <div class="flex items-center space-x-4">
        <x-mary-avatar class="!w-24">
            <x-slot:title class="text-3xl pl-2">
                {{ $user->username}}
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

        @php
            $dummyPosts = [
                ['title' => 'Delicious Chocolate Cake', 'content' => 'A rich and moist chocolate cake recipe...', 'date' => 'Feb 10, 2024'],
                ['title' => 'Spaghetti Carbonara Recipe', 'content' => 'This creamy pasta dish is a classic...', 'date' => 'Feb 8, 2024'],
                ['title' => 'How to Make the Perfect Omelette', 'content' => 'Follow these simple steps for a fluffy omelette...', 'date' => 'Feb 5, 2024'],
                ['title' => 'Best Homemade Pizza Dough', 'content' => 'Crispy crust, chewy center—this dough is amazing...', 'date' => 'Feb 2, 2024'],
                ['title' => 'Healthy Smoothie Bowl Ideas', 'content' => 'Start your morning with a nutritious smoothie...', 'date' => 'Jan 30, 2024'],
            ];
        @endphp

        @foreach ($dummyPosts as $post)
            <div class="border-b py-4">
                <h3 class="text-lg font-medium">
                    <a href="#" class="text-blue-600 hover:underline">
                        {{ $post['title'] }}
                    </a>
                </h3>
                <p class="text-gray-600 text-sm">{{ Str::limit($post['content'], 100) }}</p>
                <span class="text-gray-400 text-xs">{{ $post['date'] }}</span>
            </div>
        @endforeach
    </div>
</div>
