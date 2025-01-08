<div>
    @if($data && count($data) )
        <div class="container py-3 md:py-5 text-center">
            @livewire('headerCrumbTwo', [ "heading" => $heading, "paragraph" => $paragraph, ])         
            @if( count($data)< 4 )
                <div class="row">
                    @foreach($data as $key => $i) @include('deep::template.single-product-item', ['i' => $i]) @endforeach
                </div>
            @else
                <div class="suggestPodcast relative" x-data="{swiper: null}" x-init="swiper = new Swiper($refs.container, { loop: true, slidesPerView: 1, spaceBetween: 10, centeredSlides: true, grabCursor: true, breakpoints: {
                    640: { slidesPerView: 1, spaceBetween: 0, },
                    768: { slidesPerView: 2, spaceBetween: 10, },
                    1200: { slidesPerView: 3, spaceBetween: 10, }, }, })">
                    <div class="swiper-container" x-ref="container">
                        <div class="swiper-wrapper py-5">
                            @foreach($data as $key => $i)
                            <div class="swiper-slide">
                                @include('deep::template.single-product-item', ['i' => $i])     
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <x-swiper-button/>
            @endif
    
            <div class="text-center">
                <a href="{{ route('home') }}" class="btn">Click For More</a>
            </div>
        </div>
    @endif
</div>