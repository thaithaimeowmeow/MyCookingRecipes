<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-5xl font-bold text-gray-800 mb-6">Create Tag</h1> 

        <x-mary-form wire:submit="save">
            <x-mary-input label="Tag Name" wire:model="name" placeholder="Tag name" icon="m-tag" />

            <x-slot:actions>
                <x-mary-button label="Cancel" link="/admin/tag" />
                <x-mary-button label="Submit" class="btn-primary" type="submit" spinner="Create" />
            </x-slot:actions>

        </x-mary-form>
    </div>
</div>
