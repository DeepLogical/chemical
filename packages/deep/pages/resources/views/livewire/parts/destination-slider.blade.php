<div class="text-center relative py-12 my-5">
    <h2 class="text-xl md:text-2xl font-bold mb-5">Trending Destinations</h2>
    <div class="container relative" x-data="{swiper: null}" x-init="swiper = new Swiper($refs.container, { loop: true, autoplay: { delay: 4000 }, slidesPerView: 1, spaceBetween: 0, grabCursor: true, centeredSlides: true, breakpoints: {
                    640: { slidesPerView: 2, spaceBetween: 0, },
                    768: { slidesPerView: 3, spaceBetween: 20, },
                    1200: { slidesPerView: 4, spaceBetween: 20, }, },  })">
        <div class="absolute bottom-1 md:inset-y-0 left-0 z-10 flex items-center overflow-hidden">
            <button @click="swiper.slidePrev()" class="-ml-2 lg:-ml-4 flex justify-center items-center w-10 h-10 rounded-full focus:outline-none"><svg viewBox="0 0 20 20" fill="#000" class="chevron-left w-6 h-6"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg></button>
        </div>
        <div class="swiper-container pb-5" x-ref="container">
            <div class="swiper-wrapper">
                @foreach($destinations as $i)
                    <div class="swiper-slide deepShadow rounded-lg overflow-hidden">
                        <img src="/images/static/destinations/{{ $i['img'] }}" alt="{{ $i['name'] }}" class="w-full mx-auto" loading="lazy" width="130" height="130"/>
                        <div class="p-2 lg:p-3">
                            <h3 class="font-bold text-center py-2 lg:py-3">{{ $i['name'] }}</h3>
                            <p class="text-sm md:text-base text-center">{{ $i['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="absolute bottom-1 md:inset-y-0 right-0 z-10 flex items-center overflow-hidden">
            <button @click="swiper.slideNext()" class="-mr-2 lg:-mr-4 flex justify-center items-center w-10 h-10 rounded-full focus:outline-none"><svg viewBox="0 0 20 20" fill="#000" class="chevron-right w-6 h-6"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></button>
        </div>
        <div class="text-center">
            <button class="btn">Book Now</button>
        </div>
    </div>
</div>
