<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-5xl font-bold text-gray-800 mb-6">New recipe</h1>

            <x-mary-form wire:submit="save">
                <x-mary-input label="Recipe name" wire:model="name" placeholder="Recipe name" icon="m-tag" />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-mary-input label="Prep Time" wire:model="prepTime" placeholder="Prep Time" icon="m-clock" />
                    <x-mary-input label="Cook Time" wire:model="cookTime" placeholder="Cook Time" icon="m-clock" />
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-mary-file wire:model="image" label="Thumbnail" accept="image/*" />
                    <x-mary-input label="Video URL" wire:model="video" placeholder="Input your link here" hint="Only accept Youtube link" icon="m-video-camera" />
                </div>

                <x-slot:actions>
                    <x-mary-button label="Submit" class="btn-primary" type="submit" spinner="Create" />
                </x-slot:actions>
            </x-mary-form>

        </div>
    </div>

</div>
