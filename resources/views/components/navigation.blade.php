<nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">

                @if (Route::has('login'))
                    <!-- Public data -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('public.data')" :active="request()->routeIs('public.data')">
                            {{ __('View public notes') }}
                        </x-nav-link>
                    </div>
                    @auth
                        <!-- My work -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <x-nav-link :href="route('user.show')" :active="request()->routeIs('user.show')">
                                {{ __('My work') }}
                            </x-nav-link>
                        </div>

                        <!-- Profile -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                                {{ __('Profile') }}
                            </x-nav-link>
                        </div>

                        <!-- Events -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <x-nav-link :href="route('events.list')" :active="request()->routeIs('events.list')">
                                {{ __('Events') }}
                            </x-nav-link>
                        </div>
                    @else
                        <!-- Log in -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                                {{ __('Log in') }}
                            </x-nav-link>
                        </div>

                        @if (Route::has('register'))
                            <!-- Register -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                                    {{ __('Register') }}
                                </x-nav-link>
                            </div>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </div>
</nav>
