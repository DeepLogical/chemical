<div>
    <section class="p-12 relative" style="background: url(/images/static/parallels/testimonial-bg.jpg) fixed center no-repeat; background-size: cover;">
        <style>
            .testis-content p{
                color: #fff;
            }
        </style>
        <div class="container relative">
            @if($data && count($data) > 0)
                <div class="flex items-center justify-between">
                    <div class="block">
                        <h2 class="heading text-white">Success Stories Of All Time</h2>
                        <p class="paragraph text-white py-2 md:py-3 mb-3">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took.</p>
                    </div>
                </div>
                @if(count($data) < 4)
                    <div class="row">
                        @foreach($data as $key => $i)
                            @livewire('singleTestimonialItem', ["i" => $i, key($key)])
                        @endforeach
                    </div>
                @else
                    <div class="swiper-container" x-data="{ swiper: null }" x-init="swiper = new Swiper($refs.container, { loop: true, spaceBetween: 30, slidesPerView: 1, breakpoints: { 768: { slidesPerView: 2 }, 1024: { slidesPerView: 3 } }, navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev', }, })" x-ref="container">
                        <div class="swiper-wrapper mb-3 md:mb-6">
                            @foreach($data as $i)
                                <div class="swiper-slide group" wire:key="testis-{{ $loop->index}}">
                                    @livewire('singleTestimonialItem', ["i" => $i])
                                </div>
                            @endforeach
                        </div>
                        <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 z-10 flex items-center">
                            <button @click="swiper.slidePrev()" class="bg-primary mx-2 flex justify-center items-center w-30 h-30 rounded-full shadow focus:outline-none">
                                <svg viewBox="0 0 20 20" fill="#fff" class="chevron-left w-6 h-6">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <button @click="swiper.slideNext()" class="bg-primary mx-2 flex justify-center items-center w-30 h-30 rounded-full shadow focus:outline-none">
                                <svg viewBox="0 0 20 20" fill="#fff" class="chevron-right w-6 h-6">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif
            @endif
        </div>
        <div class="tint"></div>
    </section>
</div>