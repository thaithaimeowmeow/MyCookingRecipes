<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <h1 class="text-5xl font-bold text-gray-800 mb-6">Edit Tag</h1>

        <x-mary-form wire:submit="save">
            <x-mary-input label="Tag name" wire:model="name" icon="m-tag" />

            <x-mary-input label="Slug" wire:model="slug" disabled />

            <x-slot:actions>
                <x-mary-button label="Cancel" link="/admin/tag" />
                <x-mary-button label="Delete" class="btn-error" wire:click="deleteTag"
                    onclick="confirm('Are you sure you want to delete this?') || event.stopImmediatePropagation()" />
                <x-mary-button label="Save" class="btn-warning" type="submit" spinner="save" />
            </x-slot:actions>

        </x-mary-form>
    </div>
</div>
