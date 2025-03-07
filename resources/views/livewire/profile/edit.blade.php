<div class="max-w-2xl mx-auto bg-base-100 p-6 rounded-lg shadow-lg mt-6">
    <h2 class="text-2xl font-semibold mb-6">Edit Profile</h2>
    <x-mary-form wire:submit="editInfo" no-separator class="border-b-2 pb-3">
        <!-- Profile Photo -->
        <div class="flex flex-col items-center mb-6">
            <div class="avatar">
                <div class="w-28 h-28 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                    @if ($image)
                        <img src="{{ $image->temporaryUrl() }}">
                    @else
                        <img
                            src="{{ $avatar ? asset($avatar) : asset('images/default-avatar.png') }}">
                    @endif
                </div>
            </div>
            <x-mary-file wire:model="image" label="Upload New Photo" accept="image/*" class="mt-4" />
        </div>

        <!-- Username & Email -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-mary-input label="Username" wire:model="username" />
            <x-mary-input label="Email" wire:model="email" type="email" />
        </div>
        <x-slot:actions>
            <x-mary-button label="Save information" class="btn-primary font-bold" type="submit" spinner="Create" />
        </x-slot:actions>
    </x-mary-form>
    <h2 class="text-2xl font-semibold mt-4">Change password</h2>
    <x-mary-form wire:submit="changePassword" no-separator >

        <!-- Password Fields -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <x-mary-input label="New Password" wire:model="password" type="password" />
            <x-mary-input label="Confirm Password" wire:model="password_confirmation" type="password" />
        </div>

        <x-slot:actions>
            <x-mary-button label="Change password" class="btn-primary font-bold" type="submit" spinner="Create" />
        </x-slot:actions>
    </x-mary-form>
</div>
