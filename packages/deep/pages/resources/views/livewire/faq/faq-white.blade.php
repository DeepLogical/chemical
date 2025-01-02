<div>
    @if( $data && count($data) )
        <div class="container py-3 md:py-5" x-data="{ openTab: null }" @click.away="openTab = null">
            @livewire('headerCrumbOne', [ "heading" => $heading, "paragraph" => $paragraph ])
            
            <div class="py-3 md:py-5">
                @foreach($data as $i)
                    <div wire:key="faq-{{ $loop->index }}">
                        <div class="flex items-center justify-between p-1 md:p-3 border-b-2 hover:cursor-pointer rounded-md" :class="openTab === {{ $loop->index }} ? 'bg-primary text-white' : ''"
                        @click="openTab !== {{ $loop->index }} ? openTab = {{ $loop->index }} : openTab = null">
                            <h2 style="margin: 0" >{{ $i->quest }}</h2>
                            <img x-show="openTab !== {{ $loop->index }}" src="/images/icons/static/right-arrow-black.svg" alt="" class="mr-5 w-6 h-4">
                            <img x-show="openTab === {{ $loop->index }}" src="/images/icons/static/down-arrow-white.svg" alt="" class="mr-5 w-6 h-4">
                        </div>
                        <div class="py-5" x-show="openTab === {{ $loop->index }}">
                            {!! $i->ans !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>