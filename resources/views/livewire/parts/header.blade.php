<div>
    <nav x-data="{ open: false }" class="w-full pb-1 px-4 shadow-md" style="z-index: 101">
        <div class=" container flex justify-between">
            <div class="py-2 ">
                <a href="{{ route('home') }}"><img src="/images/logo.jpeg" alt="{{ config('deep.brand') }}" class="nav-logo" width="90" height="102" style="max-width: 100px;"></a>
            </div>
            <div class="hidden sm:flex items-center justify-around">
                <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('sportsListing')" class="pr-5">{{ __('Home') }}</x-nav-link>
                <x-nav-link href="{{ route('about') }}" :active="request()->routeIs('sportsListing')" class="pr-5">{{ __('About Us') }}</x-nav-link>
                <x-nav-link href="{{ route('blogs') }}" :active="request()->routeIs('sportsListing')" class="pr-5">{{ __('Blogs') }}</x-nav-link>
                <x-nav-link href="{{ route('contact') }}" :active="request()->routeIs('sportsListing')" class="pr-5">{{ __('Contact Us') }}</x-nav-link>
                <ul class="flex flex-wrap items-center justify-end">
                    @if( !Auth::check() )
                        <div class="flex text-white">
                            <a href="/login" class="hover:cursor-pointer"><span class="btn text-white font-bold rounded-full px-5 mx-2">Login</span></a>
                            <a href="/register" class="hover:cursor-pointer"><span class="btn text-white font-bold rounded-full px-5 mx-2">Register</span></a>
                        </div>
                    @else
                        <div class="ml-3 inline-flex relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    @if( Auth::check() )
                                        <div class="flex items-center hover:cursor-pointer">
                                            @if( Auth::user()->profile_photo_path )
                                                <img src="{{ Auth::user()->profile_photo_path }}" alt="{{ config('deep.brand') }}" class="rounded-full" style="max-width: 30px">
                                            @else
                                                <div class="bg-primary rounded-full flex items-center justify-center" style="height: 30px; width: 30px">
                                                    <p class="font-bold text-white text-xl">{{ substr(Auth::user()->name, 0, 1) }}</p>
                                                </div>
                                            @endif
                                            <svg style="width: 25px" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#294551"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                                        </div>
                                    @endif
                                </x-slot>
                                <x-slot name="content">
                                        @if( Auth::check() && Auth::user()->hasRole([ 'owner', 'superadmin', 'admin', 'seo']) )
                                            <x-dropdown-link href="{{ route('adminMeta') }}">{{ __('Admin Panel') }}</x-dropdown-link>
                                        @endif
                                        <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                        <x-dropdown-link href="{{ route('logout') }}"
                                                @click.prevent="$root.submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @endif
                </ul>
            </div>
        </div>                
        <div class="flex items-center sm:hidden">
            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out" aria-label="Toggle Mobile Menu">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>                
        </div>
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class=" border-t border-gray-200">
                @if( Auth::check() )
                    <div class="flex items-center justify-between px-4">
                        <div>
                            <div class="font-bold text-sm text-center">{{ Auth::user()->name }}</div>
                            <div class="font-bold text-sm text-center">{{ Auth::user()->phone }}</div>
                        </div>
                        <div class="mt-3 space-y-1">
                        <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="flex items-center justify-between font-bold py-3 mt-1 bg-white px-4 w-full">
                        <a href="/register" class="text-base">Register</a>
                        <a href="/login" class="text-base">Login</a>
                    </div>
                @endif
            </div>
        </div>
    </nav>
</div>