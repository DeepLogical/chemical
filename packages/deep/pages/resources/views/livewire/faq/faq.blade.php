@if( $data && count($data) )
    <section class="bg-primary">
        <div class="container py-5" x-data="{ openTab: null }">
            <h2 class="heading mb-5 text-left text-white">@if($title) {{ $title }} @else FAQs @endif</h2>
            @foreach($data as $i)
                <div wire:key="faq-{{ $loop->index }}">
                    <div class="flex py-3 border-b-2 hover:cursor-pointer" :class="openTab === {{ $loop->index }} ? 'bg-action' : ''"
                    @click="openTab !== {{ $loop->index }} ? openTab = {{ $loop->index }} : openTab = null">
                        <img x-show="openTab !== {{ $loop->index }}" src="/images/icons/static/plus-pink.svg" alt="" class="mr-5 w-6">
                        <img x-show="openTab === {{ $loop->index }}" src="/images/icons/static/minus-pink.svg" alt="" class="mr-5 w-6">
                        <h2 class="text-white">{{ $i->quest }}</h2>
                    </div>
                    <div class="py-5 text-white" x-show="openTab === {{ $loop->index }}">
                        {!! $i->ans !!}
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@else
    <div></div>
@endif