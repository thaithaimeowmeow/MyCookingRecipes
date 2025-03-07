<div>
    <x-mary-form wire:submit.prevent="save" class="max-w-6xl mx-auto mt-6 bg-white px-4 shadow-md pt-2 pb-4 mb-3">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Column (Image) -->
            <div class="flex justify-center items-center">
                <img src="{{ $post->image }}" alt="{{ $post->name }}" class="w-full h-[400px] object-cover shadow-md">
            </div>

            <!-- Right Column (Content) -->
            <div class="flex flex-col items-center justify-center p-4 h-full border-b-2">
                <div class="text-center">
                    <x-mary-input wire:model="name" class="text-3xl font-semibold text-center"></x-mary-input>
                </div>
            </div>

        </div>
        <!-- New Two-Column Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6 border-b-2 pb-6">
            <!-- Left Column (Likes & Tags) -->
            <div class="flex flex-col items-center md:items-start w-full">
                <!-- Time Information in 2 columns -->
                <div class="grid grid-cols-2 gap-2 w-full">
                    <div class="font-semibold">Prep Time</div>
                    <div><input wire:model="prepTime" class="w-[50px] " /> minutes</div>

                    <div class="font-semibold">Cooking Time</div>
                    <div><input wire:model="cookTime" class="w-[50px] " /> minutes</div>
                </div>

                <div class="grid grid-cols-2 gap-2 mt-2 w-full">
                    <div class="font-semibold">Video</div>
                    <div class="flex flex-wrap gap-2">
                        <x-mary-input wire:model="video" small/>
                    </div>
                </div>

                <!-- Tags Section in 2 Columns -->
                <div class="grid grid-cols-2 gap-2 mt-2 w-full">
                    <div class="font-semibold">Tags</div>
                    <div class="flex flex-wrap gap-2">
                        <x-mary-choices wire:model="tags_multi_ids" :options="$tags" />
                    </div>
                </div>
            </div>

            <!-- Right Column (Description) -->
            <div>
                <h2 class="text-2xl font-semibold">Description</h2>
                <x-mary-textarea rows="5" class="mt-2 text-gray-700" wire:model="description"></x-mary-textarea>
            </div>
        </div>


        <!-- New Two-Column Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6 pb-6">
            <!-- Recipe Details -->
            <div class="">
                <h2 class="text-2xl font-semibold">Ingredients</h2>
                <h2 class="text-md font-semibold mt-1">Yield: <input wire:model="yields" class="w-[100px] " /> </h2>
                <ul class="mt-2 space-y-1 list-disc list-inside text-gray-700">
                    @foreach ($ingredients as $index => $ingredient)
                        <li class="flex items-center justify-between">
                            <x-mary-input wire:model.defer="ingredients.{{ $index }}.name"
                                placeholder="Ingredient name" />
                            <x-mary-input wire:model.defer="ingredients.{{ $index }}.quantity"
                                placeholder="Quantity" />
                            <x-mary-button label="✖" wire:click.prevent="removeIngredient({{ $index }})"
                                class="btn-danger text-sm ml-4" />
                        </li>
                    @endforeach
                </ul>
                <x-mary-button label="+ Add Ingredient" wire:click.prevent="addIngredient" class="btn-primary mt-2" />
            </div>

            <!-- Right Column (Description) -->
            <div>
                <h2 class="text-2xl font-semibold">Instructions</h2>
                <ol class="mt-2 space-y-2 list-decimal list-inside text-gray-700">
                    @foreach ($steps as $index => $step)
                        <div class="text-xl font-semibold mt-2">Step {{ $loop->iteration }}</div>
                        <x-mary-textarea wire:model.defer="steps.{{ $index }}.text"
                            placeholder="Write your instruction ..." rows="3" class="flex-1 w-full" />
                        <x-mary-button label="✖" wire:click.prevent="removeStep({{ $index }})"
                            class="btn-danger text-sm self-start" />
                    @endforeach

                </ol>
                <x-mary-button label="+ Add Step" wire:click.prevent="addStep" class="btn-primary mt-2" />

            </div>
        </div>



        <x-slot:actions>
            <x-mary-button label="Submit" class="btn-primary" type="submit" spinner="Create" />
        </x-slot:actions>
    </x-mary-form>

</div>
