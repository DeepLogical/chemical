<div class="admin-sidebar @if( $show ) min-w-250 relative @else hidden @endif">
    <style>
        .min-w-250{
            min-width: 225px;
        }
    </style>
    <ul class="flex flex-col py-4 space-y-1 bg-primary z-10 h-full px-2">
        <li class="btn w-full" wire:click="$set('show', false)">Close</li>
        @foreach($data as $i)
            <div class="hasSublink flex items-center justify-between pr-5 hover:cursor-pointer border-l-4 border-transparent hover:border-blue-500 py-2">
                <li wire:key="sidebar-{{ $loop->index }}">
                    @if($i['link'])
                        <a href="{{ route($i['link']) }}" class="text-white text-sm">{{ $i['name'] }}</a>
                    @else
                        <span class="text-white text-sm">{{ $i['name'] }}</span>
                    @endif
                </li>
                @if( array_key_exists("sublinks", $i) )
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fff" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5"/></svg>
                @endif
            </div>
            @if( array_key_exists("sublinks", $i) )
                <ul class="sublinks pl-5" style="display: none;">
                    @foreach($i['sublinks'] as $j)
                        <li wire:key="sublinks-{{ $loop->index }}" class="pl-3 border-l-4 border-transparent hover:border-blue-500">
                            <a href="{{ route($j['link']) }}" class="text-white text-sm block py-2">{{ $j['name'] }}</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        @endforeach
    </ul>

    @push("scripts")
        <script>
            $(document).ready(function() {
                $('.hasSublink').click(function() {
                    var sublinks = $(this).next('.sublinks');
                    if (sublinks.is(':visible')) {
                        sublinks.hide();
                    } else {
                        $('.sublinks').hide();
                        sublinks.show();
                    }
                });
            });
        </script>
    @endpush
</div>