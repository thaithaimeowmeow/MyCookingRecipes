<x-guest-layout>
    <!-- Session Status -->
    {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}

    <x-mary-form wire:submit.prevent="login">
        @if ($errorMessage)
            <div class="bg-red-500 text-white p-4 mb-4 rounded-md">
                {{ $errorMessage }}
            </div>
        @endif
        <x-mary-input class="mb-2" wire:wire:model="email" label="Email"></x-mary-input>

        <x-mary-input wire:wire:model="password" label="Password"></x-mary-input>


        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-mary-button
                class="underline text-sm text-gray-600rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                label="Already have an account?" link="/register" class="btn-ghost" />

            <x-mary-button label="Login" class="btn-primary" type="submit" spinner="Create" />

        </div>
    </x-mary-form>

</x-guest-layout>
