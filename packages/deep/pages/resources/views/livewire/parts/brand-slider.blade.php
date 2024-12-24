@if($data && count($data) )
    <div class="container py-3 md:py-5">
        <h2 class="heading">Our Esteemed Clients</h2>
        <p class="text-center mb-3">Privileged To Be Associated With</p>
        @if( count($data)< 4 )
            <div class="row">
                @foreach($data as $key => $i)
                    <div wire:key="awards-{{ $i}}" class="col-span-12 md:col-span-4">
                        <img src="{{ optional( $i->media )->path }}" alt="{{ optional($i->media)->alt }}" class="max-w-200 mb-5 mx-auto" loading="lazy" width="130" height="130"/>
                    </div>
                @endforeach
            </div>
        @else
            <div class="relative pt-5" x-data="{swiper: null}" x-init="swiper = new Swiper($refs.container, { loop: true, slidesPerView: 1, spaceBetween: 10, breakpoints: {
                    640: { slidesPerView: 1, spaceBetween: 0, },
                    768: { slidesPerView: 2, spaceBetween: 20, },
                    1200: { slidesPerView: 3, spaceBetween: 20, }, }, })">
                <div class="z-50 absolute bottom-1 md:inset-y-0 left-0 flex items-center overflow-hidden">
                    <button @click="swiper.slidePrev()" class="bg-white -ml-2 lg:-ml-4 flex justify-center items-center w-10 h-10 rounded-full shadow focus:outline-none"><svg viewBox="0 0 20 20" fill="currentColor" class="chevron-left w-6 h-6"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg></button>
                </div>
                <div class="swiper-container" x-ref="container">
                    <div class="swiper-wrapper py-5">
                        @foreach($data as $i)
                        <div wire:key="awards-{{ $i}}" class="swiper-slide">
                            <img src="{{ optional( $i->media )->path }}" alt="{{ optional($i->media)->alt }}" class="max-w-100 mb-5 mx-auto" loading="lazy" width="130" height="130"/>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="z-50 absolute bottom-1 md:inset-y-0 right-0 flex items-center overflow-hidden">
                    <button @click="swiper.slideNext()" class="bg-white -mr-2 lg:-mr-4 flex justify-center items-center w-10 h-10 rounded-full shadow focus:outline-none"><svg viewBox="0 0 20 20" fill="currentColor" class="chevron-right w-6 h-6"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></button>
                </div>
            </div>
        @endif
    </div>
@else
    <div></div>
@endif