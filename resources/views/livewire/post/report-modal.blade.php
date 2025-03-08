<div>
    <x-mary-modal wire:model="reportModal" class="backdrop-blur-sm p-2">
        <x-mary-textarea label="Reason" wire:model="content" class="mb-5"></x-mary-textarea>
        <div class="flex justify-end space-x-2">
            <x-mary-button label="Cancel" @click="$wire.reportModal = false" />
            <x-mary-button wire:click.prevent="submitReport" label="Save" />
        </div>
    </x-mary-modal>

    <x-mary-button class="bg-red-400" label="Report this recipe" @click="$wire.reportModal = true" />
</div>
