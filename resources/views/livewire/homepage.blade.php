<div>
    <div class="max-w-7xl mx-auto p-6">

        <!-- Page Header -->
        <div class="text-center">
            <h1 class="text-4xl font-bold">All Recipes</h1>
            <p class="text-lg text-gray-600 mt-2">Discover thousands of delicious recipes, handpicked for you.</p>
        </div>

        <!-- Search & Filters -->
        <div class="mt-6 flex flex-col md:flex-row gap-4 justify-between items-center">
            <!-- Search Bar -->
            <input type="text" placeholder="Search recipes..."
                class="w-full md:w-1/3 px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-red-500">

            <!-- Filters -->
            <select class="px-4 py-2 border rounded-lg">
                <option>All Cuisines</option>
                <option>Italian</option>
                <option>Mexican</option>
                <option>Asian</option>
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
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            @php
                $recipes = [
                    ['title' => 'Spaghetti Carbonara', 'image' => 'https://source.unsplash.com/600x400/?pasta'],
                    ['title' => 'Classic Pancakes', 'image' => 'https://source.unsplash.com/600x400/?pancakes'],
                    ['title' => 'Grilled Chicken Salad', 'image' => 'https://source.unsplash.com/600x400/?salad'],
                    ['title' => 'Chocolate Cake', 'image' => 'https://source.unsplash.com/600x400/?cake'],
                    ['title' => 'Sushi Rolls', 'image' => 'https://source.unsplash.com/600x400/?sushi'],
                    ['title' => 'Homemade Pizza', 'image' => 'https://source.unsplash.com/600x400/?pizza'],
                ];
            @endphp

            @foreach ($recipes as $recipe)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ $recipe['image'] }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold">{{ $recipe['title'] }}</h3>
                        <x-mary-button small href="#">View Recipe</x-mary-button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8 text-center">
            <x-mary-button primary>Load More Recipes</x-mary-button>
        </div>

    </div>
</div>
