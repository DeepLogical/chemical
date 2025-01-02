<div class="fijb nav w-full bg-primary deepShadow p-3 z-50">
    <div class="fijb w-full">
        <div style="min-width: 150px">
            <p class="heading">ADP Traders</p>
            <!-- <a href="/"><img src="/images/logo.png" alt="" class="w-full logo"></a> -->
        </div>
        <ul class="fijb">
            @foreach( $data as $i ) <li class="text-white pr-3 md:pr-5 font-bold"><a href="{{ route($i['link']) }}">{{ $i['name'] }}</a></li> @endforeach
        </ul>
    </div>
    <div class="fijb">
        <div class="fijb">
            @if( $showSearch )
                <div>
                    <input type="text" class="formInput" plaecholder="Search" wire:model="search">
                </div>
            @endif
            <img src="/images/icons/static/search-white.svg" class="w-5 hover:cursor-pointer mx-3" wire:click="searchClicked()">
            <img wire:click="$dispatchTo('adminSidebar', 'toggleAdminSidebar')" src="/images/icons/static/grid-white-icon.svg" class="w-5 hover:cursor-pointer mx-3">
            @if( Auth::check() && $notificationCount )
                <div class="dd">
                    <x-dropdown align="right" height="100%" width="100%">
                        <x-slot name="trigger">
                            <img src="/images/icons/static/bell-icon.svg" class="w-5 hover:cursor-pointer mx-3">
                            <span class="absolute top-0 text-xs text-white mt-3">{{ $notificationCount }}</span>
                        </x-slot>
                        <x-slot name="content">
                            @foreach( Auth::user()->unreadNotifications as $i )
                                <x-dropdown-link href="{{ $i->data['url'] }}" class="whitespace-nowrap" wire:key="notify-{{ $loop->index }}">{{ $i->data['message'] }}</x-dropdown-link>
                            @endforeach
                        </x-slot>
                    </x-dropdown>
                </div>
            @endif
        </div>
        <div class="fijb">
            @if( Auth::check() )
                <div class="ml-3 inline-flex relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if( Auth::check() )
                                <div class="flex items-center hover:cursor-pointer">
                                    @if( Auth::user()->profile_photo_path )
                                        <img src="{{ Auth::user()->profile_photo_path }}" alt="{{ config('deep.brand') }}" class="rounded-full" style="max-width: 30px">
                                    @else
                                        {{ Auth::user()->name }}
                                    @endif
                                </div>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            @if( Auth::check() )
                                @if( Auth::user()->hasRole([ 'owner', 'superadmin', 'admin', 'seo']) )
                                    @foreach( $data as $i ) 
                                        <x-dropdown-link href="{{ route($i['link']) }}">{{ $i['name'] }}</x-dropdown-link>
                                    @endforeach                                
                                @endif
                            @endif
                            
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">{{ __('Log Out') }}</x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endif
        </div>
    </div>
</div>