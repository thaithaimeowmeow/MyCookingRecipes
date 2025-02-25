<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-5xl font-bold text-gray-800 mb-6">New recipe</h1>

            <x-mary-form wire:submit.prevent="save">
                <x-mary-input label="Recipe name*" wire:model="name" placeholder="Recipe name" icon="m-tag" />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-mary-input label="Prep Time (mins* wire:model="prepTime" placeholder="Prep Time"
                        icon="m-clock" />
                    <x-mary-input label="Cook Time (mins)*" wire:model="cookTime" placeholder="Cook Time"
                        icon="m-clock" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-mary-file wire:model="image" label="Thumbnail*" accept="image/*" />
                    <x-mary-input label="Video URL" wire:model="video" placeholder="Input your link here"
                        hint="Only accept Youtube link" icon="m-video-camera" />
                </div>

                <x-mary-textarea label="Description*" wire:model="description" placeholder="Enter your description ..."
                    hint="Max 1000 chars" rows="5" inline />

                <x-mary-choices label="Tags*" wire:model="tags_multi_ids" :options="$tags" />

                <x-slot:actions>
                    <x-mary-button label="Submit" class="btn-primary" type="submit" spinner="Create" />
                </x-slot:actions>

                <div wire:key="ingredient-list">
                    <label class="block text-sm font-medium text-gray-700">Ingredients*</label>
                    @error("ingredients")
                        <span class="text-red-500 text-md">{{ $message }}</span>
                    @enderror
                    <div class="mt-2 space-y-2">
                        @foreach ($ingredients as $index => $ingredient)
                            <div class="flex items-center space-x-2">
                                <x-mary-input wire:model.defer="ingredients.{{ $index }}.name"
                                    placeholder="Ingredient name"/>
                                <x-mary-input wire:model.defer="ingredients.{{ $index }}.quantity"
                                    placeholder="Quantity" />
                                <x-mary-button label="✖" wire:click.prevent="removeIngredient({{ $index }})"
                                    class="btn-danger text-sm ml-4" />
                            </div>
                        @endforeach
                    </div>
                    <x-mary-button label="+ Add Ingredient" wire:click.prevent="addIngredient"
                        class="btn-primary mt-2" />
                </div>





            </x-mary-form>

        </div>
    </div>

</div>
