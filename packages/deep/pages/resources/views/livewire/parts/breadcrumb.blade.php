<div class="">
    @if( $data && count( $data) )
        <ul class="flex items-center">
            @foreach( $data as $i )
                @if( !$loop->last )
                    <li class="flex items-center" wire:key="breadcrumb-{{ $loop->index }}">
                        <a href="{{ $i['url'] }}" class="">{{ $i['name'] }}</a>
                        <img src="/images/icons/static/right-arrow-black.svg" alt="" class="mx-5">
                    </li>
                @else
                    <li class="">{{ $i['name'] }}</li>
                @endif
            @endforeach
        </ul>
    @endif
</div>