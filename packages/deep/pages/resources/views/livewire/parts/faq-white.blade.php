@if( $data && count($data) )
    <div class="container py-5" x-data="{ tab : 'tab' }" @click.away="tab = 'tab'">
        <h2 class="heading text-left ">@if( $title ) {{ $title }} @else FAQs @endif</h2>
        @if( $content) <p>{{ $content }}</p>@endif
        @foreach($data as $i)
            <div wire:key="faq-{{ $loop->index }}">
                <div class="fijb py-3 border-b-2 hover:cursor-pointer" :class="{ 'bg-primary text-white' : tab === 'tab{{ $loop->index }}'}" @click="tab = 'tab{{ $loop->index }}'">
                    <div class="fijb w-ful">
                        <img x-show="tab != 'tab{{ $loop->index }}'" src="/images/icons/static/plus-icon.svg" alt="" class="mr-5 w-6">
                        <img x-show="tab === 'tab{{ $loop->index }}'" src="/images/icons/static/minus.svg" alt="" class="mr-5 w-6">
                        <h2 class="" :class="tab === 'tab{{ $loop->index }}' ? 'text-pink' : ''" style="margin: 0">{{ $i->quest }}</h2>
                    </div>
                    <img x-show="tab != 'tab{{ $loop->index }}'" src="/images/icons/static/right.svg" alt="" class="mr-5 w-5">
                    <img x-show="tab === 'tab{{ $loop->index }}'" src="/images/icons/static/cross.svg" alt="" class="mr-5 w-5">
                </div>
                <div class="py-5 " x-show="tab === 'tab{{ $loop->index }}'">
                    {!! $i->ans !!}
                </div>
            </div>
        @endforeach
    </div>
@else
    <div></div>
@endif