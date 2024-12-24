<div class="bg-primary py-2">
    <div class="container flex items-center justify-between">
        <ul class="flex item-center">
            @if( config('deep.email') )
                <li><a href="tel:{{ config('deep.email') }}" class="text-white mr-5">{{ config('deep.email') }}</a></li>
            @endif
            @if( config('deep.phone') )
                <li><a href="tel:{{ config('deep.phone') }}" class="text-white">{{ config('deep.phone') }}</a></li>
            @endif
        </ul>    
        <ul class="web">
            @if( config('deep.social') && count( config('deep.social') ) )
                <div class="flex">
                    @foreach( config('deep.social') as $i )
                        <a class="group flex items-center justify-center z-50 m-2" target="_blank" href="{{ $i['url']}}"> 
                            <img src="/images/icons/{{ $i['img-white']}}" alt="Connect on {{ $i['platform']}}" class="w-4 transition duration-500 ease-in-out group-hover:scale-150" width="21" height="21" loading="lazy">
                        </a>
                    @endforeach
                </div>
            @endif
        </ul>
    </div>
</div>