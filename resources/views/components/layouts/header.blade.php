<nav class="bg-white shadow-md p-4">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-800">MyCookingRecipes</a>
            <!-- Navigation Buttons -->
            <x-nav-link :href="route('home')" :active="request()->routeIs('home')"
                class="text-xl text-gray-800 hover:text-gray-600">
                {{ __('Home') }}
            </x-nav-link>
            <x-nav-link :href="route('browse')" :active="request()->routeIs('browse')"
                class="text-xl text-gray-800 hover:text-gray-600">
                {{ __('Browse') }}
            </x-nav-link>

        </div>

        <!-- Navigation Links -->
        <div class="flex items-center space-x-4">
            @guest
                <x-mary-button label="Login" link="{{ route('login') }}" />
                <x-mary-button label="Register" link="{{ route('register') }}" color="primary" />
            @else
                <x-mary-dropdown>
                    <x-slot name="trigger">
                        <x-mary-button label="{{ Auth::user()->username }}" icon="m-user" />
                    </x-slot>

                    <x-mary-menu-item title="My profile" icon="s-user-circle"
                        link="{{ route('user.index', Auth::user()->username) }}" />
                    <x-mary-menu-item title="Create" icon="o-plus-circle" link="{{ route('create') }}" />
                    <x-mary-menu-item title="Edit profile" icon="o-pencil" link="{{ route('user.edit',Auth::user()->username) }}" />
                    <x-mary-menu-item icon="o-arrow-right-circle">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left">Logout</button>
                        </form>
                    </x-mary-menu-item>
                </x-mary-dropdown>
            @endguest
        </div>
    </div>
</nav>
