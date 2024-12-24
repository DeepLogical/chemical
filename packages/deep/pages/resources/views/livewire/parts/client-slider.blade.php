@if($data && count($data))
    <div class="container relative" x-data="{swiper: null}" x-init="swiper = new Swiper($refs.container, { loop: true, autoplay: { delay: 4000 }, slidesPerView: 1, spaceBetween: 0, grabCursor: true, centeredSlides: true, breakpoints: {
                        640: { slidesPerView: 3, spaceBetween: 0, },
                        768: { slidesPerView: 4, spaceBetween: 0, },
                        1200: { slidesPerView: 5, spaceBetween: 0, }, },  })">
        <div class="absolute inset-y-0 left-0 z-10 flex items-center">
            <button @click="swiper.slidePrev()" class="flex justify-center items-center rounded-full focus:outline-none"><svg viewBox="0 0 20 20" fill="#000" class="chevron-left w-8 h-8"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg></button>
        </div>
        <div class="swiper-container" x-ref="container">
            <div class="swiper-wrapper">
                @foreach($data as $i)
                    <div wire:key="client-{{ $loop->index }}" class="swiper-slide">
                        <img src="{{ optional($i->media)->path }}" alt="Regtell Client - {{ $i->name }}" class="max-w-200 mx-auto" loading="lazy" width="130" height="130"/>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="absolute inset-y-0 right-0 z-10 flex items-center">
            <button @click="swiper.slideNext()" class="flex justify-center items-center rounded-full focus:outline-none"><svg viewBox="0 0 20 20" fill="#000" class="chevron-right w-8 h-8"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></button>
        </div>
    </div>
@else
    <div></div>
@endif