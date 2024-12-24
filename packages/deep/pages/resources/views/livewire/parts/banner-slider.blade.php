<div class="banner relative" x-data="{swiper: null}" x-init="swiper = new Swiper($refs.container, { loop: true, autoplay: { delay: 3000 }, slidesPerView: 1, spaceBetween: 0, effect: 'fade', })">
    <style>
        .banner p{
            color: #fff;
        }
    </style>
    <div class="swiper-container pb-3" x-ref="container">
        <div class="swiper-wrapper">
            @foreach($banner as $key => $i)
                <div class="swiper-slide group relative" wire:key="suggestblog-{{$loop->index}}">
                    <img src="{{ optional($i->media)->path }}" alt="{{ optional($i->media)->alt }}" class="web" width="380" height="380" loading="lazy"/>
                    <img src="{{ optional($i->mobile_media)->path }}" alt="{{ optional($i->mobile_media)->alt }}" class="mobile" width="380" height="380" loading="lazy"/>
                    <div class="container">
                        <div class="container absolute left-0 top-0 flex flex-col justify-center h-full p-6 md:p-12 z-50">
                            <h{{ $key == 0 ? '1' : '2' }} class="text-white heading text-center md:text-left mb-3 md:mb-6">{{ $i->heading }}</h{{ $key == 0 ? '1' : '2' }}>
                            <div class="paragraph subText text-white text-center md:text-left">{!! $i->text !!}</div>
                            @if( $i->url )
                                <div class="flex items-center py-6 md:py-12">
                                    <button class="btn flex items-center justify-center">
                                        <a href="{{ $i->url }}" class="text-sm mr-3">Read More</a>
                                        <img src="/images/icons/static/long-arrow-right.svg" alt="" class="w-30 bg-white rounded-full p-1 md:p-2"/>
                                    </button>
                                    <div class="flex px-3 md:px-6">
                                        <img src="/images/icons/static/calendar-white.svg" alt="" class="w-30 mx-auto mr-2 md:mr-3"/>
                                        <p class="paragraph text-white">{{ \Carbon\Carbon::parse($i->created_at)->isoFormat('Do MMM YYYY')}}</p>                            
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="tint"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 z-10 flex items-center">
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